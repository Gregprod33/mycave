<?php 
session_start();
require_once('src/models/wines.php');
if(isset($_POST['add'])) {
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

    $res = addWine($winesValues);

    if($_FILES['userfile']['name'] != '') {
    move_uploaded_file($_FILES['userfile']['tmp_name'], './assets/img/src/png'.$image);
    }

    if ($res) {
        header('Location: ./admin.html');
        exit;
    }



}