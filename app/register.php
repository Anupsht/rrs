<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');

	$errMsg = '';
	if(isset($_POST['register_individuals'])) {
	$errMsg = '';

			// Get data from FROM
			$fullname = trim($_POST['fullname']);
			$email = trim($_POST['email']);
			$mobile = trim($_POST['mobile']);
			$alternat_mobile = trim($_POST['alternat_mobile']);
			$plot_number = trim($_POST['plot_number']);
			$country = trim($_POST['country']);
			$state = trim($_POST['state']);
			$city = trim($_POST['city']);
			$address = trim($_POST['address']);
			$landmark = trim($_POST['landmark']);
			$rent = trim($_POST['rent']);
			$deposit = trim($_POST['deposit']);
			$description = trim($_POST['description']);
			$user_id = $_SESSION['id'];
			$accommodation = trim($_POST['accommodation']);
			$rooms = trim($_POST['rooms']);
			$vacant = trim($_POST['vacant']);
			$sale = trim($_POST['sale']);


			if(empty($fullname) || empty($email) || empty($mobile) || empty($plot_number) || empty($country) || empty($state) || empty($city) || empty($address) || empty($rent) || empty($deposit) || empty($description) || empty($rooms) || empty($sale)) {
				$errMsg = 'All fields are required.';
			} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errMsg = 'Invalid email format.';
			} elseif(!preg_match('/^[0-9]{10}$/', $mobile)) {
				$errMsg = 'Invalid mobile number.';
			} else {
				// Upload an image
				$target_file = "";
				if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != '') {
					$target_file = "uploads/".basename($_FILES["image"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
					$check = getimagesize($_FILES["image"]["tmp_name"]);
					if($check !== false) {
						if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
							$uploadOk = 1;
						} else {
							$errMsg = 'Sorry, there was an error uploading your file.';
							$uploadOk = 0;
						}
					} else {
						$errMsg = 'File is not an image.';
						$uploadOk = 0;
					}
				}
	
				if (empty($errMsg)) {
					try {
						$stmt = $connect->prepare('INSERT INTO room_rental_registrations (fullname, email, mobile, alternat_mobile, plot_number, rooms, country, state, city, address, landmark, rent, sale, deposit, description, image, accommodation, vacant, user_id) VALUES (:fullname, :email, :mobile, :alternat_mobile, :plot_number, :rooms, :country, :state, :city, :address, :landmark, :rent, :sale, :deposit, :description, :image, :accommodation, :vacant, :user_id)');
						$stmt->execute(array(
							':fullname' => $fullname,
							':email' => $email,
							':mobile' => $mobile,
							':alternat_mobile' => $alternat_mobile,
							':plot_number' => $plot_number,
							':rooms' => $rooms,
							':country' => $country,
							':state' => $state,
							':city' => $city,
							':address' => $address,
							':landmark' => $landmark,
							':rent' => $rent,
							':sale' => $sale,
							':deposit' => $deposit,
							':description' => $description,
							':accommodation' => $accommodation,
							':image' => $target_file,
							':vacant' => $vacant,
							':user_id' => $user_id
						));
	
						header('Location: register.php?action=reg');
						exit;
					}
					catch(PDOException $e) {
						$errMsg = $e->getMessage();
					}
				}
			}
		}
	
		if(isset($_GET['action']) && $_GET['action'] == 'reg') {
			$errMsg = 'Registered. Thank you';
		}
?>
<?php include '../include/header.php';?>
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
              <a class="nav-link" href="#"><?php echo $_SESSION['fullname']; ?> <?php if($_SESSION['role'] == 'admin'){ echo "(Admin)"; } ?></a>
            </li>
            <li class="nav-item">
              <a href="../auth/logout.php" class="nav-link">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
	<!-- end header nav -->
<?php include '../include/side-nav.php';?>
<section class="wrapper" style="margin-left: 16%;margin-top: -11%;">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link active" data-toggle="tab" href="#home" role="tab"> Room Registration</a>
	  </li>
	  
	</ul>

	<div class="tab-content">
	<!-- Single room -->
	  <div class="tab-pane active" id="home" role="tabpanel"><br>
	  		<?php include 'partials/individaul.php';?>
	  </div>

	
	</div>	
</section>
<?php include '../include/footer.php';?>
<script type="text/javascript">
	var rowCount = 1;
	function addMoreRows(frm) {
		rowCount ++;
		var recRow = '<div id="rowCount'+rowCount+'"><div class="row"><div class="col-md-4"><div class="form-group"><br> <a href="javascript:void(0);" onclick="removeRow('+rowCount+');" class="btn btn-danger btn-sm">Delete</a> </div> </div></div><div class="row"> <div class="col-md-4"><div class="form-group"> <label for="fullname">Full Name</label> <input type="fullname" class="form-control" id="fullname" placeholder="Full Name" name="fullname[]" required> </div> </div> <div class="col-md-4"><div class="form-group"> <label for="ap_number_of_plats">Flat Number</label> <input type="ap_number_of_plats" class="form-control" id="ap_number_of_plats" placeholder="Flat Number" name="ap_number_of_plats[]" required> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="rooms">Rooms</label> <input type="rooms" class="form-control" id="rooms" placeholder="2BHK/3BHK/1RK" name="rooms[]" required> </div> </div></div><div class="row"> <div class="col-md-4"> <div class="form-group"> <label for="area">Area</label> <input type="area" class="form-control" id="area" placeholder="Area" name="area[]"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="purpose">Purpose</label> <select class="form-control" id="purpose" name="purpose[]"> <option value="Residential">Residential</option> <option value="Commercial">Commercial</option> </select> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="floor">Floor</label> <select class="form-control" id="floor" name="floor[]"> <option value="Ground Floor">Ground Floor</option> <option value="1st">1st</option> <option value="2nd">2nd</option> <option value="3rd">3rd</option> <option value="4th">4th</option> <option value="5th">5th</option> <option value="6th">6th</option> <option value="7th">7th</option> <option value="8th">8th</option> </select> </div> </div> </div> <div class="row"><div class="col-md-4"> <div class="form-group"> <label for="ownership">Owner/Rented</label> <select class="form-control" id="ownership" name="own[]"> <option value="owner">Owner</option> <option value="rented">Rented</option> </select> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="rent">Rent</label> <input type="rent" class="form-control" id="rent" placeholder="Rent" name="rent[]"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="deposit">Deposit</label> <input type="deposit" class="form-control" id="deposit" placeholder="Deposit" name="deposit[]"> </div> </div>  </div><div class="row"><div class="col-md-4"> <div class="form-group"> <label for="accommodation">Facilities</label> <input type="accommodation" class="form-control" id="accommodation" placeholder="Facilities" name="accommodation[]"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="description">Description</label> <input type="description" class="form-control" id="description" placeholder="Description" name="description[]" required> </div> </div> <div class="col-4"> <div class="form-group"> <label for="vacant">Vacant/Occupied</label> <select class="form-control" id="vacant" name="vacant[]"> <option value="1">Vacant</option> <option value="0">Occupied</option> </select> </div> </div> </div></div>'; $('#addedRows').append(recRow);
	}
	function removeRow(removeNum) {
		$('#rowCount'+removeNum).remove();
	}
</script>