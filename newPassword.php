<?php 
session_start();
if(($_SESSION['OTPTimespan'] != 'YOU WIN!' && $_SESSION['OTPcode'] != 'YOU WIN!') ||
    ($_SESSION['OTPTimespan'] == 'PASSCHANGE' && $_SESSION['OTPcode'] == 'PASSCHANGE') ){
    exit(header('location: login_form.php'));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/forget.css">
</head>

<body>
<div class="main container d-flex flex-column justify-content-center align-items-center mt-5">
        <div class="text-center mt-4 header mx-auto">
            <img src="img/SPACELY.svg" class="logo mt-2 mb-4" alt="...">
            <header>
                <p class="h3" style="font-weight:100;">Change Password</p>
            </header>
        </div>
        <div class="login d-flex justify-content-center align-items-center mt-4">
            <form action="newPassword_process.php" method="POST" autocomplete="off">
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
                        <label for="password" class="form-label mt-2 mb-2"> Password </label>
                        <input type="password" class="form-control mt-1" name="password" placeholder="Password" required><br>
                        <label for="password3" class="form-label mt-2 mb-2"> Comfirm Password </label>
                        <input type="password" class="form-control mt-1" name="password2" placeholder="Confirm Password" required><br>
                        <input type="submit" class="mt-2 mb-2 btn btn-danger" name="changePassword" value="Change Password">
                    </div>
                </div>
            </form>
        </div>

        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>