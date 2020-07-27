<!-- Header shown after seller is logged in -->
<div class="logged-in-header">
  <div class="left">
    <a href="index.php">Zarurat.in</a>
    <a href="buyer_home.php">Buyer Home</a>
  </div>
</div>
<!-- SIGN IN SIGN UP POP UP
........................ -->

<?php
    require_once('includes/common.php');
?>
<html>
<head>
    <title></title>
    <style>
        .buyer-signin-signup-popup
        {
            width : 400px;
            height :450px;
            position : absolute;
            transform : translate(-50%,-50%);
            left : 50%;
            top : 50%;
            box-shadow : 0px 0px 3px 0px black;
        }
        .popup-intro
        {
            display : flex;
            align-items : center;
            font-weight : 600;
            font-size : 20px;
            background : #ecf0f1;
        }
        .popup-intro label
        {
            display : flex;
            flex : 1;
            height : 40px;
            justify-content : center;
            align-items : center;
        }
        .popup-intro label:hover
        {
            cursor : pointer;
        }

        .popup-intro label:nth-child(1)
        {
            border-top-right-radius : 15px;
            border-bottom-right-radius : 15px;
            background: linear-gradient(90deg, #FEC001, #FA990A);
        }
        .popup-intro label:nth-child(2)
        {
            border-top-left-radius : 15px;
            border-bottom-left-radius : 15px;
        }

        .input-style
        {
            width: 80%;
            height: 30px;
            border:2px solid #7f8c8d;
            margin-top: 30px;
            border-top: none;
            border-left: none;
            border-right: none;
            padding-left: 5px;
            font-size: 17px;
        }
        .input-style:focus
        {
            outline:none;
            border-bottom: 2px solid #3498db;
            transition: border linear 500ms;
        }
        .submit-style
        {
            width: 80%;
            height: 40px;
            margin-top: 30px;
            margin-right: 5px;
            margin-left: 5px;
            cursor: pointer;
            font-size: 17px;
            border:2px solid #169483;
            border-radius: 5px;
            text-align : center;
        }

        .submit-style:focus
        {
            outline: none;

        }
        .submit-style:hover
        {
            color: white;
            background: #169483;
        }
        .form-field-container
        {
            display : flex;
            flex-direction : column;
            align-items : center;
        }
        .login-form-container
        {
            display : none;
        }
        .register-form-container
        {
            display : block;
        }
        #buyer-form-close-icon
        {
            position : absolute;
            right : -28px;
            top : -4px;
        }
        #buyer-form-close-icon:hover
        {
            color : red;
            cursor : pointer;
        }
        #form-message
        {
            display: flex;
            flex: 1;
            justify-content: center;
            color: red;
        }
    </style>
    <script>
        function showBuyerSigninSignupPopup()
        {
            document.getElementsByClassName('buyer-signin-signup-popup')[0].style.display = 'block';
        }
        function showRegistrationForm()
        {
            document.getElementsByClassName('register-form-container')[0].style.display="block";
            document.getElementsByClassName('login-form-container')[0].style.display="none";
            document.getElementById('register-label').style.background='linear-gradient(90deg, #FEC001, #FA990A)';
            document.getElementById('login-label').style.background='#ecf0f1';

        }
        function showLoginForm()
        {
            document.getElementsByClassName('register-form-container')[0].style.display="none";
            document.getElementsByClassName('login-form-container')[0].style.display="block";
            document.getElementById('register-label').style.background='#ecf0f1';
            document.getElementById('login-label').style.background='linear-gradient(90deg, #FEC001, #FA990A)';
        }
        function closeFormPopup()
        {
            document.getElementsByClassName('buyer-signin-signup-popup')[0].style.display = 'none';
        }
        function checkPassword()
        {
            var x = document.getElementById('pass').value;
            var y = document.getElementById('confpass');
            if(x == y.value)
            {
                y.style.border = "2px solid #2ecc71";
            }
            else{
                y.style.border = "2px solid #e74c3c";
            }
        }
    </script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
        <div class="buyer-signin-signup-popup">
                <div class="close-icon-container">
                    <i onclick="closeFormPopup();" id="buyer-form-close-icon" style="font-size: 27px;" class="fa fa-close"></i>
                </div>
                <div class="popup-intro">
                    <label id="register-label"  onclick="showRegistrationForm()">Register</label>
                    <label id="login-label"  onclick="showLoginForm()">Login</label>
                </div>
                <div class="register-form-container">
                    <form action="" method="post">
                        <div class="form-field-container">
                            <input class="input-style" type="text" name="name" placeholder="Name">
                            <input class="input-style" type="email" name="email" placeholder="E-mail">
                            <input class="input-style" type="number" name="contact" placeholder="Contact">
                            <input id="pass" class="input-style" type="password" name="password" placeholder="Password">
                            <input id="confpass" oninput="checkPassword()" class="input-style" type="password" name="confpass" placeholder="Confirm Password">
                            <input type="submit" class="submit-style" value="Register">
                        </div>
                    </form>
                </div>
                <div class="login-form-container">
                    <form action="" method="post">
                        <div class="form-field-container">
                            <input class="input-style" name="signinemail-mobile" type="text" placeholder="E-mail/Mobile Number">
                            <input class="input-style" name="signinpass" type="password" placeholder="Password">
                            <input name="signin" type="submit" class="submit-style" value="Login">
                        </div>
                    </form>
                </div>
                <label id="form-message">
                    <?php
                        if(isset($_SESSION['failure']))
                        {
                            echo $_SESSION['failure'];
                            unset($_SESSION['failure']);
                        }

                    ?>
                </label>
        </div>
</body>
</html>

<?php





if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['contact'])&&isset($_POST['password'])&&isset($_POST['confpass']))
{
    if(!empty($_POST['name'])&&!empty($_POST['email'])&&!empty($_POST['contact'])&&!empty($_POST['password'])&&!empty($_POST['confpass']))
    {
        $sql="SELECT * FROM `buyer_reg` WHERE buyer_email = '$_POST[email]'";

        $result=mysqli_query($con,$sql);

        if($result->num_rows==0)
        {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = MD5($_POST['password']);


        $sql= " INSERT INTO `buyer_reg` (`buyer_id`, `buyer_name`, `buyer_email`, `buyer_contact`, `buyer_password`) VALUES (NULL, '$name', '$email', '$contact', '$password'); ";

        mysqli_query($con,$sql);

        }
        else $_SESSION['failure']="Email Already Exist";

    }
}

?>

<?php
    if(isset($_POST['signin']))
{
    // Getting the values from the signin page using $_POST[] and cleaning the data submitted by the user.

      $signinemailmobile = $_POST['signinemail-mobile'];
      $signinemailmobile = mysqli_real_escape_string($con, $signinemailmobile);

      $signinpass = $_POST['signinpass'];
      $signinpass = mysqli_real_escape_string($con, $signinpass);
      $signinpass = MD5($signinpass);

        // Query checks if the email / mobile number and password are present in the database.
      $query = "SELECT buyer_id, buyer_email, buyer_name FROM buyer_reg WHERE (buyer_email='" . $signinemailmobile . "' OR buyer_contact='" . $signinemailmobile . "') AND buyer_password='" . $signinpass . "'";
      $result = mysqli_query($con, $query)or die(mysqli_error($con));
      $num = mysqli_num_rows($result);

    // If the email and password are not present in the database, the mysqli_num_rows returns 0, it is assigned to $num.

    if ($num == 0) {

        $_SESSION['failure']="Please enter correct E-mail id / Mobile Number or Password";

        return;


    } else {
      $row = mysqli_fetch_array($result);
      $_SESSION['buyer_email'] = $row['buyer_email'];
      $_SESSION['buyer_id'] = $row['buyer_id'];
      $_SESSION['buyer_name'] = $row['buyer_name'];
        //seller is logged in and redirected to the dashboard
    }

}

?>
