<?php
$pageTitle = 'Stock';
require_once('src/controllers/acl.php');
session_start();
require_once('src/models/model_admin.php');
$wines = getLimitWines()[0];
$currentPage = getLimitWines()[1];
$pages = getLimitWines()[2];
ob_start();
?>

<form method="" action="">
	<input id="search_admin" type="text" name="search" placeholder="ex: France, syrah, 2009, California... ">
	<i class="fas fa-search fa-lg"></i>
</form>

<div class="add-icons">
    <?php if($_SESSION['user']['weight'] > 50) : ?>
    <a href="user_add.php"><i class="fas fa-user-plus fa-2x add-user"></i></a>
    <?php endif ?>
    <a href="wine_add.php"><i class="fas fa-folder-plus fa-2x add-wine"></i></a>  
</div>

<table id="show_admin_filter">
    <thead>
        <th class="head-img">Image</th>
        <th>Name</th>
        <th>Year</th>
        <th>Grape</th>
        <th class="head-region">Region</th>
        <th class="head-country">Country</th>
        <th class="head-description">Description</th>
        <th>Qty</th>
        <th class="head-edit">Edit</th>
    </thead>
    <?php foreach($wines as $wine) : ?>
    <tbody>
        <?php $domain = $wine['domain']; ?>
        <td class="cell-img"><img class="stock-img" src="assets/img/dist/png/<?= $wine['image'] ?>" alt="wine"></td>
        <td><?= $wine['domain'] ?></td>
        <td><?= $wine['year'] ?></td>
        <td><?= $wine['grape'] ?></td>
        <td class="cell-region"><?= $wine['region'] ?></td>
        <td class="cell-country"><?= $wine['country'] ?></td>
        <td class="cell-description"><?= $wine['description'] ?></td>
        <td class="cell-quantity"><?= $wine['quantity'] ?></td>
        <td class="cell-icons">
            <div class="flex-icons">
                <a href="wine_update.php?id=<?php echo $wine['id'] ?>">
                    <i class="fas fa-edit edit"></i>
                </a>
                <?php if($_SESSION['user']['weight'] > 50) : ?>
                <i id="btn" data-id="<?php echo $wine['id'] ?>" data-domain="<?php echo $wine['domain'] ?>" class="fas fa-trash-alt myBtn"></i>
                <?php endif ?>
            </div>
        </td>
        <td class="cell-respond-edit"><a href="wine_detail_admin.php?id=<?php echo $wine['id'] ?>"><i class="fas fa-arrow-circle-right fa-2x"></i></a></td>
    </tbody>
    <?php endforeach; ?>
</table>

<div id="myModal" class="modal">
    <div id="content" class="modal-content">
        <span class="close">&times;</span>
        <p id="message"></p>
        <div class="btn-modal-container">
            <p id="anchor"></p>
            <a class="cancel-btn" href="admin.php">Cancel</a>
        </div>
    </div>
</div>

  <div class="pages">
	<?php if($currentPage > 1) : ?>
		<a href="admin.php?page=<?=$currentPage - 1 ?>"><i class="fas fa-arrow-circle-left fa-2x pages-icon"></i></a>
		<?php $currentPage = getLimitWines()[1]; ?>
		<?php for($i = $currentPage; $i  > 1; $i--) : ?>
			<a class="link-pages" href="admin.php?page=<?php echo ($currentPage + 1) - $i ?>"><?php echo ($currentPage + 1) - $i  ?></a>
		<?php endfor ?>
	<?php endif ?>

	<?php if (($currentPage < $pages)) : ?>
		<?php for($i = $currentPage; $i < $pages; $i++) : ?>
			<a class="link-pages" href="admin.php?page=<?php echo $currentPage + 1 ?>"><?php echo $currentPage += 1 ?></a>
		<?php endfor ?>
		<?php $currentPage = getLimitWines()[1]; ?>
	<a href="admin.php?page=<?=$currentPage + 1 ?>"><i class="fas fa-arrow-circle-right fa-2x pages-icon"></i></a>
	<?php endif ?>
</div>




<?php
$content = ob_get_clean();
require_once('template/layout.php');
?>