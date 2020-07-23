<!-- Model -->

<?php
	require_once('includes/common.php');

	//Logged out user redirected to home page

	if (!isset($_SESSION['email'])) {
	  header('location: seller_home.php');
	  exit;
	}
	$seller_id = $_SESSION['seller_id'];
	//getting all the value of a shop
	$sql = "SELECT * FROM seller_shop JOIN shop_category on seller_shop.shop_category_id=shop_category.shop_category_id WHERE seller_id='$seller_id'";
	$result = mysqli_query($con,$sql);
?>

<!-- View -->

<!DOCTYPE html>
<html>
<head>
	<title>Seller View All Shops | Zarurat.in</title>
	<link rel="stylesheet" type="text/css" href="public/css/viewpageCSS.css">
	<link rel="stylesheet" type="text/css" href="public/css/sellerfooterCSS.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<link rel="stylesheet" type="text/css" href="public/css/sellerLoggedInHeaderCSS.css">
</head>
<body>

	<?php require 'includes/seller_header.php'; ?>

   <div class="wrapper">

			<?php
			if($result->num_rows>0)
			{
			?>

			<div class="allshops">
			<?php
			//printing all the details in view shop page. All the data of all the shops of a particular seller will be shown in this page
		    	while($row = $result->fetch_assoc())
			   {
				?>

				<div class="shop-details">
					<div class="shopname"><?php echo $row['shop_name'];?></div>
					<div class="shoptype"><?php echo $row['shop_category_name'];?></div>
					<div class=view>
						<?php
							$shopID = base64_encode($row['shop_id']);
							$shopcategoryID = base64_encode($row['shop_category_id']);
						?>
						<a href="seller_view_all_products_in_shop.php?shopID=<?php echo $shopID; ?>">View Products</a>
						<a href="seller_all_products_list.php?shopID=<?php echo $shopID; ?>&shopcategoryID=<?php echo $shopcategoryID; ?>">Add more items</a>
					</div>
				</div>

				<?php
			}
			?>
			</div>
		<?php
		}
		else{
			//if no shops being registered
			?>
			<h1 style="display: flex; justify-content: center; align-items: center; height: 55vh;"class="message">Shop Not Registered</h1>
			<?php
		}
		?>
		</div>
	<?php include 'includes/seller_home_footer.php'; ?>
</body>
</html>
