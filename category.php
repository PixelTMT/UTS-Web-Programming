<?php
session_start();
//need login
// if (!isset($_SESSION["id"])) {
// 	header("location: login_forum.php");
// }
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
	<link href="css/category.css" rel="stylesheet">
	<title>Profile</title>
</head>

<body>
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
						<li class="nav-item mx-2 align-middle">
							<a href="login_form.php"><button type="button" class="btn btn-outline-danger mr-2 px-3">Login</button></a>
						</li>
						<li class="nav-item align-middle">
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

	<article>
		<div class='container tabbed round mt-4'>
			<ul>
				<li><img src="img/sql.svg"> SQL</li>
				<li><img src="img/ruby.svg"> Ruby</li>
				<li><img src="img/java.svg"> Java</li>
				<li><img src="img/python.svg"> Python</li>
				<li><img src="img/cpp.svg"> C++</li>
				<li><img src="img/javascript.svg"> Javascript</li>
				<li><img src="img/c.svg"> C</li>
				<li class='active'><img src="img/php.svg"> PHP</li>
			</ul>
		</div>
		<div class="container temporary text-center d-flex align-items-center justify-content-center">
			<a href="create_post_form.php"><button class="category-button" role="button">Add Form</button></a>
		</div>

		<div class="container my-4 col-lg-8">
			<?php ?>
			<div class="card-group vgr-cards">
				<div class="card">
					<div class="card-body mx-3">
						<div class="user-container d-flex align-items-center mb-2 text-nowrap">
							<img src="img/SPACELY.svg" alt="Tes Foto User" class="post-header rounded-circle">
							<span class="post-username mx-2">NiceTryKemosabe</span>
							<span class="post-date">24h ago</span>
							<div class="w-100 d-flex justify-content-end">
								<button class="category-button" role="button">PHP</button>
							</div>
						</div>
						<div class="content-container d-flex flex-column">
							<h4 class="card-title">Judul</h4>
							<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ipsam ex et assumenda soluta, voluptatem accusantium tempore aspernatur dolorum nostrum quos, repudiandae culpa quaerat non expedita dolores eveniet illo quisquam repellendus voluptas deleniti! Illum quo molestias necessitatibus tempore quaerat placeat esse?.</p>
						</div>
						<div class="feedback-container d-flex flex-row my-2">
							<button><i class="fa-solid fa-thumbs-up"></i></button>
							<span class="mx-1">5 likes</span>
							<button><i class="fa-solid fa-comment"></i></button>
							<span class="mx-1">2 comments</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>

	<footer>
		<div class="footer p-4">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
						<div class="card border-0">
							<div class="footer-body card-body text-center">
								<h5 class="footer-title card-title display-4" style="font-size:30px">About</h5>
								<p class="d-inline lead text-white">Spacely adalah forum website diskusi seputar pemrograman
									bertujuan menjadi sarana bagi para developer di Indonesia untuk belajar dan
									berdiskusi bareng.
								</p><br>

							</div>
						</div>
					</div>

					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="card border-0">
							<div class="footer-body card-body text-center">
								<h5 class="footer-title card-title display-4" style="font-size:30px">Contact</h5>
								<a class="footer-contact text-light d-block lead" style="margin-left: -20px" href="#"><i class="fa fa-phone mx-2"></i>+62 8123456789</a>
								<a class="footer-contact text-light d-block lead" href="#"><i class="fa fa-envelope mx-2"></i>admin@spacely.com</a>
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="card border-0">
							<div class="footer-body card-body text-center d-flex flex-column">
								<h5 class="footer-title card-title display-4" style="font-size:30px">Menus</h5>

								<a class="footer-menu text-light my-1" href="#"><i class="fa fa-home fa-fw mx-2"></i>Dashboard</a>

								<a class="footer-menu text-light my-1" href="#"><i class="fa fa-th-list fa-fw mx-2"></i>Categories</a>

								<a class="footer-menu text-light my-1" href="#"><i class="fa fa-info-circle fa-fw mx-2"></i>Your Profile</a>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var tabs = document.querySelectorAll('.tabbed li');

			for (var i = 0, len = tabs.length; i < len; i++) {
				tabs[i].addEventListener("click", function() {
					if (this.classList.contains('active'))
						return;

					var parent = this.parentNode,
						innerTabs = parent.querySelectorAll('li');

					for (var index = 0, iLen = innerTabs.length; index < iLen; index++) {
						innerTabs[index].classList.remove('active');
					}

					this.classList.add('active');
				});
			}
		});
	</script>
</body>