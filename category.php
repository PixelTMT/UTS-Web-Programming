<script>
	function List(category) {
		var url = new URL(location.href);
		url.searchParams.set('list', category);
		window.location.href = url;
	}
</script>
<?php
session_start();
$current_active_list = 'cpp';
$C_list_A = array(
	'sql',
	'php',
	'c',
	'javascript',
	'cpp',
	'python',
	'java',
	'ruby'
);
$C_list_B = array(
	'F0005' => 'sql',
	'F0006' => 'php',
	'F0007' => 'c',
	'F0008' => 'javascript',
	'F0001' => 'cpp',
	'F0002' => 'python',
	'F0003' => 'java',
	'F0004' => 'ruby',
	'sql' => 'F0005',
	'php' => 'F0006',
	'c' => 'F0007',
	'javascript' => 'F0008',
	'cpp' => 'F0001',
	'python' => 'F0002',
	'java' => 'F0003',
	'ruby' => 'F0004'
);
if (isset($_GET['list'])) {
	if (in_array($_GET['list'], $C_list_A)) {
		$current_active_list = strtolower($_GET['list']);
	}
}

require_once 'NeedLogin.php';
require_once 'security.php';
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
if (isset($_GET['keyword'])) {
	$sql .= "WHERE title like '%{$_GET['keyword']}%' ";
}
$sql .= "ORDER BY time_created DESC";

$hasil = $db->query($sql);
function CheckActive($_category)
{
	global $C_list_A;
	if (isset($_GET['list'])) {
		if (in_array($_GET['list'], $C_list_A) && strtolower($_GET['list']) == $_category) {
			echo "class='active'";
		}
	} else {
		if ($_category == 'cpp') {
			echo "class='active'";
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
	if($row)
		return $row["total_likes"];
	return 0;
}
function isLikePost($_post_id){
	global $db;
	$sql = "select * from likes where user_id = ? AND post_id = ? AND like_bool = 1;";
	$stmt = $db->prepare($sql);
	$stmt->execute([$_SESSION['id'],$_post_id]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row) return 'font-size:1.25rem; color:blue';
	return 'font-size:1.25rem; color:grey';
	
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
	<link href="css/category.css" rel="stylesheet">
	<link href="css/side_panel.css" rel="stylesheet">
	<title>Profile</title>
</head>

<body>
	<!-- navbar -->
	<?php include_once './components/navbar.php' ?>

	<article>
		<div class='container tabbed round mt-4 mb-3'>
			<ul>
				<li <?php CheckActive("sql"); ?> onclick="List('sql')"><img src="img/sql.svg"> SQL</li>
				<li <?php CheckActive("ruby"); ?> onclick="List('ruby')"><img src="img/ruby.svg"> Ruby</li>
				<li <?php CheckActive("java"); ?> onclick="List('java')"><img src="img/java.svg"> Java</li>
				<li <?php CheckActive("python"); ?> onclick="List('python')"><img src="img/python.svg"> Python</li>
				<li <?php CheckActive("cpp"); ?> onclick="List('cpp')"><img src="img/cpp.svg"> C++</li>
				<li <?php CheckActive("javascript"); ?> onclick="List('javascript')"><img src="img/javascript.svg"> Javascript</li>
				<li <?php CheckActive("c"); ?> onclick="List('c')"><img src="img/c.svg"> C</li>
				<li <?php CheckActive("php"); ?> onclick="List('php')"><img src="img/php.svg"> PHP</li>
			</ul>
		</div>
		<form action="?keyword=" method="get">
				<button class="btn btn-danger rounded-circle mx-2 my-4" style="width: 35px; height: 35px;" type="submit">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
			<?php if(isset($_GET['list'])) echo "<input type='text' name='list' class='jumbotron-search w-25 text-center' value='{$_GET['list']}' hidden>" ?>
			<input type="text" name="keyword" class="jumbotron-search w-25 text-center" <?php if(isset($_GET['keyword'])) echo "value='{$_GET['keyword']}'";?>>
		</form>
		<?php while ($row = $hasil->fetch(PDO::FETCH_ASSOC)) { ?>
			<?php if ($row['forum_id'] == $C_list_B[$current_active_list]) { ?>
				<div class="container my-4 col-lg-8">
					<div class="card-group vgr-cards">
						<div class="card border-0">
							<div class="card-body me-2">
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
								<div class="d-flex flex-row">
									<div class="px-1 pb-2 align-middle text-center justify-content-center align-items-center">
										<div class="d-flex flex-column me-3 mt-1 justify-content-center align-items-center">
											<button type="button" class="upvoteBtn border-0 bg-transparent p-2 pt-3" id="like-<?= $row['id'] ?>-<?= $_SESSION['id'] ?>" name="upvoteBtn" value="like"><i class="fa-solid fa-arrow-up" id="upvoteIcon" style="<?= isLikePost($row["id"]) ?>"></i></button>
											<span class="mx-1 mb-3 mt-3" id="vote-count-<?= $row['id'] ?>"><?= getTotalLikes($row["id"]) ?></span>
											<button type="button" class="downvoteBtn border-0 bg-transparent p-2 pt-1" id="dislike-<?= $row['id'] ?>-<?= $_SESSION['id'] ?>" name="downvoteBtn" value="dislike"><i class="fa-solid fa-arrow-down" id="downvoteIcon" style="font-size:1.25rem; color:grey"></i></button>
										</div>
									</div>
									<div class="content-container d-flex flex-column mt-3" style="overflow-wrap: anywhere;">
										<h4 class="card-title" style="overflow: hidden;"><?= $row['title'] ?></h4>
										<a onMouseOver="this.style.backgroundColor='#D9D9D9'" onMouseOut="this.style.backgroundColor='rgba(236,236,236,0.5)'" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row["id"] ?>" class="p-3 rounded" style="cursor: pointer; background-color:rgba(236,236,236,0.5); color: black; text-decoration: none; ">
											<p class="card-text card-body-content" style="max-height: 6rem; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient:vertical; overflow: hidden; text-overflow: ellipsis; white-space:wrap; overflow-wrap: anywhere;"><?= $row['body'] ?></p>
										</a>

										<!-- modal to show more text of body -->
										<div class="modal" id="modal<?php echo $row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="modallabel1" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content p-3">
													<div class="modal-header">
														<h5 class="modal-title">Post Body</h5>
													</div>
													<div class="modal-body">
														<p><?= $row["body"] ?></p>
													</div>
												</div>
											</div>
										</div>
										<!-- close modal-->
									</div>
								</div>
								<?php include_once "comment.php" ?>
								<?php $stmt2 = get_comment($row["id"]);
								$flag = 0; ?>
								<div class="feedback-container d-flex flex-row my-2">
									<button class="btn-show-comment px-2 py-2" id="show_comment-<?= $row["id"] ?>"><i class=" fa-solid fa-comment" style="color: rgba(0, 0, 0, 0.75);"></i>
										<span class="mx-auto my-auto total_comment total-comment" id="total_comment-<?= $row["id"] ?>" style="font-weight: bold; color: rgba(0, 0, 0, 0.75)"><?= get_comment_total($row["id"]) ?> comments</span>
									</button>
								</div>
								<div id="test-<?= $row["id"] ?>">
									<?php while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) { ?>
										<?php $flag = 1; ?>
										<div class="card mb-3 comment-container show_comment_container-<?= $row2["post_id"] ?>">
											<div class="each-comment-container d-flex flex-column w-100">
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
									<div class="input-group mb-3 mt-3">
										<input type="text" class="form-control me-2 rounded" id="comment_body-<?= $row["id"] ?>" placeholder="add your reply" aria-label="" aria-describedby="basic-addon1">
										<div class="input-group-prepend">
											<button class="btn-add btn btn-outline-danger" type="button" id="add-<?= $row["id"] ?>-<?= $row["user_id"] ?>">Add</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				</div>
		<?php }
		} ?>
	</article>

	<?php include_once './components/footer.php' ?>

	<script type="text/javascript" src="js/buttons.js"></script>
</body>