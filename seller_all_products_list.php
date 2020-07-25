<!-- Model -->

<?php
	require_once('includes/common.php');
	//Logged out user redirected to home page

	if (!isset($_SESSION['email'])) {
	  header('location: seller_home.php');
	  exit;
	}
	//getting list of all products prefilled

	$encriptedShopcategoryID = $_GET['shopcategoryID'];
	$encriptedShopID = $_GET['shopID'];
	$shopcategoryID = base64_decode($_GET['shopcategoryID']);
	$shopID = base64_decode($_GET['shopID']);
	$sql = "SELECT * FROM products JOIN product_type JOIN shop_category on products.product_type_id=product_type.product_type_id AND products.shop_category_id=shop_category.shop_category_id WHERE products.shop_category_id=$shopcategoryID";
	$result = mysqli_query($con,$sql);
?>

<!-- View -->

<!DOCTYPE html>
<html>
<head>
	<title>All Products List | Zarurat.in </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="public/css/seller_header.css">
	<link rel="stylesheet" type="text/css" href="public/css/seller_home_footer.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/seller_all_products_list.css">
	<script type="text/javascript" src="public/javascript/seller_all_products_list.js"></script>
	<script type="text/javascript" src="public/javascript/seller_header.js"></script>
</head>
<body onload="showOnlyOneOption();countSelectedItems()">

<?php include 'includes/seller_header.php'; ?>

<div class="wrapper">
	<?php
	if($result->num_rows>0)
	{
	?>
	<div class="page-info">
		<h4>Products - List</h4>
		<div class="left-pad"></div>
		<div class="search-container">
			<select id="select-category-option" name="" id="">
				<option value="">All Categories</option>
				<option value="">Category Name</option>
			</select>
			<input class="search-box" type="text" placeholder="Search Products here...">
			<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
		</div>
		<div class="right-pad"></div>	
		<h4 style="margin-right: 10px;"><label>Selected Items  &nbsp;</label>
		<label id="count-selected-items">0</label>
		</h4>
	</div>
	<?php
	}
	else
	{
		?>
		<div class="message">No Products to Show</div>
		<?php
	}
	?>
	<form action="" method="post">
		<div style="display: flex; flex-direction: column;align-items:  center; width: 100%;" class="product-list-container">

			<!-- showing all product prefilled from database -->

			<?php
			$i=0;
			while($row = $result->fetch_assoc())
			{
			$sql = "SELECT * FROM shop_inventory WHERE product_id='$row[product_id]' AND shop_id='$shopID'";
			$res = mysqli_query($con,$sql);
			?>
			<div <?php if($res->num_rows>0){ echo "style='background: rgba(0, 153, 130 ,0.2);'";}?>class="product">
				<div><?php echo $i+1;?></div>
				<div class="thumbnail">
					<img src="public/images/kirana/<?php echo $row['product_thumb'];?>">
				</div>
				<div class="pro-name">
					<?php echo $row['product_name'];?>
				</div>
				<div class="pro-brand">
					<?php echo $row['product_brand'];?>
				</div>
				<div>
					<?php echo $row['product_type_name'];?>
				</div>
				<div class="product-option">

					<?php
					for($itr=0;$itr<4;$itr++)
					{
					?>
					<div class="options">
						<input class="option-input-style mrp" type="text" name="MRP[]" placeholder="MRP" disabled="true">
						<input class="option-input-style sp" type="text" name="SP[]" placeholder="SP" disabled="true">
						<select class="select-field" name="status[]" disabled="true">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
						<input class="option-input-style quantity" type="number" name="Quantity[]" placeholder="wt / vol" disabled="true">
						<select class="select-field" name="unit[]" disabled="true">
							<option value="1">Kg</option>
							<option value="2">gm</option>
							<option value="3">L</option>
							<option value="4">ml</option>
						</select>
					</div>
					<?php
					}
					?>
					<div style="display: flex;">
						<i class="fa fa-plus-square add-icon" onclick="addOption(<?php echo $i; ?>)"></i>
						<i class="fa fas fa-minus-square minus-icon" onclick="hideOption(<?php echo $i; ?>)"></i>
					</div>

				</div>

				<div class="select-item-by-check-box">
				
					<input onclick="onChecboxSelected(<?php echo $i; ?>);countSelectedItems();enableDisable(<?php echo $i; ?>);" class="select-item" style="width: 25px; height: 25px;" type="checkbox" name="productID[]" value="<?php echo $row['product_id']; ?>">
					
				</div>
				<?php
				if($res->num_rows>0)
				{
				?>
				<div class="product-message">
					<label >Already</label>
					<label >In shop</label>
				</div>
				<?php
				}
				?>
				
			</div>
			<?php
				$i++;
			}
			?>

		</div>
		<div style="display: flex; justify-content: center; margin: 30px 0px;">
			<?php
			if($result->num_rows>0)
			{
			?>
			<input id="add-items-btn" style="width: 50%;" type="submit" value="Add Selected Items to Shop">
			<?php
			}
			?>
		</div>
	</form>
<!-- All product list ends here -->
</div>
<?php include 'includes/seller_home_footer.php';?>
</body>
</html>

<!--Model -->

<!-- Insert selected products to shop -->
<?php
	if(isset($_POST['MRP']) && isset($_POST['SP']) && isset($_POST['status']) && isset($_POST['Quantity']) && isset($_POST['unit']))
	{
		$MRP = $_POST['MRP'];
		$SP = $_POST['SP'];
		$status = $_POST['status'];
		$quantity = $_POST['Quantity'];
		$unit = $_POST['unit'];
		$productID = $_POST['productID'];
		$k = 0;
		$m = 0;
		for($i=0;$i<sizeof($productID);$i++)
		{
			$control = 0;
			for($j=0;$j<4;$j++)
			{
				if(!empty($MRP[$m]) && !empty($SP[$m]) && !empty($quantity[$m]) && !empty($unit[$m]))
				{					
					$control = 1;
					break;
				}
				$m++;
			}

			if($control == 1)
			{
				$proID = $productID[$i];
				$sql = "SELECT * FROM shop_inventory WHERE product_id='$proID' AND shop_id='$shopID'";
				$res = mysqli_query($con,$sql);
				if($res->num_rows == 0) // if product is not in shop
				{	
					$sql = "INSERT INTO `shop_inventory` (`shop_inventory_id`, `shop_id`, `product_id`) VALUES (NULL, '$shopID', '$proID')";

					mysqli_query($con,$sql) or die(mysqli_error($con));

					$sql = "SELECT shop_inventory_id FROM shop_inventory ORDER BY shop_inventory_id DESC LIMIT 1";
					$result = mysqli_query($con,$sql);
					$row = $result->fetch_assoc();
					$shopInventoryID = $row['shop_inventory_id'];
				}	
				else {  // if product is already in shop

					$row = $res->fetch_assoc();
					$shopInventoryID = $row['shop_inventory_id'];
				}


				for($j=0;$j<4;$j++)
				{
					if(!empty($MRP[$k]) && !empty($SP[$k]) && !empty($quantity[$k]) && !empty($unit[$k]))
					{
						$sql = "INSERT INTO `product_seller_edit` (`option_id`, `shop_inventory_id`, `product_mrp`, `product_sp`, `product_status`, `product_quantity`, `product_wt_unit_id`) VALUES (NULL, '$shopInventoryID', '$MRP[$k]', '$SP[$k]', '$status[$k]', '$quantity[$k]', '$unit[$k]');";
						mysqli_query($con,$sql) or die(mysqli_error($con));

					}
					$k++;
				}
			}
		}
		?>
		<script type="text/javascript">location.href='seller_view_all_products_in_shop.php?shopID=<?php echo $encriptedShopID;?>&shopcategoryID=<?php echo $encriptedShopcategoryID;?>';</script>
		<?php
	}
	mysqli_close($con);
?>
