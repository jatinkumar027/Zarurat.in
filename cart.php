<?php
require("includes/common.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cart | Zarurat.in</title>
        <link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
        <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="public/css/buyer_footer.css">
        <link rel="stylesheet" type="text/css" href="public/css/cart.css">
        <link rel="stylesheet" type="text/css" href="public/css/buyer_header.css">
        <script type="text/javascript" src="public/javascript/seller_header.js"></script>
    </head>
    <body>
      <?php include 'includes/buyer_header.php'; ?>

      <?php
      $check=array();
      $check=$_SESSION['cart_options'];
       if($check) {?>
        <div class="container-fluid" id="content">
            <div class="row decor_bg">
                <div class="col-md-6 col-md-offset-3">
                    <table class="table table-striped">

                        <!--show table only if there are items added in the cart-->
                        <?php
                        $sum = 0;
                        $id=0;
                        // $buyer_id = $_SESSION['buyer_id'];
                            ?>
                            <thead>
                                <tr>
                                    <th>Item No.</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Weight/Volume</th>
                                    <th>Quantity</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                              <?php

                                $var=array();
                                $var=$_SESSION['cart_options'];
                                foreach ($var as $key => $value)
                                {

                                  $query = "SELECT shop_name from seller_shop where shop_id=$key";
                                  $result = mysqli_query($con, $query)or die(mysqli_error($con));
                                  $row = mysqli_fetch_array($result)
                                  ?>
                                  <h1 style="margin-top:80px;"><?php echo $row['shop_name'] ?></h1>
                                  <?php
                                  foreach ($value as $two) {

                                  $id++;
                                  $query = "SELECT seller_shop.shop_name as shopname, product_seller_edit.product_sp AS price, products.product_thumb AS image, product_seller_edit.product_quantity AS quantity, product_wt_unit.product_wt_unit_name AS unit,products.product_name AS name FROM products JOIN product_seller_edit JOIN shop_inventory join product_wt_unit join seller_shop ON product_seller_edit.shop_inventory_id=shop_inventory.shop_inventory_id AND shop_inventory.product_id=products.product_id AND product_seller_edit.product_wt_unit_id=product_wt_unit.product_wt_unit_id AND shop_inventory.shop_id=seller_shop.shop_id WHERE option_id=$two";
                                  $result = mysqli_query($con, $query)or die(mysqli_error($con));
                                  while ($row = mysqli_fetch_array($result)) {
                                      $sum+= $row["price"];
                                      echo "<tr><td>" . "#" . $id . "</td><td><img src=public/images/kirana/".$row['image']." class='thumbnail'></td><td>" . $row["name"] . "</td><td>Rs " . $row["price"] . "</td><td>" . $row["quantity"] ." ". $row["unit"] ."</td><td><select name='qty' required='true' >
                            						<option value disabled selected>Qty - 1</option>
                            						<option value='2'>2</option>
                            						<option value='3'>3</option>
                            						<option value='4'>4</option>
                            						<option value='5'>5</option>
	                                       </select></td><td><a href='cart-remove.php?id={$id}' class='remove_item_link'> Remove</a></td></tr>";
                                  }
                                ?>
                            </tbody>
                            <?php
                        }
                        ?>
                        <?php
                        echo "<tr><td></td><td></td><td></td><td></td><td>Total</td><td>Rs " . $sum . "</td><td><a href='Success.php' class='btn btn-primary'>Confirm Order</a></td></tr>";
                      }
                      }
                       else {
                      ?>
                      <div class="message" style="margin-bottom: 30px;">
                      <div style="height: 50px;"></div>
                      <h1 style="display: flex; justify-content: center; align-items: center; height: 60vh;"class="message">Your cart is waiting</h1>
                      <div class="shop-btn">
                        <a href="buyer_home.php"><button>Visit Shops</button></a>
                       </div>
                      </div>
                      <?php
                        }
                        ?>
                        <?php
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <?php include("includes/buyer_footer.php"); ?>
    </body>
</html>
