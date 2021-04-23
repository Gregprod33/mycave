<?php
session_start();
require_once('src/controllers/cont_wine_detail.php');
$pageTitle = 'Wine Detail -' . $wine['domain'];
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

<header>
    <nav>
        <a href="../index.php"><img class="img-nav" src="assets/img/dist/logo/logo-large.png" alt="logo"></a>
    </nav>
</header>

<body>
    <div class="container">
        <div class="wine-detail">
            <a href="index.php"><i class="fas fa-arrow-circle-left fa-2x"></i></a>
            <div class="up-detail-wine">
                <img src="assets/img/src/png/<?= $wine['image'] ?>" alt="wine" alt="image">
                <div class="detail-wine-infos">
                    <h2 class="wine-name"><span>Name : </span><?= $wine['domain'] ?></h2>
                    <h3 class="wine-year"><span>Year : </span><?= $wine['year'] ?></h3>
                    <p class="wine-grape"><span>Grape : </span><?= $wine['grape'] ?></p>
                    <p class="wine-region"><span>Region : </span><?= $wine['region'] ?></p>
                    <p class="wine-country"><span>Country : </span><?= $wine['country'] ?></p>
                </div>
            </div> 
            <div class="down-detail-wine">
                <p class="wine-description"><span>Description : </span><?= $wine['description'] ?></p>
            </div>
        </div>
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

