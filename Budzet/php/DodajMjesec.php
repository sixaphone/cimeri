<?php
	
	include 'db.php';
	include 'CimerController.php';

	$cimer = new CimerController();
	$iznos = $_POST['iznos'];
	$numOfCimer = $_POST['cimeri'];
	for ($i= 1; $i <= $numOfCimer; $i++) { 
		$cimeri[] = $_POST['ime'.$i];
	}
	
	for ($i= 0; $i < $numOfCimer; $i++) { 
		$temp = explode(" ", $cimeri[$i]);
		$id =$cimer->VecStanovao($conn,$temp[0],$temp[1]); 
		if($id == -1){
			$cimer->AddNewCimer($conn,$temp[0],$temp[1]);
			$id =$cimer->VecStanovao($conn,$temp[0],$temp[1]); 
		}
		$cimer->AddCimereZaMjesec($conn,$id,$iznos);
	}

	header("Location: ../html/budzet.php");


?>