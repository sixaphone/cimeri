<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require("Cleaner.php");
/**
* 
*/
//namespace Controller;

class LoginController
{
	private $username="none";
	private $password="none";

	public function __construct($conn,$user,$pass)
	{
		$this->username = Cleaner::Clean($conn,$user);
		$this->password = Cleaner::Clean($conn,$pass);
	}
	
	public function LoginUser($conn){
		$qryLoginUser = $conn->prepare("
			SELECT Username,Password 
			FROM Profili 
			WHERE Username LIKE ?"
		);
		$qryLoginUser->bind_param("s",$this->username);
		$qryLoginUser->execute();
		$response = $qryLoginUser->get_result()->fetch_all(MYSQLI_ASSOC);
		$qryLoginUser->close();
		return empty($response) || $response[0]['Password'] != $this->password;
	}
	public function IsAdmin(){
		return (int)(strcmp($this->username,'admin')==0);
	}

	public function LogOut(){
		session_start();
		$_SESSION['set'] =null;	
		$_SESSION['admin'] =null;
		session_destroy();	
	}
	/*public function print(){
		echo $this->username . " " . $this->password;
	}*/


}














?>