<?php
require_once('src/models/users.php');

if (!isset($_SESSION['user'])) {
    header('Location: ./index.php');
    exit;
}

$errors = array(
    1 => 'wrong mail format please enter a valid email',
    2 => 'Wrong password, try again'
);


if (isset($_POST['addUser'])) {
    $email = $_POST['mail'];
    if ($_POST['radio'] == 'admin') {
        $role = 1;
    } elseif ($_POST['radio'] == 'editor') {
        $role = 2;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_GET['err'] = $errors[1];
        header('Location: ./user_add.php?err=' . $_GET['err'] . '');
        exit;
    }

    $crypt_password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 14]);
    $userValues = [
        'id_role' => $role,
        'name' => mb_strtolower(htmlspecialchars($_POST['name'])), //Le prefixe mb_ gère les accents 
        'mail' => mb_strtolower(htmlspecialchars($_POST['mail'])),
        'password' => $crypt_password
    ];
    $res = addUser($userValues);

    if ($res) {
        header('Location: ./admin.php');
        exit;
    }
}
