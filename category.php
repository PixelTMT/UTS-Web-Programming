<script>
	function List(category){
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
if(isset($_GET['list'])) {
	if(in_array($_GET['list'], $C_list_A)){
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
FROM post";

$hasil = $db->query($sql);
function CheckActive($_category){
	global $C_list_A;
	if(isset($_GET['list'])){
		if(in_array($_GET['list'], $C_list_A) && strtolower($_GET['list']) == $_category){
			echo "class='active'";
		}
	}else{
		if($_category == 'cpp'){
			echo "class='active'";
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
	<link href="css/navbar.css" rel="stylesheet">
	<link href="css/dashboard.css" rel="stylesheet">
	<link href="css/footer.css" rel="stylesheet">
	<link href="css/category.css" rel="stylesheet">
	<title>Profile</title>
</head>

<body>
	<!-- navbar -->
	<?php include_once './components/navbar.php' ?>

	<article>
		<div class='container tabbed round mt-4 mb-3'>
			<ul>
				<li <?php CheckActive("sql");?> onclick="List('sql')"><img src="img/sql.svg"> SQL</li>
				<li	<?php CheckActive("ruby");?> onclick="List('ruby')"><img src="img/ruby.svg"> Ruby</li>
				<li	<?php CheckActive("java");?> onclick="List('java')"><img src="img/java.svg"> Java</li>
				<li	<?php CheckActive("python");?> onclick="List('python')"><img src="img/python.svg"> Python</li>
				<li	<?php CheckActive("cpp");?> onclick="List('cpp')"><img src="img/cpp.svg"> C++</li>
				<li	<?php CheckActive("javascript");?> onclick="List('javascript')"><img src="img/javascript.svg"> Javascript</li>
				<li	<?php CheckActive("c");?> onclick="List('c')"><img src="img/c.svg"> C</li>
				<li <?php CheckActive("php");?> onclick="List('php')"><img src="img/php.svg"> PHP</li>
			</ul>
		</div>
		<div class="container temporary text-center d-flex align-items-center justify-content-center">
			<a href="create_post_form.php"><button class="category-button mb-3" role="button">Add Post</button></a>
		</div>

		<?php while ($row = $hasil->fetch(PDO::FETCH_ASSOC)) { if($row['forum_id'] == $C_list_B[$current_active_list]){?>
			<div class="container my-4 col-lg-8">
			<div class="card-group vgr-cards">
				<div class="card border-0">
					<div class="card-body me-2 d-flex flex-row">

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
								<div style="width: 60px; height: 40px; overflow:hidden;">
									<img src=<?= "user_img/" . $row['img']?> alt="user img" class="p-0 rounded-circle" style="width: 40px; height: 40px; object-fit:cover;">
								</div>
								<?php } ?>
								<span class="post-username me-1"><?= $row['username']?></span>
								<i class="fa-solid fa-circle mx-1" style="font-size: 5px;"></i>
								<span class="post-date ms-1 text-muted" style="font-size: 15px;"><?= $row['date_created']?></span>
								<div class="w-100 d-flex flex-row justify-content-end">
									<button class="category-button" role="button"><?= $row['category']?></button>
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
		<?php }} ?>
	</article>

	<?php include_once './components/footer.php' ?>

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