<?php 
session_start();
if(isset($_SESSION['OTPTimespan']) && isset($_SESSION['OTPcode'])){
    if(time() - $_SESSION['OTPTimespan'] > 60 * 5){
        $_SESSION['OTPTimespan'] = $_SESSION['OTPcode'] = '';
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
            <input type="number" name="OTPverify" placeholder="Verification Code" required><br>
            <input type="submit" name="verifyEmail" value="Verify">
        </form>
    </div>
</body>

</html>