<?php
//This code checks if the product is added to cart.
function check_if_added_to_cart($indexval) {
  if(isset($_SESSION['buyer_id']) && isset($_SESSION['cart_options']) && isset($_SESSION['shopid'])) {
    if(isset($_SESSION['cart_options'][$_SESSION['shopid']][$indexval]))
    {
      return 1;
    }
    else {
      return 0;
    }
}
else{
  return 0;
}
}
?>
