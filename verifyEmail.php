<?php 
session_start();
require_once 'mailing.php';

if(isset($_SESSION['OTPTimespan']) && isset($_SESSION['OTPcode'])){
    if(time() - $_SESSION['OTPTimespan'] > 60 * 5){
        $_SESSION['OTPTimespan'] = $_SESSION['OTPcode'] = '';
    }
}
if(isset($_GET['resend'])){
    if(isset($_SESSION['OTPcode']) && isset($_SESSION['OTPTimespan'])){
        if(time() - $_SESSION['OTPTimespan'] > 60){
            $code = rand(999999, 111111);
            $_SESSION['OTPcode'] = $code;
            $_SESSION['OTPTimespan'] = time();
            $subject = 'Email Verification Code';
            $message = "Forgot your password? your verification code is $code, this code will expire in 5 minute";
            sendingEmail($_SESSION['ChangeEmail'], $subject, $message);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/forget.css">
</head>

<body>
    <div class="main container d-flex flex-column justify-content-center align-items-center mt-5">
        <div class="text-center mt-4 header mx-auto">
            <img src="img/SPACELY.svg" class="logo mt-2 mb-4" alt="...">
            <header>
                <p class="h3" style="font-weight:100;">OTP Verification</p>
            </header>
        </div>
        <div class="login d-flex justify-content-center align-items-center mt-4">
            <form action="verifyEmail_process.php" method="POST" autocomplete="off">
                <div class="row form-group">
                    <div class="col">
                        <?php
                        if (isset($_SESSION['ERROR'])) {
                            if($_SESSION['ERROR'] != ''){?>
                                <div id="alert"><?php echo $_SESSION['ERROR']; ?></div>
                            <?php
                            $_SESSION['ERROR'] = '';
                            }
                        }
                        ?>
                        <label for="OTPverify" class="form-label mt-2 mb-2"> Verify Email </label>
                        <br />
                        <label style="opacity: 0.5;"> Enter Verification code from your Email</label>
                        <input type="text" class="form-control mt-1" name="OTPverify" placeholder="Verification Code" required
                        <?php
                            if(isset($_GET['OTPcode'])){
                                echo "value='".$_GET['OTPcode']."'";
                            }
                        ?>>

                        <input type="submit" class="mt-2 mb-2 btn btn-danger" name="verifyEmail" value="Verify">
                    </div>
                </div>
            </form>
        </div>
        <div class="footer mt-4 d-flex text-center justify-content-center">
            <p>not receive the code yet? &nbsp;</p>
            <a href="./verifyEmail.php?resend=0000">Resend
            </a>
        </div>

        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>