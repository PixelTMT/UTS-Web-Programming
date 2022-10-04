<?php
require_once("NeedLogin.php");
// require_once('security.php');

// $sql = "SELECT * FROM post";
// $fetching = $kunci->query($sql);
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
</head>

<body>
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg sticky-top">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="img/LOGO.svg" width="45" height="45" alt="">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nvbCollapse" aria-controls="nvbCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="nvbCollapse">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item mx-1">
						<a class="nav-link" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item mx-1">
						<a class="nav-link" href="category.php">Categories</a>
					</li>
					<li class="nav-item mx-1">
						<a class="nav-link" href="profile.php"><i class="fa-sharp fa-solid fa-user border border-white rounded-circle p-1"></i></a>
					</li>
					<li class="nav-item mx-3 align-middle">
						<a href="login_form.php"><button type="button" class="btn btn-outline-danger mr-2 px-3">Login</button></a>
					</li>
					<li class="nav-item align-middle">
						<a href="create_account_form.php"><button type="button" class="btn btn-danger mr-2">Register</button></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- hero -->
	<main class="jumbotron jumbotron-fluid">
		<div class="jumboDesc">
			<h1>Selamat datang di <b>Rocket</b></h1>
			<h2>Tempat Belajar dan Berdiskusi Bahasa</h2>
			<span id="typed" class="mt-3"></span>

			<form action="#" method="POST">
				<button class="btn btn-danger rounded-circle mx-2 my-4" type="submit" name="cari">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
				<input type="text" name="keyword" class="jumbotron-search w-25 text-center">
			</form>
		</div>
	</main>

	<article>
		<div class="container my-4 col-lg-8">
			<div class="card-group vgr-cards">
				<div class="card">
					<div class="card-body mx-3">
						<div class="user-container d-flex align-items-center mb-2">
							<img src="img/LOGO.svg" alt="Tes Foto User" class="post-header rounded-circle">
							<span class="post-username mx-2">NiceTryKemosabe</span>
							<span class="post-date">1h</span>
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
			<div class="card-group vgr-cards mt-3">
				<div class="card">
					<div class="card-body mx-3">
						<div class="user-container d-flex align-items-center mb-2">
							<img src="img/LOGO.svg" alt="Tes Foto User" class="post-header rounded-circle">
							<span class="post-username mx-2">NiceTryKemosabe</span>
							<span class="post-date">1h</span>
							<div class="w-100 d-flex justify-content-end">
								<button class="category-button" role="button">PHP</button>
							</div>
						</div>
						<div class="content-container d-flex flex-column">
							<h4 class="card-title">Judul</h4>
							<p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempore aspernatur aliquid quod exercitationem commodi amet veniam eos, in omnis unde expedita eum, impedit ex qui vel quas nam. Molestias beatae inventore saepe, est minima tempore, veritatis libero repellendus sapiente assumenda possimus nihil dolor omnis quod quaerat impedit aut laborum corrupti voluptatem maxime eius. Nam facilis eius dolore aliquid earum deleniti fuga soluta at totam magnam libero amet id iste, ut incidunt beatae mollitia? Voluptas laborum omnis ducimus, beatae quia eveniet laudantium quibusdam. Nisi doloribus voluptate, illum quae exercitationem maiores eum expedita ipsa, consequuntur neque debitis beatae fuga. Dolores reprehenderit earum a maxime eum, omnis voluptas dolor consectetur! Id culpa neque consequuntur non dicta a consectetur tempore eveniet molestias, quas totam rerum aliquid aliquam aspernatur vero reprehenderit soluta enim. Asperiores repellendus soluta quod excepturi error neque sit molestias perspiciatis odit labore animi veniam, sint quis voluptatem consequatur dignissimos repudiandae fugit optio nam. Vitae architecto saepe perferendis possimus hic odit quis, recusandae id ea maiores ipsam in tempora quo? Alias natus omnis velit rem iure architecto cumque maiores sit, ut nulla quo tenetur dolores ipsum pariatur aspernatur dolorum repudiandae distinctio amet! Dolores a tempore, vero aliquam voluptatibus maiores deserunt minus vel iure eligendi ducimus iusto corporis harum esse expedita cupiditate possimus voluptatum? Vel mollitia porro adipisci eligendi similique, iure ex quod quaerat unde deleniti nesciunt laudantium modi possimus eos nisi nam necessitatibus cum quibusdam molestias facilis beatae? Cum nulla, sint nam nobis rem odit est perspiciatis expedita. Pariatur voluptatibus quod quos illum nobis cum fugiat qui tenetur earum dolorem hic nihil in aut repellendus minus, voluptatem perferendis, velit laboriosam consequatur, rem temporibus eius tempora! Unde possimus soluta cumque qui ducimus quo, voluptatibus iusto eveniet nesciunt illum ratione aliquid neque voluptatum? Nam libero distinctio voluptatibus accusamus ipsam deserunt delectus dignissimos obcaecati quae earum, saepe molestiae aliquam quod est placeat fuga commodi omnis eaque, quisquam incidunt provident architecto. Explicabo nesciunt ad deserunt debitis numquam, sapiente dolores ratione veritatis repellat temporibus obcaecati eum cum, corporis, animi voluptatem nostrum asperiores quos eaque reprehenderit enim consequatur! Dolorum corrupti, voluptatibus delectus obcaecati qui ipsum vitae. Perferendis dolorum fuga laboriosam iure animi soluta, quam aliquid odio laudantium molestias? Voluptatum quidem consectetur quia incidunt, quasi cumque corporis alias numquam consequuntur dolor quisquam veritatis optio sapiente nemo id nam, voluptas libero nisi iste enim. Laborum, iste natus voluptatem maiores perferendis fuga corrupti molestiae dicta nihil excepturi eveniet, nostrum rem enim illum culpa assumenda officia suscipit quas possimus debitis error odit consequatur quasi. Illo ab illum earum! Voluptas iste, voluptatum rerum quidem, voluptatem provident sunt ullam optio itaque magnam illo quibusdam nam veritatis dolor accusantium architecto necessitatibus amet sint! Quas vitae fuga ea ipsam repellat tempore rem similique, ipsa illum explicabo ut animi quaerat cum omnis nostrum corporis dignissimos nesciunt voluptatibus nobis blanditiis adipisci. Ipsum, doloremque natus. Et molestias incidunt excepturi. Ipsam dolorem fuga ab aperiam fugiat perspiciatis nisi ducimus officiis odit dicta, ullam voluptate rem, ad, ex illo omnis? Sunt tempora illum consectetur recusandae sequi iusto corporis debitis esse molestiae explicabo pariatur iste nostrum earum distinctio quidem natus hic ab odit quas reprehenderit, sit eos possimus id! Ullam saepe dolores quidem minus. Illo aspernatur fuga dignissimos voluptas? Hic nisi ullam sunt voluptas ut ea voluptatem necessitatibus obcaecati? Corporis, incidunt autem! Dolore labore magni, rem voluptas nesciunt impedit aut, doloribus ex corrupti harum est ratione omnis excepturi dicta dolores sapiente earum commodi consectetur animi unde architecto libero quam nostrum ab. Rem alias aut fugiat provident quis consequuntur aliquid minima doloribus ea voluptatem sed ut voluptates, ipsum commodi similique, velit assumenda odit laborum cupiditate dolor. Ut tempore est numquam eveniet architecto omnis quia dolorem at saepe repudiandae fuga vitae assumenda nihil, repellendus optio autem in inventore laudantium reiciendis! Non sit ex, architecto ratione rem rerum distinctio amet maiores temporibus dolorum eligendi quidem minus excepturi possimus, vitae nemo modi accusantium assumenda incidunt perferendis delectus? Libero vero amet voluptas optio enim veniam est ea, quis vitae, nulla exercitationem et omnis rerum? Incidunt quo architecto quam reprehenderit cum quasi optio distinctio quas. Doloremque aperiam molestias odit cumque perferendis quas voluptate numquam maxime ullam deserunt. Possimus exercitationem obcaecati consequuntur quod, porro eius excepturi maxime? Corporis, consequuntur inventore. Optio nulla delectus animi fugiat esse eligendi repellat rem modi, quidem tenetur iusto praesentium nam adipisci omnis accusamus! Illum natus quod nisi dolorem nulla, impedit cupiditate perspiciatis voluptatem non obcaecati, aliquam doloremque culpa asperiores eaque consequuntur autem accusantium inventore ullam corrupti fuga error. Non dignissimos rerum pariatur sapiente doloribus fuga obcaecati assumenda nemo, tempore eaque culpa vitae officia delectus. Tenetur officiis, nihil quaerat saepe asperiores reprehenderit repudiandae, dolorem in aut, repellat laboriosam rerum sapiente quae nobis sunt porro animi pariatur cum provident odio magnam ex. In, quis ullam totam temporibus sapiente vel et eius assumenda natus cupiditate recusandae excepturi facere aliquid placeat veritatis reiciendis velit? Asperiores porro, dicta quisquam placeat praesentium molestias explicabo, nostrum laudantium officia ab at quam.</p>
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
								<p class="d-inline lead text-white">Rocket adalah forum website diskusi seputar pemrograman
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
								<a class="footer-contact text-light d-block lead" href="#"><i class="fa fa-envelope mx-2"></i>admin@rocket.com</a>
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
		new Typed('#typed', {
			strings: ['PHP', 'C', 'Javascript', 'C++', 'Python', 'Java', 'Ruby', 'SQL', 'Swift', 'Kotlin'],
			typeSpeed: 200,
			delaySpeed: 50,
			loop: true
		});
	</script>
</body>

</html>