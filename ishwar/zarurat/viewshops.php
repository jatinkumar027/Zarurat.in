<?php
	require_once('includes/common.php');
	$seller_id = $_SESSION['seller_id'];
	$sql = "SELECT * FROM seller_shop JOIN shop_category on seller_shop.shop_category_id=shop_category.shop_category_id WHERE seller_id='$seller_id'";
	$result = mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="public/css/viewpageCSS.css">
	<link rel="stylesheet" type="text/css" href="public/css/sellerfooterCSS.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<link rel="stylesheet" type="text/css" href="public/css/sellerLoggedInHeaderCSS.css">
</head>
<body>
	<?php include 'sellerLoggedInHeader.php'; ?>

		<div class="wrapper">
			<?php 
			if($result->num_rows>0)
			{
			?>
			<div class="allshops">
			<?php
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
						<a href="viewProductsInShop.php?shopID=<?php echo $shopID; ?>">View Products</a>
						<a href="product_list.php?shopID=<?php echo $shopID; ?>&shopcategoryID=<?php echo $shopcategoryID; ?>">Add more items</a>
					</div>
				</div>

				<?php
			}
			?>
			</div>
		<?php	
		}
		else{
			?>
			<h1 style="display: flex; justify-content: center; align-items: center; height: 55vh;"class="message">Shop Not Registered</h1>
			<?php
		}
		?>
		</div>
	<?php include 'footer.php'; ?>
</body>
</html>
