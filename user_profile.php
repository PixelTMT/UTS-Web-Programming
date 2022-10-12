<?php
require_once "db.php";
require_once 'security.php';
require_once 'deleteStuff.php';
session_start();
$url = $_SERVER['REQUEST_URI'];
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	exit(header("location:profile.php"));
}

if (isset($_POST['delete'])) {
	if (isset($_POST['deletePost'])) {
		deletePost($_POST['deletePost']);
		//echo $_POST['deletePost'];
	}
	if (isset($_POST['deleteComment'])) {
		deleteComment($_POST['deleteComment']);
		//echo $_POST['deleteComment'];
	}
	if (isset($_POST['banUser'])) {
		banUser($_POST['banUser']);
		//echo $_POST['banUser'];
	}
	if (isset($_POST['unbanUser'])) {
		unbanUser($_POST['unbanUser']);
		//echo $_POST['banUser'];
	}
}

//user data
$sql = "SELECT * FROM user
WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//post history
$sql2 = "SELECT * FROM post
WHERE user_id = ?";
$stmt = $db->prepare($sql2);
$stmt->execute([$id]);
$result = $stmt->fetchAll();

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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
	<script src="js/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link href="css/navbar.css" rel="stylesheet">
	<link href="css/dashboard.css" rel="stylesheet">
	<link href="css/footer.css" rel="stylesheet">
	<link href="css/profile.css" rel="stylesheet">
	<title>Profile</title>
</head>

<body>
	<!-- navbar -->
	<?php include_once './components/navbar.php' ?>

	<main>
		<div class="container profile-main-container mb-4 justify-content-center">
			<div class="container col-lg-3 card profile-container d-flex flex-row mt-4 mx-2" style="max-height: 25rem;">
				<div class="profile-bio d-flex flex-column justify-content-center align-items-center ms-auto me-auto">
					<div class="my-3" style="width: 150px; height: 150px; overflow: hidden;">
						<img src=<?= "user_img/" . $row["img"] ?> class="rounded-circle" style="width: 150px; height: 150px; object-fit:cover;">
					</div>
					<h3><?= $row["username"] ?></h3>
					<span class="my-1"><?= $row["name"] ?></span>
					<span class="my-1"><?= $row["email"] ?></span>
					<?php if ($_SESSION['isAdmin']) { ?>
						<form action="<?= $url ?>" method='post'>
							<input type="text" name='banUser' value=<?= $row["id"] ?> hidden>
							<button class="btn btn-danger px-1 py-1" name='delete'>Ban User</button>
						</form>
					<?php } ?>
					<?php if ($_SESSION['isAdmin']) { ?>
						<form action="<?= $url ?>" method='post'>
							<input type="text" name='unbanUser' value=<?= $row["id"] ?> hidden>
							<button class="btn btn-danger px-1 py-1" name='delete'>unBan User</button>
						</form>
					<?php } ?>
				</div>
			</div>
			<div class="container card profile-container d-flex flex-row mt-4 mx-2 col-lg-8">
				<div class="profile-posts-container flex-column col-lg-12 py-3 px-3">
					<div class="pb-3">
						<h3>History</h3>
					</div>
					<?php if (!$result) {
					?>
						<div>
							<h2 class="text-center mb-3"> <?= $row["username"] ?> haven't posted anything yet </h2>
						</div>
				</div>
				<?php
					} else {
						foreach ($result as $row2) {
				?>
					<div class="profile-posts my-2 mb-3">
						<span class="mb-3 text-muted" style="font-size: 14px"><?= $row2["date_created"] ?></span>

						<div class="w-100 mt-1 d-flex justify-content-between align-items-center p-2 text-white" style="overflow-wrap: anywhere; border-top-right-radius: 30px; border-bottom-right-radius: 30px; border-top-left-radius: 6px; border-bottom-left-radius: 6px; background-color:#44318d;">

							<h5 class="ms-2"><?= $row2["title"] ?></h5>
							<button class="category-button" role="button"><?= get_category($row2["forum_id"]) ?></button>
						</div>
						<div class="my-2 d-flex flex-column">

							<a onMouseOver="this.style.backgroundColor='#D9D9D9'" onMouseOut="this.style.backgroundColor='rgba(236,236,236,0.5)'" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row2["id"] ?>" class="p-3 rounded" style="cursor: pointer; background-color:rgba(236,236,236,0.5); color: black; text-decoration: none; ">
								<span class="post-body-content"><?= $row2["body"] ?></span></a>

							<!-- modal to show more text of body -->
							<div class="modal" id="modal<?php echo $row2["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="modallabel1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content p-3">
										<div class="modal-header">
											<h5 class="modal-title">Post Body</h5>
										</div>
										<div class="modal-body">
											<p><?= $row2["body"] ?></p>
										</div>
									</div>
								</div>
							</div>
							<!-- close modal-->
							<div class="feedback-container d-flex flex-row my-3">
								<div class="border border-3 border-light rounded me-2 p-1">
									<button disabled class="rounded-circle bg-transparent">
										<i class="fa-solid fa-thumbs-up"></i>
									</button>
									<span class="mx-1"><?= getTotalLikes($row2["id"]) ?></span>
								</div>

								<div class="border border-3 border-light rounded me-2 p-1">
									<?php include_once "comment.php"; ?>
									<?php $stmt2 = get_comment($row2["id"]);
									$flag = 0; ?>
									<button class="btn-show-comment px-2 py-2" id="show_comment-<?= $row2["id"] ?>"><i class=" fa-solid fa-comment" style="color: grey;"></i>
										<span class="mx-auto my-auto total_comment" id="total_comment-<?= $row2["id"] ?>" style="font-weight: bold; color: #6B6B6B"><?= get_comment_total($row2["id"]) ?> comments</span>
									</button>
									<div id="test-<?= $row2["id"] ?>">
										<?php while ($row3 = $stmt2->fetch(PDO::FETCH_ASSOC)) { ?>
											<?php $flag = 1; ?>
											<div class="card my-2 comment-container show_comment_container-<?= $row3["post_id"] ?>">
												<div class="d-flex flex-column w-100">
													<div class="card-container d-flex align-items-center mb-2 text-nowrap">
														<img src=<?= "user_img/" . $row3['img'] ?> alt="user img" class="post-header rounded-circle p-0 me-2" style="width: 40px; height: 40px; object-fit:cover;>
																<span class=" post-username mx-2"><?= $row3['username'] ?></span>
														<i class="fa-solid fa-circle mx-1" style="font-size: 5px;"></i>
														<span class="post-date ms-1 text-muted" style="font-size: 15px;"><?= $row3['date_created'] ?></span>
													</div>
													<div class="content-container d-flex flex-column">
														<p class="card-text"><?= $row3['body'] ?></p>
													</div>
												</div>
											</div>
											<?php if ($_SESSION['isAdmin']) { ?>
												<form action="<?= $url ?>" method='post'>
													<input type="text" name='deleteComment' value=<?= $row3["id"] ?> hidden>
													<button class="btn btn-danger px-1 py-1" name='delete'>Delete Comment</button>
												</form>
											<?php } ?>
										<?php } ?>
										<?php if ($flag == 0) { ?>
											<div class=" card comment-container show_comment_container-<?= $row["id"] ?>">
												<div class="d-flex flex-column w-100 text-center py-1">
													<h4 class="pt-2"> no comments yet.. </h4>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<?php if ($_SESSION['isAdmin']) { ?>
								<form action="<?= $url ?>" method='post'>
									<input type="text" name='deletePost' value=<?= $row2["id"] ?> hidden>
									<button class="btn btn-danger px-1 py-1" name='delete'>Delete Post</button>
								</form>
							<?php } ?>
						</div>
						<hr class="pembatas-post">
					</div>
				<?php } ?>
			<?php } ?>
			</div>
		</div>
		</div>
		</div>
	</main>

	<?php include_once './components/footer.php' ?>

	<?php
	function get_category($forum_id)
	{
		switch ($forum_id) {
			case "F0001":
				$forum_id = "C++";
				break;
			case "F0002":
				$forum_id = "Python";
				break;
			case "F0003":
				$forum_id = "Java";
				break;
			case "F0004":
				$forum_id = "Ruby";
				break;
			case "F0005":
				$forum_id = "SQL";
				break;
			case "F0006":
				$forum_id = "PHP";
				break;
			case "F0007":
				$forum_id = "C";
				break;
			case "F0008":
				$forum_id = "Javascript";
				break;
		}
		return $forum_id;
	} ?>

	<script type="text/javascript" src="js/buttons.js"></script>
</body>

</html>