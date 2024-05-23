<?php
require 'config/config.php';
$data = [];

if (isset($_POST['search'])) {
  // Get data from FORM
  $keywords = $_POST['keywords'];
  $location = $_POST['location'];

  //keywords based search
  $keyword = explode(',', $keywords);
  $concats = "(";
  $numItems = count($keyword);
  $i = 0;
  foreach ($keyword as $key => $value) {
    # code...
    if (++$i === $numItems) {
      $concats .= "'" . $value . "'";
    } else {
      $concats .= "'" . $value . "',";
    }
  }
  $concats .= ")";
  //end of keywords based search

  //location based search
  $locations = explode(',', $location);
  $loc = "(";
  $numItems = count($locations);
  $i = 0;
  foreach ($locations as $key => $value) {
    # code...
    if (++$i === $numItems) {
      $loc .= "'" . $value . "'";
    } else {
      $loc .= "'" . $value . "',";
    }
  }
  $loc .= ")";

  //end of location based search

  try {
    //foreach ($keyword as $key => $value) {
    # code...



    $stmt = $connect->prepare("SELECT * FROM room_rental_registrations WHERE country IN $concats OR country IN $loc OR state IN $concats OR state IN $loc OR city IN $concats OR city IN $loc OR rooms IN $concats OR address IN $concats OR address IN $loc OR landmark IN $concats OR rent IN $concats OR deposit IN $concats");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    $errMsg = $e->getMessage();
  }
}

if (isset($_POST['book_now'])) {
  $bookingMsg = '';

  // Get data from FROM
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $number = trim($_POST['number']);
  $message = trim($_POST['message']);


  if (empty($name) || empty($number) || empty($message)) {
    $bookingMsg = 'All fields are required.';
  } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
    $bookingMsg = 'Invalid mobile number.';
  } else {


    if (empty($bookingMsg)) {
      try {
        $stmt = $connect->prepare('INSERT INTO room_bokings (name, email, number, message) VALUES (:name, :email, :number, :message)');
        $stmt->execute(array(
          ':name' => $name,
          ':email' => $email,
          ':number' => $number,
          ':message' => $message,
        ));

        header('Location: index.php?action=reg');
        exit;
      } catch (PDOException $e) {
        $bookingMsg = $e->getMessage();
      }
    }
  }
}

if (isset($_GET['action']) && $_GET['action'] == 'reg') {
  $bookingMsg = 'Room Booked Successfully. Thank you';
}

try {
  $stmt = $connect->prepare("SELECT * FROM room_rental_registrations ");
  $stmt->execute();
  $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $errMsg = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include('include/nav.php');
?>


<!-- Header -->
<header class="masthead">
  <div class="container">
    <div class="intro-text">
      <div class="intro-lead-in">Welcome To Room Recommendation System</div>
      <div class="intro-heading text-uppercase">Find ROOM Together!<br></div>
      <!-- <h1><span class="typed-text"></span><span class="cursor">&nbsp;</span></h1> -->

    </div>
  </div>
</header>

<!-- section -->
<section class="banner d-flex align-items-center min-h-100 gap-2">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12 d-flex flex-column gap-3">
        <h1 class="mb-2">Find Your Perfect Room with Ease</h1>
        <p class="text-justify mb-3">Explore a diverse selection of rooms and book your ideal stay effortlessly.
          With
          competitive prices
          and user-friendly features, Room Finders makes finding and booking rooms simple and stress-free.</p>
        <a href="#" id="#rooms" class=" text-black ">Book Your room today</a>
      </div>

      <div class="col-lg-6">
        <figure class="d-none d-lg-block">
          <img src="assets/img/banner-img.webp" class="img-fluid" alt="Room Image">
        </figure>
      </div>
    </div>
  </div>
</section>

<!-- Search -->
<section id="search">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading text-uppercase">Search</h2>
        <h3 class="section-subheading text-muted">Make a quick search at our number of services!</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form action="" method="POST" class="center" novalidate>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" id="keywords" name="keywords" type="text" placeholder="Keywords (Ex: 1 BHK, Rent Amount, Landmark)" required data-validation-required-message="Please enter keywords">
                <p class="help-block text-danger"></p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input class="form-control" id="location" type="text" name="location" placeholder="Location" required data-validation-required-message="Please enter location.">
                <p class="help-block text-danger"></p>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <button id="" class="btn btn-success btn-md text-uppercase" name="search" value="search" type="submit">Search</button>
              </div>
            </div>
          </div>
        </form>

        <?php
        if (isset($errMsg)) {
          echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
        }
        if (count($data) !== 0) {
          echo "<h2 class='text-center'>Available Results:</h2>";
        } else {
          // echo "<h2 class='text-center' style='color:red;'>Try Some other keywords</h2>";
        }
        ?>
        <?php
        foreach ($data as $key => $value) {
          echo '<div class="card card-inverse card-info mb-3" style="padding:1%;">          
                        <div class="card-block">';
          echo '<div class="row">
                            <div class="col-8">
                            <div class="row">
                              <div class="col-6">
                                <h4 class="text-center">Property Details</h4>';
          if (isset($value['rent'])) {
            echo '<p><b>Rent: </b>$' . $value['rent'] . ' <small><i>per month</i></small></p>';
          }

          if (isset($value['sale'])) {
            echo '<p><b>Sale: </b>$' . $value['sale'] . '</p>';
          }

          echo '<p><b>Available Rooms: </b>' . $value['rooms'] . '</p>';
          echo '<p><b>Address: </b>' . $value['address'] . '</p><p><b> Landmark: </b>' . $value['landmark'] . '</p>';
          echo '</div>
                              <div class="col-6">
                                <h4>Other Details</h4>';
          echo '<p><b>Accommodation: </b>' . $value['accommodation'] . '</p>';
          echo '<p><b>Description: </b>' . $value['description'] . '</p>';
          if ($value['vacant'] == 0) {
            echo '<div class="alert alert-danger" role="alert"><h3><b>Occupied</b></h3></div>';
          } else {
            echo '<div class="alert alert-success" role="alert"><h3><b>Vacant!</b></h3></div>';
          }
          echo '</div>
                            </div>
                            </div>
                            <div class="col-4">';
          if ($value['image'] !== 'uploads/') {
            echo '<h4 class="text-center">Room Image</h4>';
            echo '<img src="app/' . $value['image'] . '" width="100%" class="img-thumbnail">';
          }
          echo '</div>
                          </div>              
                         </div>
                      </div>';
        }
        ?>
      </div>
    </div>
  </div>
  <br><br><br><br>
</section>


<!-- Room Section -->
<section style="background-color: #ccc;">
  <div class="container">
    <div class="d-flex justify-content-center mb-3">
      <h2 class="section-heading text-uppercase" id="rooms">Rooms</h2>
    </div>
    <div class="row">
      <?php foreach ($rooms as $room) { ?>
        <div class="col-lg-4">
          <div class="card mb-2">
            <?php
            if (isset($room['image'])) {
              if (file_exists('app/' . $room['image'])) {
                $imagePath = 'app/' . $room['image'];
              } else {
                $imagePath = 'assets/img/placholder.jpg';
              }
            }

            ?>
            <img class="card-img-top" src="<?php echo $imagePath ?>" height=200px alt="Card image cap">
            <span class="room-status" <?php echo $room['vacant'] == 1 ? 'style="background-color:green;"' : 'style="background-color:red;"'; ?>><?php echo $room['vacant'] == 1 ? 'Vacant' : ' Occupied' ?></span>

            <div class="card-body">
              <h5 class="card-title"><?php echo $room['address'] ?></h5>
              <p class="card-text"><?php echo $room['description'] ?></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><?php echo "Rent Rs " . $room['rent'] ?></li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Vestibulum at eros</li>
            </ul>
            <div class="card-body d-flex justify-content-between">
              <a href="#" class="card-link">View More</a>
              <a href="room-detail.php?room_id=<?php echo $room['id'] ?>" class="card-link">Book Now</a>
            </div>



            <!-- Modal -->
            

          </div>
        </div>
      <?php } ?>

    </div>
  </div>
</section>

<?php
include('include/footer.php');
?>