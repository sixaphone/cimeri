<?php 

include 'db.php';
include 'ArtikalController.php';
echo $_POST['artikal'];
ArtikalController::AddArtikal($conn,$_POST['artikal']);
header("Location: ../html/budzet.php");

 ?>