<!-- Header shown after seller is logged in -->
<div class="profile-menu">
			<div>
				<label onclick="show_change_password_popup()"><i class="fa fa-lock"></i>&nbsp;&nbsp;Change Password</label>
				<a href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log-Out</a>
			</div>
</div>

<div class="change-password-popup">
	<div class="cancel-icon-container">
		<label>Change Password</label>
		<label><i onclick="hide_change_password_popup()" class="fa fa-close"></i></label>
		<img src="images/cancel.jpg" onclick="hide_change_password_popup()">
	</div>
	<form>				
		<input type="Password" name="old_pass" placeholder="Old Password">
		<input type="Password" name="old_pass" placeholder="New Password">
		<input type="Password" name="old_pass" placeholder="Re-enter Password">
		<input type="submit" value="Update" id="update-btn">
	</form>
</div>

<div class="logged-in-header">
	<div class="left">
		<a href="seller_home.php">Home</a>
		<a href="seller_dashboard.php">Dashboard</a>
	</div>
	<div class="right">
		<a href="seller_dashboard.php?register=true">Register New Shop</a>
		<a href="seller_view_shops.php">View Shops</a>
		<label onclick="show_profile_menu()"><?php echo $_SESSION['seller_name'];?>&nbsp;<i class="fa fa-caret-down"></i></label>
	</div>
</div>


<div class="success-pop-up">
	<?php 
	if(isset($_SESSION['message']))
		echo $_SESSION['message'];
	?>
</div>
