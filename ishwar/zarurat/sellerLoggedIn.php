<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="public/css/sellerhomeCSS.css">
	<link rel="stylesheet" type="text/css" href="public/css/sellerLoggedInCSS.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" type="text/css" href="public/css/sellerfooterCSS.css">
    <script type="text/javascript" src="public/java/sellerLoggedInscript.js"></script>
    <link rel="stylesheet" type="text/css" href="public/css/sellerLoggedInHeaderCSS.css">
</head>
<body>
	<?php include 'sellerLoggedInHeader.php' ?>
	<div class="wrapper">
		<div class="register-shop-btn">
			<button  onclick="showShopForm()">Register your Shop</button>
		</div>
        <div class="shop-form-container" >
        	<form id="shop-info">
        		<div class="choose-shop-type">
                    <div><h1>Choose Category of Shop</h1></div>
        			<div class="radio-toolbar">
    					<input type="radio" id="radioApple" name="shop" value="apple" checked>
    						<label for="radioApple">Grocery</label>

    					<input type="radio" id="radioBanana" name="shop" value="banana">
    						<label for="radioBanana">Bakery</label>

    					<input type="radio" id="radioOrange" name="shop" value="orange">
    						<label for="radioOrange">Medicine</label>
    					<input type="radio" id="radioOrange2" name="shop" value="orange">
    						<label for="radioOrange2">Dairy</label>
					</div>
					
        		</div>
        		<div class="shop-details" >
        			<!-- form -->
                    <div>
                        <div>
                            <input class="input-style" type="text" placeholder="Shop name">
                        </div>
                        <div>
                            <input class="input-style" type="text" placeholder="Shop Address">
                        </div>
                        <div>
                             <input class="input-style" type="text" placeholder="Open Time">
                        </div>
                        <div>
                             <input class="input-style" type="text" placeholder="close Time">
                        </div>
                        <div>
                             <input class="input-style" type="number" placeholder="Minumum no of order">
                        </div>
                        <div>
                            <label style="margin-top: 15px;">Mode of Payment</label>
                            <div style="display: flex; flex-direction: row">
                                <input style="width: 25px; height: 25px; margin:5px; margin-left: 25px;" type="checkbox" name="order-type">
                                <label>Cash</label>
                                <input style="width: 25px; height: 25px; margin:5px; margin-left: 25px;" type="checkbox" name="order-type">
                                <label>Online</label>
                            </div>
                        </div>
                        <div>
                            <input style="margin-top: 15px;" id="create-button" type="submit" value="Create Shop">
                        </div>
                    </div>
        		</div>
        	</form>
        </div>	

	</div>
	<?php include 'footer.php'; ?>
</body>
</html>