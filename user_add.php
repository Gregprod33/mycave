<?php
session_start();
$pageTitle = 'Add User';
require_once('src/controllers/cont_user_add.php');
require_once('src/controllers/acl.php');
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
        <?php if(isset($_GET['err'])) : ?>
            <?php echo '<p class="error">' . $_GET['err'] . '</p>'?>
        <?php endif ?>
        <form id="user-form" method="POST" action="user_add.php">
            <a href="admin.php"><i class="fas fa-arrow-circle-left fa-2x"></i></a>
            <input type="text" name="name" placeholder="Name" required>
            <input type="mail" name="mail" placeholder="Mail" required>
            <input type="text" name="password" placeholder="Password" required>
            <div class="radio">
                <fieldset>
                    <legend>User's role weight</legend>
                    <div class="administrator">
                        <label for="administrator">Administrator</label>
                        <input type="radio" id="administrator" name="radio" value="admin">
                    </div>
                    <div class="editor">  
                        <label for="editor">Editor</label>
                        <input type="radio" id="editor" name="radio" value="editor">
                    </div>
                </fieldset>
                
            </div>
            <div class="login-buttons">
                <button type="submit" name="addUser">Confirm</button>
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