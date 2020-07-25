<!-- Model -->

<?php
require_once("includes/common.php");

//Logged out user redirected to home page

if (!isset($_SESSION['email'])) {
  header('location: seller_home.php');
  exit;
}
/*
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
*/
	
	
?>

<!-- View -->

<!DOCTYPE html>
<html>
<head>
	<title>Seller Dashboard | Zarurat.in</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="public/css/seller_home_footer.css">
  <script type="text/javascript" src="public/javascript/seller_dashboard.js"></script>
  <link rel="stylesheet" type="text/css" href="public/css/seller_header.css">
  <link rel="stylesheet" type="text/css" href="public/css/seller_dashboard.css">
  <script type="text/javascript" src="public/javascript/seller_header.js"></script>
</head>
<body>

	<?php require 'includes/seller_header.php' ?>
	<div class="wrapper">
    <?php
    $sql = "SELECT * FROM seller_shop WHERE seller_id='$_SESSION[seller_id]'";
    $result = mysqli_query($con,$sql) or die(mysqli_error($con));
     if($result->num_rows > 0 && !isset($_GET['register']))
    header('Location: seller_view_shops.php');
    ?>
    		<div class="register-shop-btn">
    			<button  onclick="showShopTypes()">Register your Shop</button>
    		</div>
        
        <!-- Radio Buttons-->
            <div class="shop-form-container">
              	<form id="shop-info" method="post">
              		<div class="shop-type-container">
                      <div style="display:flex;justify-content: flex-end;">
                        <i  style="font-size: 20px;" class="fa fa-shopping-bag"></i>&nbsp; Shop Category
                      </div>
                      <div class="shops-type">
                    			<div class="radio-toolbar">
            	    					<input type="radio" id="radiokirana" name="shopcategory" value="1" checked>
            	    						<label for="radiokirana">Kirana</label>

            	    					<input type="radio" id="radiodairy" name="shopcategory" value="2">
            	    						<label for="radiodairy">Dairy</label>

            	    					<input type="radio" id="radiomedicine" name="shopcategory" value="3">
            	    						<label for="radiomedicine">Medical</label>

            					    </div>
                      </div> 
                      <div class="div-btn-container">
                         <div onclick="showShopDetails()" class="div-btn">Next <i class="fa fa-arrow-right"></i></div>
                      </div> 
                  </div>
              		<div class="shop-details">
                      <div style="display:flex;justify-content: space-between;">
                        <label><i id="back-icon" onclick="goBackToShopType()"class="fa fa-arrow-left"></i></label> 
                        <label><i style="font-size: 20px;" class="fa fa-edit"></i> &nbsp;Shop Details</label>
                      </div>
                      <div>
                          <div>
                            <input class="input-style" type="" name="" placeholder="Shop Name">
                          </div>
                          <div>
                            <input class="input-style" type="" name="" placeholder="Shop No">
                          </div>
                          <div>
                            <input class="input-style" type="" name="" placeholder="City">
                          </div>
                          <div>
                            <input class="input-style" type="" name="" placeholder="State">
                          </div>
                          <div>
                            <input class="input-style" type="" name="" placeholder="Pincode">
                          </div>
                          <div>
                            <input class="input-style" type="" name="" placeholder="GST Number">
                          </div>
                          <div>
                            <input id="country-field" onmouseover="disableField();" onmouseout="enableField()" class="input-style" type="" name="country" value="India" placeholder="Country">
                          </div>
                          <div>
                            <div class="time-container">
                              <label>Shop Open Time : &nbsp;</label>
                              <select>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                              </select>
                              <select>
                                <option>00</option>
                                <option>30</option>
                              </select>
                              <select>
                                <option>AM</option>
                                <option>PM</option>
                              </select>
                            </div>
                            <div class="time-container">
                              <label>Shop Close Time : &nbsp;</label>
                              <select>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                              </select>
                              <select>
                                <option value="00">00</option>
                                <option value="30">30</option>
                              </select>
                              <select>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                              </select>
                            </div>   
                          </div>
                       </div>   
                       <div class="div-btn-container">
                         <div onclick="showBankDetails()" class="div-btn">Next <i class="fa fa-arrow-right"></i></div>
                      </div> 
                  </div>
                  <div class="bank-details">
                    <div>
                      <div style="display:flex;justify-content: space-between;">
                        <label><i id="back-icon" onclick="goBackToShopDetails()"class="fa fa-arrow-left"></i></label>
                        <label><i style="font-size: 20px;" class="fa fa-bank"></i>&nbsp; Bank Details</label>
                      </div>
                      
                      <div>
                          <input class="input-style" type="" name="" placeholder="Bank Name">
                      </div>
                      <div>
                          <input class="input-style" type="" name="" placeholder="IFSC code">
                      </div>
                      <div>
                          <input class="input-style" type="" name="" placeholder="Account Holder Name">
                      </div>
                      <div>
                          <input class="input-style" type="" name="" placeholder="Account Number">
                      </div>
                      <div >
                        <input id="create-button" type="submit" name="createshop" value="Create Shop">
                      </div>
                    </div>
                  </div>
              	</form>
            </div>

	</div>
  <div class="info">

  </div>
	<?php require 'includes/seller_home_footer.php'; ?>

</body>
</html>
<?php
mysqli_close($con);
//connection is closed
?>


