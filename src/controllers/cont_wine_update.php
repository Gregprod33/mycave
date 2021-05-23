<?php
session_start();
require_once('src/models/wines.php');



if (!isset($_SESSION['user'])) {
    header('Location: ./index.php');
    exit;
}

/**
 * On récupère l'id du vin à éditer 
 */
$wine = getWineDetail($_GET['id']);
$id = $wine['id'];


/**
 * Fonction de redirection en cas d'erreur
 */
function redirectRoute($val)
{
    header('Location: ./wine_update.php?id=' . $val);
    exit;
}

/**
 * Vérification de l'image à uploader
 */
if (isset($_POST['update'])) {
    $ext = array('png', 'jpg', 'jpeg', 'gif');
    if ($_POST['year'] < 1950 || $_POST['year'] > 2022) {
        $_SESSION['msg_error']  = 'L\'année n\'est pas valide !';
        redirectRoute($id);
    } elseif ($_FILES['userfile']['name'] == '') {
        $image = $wine['image'];
    } elseif ($_FILES['userfile']['name'] != '' && !in_array(pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION), $ext)) {
        $_SESSION['msg_error'] = 'le fichier téléchargé n\'est pas pas une image';
        redirectRoute($id);
    } elseif ($_FILES['userfile']['size'] > 2000000) {
        $_SESSION['msg_error']  = 'La taille du fichier est limité à 2 Mo, merci de remplacer le fichier';
        redirectRoute($id);
    } else {
        $img_name = uniqid() . $_FILES['userfile']['name'];
        $img_folder = './assets/img/src/uploads/';
        $dir = $img_folder . $img_name;
        @move_uploaded_file($_FILES['userfile']['tmp_name'], $dir);
        $image = $img_name;
    }

    
    function html($string) // faille XSS
    {
        return trim(htmlspecialchars($string, ENT_QUOTES));
    }


    $winesValues = [
        'domain' => mb_strtoupper(html($_POST['domain'])),
        'image' => $image,
        'year' => html($_POST['year']),
        'grape' => htmlspecialchars($_POST['grape']),
        'region' => html($_POST['region']),
        'description' => html($_POST['description']),
        'country' => html($_POST['country']),
        'quantity' => html($_POST['quantity'])
    ];

    $res = addWine($winesValues);

    if ($res) {
        header('Location: ./admin.php');
        exit;
    } else {
        $_SESSION['msg_erreur'] = 'Il y a eu un problème, veuillez réessayer';
    }
}
