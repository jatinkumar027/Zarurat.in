<?php

require("includes/common.php");
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET["id"];
    unset($_SESSION['cart_options'][$item_id]);
    header("location:cart.php");
}
?>
