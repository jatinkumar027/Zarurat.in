<!-- Model -->

<?php
	require_once('includes/common.php');
	//Logged out user redirected to home page
	if (!isset($_SESSION['city']) && !isset($_SESSION['state']) && !isset($_SESSION['pincode']) && !isset($_GET['shopID']) && !isset($_GET['shopcategoryID'])) {
	  header('location: buyer_home.php');
	  exit;
	}
	//showing all products in the selected shop
	$encriptedShopcategoryID = $_GET['shopcategoryID'];
	$encriptedShopID = $_GET['shopID'];
	$shopID = base64_decode($_GET['shopID']);
	$_SESSION['shopid']=$shopID;
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
    <script type="text/javascript" src="public/javascript/buyer_view_all_products_in_shop.js"></script>
    <link rel="stylesheet" type="text/css" href="public/css/buyer_header.css">
    <link rel="stylesheet" type="text/css" href="public/css/buyer_footer.css">
    <link rel="stylesheet" type="text/css" href="public/css/buyer_view_all_products_in_shop.css">
    <script type="text/javascript" src="public/javascript/seller_header.js"></script>
  </head>

  <body>
    <?php include 'includes/buyer_header.php'; ?>
      <?php include 'includes/check-if-added.php'; ?>
        <?php
		if(isset($_SESSION['message']) && isset($_SESSION['color']))
		{
			echo "<script>show_success('$_SESSION[color]');timer_on();</script>";
			array_pop($_SESSION);
			array_pop($_SESSION);
		}
	?>

          <div class="wrapper">
            <?php
	if($result->num_rows>0)
	{
	?>
              <div class="product-list-container">
                <!-- product -->
                <table>
                  <tr>
                    <th>S. No.</th>
                    <th>Thumbnail</th>
                    <th style="width: 15%;">Name</th>
                    <th>Brand</th>
                    <th>Type</th>
                    <th>
                      <div style="border: none;" class="options">
                        <label>MRP&nbsp;(₹)</label>
                        <label>Selling
                          <br/>Price&nbsp;(₹)</label>
                        <label>Weight
                          <br/>Volume</label>
                        <label>Unit</label>
                        <label>Add to Cart</label>
                      </div>
                    </th>
                  </tr>

                  <?php
				$i=1;
				$num=1;
				$indexvalue=0;
				while($row = $result->fetch_assoc())
				{

				?>
                    <tr>
                      <td>
                        <?php echo $i;?>
                      </td>
                      <td><img class="thumbnail" src="public/images/kirana/<?php echo $row['product_thumb'];?>"></td>
                      <td style="width: 15%;">
                        <?php echo $row['product_name'];?>
                      </td>
                      <td>
                        <?php echo $row['product_brand'];?>
                      </td>
                      <td>
                        <?php echo $row['product_type_name'];?>
                      </td>
                      <td>
                        <?php
							$sql = "SELECT * FROM product_seller_edit JOIN product_wt_unit on product_seller_edit.product_wt_unit_id=product_wt_unit.product_wt_unit_id WHERE shop_inventory_id='$row[shop_inventory_id]'";
							$result2 = mysqli_query($con,$sql);

							while($row2 = $result2->fetch_assoc())
							{
								$indexvalue++;

							?>
                          <form id="option-form<?php echo $num;?>" action="seller_view_all_products_in_shop.php?shopID=<?php echo $_GET['shopID'];?>&update=true&optionID=<?php echo $row2['option_id'];?>&shopcategoryID=<?php echo $encriptedShopcategoryID;?>" method="post">
                            <div class="options">

                              <label>
                                <input class="input-style" type="number" value="<?php echo $row2['product_mrp']; ?>" name="mrp" disabled="true">
                              </label>
                              <label>
                                <input class="input-style" type="number" value="<?php echo $row2['product_sp']; ?>" name="sp" disabled="true">
                              </label>
                              <label>
                                <input style="width:100%;" class="input-style" type="number" value="<?php echo $row2['product_quantity']; ?>" name="weight" disabled="true">
                              </label>
                              <label>
                                <select class="unit-picker" name="unit" disabled="true">
                                  <option value="<?php echo $row2['product_wt_unit_id'];?>">
                                    <?php echo $row2['product_wt_unit_name'];?>
                                  </option>
                                  <?php
										if($row2['product_wt_unit_id']!='1')
											echo "<option value='1'>Kg</option>";
										if($row2['product_wt_unit_id']!='2')
											echo "<option value='2'>g</option>";
										if($row2['product_wt_unit_id']!='3')
											echo "<option value='3'>L</option>";
										if($row2['product_wt_unit_id']!='4')
										 	echo "<option value='4'>mL</option>";
										 ?>
                                </select>
                              </label>
                              <?php if (isset($_SESSION['buyer_id'])) { ?>
                                <button onclick="showBuyerSigninSignupPopup();" type="button" name="button" value="Add to Cart" class="add-to-cart-btn">Add to Cart</button>
                                <?php
								} else {
										//We have created a function to check whether this particular product is added to cart or not.
											 	if (check_if_added_to_cart($indexvalue) ){ //This is same as if(check_if_added_to_cart != 0)
												echo "<button type='button' name='button' class='added-to-cart-btn' disabled=true>Added to Cart</button>";
												} else {
												?>
                                  <button type="button" onclick="location.href='buyer_view_all_products_in_shop.php?shopID=<?php echo $_GET['shopID'];?>&update=true&optionID=<?php echo $row2['option_id'];?>&shopcategoryID=<?php echo $encriptedShopcategoryID;?>&arrayunique=<?php echo $indexvalue;?>';"
                                  name="button" value="Add-to-cart" class="add-to-cart-btn">Add to Cart</button>
                                  <?php
										}
								}
								?>
                            </div>
                          </form>
                          <?php
							$num++;
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
                <div class="message" style="margin-top: 100px;margin-bottom: 50px;">
                  <div style="height: 50px;"></div>
                  <h1 style="display: flex; justify-content: center; align-items: center; height: 25vh;" class="message">Sorry, No Shops found Registered in this area.</h1>
                  <div class="shop-btn">
                    <a href="buyer_view_shops.php">
                      <button>Go Back</button>
                    </a>
                  </div>
                </div>
                <?php
		}
		?>

          </div>

          <div class="info">

          </div>
          <?php include 'includes/buyer_footer.php';?>
  </body>

  </html>

  <!-- add product to cart -->
  <?php
	if(isset($_GET['update']) && isset($_GET['optionID']) && isset($_SESSION['shopid']))
	{
		$index=$_GET['arrayunique'];
		$_SESSION['cart_options'][$_SESSION['shopid']][$index]=$_GET['optionID'];
		$_SESSION['message'] = 'Added Successfully';
		$_SESSION['color'] = '#2ecc71';
		?>
    <script>
      location.href = 'buyer_view_all_products_in_shop.php?shopID=<?php echo $encriptedShopID;?>&shopcategoryID=<?php echo $encriptedShopcategoryID;?>&index=<?php echo $index;?>'
    </script>
    <?php
	}
	mysqli_close($con);

?>
