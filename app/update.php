<?php
require '../config/config.php';

if (empty($_SESSION['username'])) {
	header('Location: login.php');
	exit;
}

$data = [
	'id' => '',
	'fullname' => '',
	'email' => '',
	'mobile' => '',
	'alternat_mobile' => '',
	'plot_number' => '',
	'rooms' => '',
	'country' => '',
	'state' => '',
	'city' => '',
	'address' => '',
	'landmark' => '',
	'rent' => '',
	'sale' => '',
	'deposit' => '',
	'description' => '',
	'accommodation' => '',
	'vacant' => '',
	'other' => ''
];

if (isset($_GET['id'])) {
	$id = $_REQUEST['id'];
	try {
		$stmt = $connect->prepare('SELECT * FROM room_rental_registrations WHERE id = :id');
		$stmt->execute([':id' => $id]);
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

if (isset($_POST['register_individuals'])) {
	$errMsg = '';
	// Get data from FORM
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$alternat_mobile = $_POST['alternat_mobile'];
	$plot_number = $_POST['plot_number'];
	$country = $_POST['country'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$address = $_POST['address'];
	$landmark = $_POST['landmark'];
	$rent = $_POST['rent'];
	$deposit = $_POST['deposit'];
	$description = $_POST['description'];
	$user_id = $_SESSION['id'];
	$accommodation = $_POST['accommodation'];
	$other = $_POST['other'];
	$vacant = $_POST['vacant'];
	$rooms = $_POST['rooms'];
	$id = $_POST['id'];
	$sale = $_POST['sale'];


	if (empty($fullname) || empty($email) || empty($mobile) || empty($plot_number) || empty($country) || empty($state) || empty($city) || empty($address) || empty($rent) || empty($deposit) || empty($description) || empty($rooms) || empty($vacant) || empty($sale)) {
		$errMsg = 'All fields are required.';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errMsg = 'Invalid email format.';
	} elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
		$errMsg = 'Invalid mobile number.';
	} else {


		if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != '') {
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			// Check if the file is an image
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if ($check === false) {
				$errMsg = "File is not an image.";
			} elseif ($_FILES["image"]["size"] > 500000) { // Adjust the file size limit as needed
				$errMsg = "File is too large.";
			} elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				$errMsg = "Only JPG, JPEG, PNG files are allowed.";
			} else {
				// Move the uploaded file to the target location
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
					// Update the database with the new image file path
					if (empty($errMsg)) {
						try {
							$stmt = $connect->prepare('UPDATE room_rental_registrations SET image = ? WHERE id = ?');
							$stmt->execute([$target_file, $_POST['id']]);
						} catch (PDOException $e) {
							$errMsg = 'Error updating database: ' . $e->getMessage();
						}
					}
				} else {
					$errMsg = 'Sorry, there was an error uploading your file.';
				}
			}
		}


		if (empty($errMsg)) {
			try {
				$stmt = $connect->prepare('UPDATE room_rental_registrations SET fullname = ?, email = ?, mobile = ?, alternat_mobile = ?, plot_number = ?, rooms = ?, country = ?, state = ?, city = ?, address = ?, landmark = ?, rent = ?, sale = ?, deposit = ?, description = ?, accommodation = ?, vacant = ?, user_id = ? WHERE id = ?');
				$stmt->execute([
					$fullname,
					$email,
					$mobile,
					$alternat_mobile,
					$plot_number,
					$rooms,
					$country,
					$state,
					$city,
					$address,
					$landmark,
					$rent,
					$sale,
					$deposit,
					$description,
					$accommodation,
					$vacant,
					$user_id,
					$id
				]);
				$_SESSION['success_message'] = 'Update successful. Thank you';
				header('Location: list.php');
				exit;
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
}

if (isset($_GET['action']) && $_GET['action'] == 'reg') {
	$errMsg = 'Update successfull. Thank you';
}


?>
<?php include '../include/header.php'; ?>
<!-- Header nav -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#212529;" id="mainNav">
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
<?php include '../include/side-nav.php'; ?>
<section class="wrapper" style="margin-left: 16%;margin-top: -11%;">
	<?php
	include 'partials/edit/individaul.php';
	?>
</section>
<?php include '../include/footer.php'; ?>