<?php 
session_start();
if(isset($_SESSION['OTPTimespan']) && isset($_SESSION['OTPcode'])){
    if(time() - $_SESSION['OTPTimespan'] > 60 * 5){
        $_SESSION['OTPTimespan'] = $_SESSION['OTPcode'] = '';
    }
}
if(isset($_GET['resend'])){
    if(isset($_SESSION['OTPcode']) && $_SESSION['OTPTimespan']){
        if(time() - $_SESSION['OTPTimespan'] > 60){
            $code = rand(999999, 111111);
            $_SESSION['OTPcode'] = $code;
            $_SESSION['OTPTimespan'] = time();
            $subject = 'Email Verification Code';
            $message = "Forgot your password? your verification code is $code, this code will expire in 5 minute";
            $stat = sendingEmail($_POST['email'], $subject, $message);
        }
        else{
            $t = 60 - (time() - $_SESSION['OTPTimespan']);
            echo "<script type='text/javascript'>alert('Wait for {$t} seconds');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification Form</title>
    <link rel="stylesheet" href="css/forgot.css">
</head>

<body>
    <div id="container">
        <h2>Email</h2>
        <div id="line"></div>
        <form action="create_account_verify_process.php" method="POST" autocomplete="off">
            <?php
            if (isset($_SESSION['ERROR'])) {
                if($_SESSION['ERROR'] != ''){?>
                    <div id="alert"><?php echo $_SESSION['ERROR']; ?></div>
                <?php
                $_SESSION['ERROR'] = '';
                }
            }
            ?>
            <input type="number" name="OTPverify" placeholder="Verification Code" required
            <?php
                if(isset($_GET['OTPcode'])){
                    echo "value='".$_GET['OTPcode']."'";
                }
            ?>><br>
            <a href="./create_account_verify.php?resend=0000">
                <input type="button" name="resend" value="resend">
            </a>
            <input type="submit" name="verifyEmail" value="Verify">
        </form>
    </div>
</body>

</html>