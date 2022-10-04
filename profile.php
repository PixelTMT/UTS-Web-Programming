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
					<li class="nav-item mx-2 my-1">
						<a class="nav-link" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item mx-2 my-1">
						<a class="nav-link" href="category.php">Categories</a>
					</li>
					<li class="nav-item mx-2 my-1">
						<a class="nav-link" href="profile.php"><i class="fa-sharp fa-solid fa-user fa-lg"></i></a>
					</li>
					<li class="nav-item mx-2 align-middle">
						<a href="login_form.php"><button type="button" class="btn btn-outline-danger mr-2 px-3 my-1">Login</button></a>
					</li>
					<li class="nav-item mx-2 align-middle">
						<a href="create_account_form.php"><button type="button" class="btn btn-danger mr-2 my-1">Register</button></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

<main>
    <div class="container card profile-container d-flex flex-row mt-4">
        <div class="profile-bio d-flex flex-column col-lg-3 ms-3 py-3">
            <img src="img/SPACELY.svg" style="max-width: 6rem;">
            <h3>John Thor</h3>
            <span class="my-1">johnthor@gmail.com</span>
            <span class="my-1">john_thor</span>
            <button class="edit-profile btn btn-warning my-2" style="max-width: 8rem;">Edit Profile</button>
        </div>
        <div class="profile-posts-container flex-column col-lg-9 py-3 px-3">
            <div class="profile-posts my-2">
                <h5>Judul Post 1</h5>
                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro doloremque ex ad, tenetur eos ut sapiente, maiores illo repudiandae quas quisquam quia excepturi unde, tempora accusamus doloribus minus nostrum facere!</span>
            </div>
            <div class="profile-posts my-2">
                <h5>Judul Post 2</h5>
                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro doloremque ex ad, tenetur eos ut sapiente, maiores illo repudiandae quas quisquam quia excepturi unde, tempora accusamus doloribus minus nostrum facere!</span>
            </div>
            <div class="profile-posts my-2">
                <h5>Judul Post 3</h5>
                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro doloremque ex ad, tenetur eos ut sapiente, maiores illo repudiandae quas quisquam quia excepturi unde, tempora accusamus doloribus minus nostrum facere!</span>
            </div>
        </div>


    </div>
</main>
</body>
</html>