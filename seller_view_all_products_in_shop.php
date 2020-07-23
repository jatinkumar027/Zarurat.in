<!-- Model -->

<?php
	require_once('includes/common.php');
	//Logged out user redirected to home page

	if (!isset($_SESSION['email'])) {
		header('location: seller_home.php');
		exit;
	}
	//showing all products in the selected shop
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
	<link rel="stylesheet" type="text/css" href="public/css/sellerLoggedInHeaderCSS.css">
	<link rel="stylesheet" type="text/css" href="public/css/sellerfooterCSS.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<link rel="stylesheet" type="text/css" href="public/css/viewProductInShopCSS.css">
</head>
<body>
<?php include 'includes/seller_header.php'; ?>
	<div class="wrapper">
	<?php
	if($result->num_rows>0)
	{
	?>
		<div class="product-list-container">
			<!-- all selected products will be shown here -->
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
			</table>
		</div>
		<?php
		}
		else {
			?>
			<!-- If no product selected in shop -->

			<h1 style="display: flex; justify-content: center; align-items: center; height: 55vh;"class="message">Shop is empty</h1>
			<?php
		}
		?>

	</div>
<?php include 'includes/seller_home_footer.php';?>
</body>
</html>
