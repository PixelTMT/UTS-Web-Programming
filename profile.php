<?php
require "NeedLogin.php";
//user data
$dsn = "mysql:host=localhost;dbname=uts_forum";
$kunci = new PDO($dsn, "root", "");
$sql = "SELECT * FROM user
WHERE id = ?";
$stmt = $kunci->prepare($sql);
$stmt->execute([$_SESSION["id"]]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//post history
$sql2 = "SELECT * FROM post
WHERE user_id = ?";
$stmt = $kunci->prepare($sql2);
$stmt->execute([$_SESSION["id"]]);
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/regular.min.css" integrity="sha512-aNH2ILn88yXgp/1dcFPt2/EkSNc03f9HBFX0rqX3Kw37+vjipi1pK3L9W08TZLhMg4Slk810sPLdJlNIjwygFw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/solid.min.css" integrity="sha512-uj2QCZdpo8PSbRGL/g5mXek6HM/APd7k/B5Hx/rkVFPNOxAQMXD+t+bG4Zv8OAdUpydZTU3UHmyjjiHv2Ww0PA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
	<script src="js/jquery.js"></script>
	<link href="css/navbar.css" rel="stylesheet">
	<link href="css/dashboard.css" rel="stylesheet">
	<link href="css/footer.css" rel="stylesheet">
	<link href="css/profile.css" rel="stylesheet">
	<title>Profile</title>
</head>

<body>
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg sticky-top">
		<div class="container">
			<a class="navbar-brand" href="dashboard.php">
				<img src="img/SPACELY.svg" width="45" height="45" alt="">
			</a>
			<button class="navbar-toggler navbar-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#nvbCollapse" aria-controls="nvbCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse text-center" id="nvbCollapse">
				<ul class="navbar-nav nav ms-auto">
					<li class="nav-item mx-2 my-2">
						<a class="nav-link" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item mx-2 my-2">
						<a class="nav-link" href="category.php">Categories</a>
					</li>
					<?php
					if (empty($_SESSION['id'])) {
					?>
						<li class="nav-item mx-2 my-2 align-middle">
							<a href="login_form.php"><button type="button" class="btn btn-outline-danger mr-2 px-3">Login</button></a>
						</li>
						<li class="nav-item mx-2 my-2 align-middle">
							<a href="create_account_form.php"><button type="button" class="btn btn-danger mr-2">Register</button></a>
						</li>
					<?php
					} else {
					?>
						<li class="nav-item mx-2 my-1">
							<a class="nav-link" href="profile.php">
								<?= $_SESSION["username"]; ?>
								<img src=<?= "user_img/" . $_SESSION["id"] . $_SESSION["img"] ?> alt="Tes Foto User" class="rounded-circle" style="width: 32px;">
							</a>
						</li>

						<li class="nav-item mx-2 my-2">
							<a href="login_form.php"><button type="button" class="btn btn-outline-danger mr-2 px-3">Log Out</button></a>
						</li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</nav>

	<main>
		<div class="container card profile-container d-flex flex-row mt-4">
			<div class="profile-bio d-flex flex-column col-lg-3 ms-3 py-3 justify-content-center align-items-center">
				<img src=<?= "user_img/" . $row["img"] ?> style="max-width: 12rem;">
				<h3><?= $row["username"] ?></h3>
				<span class="my-1"><?= $row["email"] ?></span>
				<a href="edit_profile.php"><button class="edit-profile btn btn-warning my-2" style="max-width: 8rem;">Edit Profile</button></a>
			</div>
			<div class="profile-posts-container flex-column col-lg-9 py-3 px-3">
				<div class="pb-3">
					<h3>History</h3>
				</div>
				<?php if (!$row2) {
				?>
					<div>
						<h2> you havent post anything yet </h2>
						<div class="container temporary text-center d-flex align-items-center justify-content-center">
							<a href="create_post_form.php"><button class="category-button" role="button">Add Post</button></a>
						</div>
					</div>
					<?php
				} else {
					while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<div class="profile-posts my-2 mb-3">
							<div class="w-100 d-flex justify-content-between align-items-center">
								<h5><?= $row2["title"] ?></h5>
								<button class="category-button" role="button"><?= get_category($row2["forum_id"]) ?></button>
							</div>
							<div class="my-2 d-flex flex-column">
								<span class="mb-2"><?= $row2["date_created"] ?></span>
								<span><?= $row2["body"] ?></span>
							</div>
							<div class=" feedback-container d-flex flex-row my-3">
								<i class="fa-solid fa-thumbs-up"></i>
								<span class="mx-1"><?= $row2["like_ammount"] ?></span>
								<i class="fa-solid fa-comment"></i>
								<span class="mx-1"><?= $row2["comment_ammount"] ?></span>
							</div>
							<hr>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</main>
	<?php
	function get_category($forum_id)
	{
		switch ($forum_id) {
			case "F0001":
				$forum_id = "c++";
				break;
			case "F0002":
				$forum_id = "python";
				break;
			case "F0003":
				$forum_id = "java";
				break;
			case "F0004":
				$forum_id = "ruby";
				break;
			case "F0005":
				$forum_id = "sql";
				break;
			case "F0006":
				$forum_id = "sql";
				break;
			case "F0007":
				$forum_id = "c";
				break;
			case "F0008":
				$forum_id = "javascript";
				break;
		}
		return $forum_id;
	} ?>
</body>

</html>