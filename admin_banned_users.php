<?php

session_start();
require_once('isAdmin.php');
require_once("security.php");
require_once('deleteStuff.php');

if(isset($_POST['delete'])){
    if(isset($_POST['user_id_delete'])) {
        deleteUser($_POST['user_id_delete']);
		unset($_POST['user_id_delete']);
        echo "<span class='d-flex justify-content-center text-center'>  {$_POST['username']} has been <b> Deleted </b> </span>";
		//echo $_POST['user_id_delete'];
	}
	if(isset($_POST['user_id_unban'])) {
        unbanUser($_POST['user_id_unban']);
		unset($_POST['user_id_unban']);
        echo "<span class='d-flex justify-content-center text-center'>  {$_POST['username']} has been <b> Unbanned </b> </span>";
		//echo $_POST['user_id_unban'];
	}
    unset($_POST['delete']);
}

$sql = "SELECT * from user where id = ANY(SELECT user_id from banned)"; //ni ganti jangan user sesuai database 
$stmt = $db->prepare($sql);
$data = [$_SESSION["id"]];
$stmt->execute($data);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/regular.min.css" integrity="sha512-aNH2ILn88yXgp/1dcFPt2/EkSNc03f9HBFX0rqX3Kw37+vjipi1pK3L9W08TZLhMg4Slk810sPLdJlNIjwygFw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/solid.min.css" integrity="sha512-uj2QCZdpo8PSbRGL/g5mXek6HM/APd7k/B5Hx/rkVFPNOxAQMXD+t+bG4Zv8OAdUpydZTU3UHmyjjiHv2Ww0PA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>

    <div class="wrapper d-flex">
        <nav id="sidebar" class="active">
            <div class="p-4">
                <h1><a href="#" style="text-decoration: none; color: #fff;" class="logo">Admin Panel</a></h1>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="admin_users.php"><span class="fa-solid fa-user-group my-3 me-2"></span>User Data</a>
                    </li>
                    <li>
                        <a href="#"><span class="fa-solid fa-chart-bar my-3 me-2"></span>Export Statistic</a>
                    </li>
                    <li>
                        <a href="admin_banned_users.php"><span class="fa-solid fa-chart-bar my-3 me-2"></span>Banned Users</a>
                    </li>
                    <li>
                        <a href="dashboard.php"><span class="fa-solid fa-chart-bar my-3 me-2"></span>Back</a>
                    </li>
                    <li>
                        <a href="login_form.php"><span class="fa-solid fa-chart-bar my-3 me-2"></span>Logout</a>
                    </li>
                </ul>

                <div class="mb-5">
                    <h3 class="h6 mb-3">Search User</h3>
                    <form action="#" class="subscribe-form">
                        <div class="form-group d-flex">
                            <div class="icon"><span class="icon-paper-plane"></span></div>
                            <input type="text" class="form-control" placeholder="Enter any username">
                        </div>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Page Content  -->
        <main class="d-flex flex-column justify-content-center align-items-center">
            <h2 class=" my-4 ms-6 text-center">All Banned Users Account</h2>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="d-flex flex-row justify-content-center align-items-center" style="width: 1500px;">
                    <div class="container mb-4 d-flex flex-row col-lg-6">
                        <div class="container col-lg-12 card profile-container d-flex flex-row mt-4 mx-2" style="max-height: 25rem;">
                            <div class="profile-bio d-flex flex-column ms-auto me-auto my-4">
                                <div class="my-3" style="width: 150px; height: 150px; overflow: hidden;">
                                    <img src=<?= "user_img/" . $row["img"] ?> class="rounded-circle" style="width: 150px; height: 150px; object-fit:cover;">
                                </div>
                                <h3><?= $row["username"] ?></h3>
                                <span class="my-1"><?= $row["email"] ?></span>
                            </div>
                            <div class="d-flex flex-column my-auto me-auto">
                                <form action="admin_banned_users.php" method='post'>
                                    <input type="text" name='user_id_unban' value="<?= $row["id"] ?>" hidden>
                                    <input type="text" name='username' value="<?= $row["username"] ?>" hidden>
                                    <input type="text" name='delete' value="delete" hidden>
                                    <button class="adminBtn edit-profile btn btn-danger my-2 px-3" style="max-width: 10rem;" id="ban-<?= $row['id'] ?>-<?= $row['username'] ?>">unBan User</button>
                                </form>
                                <form action="admin_banned_users.php" method='post'>
                                    <input type="text" name='user_id_delete' value="<?= $row["id"] ?>" hidden>
                                    <input type="text" name='username' value="<?= $row["username"] ?>" hidden>
                                    <input type="text" name='delete' value="delete" hidden>
                                    <button class="adminBtn edit-profile btn btn-danger my-2 px-3" style="max-width: 10rem;" id="delete-<?= $row['id'] ?>-<?= $row['username'] ?>">Delete Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>