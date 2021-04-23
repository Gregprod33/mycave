<?php 
session_start();
require_once('src/models/wines.php');

if(!isset($_SESSION['user'])) {
    header('Location: ./index.php');
    exit;
}

$wine = getWineDetail($_GET['id']);


if(isset($_POST['update'])) {
    if($_FILES['userfile']['name'] == '') {
        $image = 'generic.png';
    } else {
        $image = $_FILES['userfile']['name'];
    }

    $winesValues = [
        'domain' => strtoupper($_POST['domain']),
        'image' => $image,
        'year' => $_POST['year'],
        'grape' => $_POST['grape'],
        'region' => $_POST['region'],
        'description' => $_POST['description'],
        'country' => $_POST['country'],
        'quantity'=> $_POST['quantity']
    ];

    $res = updateWine($_GET['id'], $winesValues);

    if($_FILES['userfile']['name'] != '') {
    move_uploaded_file($_FILES['userfile']['tmp_name'], './assets/img/src/png'.$image);
    }

    if ($res) {
        header('Location: ./admin.php');
        exit;
    }
}

