<?php 

require 'db.php';
require("LoginController.php");

$user = $_POST['Username'];
$pass = $_POST['Password'];
$lc = new LoginController($conn,$user,$pass);
$location = "../html/";
session_start();	
$_SESSION['set'] = false;
$_SESSION['admin'] = false;
if($lc->LoginUser($conn)==false)
{
	$_SESSION['admin'] = $lc->IsAdmin();
	$_SESSION['set'] = true;
	$location = "../html/budzet.php";
}
header("Location: $location");


?>