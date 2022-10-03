<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <link href="css/navbar.css" rel="stylesheet">
</head>

<body style="background-color:#3D5A80;">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#293241;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/LOGO.svg" width="45" height="45" alt="">
            </a>
            <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link active" href="dashboard.php">Dashboard</a>
                    <a class="nav-link active" href="category.php">Categories</a>
                    <a href="login_form.php"><button type="button" class="btn btn-outline-success mr-2">Login</button></a>
                    <a href="create_account_form.php"><button type="button" class="btn btn-success mr-2">Register</button></a>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>