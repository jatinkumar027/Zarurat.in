<!-- Model -->

<?php
	require_once('includes/common.php');

	//Logged out user redirected to home page

	if (!isset($_SESSION['city']) && !isset($_SESSION['state']) && !isset($_SESSION['pincode']) ) {
	  header('location: buyer_home.php');
	  exit;
	}

  $shops_found='';

//............................................................................................
  $city=$_SESSION['city'];
	$state=$_SESSION['state'];
	$pincode=$_SESSION['pincode'];

	//query checking if user already Exists
	$query = "SELECT * FROM `seller_shop` JOIN seller_reg_personal JOIN shop_category JOIN payment_mode_table ON
	seller_reg_personal.seller_id=seller_shop.seller_id AND seller_shop.shop_category_id=shop_category.shop_category_id AND
	seller_shop.payment_mode_id=payment_mode_table.payment_mode_id WHERE seller_shop.City='" . $city . "' AND seller_shop.Pincode='" . $pincode . "' ";
	$result = mysqli_query($con, $query)or die(mysqli_error($con));
	$num = mysqli_num_rows($result);

 //Data Validation and passing error messages
	if ($num != 0) {
		$shops_found=true;
		//Show shops
} elseif($num == 0) {
	//run query of state and city
	$query = "SELECT * FROM `seller_shop` JOIN seller_reg_personal JOIN shop_category JOIN payment_mode_table ON
	seller_reg_personal.seller_id=seller_shop.seller_id AND seller_shop.shop_category_id=shop_category.shop_category_id AND
	seller_shop.payment_mode_id=payment_mode_table.payment_mode_id WHERE seller_shop.City='" . $city . "' AND seller_shop.state='" . $state . "' ";
	$result = mysqli_query($con, $query)or die(mysqli_error($con));
	$num = mysqli_num_rows($result);

	if ($num != 0) {
		//Show shops
		$shops_found=true;
	}

}
else {
	$shops_found=false;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Seller View All Shops | Zarurat.in</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/buyer_header.css">
	<link rel="stylesheet" type="text/css" href="public/css/buyer_view_shops.css">
	<link rel="stylesheet" type="text/css" href="public/css/buyer_footer.css">
	<script type="text/javascript" src="public/javascript/seller_header.js"></script>

</head>
<body>

	<?php require 'includes/buyer_header.php'; ?>

  <div class="wrapper">

     <?php
     if($shops_found==true)
     {
     ?>

     <div class="allshops">
			 <center>
			 <h2 style="display: flex; justify-content: space-between; align-items: center; height: 10vh; margin-left:auto;"class="message">We found <?php echo $num;?> Shops Registered in your area.</h2>
		 </center>
		 <?php
     $i=0;
     //printing all the details in view shop page. All the data of all the shops of a particular seller will be shown in this page
         while($row = $result->fetch_assoc())
        {
       ?>
       <div class="shop-details">
         <div class="shopname">
           <label><?php echo strtoupper($row['shop_name']);?></label>
           <label class="seller-name"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
Own By</br> <?php echo $row['seller_name']; ?></label>
         </div>
         <div class="shoptype">
           <label><i class="fa fa-clock-o icon-style"></i>&nbsp;<span style="font-size:17px;"><?php echo $row['open_time']; echo " - ".$row['close_time']; ?></span></label>
           <label>
             <?php echo $row['shop_category_name'];?>&nbsp;
             <i class="fa fa-shopping-bag icon-style"></i>
           </label>

         </div>
         <div class="view">
					 <?php
						 $shopID = base64_encode($row['shop_id']);
						 $shopcategoryID = base64_encode($row['shop_category_id']);
					 ?>
					 <label><span><i class="fa fa-map-marker icon-style">&nbsp;Ordering from</i></span><span><?php echo $row['shop_no'];?><?php echo ", ".$row['shop_area']; ?></span></label>
           <a href="buyer_view_all_products_in_shop.php?shopID=<?php echo $shopID; ?>&shopcategoryID=<?php echo $shopcategoryID; ?>"><span class="buy-now-btn"><i class="fa fa-cart-arrow-down icon-style"></i>&nbsp;Buy Now</span></a>
         </div>
       </div>
       <?php
       $i++;
     }
     ?>
     </div>
   <?php
   }
   elseif($shops_found==false){
     //if no shops being registered
     ?>
		 <div class="message" style="margin-top: 100px;margin-bottom: 50px;">
		 <div style="height: 50px;"></div>
     <h1 style="display: flex; justify-content: center; align-items: center; height: 25vh;"class="message">Sorry, No Shops found Registered in this area.</h1>
		 <div class="shop-btn">
			 <a href="buyer_home.php"><button>Go to Home</button></a>
			</div>
		</div>
		 <?php
   }
   ?>
   </div>

		<div class="info">

		</div>
	<?php include 'includes/buyer_footer.php'; ?>
</body>
</html>

<?php

  if(isset($_GET['shopID']))
  {
    $shopID = $_GET['shopID'];
    $sql = "SELECT * FROM shop_inventory WHERE shop_id='$shopID'";
    $result = mysqli_query($con,$sql);

    ?>
    <script type="text/javascript">location.href='seller_view_shops.php';</script>
    <?php
  }
?>
