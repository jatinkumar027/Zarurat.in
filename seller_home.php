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
	  $query = "SELECT seller_id, seller_email, seller_name FROM seller_reg_personal WHERE (seller_email='" . $signinemailmobile . "' OR seller_contact='" . $signinemailmobile . "') AND seller_password='" . $signinpass . "'";
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
	  $_SESSION['seller_name'] = $row['seller_name'];
	  header('location: seller_dashboard.php');
		//seller is logged in and redirected to the dashboard
	}
}

elseif (isset($_POST['signup'])) {
  // Getting the values from the signup page using $_POST[] and cleaning the data submitted by the user.
	  if($_POST['password'] != $_POST['confpassword'])
	  {
		  $_SESSION['failure'] = 'Password not matched';
		  header('Location: seller_home.php');
		  return ;
	  }

  	  $name = $_POST['name'];
	  $name = mysqli_real_escape_string($con, $name);

	  $email = $_POST['email'];
	  $email = mysqli_real_escape_string($con, $email);

	  $password = $_POST['password'];
	  $password = mysqli_real_escape_string($con, $password);
	  $password = MD5($password);

	  $contact = $_POST['contact'];
	  $contact = mysqli_real_escape_string($con, $contact);

	  $house = $_POST['house'];
	  $house = mysqli_real_escape_string($con, $house);
	  
	  $area = $_POST['area'];
	  $area = mysqli_real_escape_string($con, $area);

	  $city = $_POST['city'];
	  $city = mysqli_real_escape_string($con, $city);

	  $landmark = $_POST['landmark'];
	  $landmark = mysqli_real_escape_string($con, $landmark);

	  $state = $_POST['state'];
	  $state = mysqli_real_escape_string($con, $state);

	  $pincode = $_POST['pincode'];
	  $pincode = mysqli_real_escape_string($con, $pincode);
	  
	  $pan = $_POST['pan'];
	  $pan = mysqli_real_escape_string($con, $pan);

	  $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
	  $regex_num = "/^[6789][0-9]{9}$/";
	  $regex_pin = "/^[0-9]{6}$/";

	  //query checking if user already Exists
	  $query = "SELECT * FROM seller_reg_personal WHERE seller_email='$email'";
	  $result = mysqli_query($con, $query)or die(mysqli_error($con));
	  $num = mysqli_num_rows($result);

   //Data Validation and passing error messages
    if ($num != 0) {
			$_SESSION['failure']="Email Already Exists";
			header("Location:seller_home.php");
			return;

  } else if (!preg_match($regex_email, $email)) {
			$_SESSION['failure']="Not a valid Email Id";
			header("Location:seller_home.php");
			return;

  } else if (!preg_match($regex_num, $contact)) {
			$_SESSION['failure']="Not a valid phone number";
			header("Location:seller_home.php");
			return;

  }else if (!preg_match($regex_pin, $pincode)) {
	    $_SESSION['failure']="Not a valid pincode";
			header("Location:seller_home.php");
	    return;
  } else {
		//Query inserts values into signup page
	    $query = "INSERT INTO `seller_reg_personal` (`seller_id`, `seller_name`, `seller_contact`, `seller_email`, `seller_home`, `seller_area`, `seller_landmark`, `seller_city`, `seller_state`, `seller_pincode`, `seller_pan_number`, `seller_password`) VALUES (NULL, '$name', '$contact', '$email', '$house', '$area', '$landmark', '$city', '$state', '$pincode', '$pan', '$password')";
	    mysqli_query($con, $query) or die(mysqli_error($con));
	    $user_id = mysqli_insert_id($con);
	    $_SESSION['email'] = $email;
		$_SESSION['seller_id'] = $user_id;
		$_SESSION['seller_name'] = $name;
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
	<link rel="stylesheet" type="text/css" href="public/css/seller_home_header.css">
</head>
<body>
	<?php require 'includes/seller_home_header.php'; ?>
	<div style="height: 50px;"></div>
	<div class="Main-wrapper">
		<div class="banner">
			<div class="left-padding"></div>
			<div class="left-banner">
				<h1>Sell your products to Thousands of customers across Your City</h1>
				<button onclick="showSignupForm()" id="banner-btn">Start Selling</button>
			</div>
			<div class="right-banner">
					<img id="dairy-img" src="images/dairy_banner_icon.png" alt="">
					<label><i style="font-size : 100px;" class="fa fa-shopping-basket"></i></label>
					<label><i style="font-size:100px;" class="fa fa-medkit"></i></label>
			</div>
		</div>
		<div class="inner-wrapper">
			<div class="log">
					<div id="message">
						<?php
						//error messages
							if ( isset($_SESSION['failure']) ) {
							echo('<p style="color: red;">'.htmlentities($_SESSION['failure'])."</p>\n");
							unset($_SESSION['failure']);
						 }
						 ?>

					</div>
				<div id="back-container" style="display: flex;justify-content: flex-start; width: 80%; ">
          	<div id="back-icon-container"><i id="back-icon" onclick="hideBackIcon()"class="fa fa-arrow-left"></i></div></div>
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
					<input class="input-style" type="Email" name="email" placeholder="Email" required="true">
				</div>
				<div>
					<input class="input-style" type="text" name="house" placeholder="Flat, House no., Building, Company, Apartment: " required="true">
				</div>
				<div>
					<input class="input-style" type="text" name="area" placeholder="Area, Colony, Street, Sector, Village:" required="true">
				</div>
				<div>
					<input class="input-style" type="text" name="landmark" placeholder="Landmark e.g. near apollo hospital:" required="true">
				</div>
				<div style="margin-bottom: 30px;">
					<input class="input-style" type="text" name="city" placeholder=" Town/City:" required="true">
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
					<input class="input-style" type="text" name="pan" placeholder="Pan Number" required="true">
				</div>
				<div>
					<input class="input-style" id="password" type="password" name="password" placeholder="Password" required="true">
				</div>
				<div>
					<input class="input-style" id="confirm_password" type="password" name="confpassword" placeholder="Confirm Password" required="true">
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

		<div class="help"> <!-- Yet to work -->
		    <div id="top-pad"></div>
			<div class="help-btn-container"><button onclick="showHelp()" class="help-button">Help</button></div>
			<div class="help-details">
				<div class="goback-icon-container"><i onclick="goBack()" id="goback-icon" class="fa fa-arrow-left"></i> <label id="help-written"><i class="fa fa-question-circle"></i>&nbsp;Help</label></div>
				<div class="tab">
					<div>
						<div class="info">How to Signup/Sign in?</div>
						<div class="help-content">
							<ul>
								<li>On the home page you will be provided by two buttons sign in and signup.</li>
							</ul>	
							<div class="img-container">
									<img src="images/signin_signup_btn.png" alt="">
							</div>
							<ul>		
								<li>If you are registering then you have to sign in with your with your basic information.</li>
							</ul>
							<div class="img-container">
								<img src="images/signin_form_details.png" alt="">
							</div>
							<ul>	
								<li>If you are new then you have to sign up.</li>
								<li>For signup you have to fill your own basic details as mention below. </li>
							</ul>
							<div class="img-container">
								<img src="images/signup_form_details.png" alt="">
							</div>
							<ul>
								<li>Then you have to click submit.</li>
								<li>These are the personal details and please don’t share your data to anyone.</li>
								<li>You will find a home page in front of the window.</li>
								<li>Then we can see dashboard, shops and moreover seller can view his shops and can change password.</li>
							</ul>	
						</div>
					</div>
				</div>
				<div class="tab">
					<div>
						<div class="info">How to Register your Shop?</div>
						<div class="help-content">
							<ul>
								<li>While login in you have to register, by which you can register your shop.</li>
								<li>After registering your shop, you have to fill all the details very carefully. i.e. (opening/closing time of the shops, mode of payment i.e.(cash/online) etc).</li>
								<li>You will enter the costing of the items.</li>
								<li>After that your shop will be registered.</li>
							</ul>
							<div class="img-container">
								<img src="images/shop_category_screenshot.png" alt="">
							</div>
							<ul>
								<li>After registering your shop, you will find one popup.</li>
							</ul>
							<div class="img-container">
								<img src="images/shop_details_screenshot.png" alt="">
							</div>
							<div class="img-container">
								<img src="images/bank_details_screenshot.png" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="tab">
					<div>
						<div class="info">How to Add Products in Shop?</div>
						<div class="help-content">
							<ul>
								<li>For adding the products, you will have to select add more items.</li>
							</ul>	
							<div class="img-container">
								<img src="images/add_products.PNG" alt="">
							</div>
							<ul>
								<li>Then a new page will open where you will see many products where you can add ones by clicking on the checkboxes.</li>
								<li>After clicking checkbox there, Item is in active state.</li>
								<li>You can also add the mrp, quantities volume.</li>
							</ul>
							<div class="img-container">
								<img src="images/pro_add.PNG" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="tab">
					<div>
						<div class="info">How to view Products in Shop?</div>
						<div class="help-content">
							<ul>
								<li>For viewing the products, you have to click view product.</li>
							</ul>
							<div class="img-container">
								<img src="images/add_products.PNG" alt="">
							</div>
							<ul>
								<li>In this you can view your products.</li>
							</ul>
							<div class="img-container">
								<img src="images/view_products.PNG" alt="">
							</div>
							<ul>
								<li>You can view your products which has to be sold.</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="tab">
					<div>
						<div class="info">How to edit Products?</div>
						<div class="help-content">
							<ul>
								<li>To edit the products, you have to select the view products.</li>
							</ul>
							<div class="img-container">
								<img src="images/add_products.PNG" alt="">
							</div>
							<ul>
								<li>In this you will be able to select the items /quantities/ mrp etc. which you ought to sell.</li>
								<li>You can edit the items by clicking update icon, where you can edit the cost, volume etc.</li>
							</ul>
							<div class="img-container">
								<img src="images/edit.PNG" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="tab">
					<div>
						<div class="info">How to add more Shops?</div>
						<div class="help-content">
							<ul>
								<li>If you have registered your shop once.</li>
								<li>Then you have to click register new shops and can follow step 2.</li>
							</ul>
							<div class="img-container">
								<img src="images/register.PNG" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="tab">
					<div>
						<div class="info">How to view your Orders?</div>
						<div class="help-content">
							<ul>
								<li>To view your order, select the view order.</li>
							</ul>
							<div class="img-container">
								<img src="images/view.PNG" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="tab">
					<div>
						<div class="info">How to manage your Orders?</div>
						<div class="help-content">
							<ul>
								<li>Order page will be shown and all the item will be shown from byer side</li>
								<li>Then you will be able to see which items are ordered from byers side.</li>
								<li>And able to see the details of byers like (contact no. and address). </li>
							</ul>
						</div>
					</div>
				</div>
				<div class="tab">
					<div>
						<div class="info">How to delete Shop?</div>
						<div class="help-content">
							<ul>
								<li>To delete the shop, you have to follow the following steps: -</li>
								<li>1.Firstly, clear all the items by clicking trash icon in view products.</li>
							</ul>
							<div class="img-container">
								<img src="images/view_products.PNG" alt="">
							</div>
							<ul>
								<li>2.Then you have to go in view shops.</li>
								<li>3.Then you have to click the trash icon in your shop.</li>
							</ul>
							<div class="img-container">
								<img src="images/view.PNG" alt="">
							</div>
							<ul>
								<li>Your shop will be been removed successfully.</li>
							</ul>
							<div class="img-container">
								<img src="images/delete.PNG" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="gonext-btn-container">
					<button id="gonext-btn" onclick="goNext()">Next &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
				</div>
			</div>
		</div>
	  </div>
	  <div class="banner-benefits-intro">Seller Benefits</div>
	  <div class="banner-benefits">
		  <div class="inner-benefits">
			<div class="one">
				<label>Secure Payments, Regularly</label>
				<img src="images/payment.png" alt="">
				<label class="benefit-info">Funds are safely deposited directly to your bank account</label>
			</div>
			<div class="two">
				<label for="">Ship Your Orders strees-Free</label>
				<i style="font-size : 120px" class="fa fa-truck"></i>
				<label class="benefit-info">Whether you choose Fulfillment by Zarurat (FBA) or Easy Ship, let us take care of delivering your products.</label>
			</div>
			<div class="three">
				<label for="">Services to Help you through every step</label>
				<i style="font-size : 120px" class="fa fa-gear"></i>
				<label class="benefit-info">Get paid support from Amazon empanlled third party professionals for product photography, account management and much more</label>
			</div>
		  </div>
	  </div>
	</div>
	<?php require 'includes/seller_home_footer.php'; ?>
</body>
</html>
