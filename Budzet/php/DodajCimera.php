<?php
	
	include 'db.php';
	include 'CimerController.php';
	$cimer = new CimerController();
	$iznos = $_POST['kolicina'];
	$temp = explode(" ", $_POST['novi']);
	echo $temp[0] . " " . $temp[1] . "  " . $iznos;
	echo $cimer->AddNewCimer($conn,$temp[0],$temp[1]);
	$id = $cimer->VecStanovao($conn,$temp[0],$temp[1]); 
	$cimer->AddCimereZaMjesec($conn,$id,$iznos);
	header("Location: ../html/budzet.php");

?>