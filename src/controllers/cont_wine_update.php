<?php 
session_start();
require_once('src/models/wines.php');



if(!isset($_SESSION['user'])) {
    header('Location: ./index.php');
    exit;
}

$wine = getWineDetail($_GET['id']);
$id = $wine['id'];



if(isset($_POST['update'])) {
    $ext = array('png', 'jpg', 'jpeg', 'gif');
    if($_POST['year'] < 1950 || $_POST['year'] > 2022) {
        header('Location: ./wine_update.php?id=' . $id . '&alert=');
        exit;
    }

    if($_FILES['userfile']['name'] == '') {
        $image = 'generic.png';
    } else {
        if($_FILES['userfile']['size'] > 1000000) {
            $msg_error = 'La taille du fichier est limité à 1 Mo, merci de remplacer le fichier';
        } elseif (!in_array(pathinfo($_FILES['userfile']['name'],PATHINFO_EXTENSION), $ext)) {
            $msg_error = 'le fichier téléchargé n\'est pas pas une image';
        } else {
            $img_name = uniqid() . $_FILES['userfile']['name'];
            $img_folder = './assets/img/src/uploads/';
            $dir = $img_folder . $img_name;
            @move_uploaded_file($_FILES['userfile']['tmp_name'], $dir);
            $image = $img_name;
        } 

    }


        $winesValues = [
            'domain' => strtoupper(htmlspecialchars($_POST['domain'])),
            'image' => $image,
            'year' => htmlspecialchars($_POST['year']),
            'grape' => htmlspecialchars($_POST['grape']),
            'region' => htmlspecialchars($_POST['region']),
            'description' => htmlspecialchars($_POST['description']),
            'country' => htmlspecialchars($_POST['country']),
            'quantity'=> htmlspecialchars($_POST['quantity'])
        ];

        $res = updateWine($_GET['id'], $winesValues);

        if ($res) {
            header('Location: ./admin.php');
            exit;
        }
}

        
    
       

    
     

