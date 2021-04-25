<?php
session_start();
require_once('src/controllers/acl.php');
$pageTitle = 'La cave';
require_once('src/models/model_index.php');
$wines = getLimitWines()[0];
$currentPage = getLimitWines()[1];
$pages = getLimitWines()[2];
ob_start();
?>

<form method="" action="">
	<input type="text" id="search" name="search" placeholder="ex: France, syrah, 2009, California... ">
	<i class="fas fa-search fa-lg"></i>
</form>


<?php if(isset($_SESSION['msg_flash'])) { ?>
	<div class="alert_role_message">
		<div class="alert_role_message_content">
			<p><?php echo $_SESSION['msg_flash'] ?> <br>or <a href="login.php">login</a></p>
			<span class="close">&times;</span>
		</div>
	</div>  
<?php } ?>

<div id="show_filter" class="wine-grid">
<?php foreach($wines as $wine) : ?>
	<div class="wine-card">
		<div class="wine-body">
			<p class="wine-description"><?= $wine['description'] ?></p>
			<img class="wine-img" src="assets/img/dist/png/<?= $wine['image'] ?>" alt="wine">
			<div class="wine-infos">
				<h2 class="wine-name"><?= $wine['domain'] ?></h2>
				<h3 class="wine-year"><?= $wine['year'] ?></h3>
				<p class="wine-grape"><?= $wine['grape'] ?></p>
				<p class="wine-region"><?= $wine['region'] ?></p>
				<p class="wine-country"><?= $wine['country'] ?></p>
			</div>
		</div>
		<a href="wine_detail.php?id=<?php echo $wine['id'] ?>" class="wine-btn">+ d'infos</a>
		<div class="more-infos">
			<p class="wine-description"><?= $wine['description'] ?></p>
		</div>
	</div>
<?php endforeach; ?>
</div>

<div class="pages">
	<?php if($currentPage > 1) : ?>
		<a href="index.php?page=<?=$currentPage - 1 ?>"><i class="fas fa-arrow-circle-left fa-2x pages-icon"></i></a>
		<?php $currentPage = getLimitWines()[1]; ?>
		<?php for($i = $currentPage; $i  > 1; $i--) : ?>
			<a class="link-pages" href="index.php?page=<?php echo ($currentPage + 1) - $i ?>"><?php echo ($currentPage + 1) - $i  ?></a>
		<?php endfor ?>
	<?php endif ?>

	<?php if (($currentPage < $pages)) : ?>
		<?php for($i = $currentPage; $i < $pages; $i++) : ?>
			<a class="link-pages" href="index.php?page=<?php echo $currentPage + 1 ?>"><?php echo $currentPage += 1 ?></a>
		<?php endfor ?>
		<?php $currentPage = getLimitWines()[1]; ?>
	<a href="index.php?page=<?=$currentPage + 1 ?>"><i class="fas fa-arrow-circle-right fa-2x pages-icon"></i></a>
	<?php endif ?>
</div>


<?php
$content = ob_get_clean();
require_once('template/layout.php');
?>