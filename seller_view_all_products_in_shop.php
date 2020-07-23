<!-- Model -->

<?php
	require_once('includes/common.php');
	//Logged out user redirected to home page

	if (!isset($_SESSION['email'])) {
		header('location: seller_home.php');
		exit;
	}
	//showing all products in the selected shop
	$encriptedShopID = $_GET['shopID'];
	$shopID = base64_decode($_GET['shopID']);
	$sql = "SELECT * FROM shop_inventory JOIN products JOIN product_type on shop_inventory.product_id=products.product_id AND products.product_type_id=product_type.product_type_id WHERE shop_inventory.shop_id='$shopID'";
	$result = mysqli_query($con,$sql);
?>

<!-- View -->

<!DOCTYPE html>
<html>
<head>
	<title>View all products in Shop | Zarurat.in </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<script type="text/javascript" src="public/java/seller_view_all_products_in_shop.js"></script>
	<link rel="stylesheet" type="text/css" href="public/css/seller_header.css">
	<link rel="stylesheet" type="text/css" href="public/css/seller_home_footer.css">
	<link rel="stylesheet" type="text/css" href="public/css/seller_view_all_products_in_shop.css">
</head>
<body>
<?php include 'includes/seller_header.php'; ?>
	
	<div class="wrapper">
	<?php
	if($result->num_rows>0)
	{
	?> 	
		<div class="product-list-container">
			<!-- product -->
		<table>
			<tr>
				<th>S No</th>
				<th>Thumbnail</th>
				<th style="width: 15%;">Name</th>
				<th>Brand</th>
				<th>Type</th>
				<th>
					<div class="options">
						<label>MRP</label>
						<label>SP</label>
						<label>Quantity</label>
						<label>Status</label>
						<label>Toggle</label>
						<label>Delete</label>
					</div>
				</th>
			</tr>


		
				<?php
				$i=1;
				while($row = $result->fetch_assoc())
				{
					
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><img class="thumbnail" src="public/images/kirana/<?php echo $row['product_thumb'];?>"></td>
					<td style="width: 15%;"><?php echo $row['product_name'];?></td>
					<td><?php echo $row['product_brand'];?></td>
					<td><?php echo $row['product_type_name'];?></td>
					<td>
						<?php 
							$sql = "SELECT * FROM product_seller_edit JOIN product_wt_unit on product_seller_edit.product_wt_unit_id=product_wt_unit.product_wt_unit_id WHERE shop_inventory_id='$row[shop_inventory_id]'";
							$result2 = mysqli_query($con,$sql);
							while($row2 = $result2->fetch_assoc())
							{
							?>

							<div class="options">
								<label><?php echo $row2['product_mrp']."₹"; ?></label>
								<label><?php echo $row2['product_sp']."₹"; ?></label>
								<label><?php echo $row2['product_quantity']." ".$row2['product_wt_unit_name']; ?></label>
								<label>
									<?php
										if($row2['product_status']=='0')
										{
											echo "<i style='color:red;' class='icon-style'>Inactive</i>";
										}
										else{
											echo "<i style='color:green;' class='icon-style'>Active</i>";
										}
									?>		
								</label>
								<label>
									<?php
							 		if($row2['product_status']=='1') 
							 		{
							 			?>
							 			<a href="seller_view_all_products_in_shop.php?shopID=<?php echo $_GET['shopID'];?>&status=<?php echo $row2['product_status'];?>&optionID=<?php echo $row2['option_id'];?>"><i class="fas fa-toggle-on toggle"></i></a>
							 			<?php
							 		}
							 		else
							 		{
							 			?>
							 			<a href="seller_view_all_products_in_shop.php?shopID=<?php echo $_GET['shopID'];?>&status=<?php echo $row2['product_status'];?>&optionID=<?php echo $row2['option_id'];?>"><i class="fas fa-toggle-off toggle"></i></a>
							 			<?php

							 		}
						 			?>
								</label>
								<label>
									<?php
									if($result2->num_rows==1)
									{
										?>
										<a onclick="return productDeletionConfirmation()" href="seller_view_all_products_in_shop.php?shopID=<?php echo $_GET['shopID'];?>&shopInventoryID=<?php echo $row2['shop_inventory_id'];?>">
										<i style="color: red; font-size: 20px;" class="fa fa-trash"></i>
										</a>
										<?php
									}
									else
									{
									?>
									<a onclick="return optionDeletionConfirmation()" href="seller_view_all_products_in_shop.php?shopID=<?php echo $_GET['shopID'];?>&optionID=<?php echo $row2['option_id'];?>">
									<i style="color: red; font-size: 20px;" class="fa fa-trash"></i>
									</a>
									<?php
									}
									?>
								</label>
							</div>

							<?php
							}
						?>
					</td>
				</tr>

				<?php
					$i++;
				}
				?>
				<!-- product -->
			</table>
		</div>
		<?php
		}
		else {
			?>
			<h1 style="display: flex; justify-content: center; align-items: center; height: 55vh;"class="message">Shop is empty</h1>
			<?php
		}
		?>		

	</div>

<?php include 'includes/seller_home_footer.php';?>
</body>
</html>

<!-- delete product option or product from shop -->
<?php
	if(isset($_GET['status']) && isset($_GET['optionID']) )
	{
		$status=!$_GET['status'];
		$ID=$_GET['optionID'];
		$sql="UPDATE product_seller_edit SET product_status='$status' WHERE option_id='$ID'";
		mysqli_query($con,$sql);
?>
<script>location.href='seller_view_all_products_in_shop.php?shopID=<?php echo $encriptedShopID;?>'</script>
<?php
	}
	else if(isset($_GET['optionID']))
	{
		$sql = "DELETE FROM product_seller_edit WHERE option_id='$_GET[optionID]'";
		mysqli_query($con,$sql);
?>
<script>location.href='seller_view_all_products_in_shop.php?shopID=<?php echo $encriptedShopID;?>'</script>
<?php		
	}
	else if(isset($_GET['shopInventoryID']))
	{
		$sql = "DELETE FROM shop_inventory WHERE shop_inventory_id='$_GET[shopInventoryID]'";
		mysqli_query($con,$sql);
		$sql = "DELETE FROM product_seller_edit WHERE shop_inventory_id='$_GET[shopInventoryID]'";
		mysqli_query($con,$sql);
?>
<script>location.href='seller_view_all_products_in_shop.php?shopID=<?php echo $encriptedShopID;?>'</script>
<?php
	}
?>
