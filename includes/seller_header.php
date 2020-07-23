<!-- Header shown after seller is logged in -->
<<<<<<< HEAD
<div class="profile-menu">
			<div>
				<label onclick="show_change_password_popup()"><i class="fa fa-lock"></i>&nbsp;&nbsp;Change Password</label>
				<a href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log-Out</a>
			</div>
</div>

<div class="change-password-popup">
	<div class="cancel-icon-container">
		<img src="images/cancel.jpg" onclick="hide_change_password_popup()">
	</div>
	<form>				
		<input type="Password" name="old_pass" placeholder="Old Password">
		<input type="Password" name="old_pass" placeholder="New Password">
		<input type="Password" name="old_pass" placeholder="Re-enter Password">
		<input type="submit" value="Update" id="update-btn">
	</form>
</div>


=======
>>>>>>> master
<div class="logged-in-header">
	<div class="left">
		<a href="seller_home.php">Home</a>
		<a href="seller_dashboard.php">Dashboard</a>
	</div>
	<div class="right">
		<a href="seller_view_shops.php">View Shops</a>
<<<<<<< HEAD
		<label onclick="show_profile_menu()"><?php echo $_SESSION['seller_name'];?>&nbsp;<i class="fa fa-caret-down"></i></label>
=======
		<a href="">Manage Shops</a>
		<a href="">View Orders</a>
		<label>User Name</label>
		<a href="logout.php">Logout</a>
>>>>>>> master
	</div>
</div>
