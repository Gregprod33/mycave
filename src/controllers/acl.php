<?php

//Récupération de l'url (ex /my_cave/admin.html);
$phpSelf = $_SERVER['PHP_SELF'];

//récupération du nom du fichier (admin.html);
$fileUrl = basename($phpSelf);

// Récupération du nom du fichier sans l'extension (admin);
$currentPage = pathinfo($fileUrl)['filename'];

//tableau des pages et autorisations selon le poids des roles attribués
$tabPageAdmin = [
    'delete_wine' => 100,
    'wine_add' => 50,
    'wine_update' => 50,
    'user_add' => 100
];

//on cherche si la page courante est un index du tableau des autorisations;
$res = isset($tabPageAdmin[$currentPage]);


//si la page courante est bien un index du tableau et que la personne n'est pas log
//ou si elle est log avec un poids inférieur à la valeur de l'index
//Alors on redirige vers le formulaire de login 
if( $res === true && $_SESSION['user']['weight'] < $tabPageAdmin[$currentPage]){
    $_SESSION['msg_flash'] = 'Access Denied' . '<br>' . 'Please contact the webmaster';
    header('Location: ../../index.php');
    exit;
}


