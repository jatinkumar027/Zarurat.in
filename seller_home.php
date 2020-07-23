<!-- Model -->
<?php
    require_once("includes/common.php");

//Logged in user redirected to dashboard

if (isset($_SESSION['email'])) {
    header('location: seller_dashboard.php');
    exit;
}

//checking which submit button is clicked and running the code accordingly

if(isset($_POST['signin']))
{
	// Getting the values from the signin page using $_POST[] and cleaning the data submitted by the user.

	  $signinemailmobile = $_POST['signinemail-mobile'];
	  $signinemailmobile = mysqli_real_escape_string($con, $signinemailmobile);

	  $signinpass = $_POST['signinpass'];
	  $signinpass = mysqli_real_escape_string($con, $signinpass);
	  $signinpass = MD5($signinpass);

		// Query checks if the email / mobile number and password are present in the database.
	  $query = "SELECT seller_id, seller_email FROM seller_reg_personal WHERE (seller_email='" . $signinemailmobile . "' OR seller_contact='" . $signinemailmobile . "') AND seller_password='" . $signinpass . "'";
	  $result = mysqli_query($con, $query)or die(mysqli_error($con));
	  $num = mysqli_num_rows($result);

	// If the email and password are not present in the database, the mysqli_num_rows returns 0, it is assigned to $num.

	if ($num == 0) {

		$_SESSION['failure']="Please enter correct E-mail id / Mobile Number or Password";
		header("Location:seller_home.php");
		return;

	} else {
	  $row = mysqli_fetch_array($result);
	  $_SESSION['email'] = $row['seller_email'];
	  $_SESSION['seller_id'] = $row['seller_id'];
	  header('location: seller_dashboard.php');
		//seller is logged in and redirected to the dashboard
	}
}

elseif (isset($_POST['signup'])) {
  // Getting the values from the signup page using $_POST[] and cleaning the data submitted by the user.
	  $name = $_POST['name'];
	  $name = mysqli_real_escape_string($con, $name);

	  $email = $_POST['e-mail'];
	  $email = mysqli_real_escape_string($con, $email);

	  $password = $_POST['password'];
	  $password = mysqli_real_escape_string($con, $password);
	  $password = MD5($password);

	  $contact = $_POST['contact'];
	  $contact = mysqli_real_escape_string($con, $contact);

	  $address = $_POST['address'];
	  $address = mysqli_real_escape_string($con, $address);

		$state = $_POST['state'];
		$state = mysqli_real_escape_string($con, $state);

		$pincode = $_POST['pincode'];
		$pincode = mysqli_real_escape_string($con, $pincode);

	  $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
	  $regex_num = "/^[789][0-9]{9}$/";
		$regex_pin = "/^[0-9]{6}$/";

	  //query checking if user already Exists
	  $query = "SELECT * FROM seller_reg_personal WHERE seller_email='$email'";
	  $result = mysqli_query($con, $query)or die(mysqli_error($con));
	  $num = mysqli_num_rows($result);

   //Data Validation and passing error messages
    if ($num != 0) {
			$_SESSION['failure']="Email Already Exists";
			header("Location:sellerhome.php");
			return;

  } else if (!preg_match($regex_email, $email)) {
			$_SESSION['failure']="Not a valid Email Id";
			header("Location:sellerhome.php");
			return;

  } else if (!preg_match($regex_num, $contact)) {
			$_SESSION['failure']="Not a valid phone number";
			header("Location:sellerhome.php");
			return;

  }else if (!preg_match($regex_pin, $pincode)) {
	    $_SESSION['failure']="Not a valid pincode";
			header("Location:sellerhome.php");
	    return;
  } else {
		//Query inserts values into signup page
	    $query = "INSERT INTO seller_reg_personal(seller_name, seller_contact, seller_email, seller_home_add, seller_state, seller_pincode, seller_password)VALUES
			('" . $name . "','" . $contact . "','" . $email . "','" . $address . "','" . $state . "','" . $pincode . "','" . $password . "')";
	    mysqli_query($con, $query) or die(mysqli_error($con));
	    $user_id = mysqli_insert_id($con);
	    $_SESSION['email'] = $email;
	    $_SESSION['seller_id'] = $user_id;
	    header('location: seller_dashboard.php');
  }
}

      mysqli_close($con);
			//connection closed
 ?>

<!-- View -->
<!DOCTYPE html>
<html>
<head>
	<title>Seller Home | Zarurat.in</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="public/css/seller_home.css">
	<script type="text/javascript" src="public/javascript/seller_home.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/seller_home_footer.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<body>
	<?php require 'includes/seller_home_header.php'; ?>
	<div class="Main-wrapper">
		<div class="tag-line">
			<h1>The way to get started is to quit talking and begin doing.</h1>
			<h1>Expand your business with Zarurat.in</h1></div>
		<div class="inner-wrapper">

			<div class="log">
					<div>

						<?php
						//error messages
							if ( isset($_SESSION['failure']) ) {
							echo('<p style="color: red;">'.htmlentities($_SESSION['failure'])."</p>\n");
							unset($_SESSION['failure']);
						 }
						 ?>

					</div>
				<div id="back-container" style="display: flex;justify-content: flex-start; width: 80%; ">
          <div id="back-icon-container"><i id="back-icon" onclick="hideBackIcon()"class="fas fa-arrow-left"></i></div></div>
			<div class="hide"><button onclick="showSigninForm()">Sign In</button></div>
			<div class="or hide" ><h3>OR</h3></div>
			<div class="hide"><button onclick="showSignupForm()">Sign Up</button></div>

			<!-- SIGN IN Form Starts -->

			<div class="form-container">

				<form id="signin-form" method="post">
					<div>
							<input class="input-style" type="type" name="signinemail-mobile" placeholder="Email / Mobile Number" required="true" >
					</div>
					<div>
							<input class="input-style" type="password" name="signinpass" placeholder="Password" required="true">
					</div>
					<div>
							<input class="submit-style" type="submit" value="Sign In" name="signin">
					</div>
				</form>

				<!-- SIGN UP Form Starts -->

				<form id="signup-form" method="post">
				<div>
							<input class="input-style" type="text" name="name" placeholder="Name" required="true">
				</div>
				<div>
					<input class="input-style" type="number" name="contact" placeholder="Contact" required="true">
				</div>
				<div>
					<input class="input-style" type="Email" name="e-mail" placeholder="Email" required="true">
				</div>
				<div style="margin-bottom: 30px;">
					<input class="input-style" type="text" name="address" placeholder="Permanent Address" required="true">
				</div>
				<div>
					<select name="state" required="true" >
						<option value disabled selected>--Select State--</option>
						<option value="Andhra Pradesh">Andhra Pradesh</option>
						<option value="Arunachal Pradesh">Arunachal Pradesh</option>
						<option value="Assam">Assam</option>
						<option value="Bihar">Bihar</option>
						<option value="Chhattisgarh">Chhattisgarh</option>
						<option value="Delhi">Delhi</option>
						<option value="Goa">Goa</option>
						<option value="Gujarat">Gujarat</option>
						<option value="Haryana">Haryana</option>
						<option value="Himachal Pradesh">Himachal Pradesh</option>
						<option value="Jammu and Kashmir">Jammu and Kashmir</option>
						<option value="Jharkhand">Jharkhand</option>
						<option value="Karnataka">Karnataka</option>
						<option value="Kerala">Kerala</option>
						<option value="Madhya Pradesh">Madhya Pradesh</option>
						<option value="Maharashtra">Maharashtra</option>
						<option value="Manipur">Manipur</option>
						<option value="Meghalaya">Meghalaya</option>
						<option value="Mizoram">Mizoram</option>
						<option value="Nagaland">Nagaland</option>
						<option value="Odisha">Odisha</option>
						<option value="Punjab">Punjab</option>
						<option value="Rajasthan">Rajasthan</option>
						<option value="Sikkim">Sikkim</option>
						<option value="Telangana">Telangana</option>
						<option value="Tripura">Tripura</option>
						<option value="Uttar Pradesh">Uttar Pradesh</option>
						<option value="Uttarakhand">Uttarakhand</option>
						<option value="West Bengal">West Bengal</option>
					</select>
				</div>
				<div>
					<input class="input-style" type="number" name="pincode" placeholder="Pincode" required="true">
				</div>
				<div>
					<input class="input-style" id="password" type="password" name="password" placeholder="Password" required="true">
				</div>
				<div>
					<input class="input-style" id="confirm_password" type="password" name="conf-password" placeholder="Confirm Password" required="true">
				</div>
        <!-- javascript-->
				<script>
				//matching password and confirm password
	        var password = document.getElementById("password") , confirm_password = document.getElementById("confirm_password");
	        function validatePassword(){
	          if(password.value != confirm_password.value) {
	            confirm_password.setCustomValidity("Passwords Don't Match");
	          } else {
	            confirm_password.setCustomValidity('');
	          }
	        }
		      password.onchange = validatePassword;
		      confirm_password.onkeyup = validatePassword;
       </script>

				<div>
					<input class="submit-style" type="submit" value="Sign Up" name="signup">
				</div>
				</form>
			</div>
		</div>

		<div class="line"></div>

		<div class="help"><button>Help</button> <!-- Yet to work -->
		</div>
		</div>
	</div>
	<?php require 'includes/seller_home_footer.php'; ?>
</body>
</html>
