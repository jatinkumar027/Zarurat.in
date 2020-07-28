<?php
    session_start();
?>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/seller_home_footer.css">
    <link rel="stylesheet" type="text/css" href="public/css/seller_header.css">
    <link rel="stylesheet" type="text/css" href="public/css/manage_orders.css">
    <script type="text/javascript" src="public/javascript/seller_header.js"></script>
    <script type="text/javascript" src="public/javascript/manage_orders.js"></script>
</head>
<body>
    <?php require 'includes/seller_header.php';?>
    <div style="height:50px;"></div>
    <div class="order-details-popup">
        <div class="close-icon-container">
            <i onclick="hideOrderDetailsPopup(0)" style="font-size : 30px;" class="fa fa-close close-icon"></i>
        </div>
        <div class="intro">
            <label for="">Order Details</label>
            <label id="print-btn" onclick="printOrderReceipt()">Print</label>
        </div>
        <div class="scroll-window">
            <div class="shop-name-order-id">
                <label>Shop Name</label>
                <label>Order ID</label>
            </div>
            <div class="line-container">
                <div class="line"></div>
            </div>
            <div class="order-info">
                <div class="left-info">
                    <label class="heading">Purchased From</label>
                    <label>Seller Name  </label>
                    <label>Shop Number</label>
                    <label>Area</label>
                    <label>City/Pincode</label>
                    <label>State</label>
                    <label class="order-pad"></label>
                    <label class="heading">Payment Method</label>
                    <label>Online</label>
                </div>
                <div class="right-info">
                    <label class="heading">Purchased By</label>
                    <label>Name </label>
                    <label>E-mail</label>
                    <label>Contact</label>
                    <label class="order-pad"></label>
                    <label class="heading">Shipped To</label>
                    <label>Area</label>
                    <label>City/Pincode</label>
                    <label>State</label>
                    <label class="order-pad"></label>
                    <label class="heading">Order Date/Time</label>
                    <label>Sun,26-07-2020 23:45 AM</label>
                </div>
            </div>
            <div class="popup-table-container">
                <label>Product Details</label>
                <table>
                    <tr>
                        <th>S. No.</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Weight/Volume</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    <!-- In loop -->
                    <tr>
                        <td>1</td>
                        <td>Aata</td>
                        <td>Aashirvad</td>
                        <td>10 KG</td>
                        <td>2</td>
                        <td>335₹</td>
                        <td>670₹</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Aata</td>
                        <td>Aashirvad</td>
                        <td>10 KG</td>
                        <td>2</td>
                        <td>335₹</td>
                        <td>670₹</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Aata</td>
                        <td>Aashirvad</td>
                        <td>10 KG</td>
                        <td>2</td>
                        <td>335₹</td>
                        <td>670₹</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Aata</td>
                        <td>Aashirvad</td>
                        <td>10 KG</td>
                        <td>2</td>
                        <td>335₹</td>
                        <td>670₹</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Aata</td>
                        <td>Aashirvad</td>
                        <td>10 KG</td>
                        <td>2</td>
                        <td>335₹</td>
                        <td>670₹</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Aata</td>
                        <td>Aashirvad</td>
                        <td>10 KG</td>
                        <td>2</td>
                        <td>335₹</td>
                        <td>670₹</td>
                    </tr>
                    
                    
                    <!-- In loop -->
                    <tr style="border:none;">
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td >Grand Total</td>
                        <td>5870₹</td>
                    </tr>
                </table>
            </div>
            <div class="accept-reject-btn-container">
                <button class="reject-btn">Reject Order</button>
                <button class="accept-btn">Accept Order</button>
            </div>
        </div>
        
    </div>
    <div class="wrapper">
        <div class="order-list-container">
        <table>
            <tr>
                <th>Buyer Name</th>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Date/Time</th>
                <th>View Details</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        </div>
        <div class="banner">
            <div class="left-banner">

            </div>
            <div class="right-banner">
                <div>
                    <img src="images/delivery_icon.png" alt="">
                    <i style="font-size : 100px; color : white;" class="fas fa-shipping-fast"></i>
                </div>
            </div>
        </div>
    </div>
    <?php require 'includes/seller_home_footer.php';?>
</body>
</html>