<!-- <div class="row"> -->
<div class="col-md-11 col-xs-12 col-sm-12">
	<div class="alert alert-dark" role="alert">
		<?php
		if (isset($errMsg)) {
			echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
		}
		?>
		<h2 class="text-center">Register Room</h2>
		<form action="" method="POST" enctype="multipart/form-data">

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="fullname">Full Name</label>
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
						<input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" value="<?php echo htmlspecialchars($data['fullname']); ?>">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="mobile">Mobile</label>
						<input type="number" class="form-control" id="mobile" placeholder="Mobile" name="mobile" value="<?php echo htmlspecialchars($data['mobile']); ?>">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="alternat_mobile">Alternat Mobile</label>
						<input type="number" class="form-control" id="alternat_mobile" placeholder="Alternat Mobile" name="alternat_mobile" value="<?php echo htmlspecialchars($data['alternat_mobile']); ?>">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="plot_number">Plot Number/Home Number</label>
						<input type="text" class="form-control" id="plot_number" placeholder="Plot Number/Home Number" name="plot_number" value="<?php echo htmlspecialchars($data['plot_number']); ?>">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="rooms">Available Rooms</label>
						<input type="text" class="form-control" id="rooms" placeholder="1BHK/2BHK/3BHK/1RK" name="rooms" value="<?php echo htmlspecialchars($data['rooms']); ?>">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="country">Country</label>
						<input type="text" class="form-control" id="country" placeholder="Country" name="country" value="<?php echo htmlspecialchars($data['country']); ?>">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="state">State</label>
						<input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?php echo htmlspecialchars($data['state']); ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="city">City</label>
						<input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?php echo htmlspecialchars($data['city']); ?>">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="rent">Rent</label>
						<input type="text" class="form-control" id="rent" placeholder="Rent" name="rent" value="<?php echo htmlspecialchars($data['rent']); ?>">
					</div>
				</div>

				<div class="col-md-2">
					<div class="form-group">
						<label for="sale">Sale</label>
						<input type="text" class="form-control" id="sale" placeholder="Sale" name="sale" value="<?php echo htmlspecialchars($data['sale']); ?>">
					</div>
				</div>


				<div class="col-md-4">
					<div class="form-group">
						<label for="deposit">Deposit</label>
						<input type="text" class="form-control" id="deposit" placeholder="Deposit" name="deposit" value="<?php echo htmlspecialchars($data['deposit']); ?>">
					</div>
				</div>
				<div class="col-md-4">

					<div class="form-group">
						<label for="accommodation">Accommodation</label>
						<input type="text" class="form-control" id="accommodation" placeholder="Accommodation" name="accommodation" value="<?php echo htmlspecialchars($data['accommodation']); ?>">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="description">Description</label>
						<input type="text" class="form-control" id="description" placeholder="Description" name="description" value="<?php echo htmlspecialchars($data['description']); ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="landmark">Landmark</label>
						<input type="text" class="form-control" id="landmark" placeholder="landmark" name="landmark" value="<?php echo htmlspecialchars($data['landmark']); ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" class="form-control" id="address" placeholder="Address" name="address" value="<?php echo htmlspecialchars($data['address']); ?>">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="vacant">Vacant/Occupied</label>
						<select class="form-control" id="vacant" name="vacant" required>
							<option value="1" <?php if ($data['vacant'] == '1') echo 'selected'; ?>>Vacant</option>
							<option value="0" <?php if ($data['vacant'] == '0') echo 'selected'; ?>>Occupied</option>
						</select>

					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="other">Other</label>
						<input type="text" class="form-control" id="other" placeholder="Other" name="other" value="<?php echo htmlspecialchars($data['other'] ?? ''); ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="description">Image</label>
						<input type="file" class="form-control" id="image" name="image">
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary" name='register_individuals'>Submit</button>
		</form>
	</div>
</div>
<!-- </div> -->