<?php
require 'config/config.php';

if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];
    try {
        // Assume $connect is your PDO connection
        $stmt = $connect->prepare("SELECT * FROM room_rental_registrations WHERE id = :room_id");
        $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $stmt->execute();
        $room = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        $errMsg = $e->getMessage();
        echo "Error: " . htmlspecialchars($errMsg);
    }
} else {
    echo "No room ID provided.";
}

if (isset($_POST['book_now'])) {
    $bookingMsg = '';

    // Get data from FROM
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $number = trim($_POST['number']);
    $message = trim($_POST['message']);
    $roomId = $room_id;


    if (empty($name) || empty($number) || empty($message)) {
        $bookingMsg = 'All fields are required.';
    } elseif (!preg_match('/^[0-9]{10}$/', $number)) {
        $bookingMsg = 'Invalid mobile number.';
    } else {


        if (empty($bookingMsg)) {
            try {
                $stmt = $connect->prepare('INSERT INTO room_bookings (name, email, number, message, room_id) VALUES (:name, :email, :number, :message, :room_id)');
                $stmt->execute(array(
                    ':name' => $name,
                    ':email' => $email,
                    ':number' => $number,
                    ':message' => $message,
                    ':room_id' => $roomId,
                ));

                header('Location: room-detail.php?room_id=' . $roomId);
                exit;
            } catch (PDOException $e) {
                $bookingMsg = $e->getMessage();
            }
        }
    }
}

if (isset($_GET['action'])) {
    $bookingMsgSuccess = 'Room Booked Successfully. Thank you';
}

?>
<!DOCTYPE html>
<html lang="en">

<?php
include('include/nav.php');
?>

<?php
if (isset($room['image'])) {
    if (file_exists('app/' . $room['image'])) {
        $imagePath = 'app/' . $room['image'];
    } else {
        $imagePath = 'assets/img/placholder.jpg';
    }
}

?>
<div class="container-fluid px-0">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" style="height:80vh;">
            <div class="carousel-item active">
                <img class="d-block w-100" src="<?php echo $imagePath ?>" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo $imagePath ?>" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo $imagePath ?>" alt="Third slide">
            </div>
        </div>
    </div>
</div>
<div class="bg-secondary py-5">
    <div class="container">
        <h3 class="d-flex justify-content-center align-items-center">
            Room Details
        </h3>
        <div class="row">
            <div class="col-md-4">
                <h5 class="d-flex justify-content-center ">Property Details</h5>
                <div class="text-white">
                   <p>Address:   <?php echo $room['address'] ?></p> 
                </div>
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
</div>
<div class="container my-4">
    <?php
    if(empty($bookingMsg))
    if(isset($bookingMsgSuccess)){
        ?>
        <div class="alert alert-success">
       <?php   $bookingMsgSuccess ?>
</div>
<?php }else{ 
    if(isset($bookingMsg)){?>
<div class="alert alert-danger">
    <?php   $bookingMsg ?>
    </div>
    
<?php }} ?>
    
    
    <h3 class="d-flex justify-content-center">Book Now</h3>
    <form action="" method="POST" class="row">
        <div class="col-12">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="col-12">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="col-12">
            <label for="number">Number</label>
            <input type="number" name="number" class="form-control">
        </div>
        <div class="col-12">
            <label for="message">Message</label>
            <textarea name="message" class="form-control"></textarea>
        </div>
        <div class="d-flex justify-content-center pt-5">
            <button type="submit" class="btn btn-primary" name="book_now">Book Now</button>
        </div>
    
</form>
</div>


<?php
include('include/footer.php');
?>