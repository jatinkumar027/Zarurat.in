<?php
	require_once('includes/common.php');

	if (isset($_POST['submit'])) {
	  // Getting the values from the Location page using $_POST[] and cleaning the data submitted by the user.
		  $city = $_POST['city'];
		  $city = mysqli_real_escape_string($con, $city);

			$pincode = $_POST['pincode'];
			$pincode = mysqli_real_escape_string($con, $pincode);

			$state = $_POST['state'];
			$state = mysqli_real_escape_string($con, $state);

		  $regex_pin = "/^[0-9]{6}$/";

			if (!preg_match($regex_pin, $pincode)) {
				 $_SESSION['buyer_failure']="Not a valid pincode";
			}

			else {
				$_SESSION['city']=$city;
				$_SESSION['pincode']=$pincode;
				$_SESSION['state']=$state;
				header("Location:buyer_view_shops.php");
				return;
			}
		}
  ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Buy your needs | Zarurat.in</title>

    <link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/buyer_footer.css">
    <link rel="stylesheet" type="text/css" href="public/css/buyer_home.css">
    <link rel="stylesheet" type="text/css" href="public/css/buyer_header.css">
    <script type="text/javascript" src="public/javascript/seller_header.js"></script>

  </head>

  <body>
    <header>
      <?php include 'includes/buyer_header.php'; ?>
    </header>
    <div id="content">
      <div class="container-fluid decor_bg" id="login-panel">
        <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-primary">
            <div id="message">
              <?php
													 //error messages
														 if ( isset($_SESSION['buyer_failure']) ) {
														 echo('<p style="color: red;">'.htmlentities($_SESSION['buyer_failure'])."</p>\n");
														 unset($_SESSION['buyer_failure']);
														}
														?>

            </div>
            <div class="panel-heading">
              <h4>Please Enter your location</h4>
            </div>
            <div class="panel-body">
              <p class="text-warning"><i>Enter Location to make a purchase</i>
                <p>
                  <form role="form" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="City" name="city" required>
                    </div>
                    <div class="form-group">
                      <input type="number" class="form-control" placeholder="Pincode" name="pincode" required>
                    </div>
                    <div class="form-group">
                      <select name="state" required="true" style="width:100%;">
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
                    <button type="submit" name="submit" class="btn btn-primary">Enter</button>
                    <br>
                    <br>
                  </form>
                  <br/>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'includes/buyer_footer.php'; ?>

  </body>

  </html>
