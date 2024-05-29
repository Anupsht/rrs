<!-- <div class="row"> -->			
  <div class="col-md-11 col-xs-12 col-sm-12">
  	<div class="alert alert-dark" role="alert">
  		<?php
			if(isset($errMsg)){
				echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
			}
		?>
  		<h2 class="text-center">Register Room</h2>
  		<form action="" method="post" enctype="multipart/form-data">
		  	 <div class="row">
		  	 	<div class="col-md-4">
			  	  <div class="form-group">
				    <label for="fullname">Full Name</label>
				    <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : ''; ?>">
				  </div>
				 </div>

				<div class="col-md-4">
				  <div class="form-group">
				    <label for="mobile">Mobile</label>
				    <input type="number" class="form-control" pattern="^(\d{10})$" id="mobile" title="10 digit mobile number" placeholder="10 digit mobile number" name="mobile"  value="<?php echo isset($_POST['mobile']) ? $_POST['mobile'] : ''; ?>">
				  </div>
				 </div>

				<div class="col-md-4">
				  <div class="form-group">
				    <label for="alternat_mobile">Alternate Mobile</label>
				    <input type="number" class="form-control" pattern="^(\d{10})$" id="alternat_mobile" title="10 digit mobile number" placeholder="10 digit mobile number" name="alternat_mobile" value="<?php echo isset($_POST['alternat_mobile']) ? $_POST['alternat_mobile'] : ''; ?>">
				  </div>
				</div>
			</div>

			<div class="row">
		  	 	<div class="col-md-4">
				  <div class="form-group">
				    <label for="email">Email</label>
				    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
				  </div>
				 </div>

				 <div class="col-md-4">
				  <div class="form-group">
				    <label for="plot_number">Plot Number/Home Number</label>
				    <input type="text" class="form-control" id="plot_number" placeholder="Plot Number/Home Number" name="plot_number" value="<?php echo isset($_POST['plot_number']) ? $_POST['plot_number'] : ''; ?>">
				  </div>
				 </div>

				 <div class="col-md-4">
				  <div class="form-group">
				    <label for="rooms">Available Rooms</label>
				    <input type="text" class="form-control" id="rooms" placeholder="1BHK/2BHK/3BHK/1RK" name="rooms" value="<?php echo isset($_POST['rooms']) ? $_POST['rooms'] : ''; ?>">
				  </div>
				 </div>
			</div>

			<div class="row">
				<div class="col-md-4">
			  <div class="form-group">
			    <label for="country">Country</label>
			    <input type="text" class="form-control" id="country" placeholder="Country" name="country" value="<?php echo isset($_POST['country']) ? $_POST['country'] : ''; ?>">
			  </div>
			  </div>

			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="state">State</label>
			    <input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?php echo isset($_POST['state']) ? $_POST['state'] : ''; ?>">
			  </div>
			  </div>
			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="city">City</label>
			    <input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : ''; ?>">
			  </div>
			  </div>
			 </div>

			 <div class="row">
			 	<div class="col-md-2">
			 <div class="form-group">
			    <label for="rent">Rent</label>
			    <input type="text" class="form-control" id="rent" placeholder="Rent" name="rent" value="<?php echo isset($_POST['rent']) ? $_POST['rent'] : ''; ?>">
			  </div>
			  </div>

			  <div class="col-md-2">
			 <div class="form-group">
			    <label for="sale">Sale</label>
			    <input type="text" class="form-control" id="sale" placeholder="Sale" name="sale" value="<?php echo isset($_POST['sale']) ? $_POST['sale'] : ''; ?>">
			  </div>
			  </div>

			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="deposit">Deposit</label>
			    <input type="text" class="form-control" id="deposit" placeholder="Deposit" name="deposit"  value="<?php echo isset($_POST['deposit']) ? $_POST['deposit'] : ''; ?>">
			  </div>
			  </div>
			  <div class="col-md-4">

			  <div class="form-group">
			    <label for="accommodation">Facilities</label>
			    <input type="text" class="form-control" id="accommodation" placeholder="Facilities" name="accommodation" value="<?php echo isset($_POST['accommodation']) ? $_POST['accommodation'] : ''; ?>">
			  </div>
			  </div>
			  </div>

			   <div class="row">
			 	<div class="col-md-4">
			  <div class="form-group">
			    <label for="description">Description</label>
			    <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="<?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?>">
			  </div>
			   </div>
			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="landmark">Landmark</label>
			    <input type="text" class="form-control" id="landmark" placeholder="landmark" name="landmark" value="<?php echo isset($_POST['landmark']) ? $_POST['landmark'] : ''; ?>">
			  </div>
			   </div>
			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="address">Address</label>
			    <input type="text" class="form-control" id="address" placeholder="Address" name="address"  value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>">
			  </div>
			   </div>
			    </div>				  
			  
			   <div class="row">
			   	<div class="col-4">
			 		 <div class="form-group">
					    <label for="vacant">Vacant/Occupied</label>
					    <select class="form-control" id="vacant" name="vacant">
					      <option value="1">Vacant</option>
					      <option value="0">Occupied</option>
					    </select>
					  </div>
			 	</div>
				<div class="col-md-4">
			  <div class="form-group">
			    <label for="image">Image</label>
			    <input type="file" name="image[]" id="image" multiple>
			  </div>
			  </div>
			  </div>			
			  <button type="submit" class="btn btn-secondary btn-lg" name='register_individuals' value="register_individuals">Submit</button>
			</form>	
			</div>			
  	</div>
<!-- </div> -->