<!-- Model -->

<?php
require_once("includes/common.php");

//Logged out user redirected to home page

if (!isset($_SESSION['email'])) {
  header('location: seller_home.php');
  exit;
}
if(isset($_POST['createshop']))
{
  // Getting the values from the signup page using $_POST[] and cleaning the data submitted by the user.
  $shopname = $_POST['shopname'];
  $shopname = mysqli_real_escape_string($con, $shopname);

  $shopopentime = $_POST['shopopentime'];
  $shopopentime = mysqli_real_escape_string($con, $shopopentime);

  $shopclosetime = $_POST['shopclosetime'];
  $shopclosetime = mysqli_real_escape_string($con, $shopclosetime);

  $shopaadhar = $_POST['shopaadhar'];
  $shopaadhar = mysqli_real_escape_string($con, $shopaadhar);

  $shoppan = $_POST['shoppan'];
  $shoppan = mysqli_real_escape_string($con, $shoppan);

  $shopminorder = $_POST['shopminorder'];
  $shopminorder = mysqli_real_escape_string($con, $shopminorder);

  $shopadd = $_POST['shopadd'];
  $shopadd = mysqli_real_escape_string($con, $shopadd);

	$shopcategory = $_POST['shopcategory'];
	$shopcategory = mysqli_real_escape_string($con, $shopcategory);

  $arr=array();
  $arr=$_POST['ordertype'];
  if(isset($arr[0]) && isset($arr[1]) ){
      $shoppaymenttype="3";
  }
  elseif(isset($arr[0]))
  {
      $shoppaymenttype="1";
  }
  elseif (isset($arr[1])) {
      $shoppaymenttype="2";
  }

  //getting seller id from session
  $sellerid=$_SESSION['seller_id'];

  $query = "INSERT INTO seller_shop(seller_id, shop_category_id, shop_name, shop_add, aadhar_number, pan_number, open_time, close_time, min_order, payment_mode_id)VALUES
  ('" . $sellerid . "','" . $shopcategory . "','" . $shopname . "','" . $shopadd . "','" . $shopaadhar . "','" . $shoppan . "','" . $shopopentime . "','" . $shopclosetime . "','" . $shopminorder . "','" . $shoppaymenttype . "')";
  mysqli_query($con, $query) or die(mysqli_error($con));
  $user_id = mysqli_insert_id($con);
  header('location: seller_view_shops.php');
	//if values inserted correctly seller redirected to view shops page
}

	mysqli_close($con);
	//connection is closed
?>

<!-- View -->

<!DOCTYPE html>
<html>
<head>
	<title>Seller Dashboard | Zarurat.in</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="public/css/sellerhomeCSS.css">
	<link rel="stylesheet" type="text/css" href="public/css/sellerLoggedInCSS.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" type="text/css" href="public/css/sellerfooterCSS.css">
  <script type="text/javascript" src="public/java/sellerLoggedInscript.js"></script>
  <link rel="stylesheet" type="text/css" href="public/css/sellerLoggedInHeaderCSS.css">
</head>
<body>

	<?php require 'includes/seller_header.php' ?>

	<div class="wrapper">
		<div class="register-shop-btn">
			<button  onclick="showShopForm()">Register your Shop</button>
		</div>
    <!-- Radio Buttons-->
        <div class="shop-form-container" >
        	<form id="shop-info" method="post">
        		<div class="choose-shop-type">
                    <div><h1>Choose Category of Shop</h1></div>
        			<div class="radio-toolbar">
	    					<input type="radio" id="radiokirana" name="shopcategory" value="1" checked>
	    						<label for="radiokirana">Kirana</label>

	    					<input type="radio" id="radiodairy" name="shopcategory" value="2">
	    						<label for="radiodairy">Dairy</label>

	    					<input type="radio" id="radiomedicine" name="shopcategory" value="3">
	    						<label for="radiomedicine">Medicine</label>
					    </div>
            </div>
        		<div class="shop-details" >
        			<!-- shop form -->
                    <div>
                        <div>
                            <input class="input-style" type="text" placeholder="Shop name" name="shopname">
                        </div>
                        <div>
                            <input class="input-style" type="text" placeholder="Shop Address" name="shopadd">
                        </div>
                        <div>
                             <input class="input-style" type="text" placeholder="Open Time" name="shopopentime">
                        </div>
                        <div>
                             <input class="input-style" type="text" placeholder="Close Time" name="shopclosetime">
                        </div>
                        <div>
                             <input class="input-style" type="text" placeholder="Aadhar Card" name="shopaadhar">
                        </div>
                        <div>
                             <input class="input-style" type="text" placeholder="PAN Card" name="shoppan">
                        </div>
                        <div>
                             <input class="input-style" type="number" placeholder="Minumum cost of order" name="shopminorder">
                        </div>
                        <div>
                            <label style="margin-top: 15px;">Mode of Payment</label>
                            <div style="display: flex; flex-direction: row">
                                <input style="width: 25px; height: 25px; margin:5px; margin-left: 25px;" type="checkbox" name="ordertype[0]" value="1" >
                                <label>Cash</label>
                                <input style="width: 25px; height: 25px; margin:5px; margin-left: 25px;" type="checkbox" name="ordertype[1]" value="2" >
                                <label>Online</label>
                            </div>
                        </div>
                        <div>
                            <input style="margin-top: 15px;" id="create-button" type="submit" value="Create Shop" name="createshop" >
                        </div>
                    </div>
        		</div>
        	</form>
        </div>

	</div>

	<?php require 'includes/seller_home_footer.php'; ?>

</body>
</html>
