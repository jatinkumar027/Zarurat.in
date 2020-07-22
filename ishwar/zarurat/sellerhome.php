<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="public/css/sellerhomeCSS.css">
	<script type="text/javascript" src="public/java/sellerhome.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/sellerfooterCSS.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="Main-wrapper">
		<div class="tag-line"><h1>The way to get started is to quit talking and begin doing.</h1><h1>Expand your business with Zarurat.in</h1></div>
		<div class="inner-wrapper">
			<div class="log">
				<div id="back-container" style="display: flex;justify-content: flex-start; width: 80%; "><div id="back-icon-container"><i id="back-icon" onclick="hideBackIcon()"class="fas fa-arrow-left"></i></div></div>
			<div class="hide"><button onclick="showSigninForm()">Sign In</button></div>
			<div class="or hide" ><h3>OR</h3></div>
			<div class="hide"><button onclick="showSignupForm()">Sign Up</button></div>
			<div class="form-container">
				<form id="signin-form">
					<div>
							<input class="input-style" type="text" name="" placeholder="Email or Mobile No">
					</div>
					<div>
							<input class="input-style" type="password" name="" placeholder="Password">
					</div>
					<div>
							<input class="submit-style" type="submit" value="Sign In">
					</div>
				</form>
			
				<form id="signup-form">
				<div>
							<input class="input-style" type="text" name="" placeholder="Name">
				</div>
				<div>
					<input class="input-style" type="number" name="" placeholder="Contact">
				</div>
				<div>
					<input class="input-style" type="Email" name="" placeholder="Email">
				</div>
				<div style="margin-bottom: 30px;">
					<input class="input-style" type="text" name="" placeholder="Permanent Address">
				</div>
				<div>
					<select>
						<option>Delhi</option>
						<option>Bihar</option>
						<option>gujart</option>
						<option>jammu</option>
					</select>
				</div>
				<div>
					<input class="input-style" type="number" name="" placeholder="Pincode">
				</div>
				<div>
					<input class="input-style" type="password" name="" placeholder="Password">
				</div>
				<div>
					<input class="input-style" type="password" name="" placeholder="Confirm Password">
				</div>
				<div>
					<input class="submit-style" type="submit" value="Sign Up">
				</div>
				</form>
			</div>
		</div>

		<div class="line"></div>

		<div class="help"><button>Help</button>
		</div>
		</div>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>