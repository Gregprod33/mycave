<?php 
require_once('src/controllers/acl.php');
$pageTitle = $pageTitle ?? '';
$uri = $_SERVER['REQUEST_URI'];
$admin = 'admin';
$findAdmin = strpos($uri, $admin);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Cave | <?php echo $pageTitle ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="assets/css/dist/style.min.css">
</head>
<body>
	<header>
		<nav>
			<a href="../index.php"><img class="img-nav" src="assets/img/dist/logo/logo-large.png" alt="logo"></a>
			<?php if(!isset($_SESSION['user'])) : ?>
			<a class="btn-nav" href="login.php">Login</a>
			<?php elseif(isset($_SESSION['user']) && $findAdmin == false): ?>
			<div class="nav-buttons">
				<a class="btn-nav logout-btn" href="src/controllers/logout.php">Logout</a>
				<a class="btn-nav" href="admin.php">Admin</a>
			</div>
			<?php  elseif ($_SESSION['user'] && $findAdmin == true) : ?>
			<div class="nav-buttons">
				<a class="btn-nav logout-btn" href="src/controllers/logout.php">Logout</a>
				<a class="btn-nav" href="index.php">Cellar</a>
			</div>
			<?php endif; ?>
			
		</nav>
	</header>
	
	<?php if(isset($_SESSION['user'])){ ?>
		<p class="greeting">Welcome in your cellar <?php echo strtoupper($_SESSION['user']['name']) ?> :)</p>
		<?php } ?>
	<div class="container">
		<?php echo $content; ?>
	</div>
	<footer>
		<a href="../index.php"><img class="img-nav" src="assets/img/dist/logo/logo-large.png" alt="logo"></a>
		<p class="footer">©2021 made with ♥ and not drunk !</p>
		<a href="https://www.linkedin.com/in/gr%C3%A9gory-boes-98b0b21a3/" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
	</footer>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
	<script src="//code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="assets/js/dist/scripts.min.js"></script>
</body>
</html>