<?php 

session_start();
require_once 'isAdmin.php';
require_once("security.php");

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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
	<script src="js/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<link rel="stylesheet" href="css/admin.css">
		<link rel="stylesheet" href="css/dashboard.css">
  </head>
  <body>

		<div class="wrapper d-flex">
			<nav id="sidebar" class="active">
				<div class="p-4">
		  		<h1><a href="admin.php" style="text-decoration: none; color: #fff;" class="logo">Admin Panel</a></h1>
	        <ul class="list-unstyled components mb-5">
				<li>
					<a href="admin_posts.php"><span class="fa-solid fa-rectangle-list my-3 me-2"></span>Posts List</a>
				</li>
				<li>
					<a href="admin_users.php"><span class="fa-solid fa-user-group my-3 me-2"></span>User Data</a>
				</li>
				<li>
					<a href="#"><span class="fa-solid fa-chart-bar my-3 me-2"></span>Export Statistic</a>
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
    <main>
    <div id="content" class="container p-4 p-md-5 pt-5 ms-5">
        <h2 class="my-4 text-center">All User Posts</h2>
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
                                <button class="btn btn-danger mx-auto">Delete Post</button>
								<a onMouseOver="this.style.textDecoration='underline'" onMouseOut="this.style.textDecoration='none'" class="post-detail-link ms-auto align-self-end" style="text-decoration: none; color: #6B6B6B; font-size: 13px; " href="post_detail.php">show details</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
      </div>
	</div>
    </main>


  </body>
</html>