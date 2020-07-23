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
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/seller_header.css">
	<link rel="stylesheet" type="text/css" href="public/css/seller_view_shops.css">
	<link rel="stylesheet" type="text/css" href="public/css/seller_home_footer.css">
	<script type="text/javascript" src="public/javascript/seller_header.js"></script>
	<script type="text/javascript">
		function shopDeletionConfirmation()
		{
			var x = confirm("Are you sure !");
			if(x)
				return true;
			else return false;
		}
	</script>
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
					<div class="shopname">
						<label><?php echo $row['shop_name'];?></label>
						<label><a onclick="return shopDeletionConfirmation()" href="seller_view_shops.php?shopID=<?php echo $row['shop_id']; ?>"><i class="fa fa-trash"></i></a></label>
					</div>
					<div class="shoptype">
						<label><a href=""><i class="fa fa-truck icon-style"></i>&nbsp;View Orders</a></label>
						<label>
							<?php echo $row['shop_category_name'];?>&nbsp;
							<i class="fa fa-shopping-bag icon-style"></i>
						</label>
						
					</div>
					<div class="shopname"><?php echo $row['shop_name'];?></div>
					<div class="shoptype"><?php echo $row['shop_category_name'];?></div>
					<div class=view>
						<?php
							$shopID = base64_encode($row['shop_id']);
							$shopcategoryID = base64_encode($row['shop_category_id']);
						?>
						<a href="seller_view_all_products_in_shop.php?shopID=<?php echo $shopID; ?>"><i class="fa fa-eye icon-style"></i>&nbsp;View Products</a>
						<a href="seller_all_products_list.php?shopID=<?php echo $shopID; ?>&shopcategoryID=<?php echo $shopcategoryID; ?>">Add more items &nbsp;<i class="fa fa-plus-square icon-style"></i></a>
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
		<div class="info">
			
		</div>
	<?php include 'includes/seller_home_footer.php'; ?>
</body>
</html>


<?php
  
  if(isset($_GET['shopID']))
  {
    $shopID = $_GET['shopID'];
    $sql = "SELECT * FROM shop_inventory WHERE shop_id='$shopID'";
    $result = mysqli_query($con,$sql);

    while($row = $result->fetch_assoc())
    {
      $sql = "DELETE FROM product_seller_edit WHERE shop_inventory_id='$row[shop_inventory_id]'";
      mysqli_query($con,$sql);
    }
    $sql = "DELETE FROM seller_shop WHERE shop_id='$shopID'";
    mysqli_query($con,$sql);
    ?>
    <script type="text/javascript">location.href='seller_view_shops.php';</script>
    <?php
  }
?>
	<?php include 'includes/seller_home_footer.php'; ?>
</body>
</html>
