<?php
$pageTitle = 'Add Wine';
require_once('src/controllers/cont_wine_add.php');
$alert = "Wrong year input, please enter a valid year";
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
    <?php 
        if(isset($_GET['alert'])) {
            $_GET['alert'] = $alert;
        echo '<p class="year-alert">' . $alert . '</p>'; 
        }
        ?>
        <form enctype="multipart/form-data" id="add-form" method="POST" action="wine_add.php">
            <a href="admin.php"><i class="fas fa-arrow-circle-left fa-2x"></i></a>
            <h1 class="wine-add-greeting"><?php echo strtoupper($_SESSION['user']['name']) ?>, you can add some wine here :)</h1>
            <input type="text" name="domain" placeholder="Name" required>
            <input type="number" name="year" placeholder="Year" required>
            <input type="text" name="grape" placeholder="Grape" required>
            <input type="text" name="region" placeholder="Region" required>
            <input type="text" name="country" placeholder="Country" required>
            <textarea id="description" name="description" rows="5" cols="36">Description
            </textarea>
            <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
            <label for="userfile">Image</label>
            <input type="file" name="userfile" class="userfile">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" step="1" value="1" required>
            <div class="add-buttons">
                <button class="confirm-btn" type="submit" name="add">Add</button>
                <a class="cancel-btn" href="admin.php">Cancel</a>
            </div>
        </form>
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