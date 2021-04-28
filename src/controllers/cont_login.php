<?php
/**
 * On démarre la session
 */
session_start();

/**
 * Si l'index de session utilisateur est définit alors 
 * il y a déjà une connexion.
 */
if(isset($_SESSION['user'])){
    header('Location: ./index.php');
        exit;
}


$errors = array (
    1 => 'wrong mail format please enter a valid email',
    2 => 'Wrong password, try again'
);


if(isset($_POST['login'])){
    require_once('src/models/users.php');
    $email = $_POST['mail'];
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $user = getUserFromLogin(htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['password'])); 
        
    } else {
        $_GET['err'] = $errors[1];
        header('Location: ./login.php?err=' . $_GET['err'] . '');
        exit;
    }

    

    if($user == false){
        $_GET['err'] = $errors[2];
        header('Location: ./login.php?err=2');
        exit;

    }else{
        $_SESSION['user'] = $user;
        header('Location: ./admin.php');
        exit;
    }
}