<?php
require '../config/config.php';
if (empty($_SESSION['username']))
    header('Location: login.php');

try {
    if ($_SESSION['role'] == 'admin') {

        $stmt = $connect->prepare('SELECT * FROM room_bookings ORDER BY created_at DESC');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // if($_SESSION['role'] == 'user'){

    // 	$stmt = $connect->prepare('SELECT * FROM room_rental_registrations WHERE :user_id = user_id ');
    // 	$stmt->execute(array(
    // 		':user_id' => $_SESSION['id']
    // 	));
    // 	$data = $stmt->fetchAll (PDO::FETCH_ASSOC);
    // }
} catch (PDOException $e) {
    $errMsg = $e->getMessage();
}
?>
<?php include '../include/header.php'; ?>

<!-- Header nav -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#212529;" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../index.php">Room-Recommendation-System</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $_SESSION['fullname']; ?> <?php if ($_SESSION['role'] == 'admin') {
                                                                                            echo "(Admin)";
                                                                                        } ?></a>
                </li>
                <li class="nav-item">
                    <a href="../auth/logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- end header nav -->
<section style="padding-left:0px;">
    <?php include '../include/side-nav.php'; ?>
</section>

<section class="wrapper" style="margin-left: 16%;margin-top: -23%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-5 text-center">

                <h2>Booking Lists</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Room</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data as $booking) {
                                $room_id = $booking['room_id'];
                                $stmt = $connect->prepare('SELECT * FROM room_rental_registrations WHERE id = :room_id');
                                $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
                                $stmt->execute();
                                $room = $stmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $i  ?></th>
                                    <td><?php echo $booking['name'] ?></td>
                                    <td><?php echo $booking['email'] ?? '' ?></td>
                                    <td><?php echo $booking['number'] ?></td>
                                    <td><?php echo '(' . $room['rooms'] . ')' . ' ' . $room['address'] ?></td>
                                    <td><?php echo $room['fullname'] ?></td>
                                    <td><?php echo $booking['message'] ?></td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>


<?php include '../include/footer.php'; ?>