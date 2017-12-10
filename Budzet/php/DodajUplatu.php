<?php 
if(isset($_GET['id']) && isset($_GET['iznos'])){
	include 'db.php';
	include 'CimerController.php';
	$cimer = new CimerController();
	$cimer->DodajUplatu($conn,$_GET['id'],$_GET['iznos']);
}
header("Location: ../html/budzet.php");


 ?>