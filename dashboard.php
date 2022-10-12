<script>
	function List(category) {
		var url = new URL(location.href);
		url.searchParams.set('list', category);
		window.location.href = url;
	}

	function addLike(like_ammount) {
		return like_ammount += 1;
	}
</script>
<?php
session_start();
require_once("security.php");
<<<<<<< Updated upstream
include_once 'deleteStuff.php';
if(isset($_POST['delete'])){
	if(isset($_POST['deletePost'])){
		deletePost($_POST['deletePost']);
		//echo $_POST['deletePost'];
	}
	if(isset($_POST['deleteComment'])) {
		deleteComment($_POST['deleteComment']);
		//echo $_POST['deleteComment'];
=======
if($_SESSION['isAdmin']){
	include_once 'deleteStuff.php';
	if(isset($_POST['delete'])){
		if(isset($_POST['deletePost'])){
			deletePost($_POST['deletePost']);
			//echo $_POST['deletePost'];
		}
		if(isset($_POST['deleteComment'])) {
			deleteComment($_POST['deleteComment']);
			//echo $_POST['deleteComment'];
		}
>>>>>>> Stashed changes
	}
}

$tabs = array('trends', 'likes', 'latest');
$current_tabs = 'trends';
if (isset($_GET['list'])) {
	if (in_array($_GET['list'], $tabs)) {
		$current_tabs = strtolower($_GET['list']);
	}
}

$sql = "SELECT *, id post,
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
) AS 'category',
(
	SELECT SUM(like_bool) FROM likes GROUP BY post_id HAVING post_id = id 	
) AS total_likes,
(
	SELECT 
	CASE 
	WHEN body is NULL
	THEN 0
	ELSE COUNT(body)
	END
	FROM comment
	WHERE post_id = post
) AS total_comment
FROM post ";

if(isset($_GET['keyword'])){
	$sql .= "WHERE title like '%{$_GET['keyword']}%' ";
}
switch ($current_tabs) {
	case "trends":
		$sql .= "ORDER BY (total_likes * 0.3) + (total_comment * 0.7) DESC";
		break;
	case "likes":
		$sql .= "ORDER BY total_likes DESC";
		break;
	case "latest":
		$sql .= "ORDER BY date_created DESC, time_created DESC";
		break;
}
$hasil = $db->query($sql);

function CheckActive($_category)
{
	global $tabs;
	if (isset($_GET['list'])) {
		if (in_array($_GET['list'], $tabs) && strtolower($_GET['list']) == $_category) {
			echo "active";
		}
	} else {
		if ($_category == 'trends') {
			echo "active";
		}
	}
}

function getTotalLikes($_post_id)
{
	global $db;
	$sql = "SELECT SUM(like_bool) AS total_likes FROM likes GROUP BY post_id having post_id = ?";
	$stmt = $db->prepare($sql);
	$stmt->execute([$_post_id]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row["total_likes"];
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
	<link href="css/navbar.css" rel="stylesheet">
	<link href="css/dashboard.css" rel="stylesheet">
	<link href="css/footer.css" rel="stylesheet">
	<link href="css/side_panel.css" rel="stylesheet">
</head>

<body>
	<!-- navbar -->
	<?php include_once './components/navbar.php'  ?>

	<!-- hero -->
	<main class="jumbotron jumbotron-fluid">
		<div class="jumboDesc">
			<h1>Welcome to <span>Spacely</span></h1>
			<h2>Chill Place to Learn and Discuss</h2>
			<div style="height: 100px; padding-bottom: 10px;">
				<span id="typed" class="mt-3"></span>
			</div>

			<form action="dashboard.php" method="get">
				<button class="btn btn-danger rounded-circle mx-2 my-4" style="width: 35px; height: 35px;" type="submit">
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
						<a href="create_post_form.php">
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
					<li class="tabs-trends <?php CheckActive("trends"); ?>" onclick="List('trends')" data-tabs="trends">Trending</li>
					<li class="tabs-likes <?php CheckActive("likes"); ?>" onclick="List('likes')" data-tabs="likes">Most Liked</li>
					<li class="tabs-latest <?php CheckActive("latest"); ?>" onclick="List('latest')" data-tabs="latest">Latest Post</li>
				</ul>
			</div>
		</div>

		<!-- posts -->
		<?php while ($row = $hasil->fetch(PDO::FETCH_ASSOC)) { ?>
			<div class="container my-4 col-lg-8">
				<div class="card-group vgr-cards">
					<div class="card border-0 bottom-right-round">
						<div class="card-body me-4 d-flex flex-row">

							<div class="px-2 align-middle text-center justify-content-center align-items-center">
								<div class="d-flex flex-column me-3 mt-1 justify-content-center align-items-center">
									<?php if (!empty($_SESSION["id"])) { ?>
										<button type="button" class="upvoteBtn border-0 bg-transparent p-2 pt-3" id="like-<?= $row['id'] ?>-<?= $_SESSION['id'] ?>" name="upvoteBtn" value="like">
											<i class="fa-solid fa-arrow-up" id="upvoteIcon" style="font-size:1.25rem; color:grey"></i></button>
										<span class="mx-1 mb-3 mt-3" id="vote-count-<?= $row['id'] ?>"><?= getTotalLikes($row["id"]) ?></span>
										<button type="button" class="downvoteBtn border-0 bg-transparent p-2 pt-1" id="dislike-<?= $row['id'] ?>-<?= $_SESSION['id'] ?>" name="downvoteBtn" value="dislike"><i class="fa-solid fa-arrow-down" id="downvoteIcon" style="font-size:1.25rem; color:grey"></i></button>
								</div>
							<?php } else { ?>
								<button type="button" class="upvoteBtn border-0 bg-transparent p-2 pt-3" id="like-<?= $row['id'] ?>-no_session" name="upvoteBtn" value="like">
									<i class="fa-solid fa-arrow-up" id="upvoteIcon" style="font-size:1.25rem; color:grey"></i></button>
								<span class="mx-1 mb-3 mt-3" id="vote-count-<?= $row['id'] ?>"><?= getTotalLikes($row["id"]) ?></span>
								<button type="button" class="downvoteBtn border-0 bg-transparent p-2 pt-1" id="dislike-<?= $row['id'] ?>-no_session" name="downvoteBtn" value="dislike"><i class="fa-solid fa-arrow-down" id="downvoteIcon" style="font-size:1.25rem; color:grey"></i></button>
							</div>
						<?php } ?>
						</div>

						<div class="d-flex flex-column w-100">
							<div class="user-container d-flex align-items-center mb-2 text-nowrap col-lg-12">
								<div style="min-width: 50px; min-height: 40px; overflow:hidden;">
									<a href="user_profile.php?id=<?= $row['user_id'] ?>">
										<img src=<?= "user_img/" . $row['img'] ?> alt="user img" class="p-0 rounded-circle" style="width: 40px; height: 40px; object-fit:cover;"></a>
								</div>
								<a style="text-decoration: none; color: black;" class="detail-user-profile" href="user_profile.php?id=<?= $row['user_id'] ?>">
									<span class="post-username me-1"><?= $row['username'] ?></span>
								</a>

								<i class="fa-solid fa-circle mx-1" style="font-size: 5px;"></i>
								<span class="post-date ms-1 text-muted" style="font-size: 15px;"><?= $row['date_created'] ?></span>
								<div class="w-100 d-flex flex-row justify-content-end">
									<?php $category = $row['category']; ?>
									<a href="category.php?list=<?= strtolower($category) ?>"><button class="category-button" role="button"><?= $row['category'] ?></button></a>
								</div>
							</div>
							<div class="content-container d-flex flex-column">
								<h4 class="card-title"><?= $row['title'] ?></h4>
								<p class="card-text card-body-content" style="max-height: 6rem; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient:vertical; overflow: hidden; text-overflow: ellipsis; white-space:wrap;"><?= $row['body'] ?></p>
							</div>
							<?php include_once "comment.php" ?>
							<?php $stmt2 = get_comment($row["id"]);
							$flag = 0; ?>
							<div class="feedback-container d-flex flex-row my-2">
								<button class="btn-show-comment px-2 py-2" id="show_comment-<?= $row["id"] ?>"><i class=" fa-solid fa-comment" style="color: grey;"></i>
									<span class="mx-auto my-auto total_comment" id="total_comment-<?= $row["id"] ?>" style="font-weight: bold; color: #6B6B6B"><?= get_comment_total($row["id"]) ?> comments</span>
								</button>
							</div>
							<?php if($_SESSION['isAdmin']){?>
								<form action="dashboard.php" method='post'>
									<input type="text" name='deletePost' value=<?= $row["id"] ?> hidden>
									<button class="btn btn-danger px-4 py-2" name='delete'>Delete Post</button>
								</form>
							<?php }?>
							<div id="test-<?= $row["id"] ?>">
								<?php while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) { ?>
									<?php $flag = 1; ?>
									<div class="card mb-3 comment-container show_comment_container-<?= $row2["post_id"] ?>">
										<div class="d-flex flex-column w-100">
											<div class="card-container d-flex align-items-center mb-2 text-nowrap">
												<div class="user-container d-flex align-items-center mb-2 text-nowrap col-lg-12">
													<div style="min-width: 50px; min-height: 40px; overflow:hidden;">
														<a href="user_profile.php?id=<?= $row2['user_id'] ?>">
															<img src=<?= "user_img/" . $row2['img'] ?> alt="user img" class="p-0 rounded-circle" style="width: 40px; height: 40px; object-fit:cover;"></a>
													</div>
													<a style="text-decoration: none; color: black;" class="detail-user-profile" href="user_profile.php?id=<?= $row2['user_id'] ?>">
														<span class="post-username me-1"><?= $row2['username'] ?></span>
													</a>

													<i class="fa-solid fa-circle mx-1" style="font-size: 5px;"></i>
													<span class="post-date ms-1 text-muted" style="font-size: 15px;"><?= $row2['date_created'] ?></span>
													<?php if($_SESSION['isAdmin']){?>
														<form action="dashboard.php" method='post'>
															<input type="text" name='deleteComment' value=<?= $row2["id"] ?> hidden>
															<button class="btn btn-danger px-1 py-1" name='delete'>Delete Comment</button>
														</form>
													<?php }?>
												</div>
											</div>
											<div class="content-container d-flex flex-column">
												<p class="card-text"><?= $row2['body'] ?></p>
											</div>
										</div>
									</div>
								<?php } ?>
								<?php if ($flag == 0) { ?>
									<div class=" card comment-container show_comment_container-<?= $row["id"] ?>">
										<div class="d-flex flex-column w-100 text-center py-1">
											<h4 class="pt-2"> no comments yet.. </h4>
										</div>
									</div>
								<?php } ?>
							</div>
							<form action="#" method="post" enctype="multipart/form-data">
								<div class="feedback-container d-flex flex-row my-2">
									<?php if (!empty($_SESSION["id"])) { ?>
										<input type="text" class="form-control" id="comment_body-<?= $row["id"] ?>" placeholder="add your reply..." aria-label="" aria-describedby="basic-addon1">
										<div class="input-group-prepend">
											<button class="btn-add btn btn-outline-danger" type="button" id="add-<?= $row["id"] ?>-<?= $row["user_id"] ?>">Add</button>
										</div>
									<?php } ?>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			</div>
		<?php } ?>
	</article>
	<?php include_once './components/footer.php'; ?>
	<script type="text/javascript" src="js/buttons.js"></script>
</body>

</html>