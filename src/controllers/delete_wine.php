<?php 

require_once('../models/wines.php');
$test = $_GET['id'];

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $isDeleted = deleteWine($id);

   
} else {
    echo 'error on $test';
}

header('Location: ../../admin.html');
exit;

?>