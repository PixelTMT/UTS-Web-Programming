<script>
	function List(category){
		var url = new URL(location.href);
    	url.searchParams.set('list', category);
		window.location.href = url;
	}
</script>
<?php
session_start();
//need login

require_once("security.php");

$tabs = array('trends','likes','latest');
$current_tabs = 'trends';
if(isset($_GET['list'])){
	if(in_array($_GET['list'], $tabs)){
		$current_tabs = strtolower($_GET['list']);
	}
}

$sql = "SELECT *,
(
    SELECT username from user
    where id = user_id
) AS 'username',
(
    SELECT img from user
    where id = user_id
) AS 'img',
(
    SELECT categories from forum
    where id = forum_id
) AS 'category'
FROM post ";

$hasil = $db->query($sql);

switch($current_tabs){
	case "trends":
		$sql .= "ORDER BY comment_ammount";
		break;
	case "likes":
		$sql .= "ORDER BY like_ammount";
		break;
	case "latest":
		$sql .= "ORDER BY date_created DESC, time_created DESC";
		break;
}

function CheckActive($_category){
	global $tabs;
	if(isset($_GET['list'])){
		if(in_array($_GET['list'], $tabs) && strtolower($_GET['list']) == $_category){
			echo "active";
		}
	}else{
		if($_category == 'trends'){
			echo "active";
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/regular.min.css" integrity="sha512-aNH2ILn88yXgp/1dcFPt2/EkSNc03f9HBFX0rqX3Kw37+vjipi1pK3L9W08TZLhMg4Slk810sPLdJlNIjwygFw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/solid.min.css" integrity="sha512-uj2QCZdpo8PSbRGL/g5mXek6HM/APd7k/B5Hx/rkVFPNOxAQMXD+t+bG4Zv8OAdUpydZTU3UHmyjjiHv2Ww0PA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
	<script src="js/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link href="css/navbar.css" rel="stylesheet">
	<link href="css/dashboard.css" rel="stylesheet">
	<link href="css/footer.css" rel="stylesheet">
	<link href="css/side_panel.css" rel="stylesheet">
</head>

<body>
	<!-- navbar -->
	<?php include_once './components/navbar.php' ?>

	<!-- hero -->
	<main class="jumbotron jumbotron-fluid">
		<div class="jumboDesc">
			<h1>Welcome to <span>Spacely</span></h1>
			<h2>Chill Place to Learn and Discuss</h2>
			<div style="height: 100px; padding-bottom: 10px;">
				<span id="typed" class="mt-3"></span>
			</div>

			<form action="#" method="POST">
				<button class="btn btn-danger rounded-circle mx-2 my-4" style="width: 35px; height: 35px;" type="submit" name="cari">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
				<input type="text" name="keyword" class="jumbotron-search w-25 text-center">
			</form>
		</div>
	</main>

<aside>
	<div class="social-panel-container">
		<div class="social-panel">
			<p>Spacely Side Panel</p>
			<button class="close-btn"><i class="fas fa-times"></i></button>
			<ul class="mt-3">
				<li>
					<a href="#" class="ms-2">
						<i class="fa-solid fa-phone"></i>
					</a>
					<h5 class="mt-2">Ask Admin</h5>
				</li>
				<li>
					<a href="#">
						<i class="fa-solid fa-pencil"></i>
					</a>
					<h5 class="mx-auto mt-2">Add Post</h5>

				</li>
			</ul>
		</div>
	</div>
	<button class="floating-btn">
		Click me
	</button>
</aside>

	<article>
		<div class="container tabs-container mt-4">
			<div class="tabs-wrap">
				<ul>
					<li class="tabs-trends <?php CheckActive("trends");?>" onclick="List('trends')" data-tabs="trends">Trending</li>
					<li class="tabs-likes <?php CheckActive("likes");?>" onclick="List('likes')" data-tabs="likes">Most Liked</li>
					<li class="tabs-latest <?php CheckActive("latest");?>" onclick="List('latest')" data-tabs="latest">Latest Post</li>
				</ul>
			</div>
		</div>

		<!-- posts -->
		<?php while ($row = $hasil->fetch(PDO::FETCH_ASSOC)) {?>
			<div class="container my-4 col-lg-8">
			<div class="card-group vgr-cards">
				<div class="card border-0 bottom-right-round">
					<div class="card-body me-4 d-flex flex-row">

						<div class="px-2 align-middle text-center justify-content-center align-items-center">
							<div class="d-flex flex-column me-3 mt-1">
								<button class="border-0 bg-transparent p-2" id="upvoteBtn"><i class="fa-solid fa-arrow-up" id="upvoteIcon" style="font-size:1.25rem; color:grey"></i></button>
								<span class="mx-1" id="vote-count"><?= $row['like_ammount']?></span>
								<button class="border-0 bg-transparent p-2" id="downvoteBtn"><i class="fa-solid fa-arrow-down" id="downvoteIcon" style="font-size:1.25rem; color:grey"></i></button>
							</div>
						</div>

						<div class="d-flex flex-column w-100">
							<div class="user-container d-flex align-items-center mb-2 text-nowrap col-lg-12">
								<?php if ($_SESSION['id']) {?>
								<div style="min-width: 50px; min-height: 40px; overflow:hidden;">
								<a href="user_profile.php?id=<?=$row['user_id']?>">
								<img src=<?= "user_img/" . $row['img']?> alt="user img" class="p-0 rounded-circle" style="width: 40px; height: 40px; object-fit:cover;"></a>
								</div>
								<?php } ?>
								<a style="text-decoration: none; color: black;" class="detail-user-profile" href="user_profile.php?id=<?=$row['user_id']?>">
								<span class="post-username me-1"><?= $row['username']?></span></a>
								<i class="fa-solid fa-circle mx-1" style="font-size: 5px;"></i>
								<span class="post-date ms-1 text-muted" style="font-size: 15px;"><?= $row['date_created']?></span>
								<div class="w-100 d-flex flex-row justify-content-end">
									<?php $category = $row['category']; ?>
									<a href="category.php?list=<?= strtolower($category)?>"><button class="category-button" role="button"><?= $row['category']?></button></a>
								</div>
							</div>
							<div class="content-container d-flex flex-column">
								<h4 class="card-title"><?= $row['title']?></h4>
								<p class="card-text card-body-content" style="max-height: 6rem; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient:vertical; overflow: hidden; text-overflow: ellipsis; white-space:wrap;"><?= $row['body']?></p>
							</div>
							<div class="feedback-container d-flex flex-row my-2">
								<button class="px-2 py-2" style="max-width: 10rem"><i class="fa-solid fa-comment" style="color: grey;"></i>
								<span class="mx-auto my-auto" style="font-weight: bold; color: #6B6B6B"><?= $row['comment_ammount']?> comments</span></button>
								<a onMouseOver="this.style.textDecoration='underline'" onMouseOut="this.style.textDecoration='none'" class="post-detail-link ms-auto align-self-end" style="text-decoration: none; color: #6B6B6B; font-size: 13px; " href="post_detail.php">show details</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</article>

	<?php include_once './components/footer.php'; ?>

	<script>
		// typed js
		new Typed('#typed', {
			strings: ['PHP', 'C', 'Javascript', 'C++', 'Python', 'Java', 'Ruby', 'SQL'],
			typeSpeed: 175,
			delaySpeed: 50,
			loop: true
		});

		// tabs for sorting
		var tabs = document.querySelectorAll(".tabs-wrap ul li");

		tabs.forEach((tab) => {
			tab.addEventListener("click", () => {
				tabs.forEach((tab) => {
					tab.classList.remove("active");
				})
				tab.classList.add("active");
			})
		})

	var upvoteBtn = document.getElementById('upvoteBtn');
	var upvoteIcon = document.getElementById('upvoteIcon');

	upvoteBtn.addEventListener('click', function onClick(event) {
		const color = upvoteIcon.style.color;

		if(color === 'grey') {
			upvoteIcon.style.color = '#3d5af1';
		} else {
			upvoteIcon.style.color = 'grey';
		}

		
	})

	var downvoteBtn = document.getElementById('downvoteBtn');
	var downvoteIcon = document.getElementById('downvoteIcon');

	downvoteBtn.addEventListener('click', function onClick(event) {
		const color = downvoteIcon.style.color;

		if(color === 'grey') {
			downvoteIcon.style.color = '#e63946';
		} else {
			downvoteIcon.style.color = 'grey';
		}
	})

	const floating_btn = document.querySelector('.floating-btn');
	const close_btn = document.querySelector('.close-btn');
	const social_panel_container = document.querySelector('.social-panel-container');

	floating_btn.addEventListener('click', () => {
		social_panel_container.classList.toggle('visible')
	});

	close_btn.addEventListener('click', () => {
		social_panel_container.classList.remove('visible')
	});

	</script>
</body>

</html>