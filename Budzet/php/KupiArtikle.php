<?php 
include 'db.php';
include 'ArtikalController.php';
$trosakID = ArtikalController::DodajTrosak($conn,$_POST['potroseno']);

ArtikalController::SetArtikleToKupljen($conn,$_POST['artikli'],$trosakID);

header("Location: ../html/budzet.php");
 ?>