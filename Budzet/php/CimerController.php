<?php


/**
* 
*/
class CimerController
{
	public function AddNewCimer($conn,$ime,$prezime){
		$qryAddCimer = $conn->prepare("INSERT INTO Cimeri(Ime,Prezime) VALUES(?,?)");
		$qryAddCimer->bind_param("ss",$ime,$prezime);
		$qryAddCimer->execute();
		$qryAddCimer->close();}
	public function AddCimereZaMjesec($conn,$cimerID,$iznos){
		$qryAddCimeraUmjesec= $conn->prepare("INSERT INTO Stanuje(CimerID,MjesecID,Godina,KolicinaZaUplatit) VALUES(?,?,?,?)");
		$mjesec = date('m');
		$godina = date('Y');
		$qryAddCimeraUmjesec->bind_param("iiid",$cimerID,$mjesec,$godina,$iznos);
		$qryAddCimeraUmjesec->execute();
		$qryAddCimeraUmjesec->close();}
	public function VecStanovao($conn,$ime,$prezime){
		$qryFindCimera = $conn->prepare("SELECT CimerID FROM Cimeri WHERE Ime LIKE ? AND Prezime LIKE ?");
		$qryFindCimera->bind_param("ss",$ime,$prezime);
		$qryFindCimera->execute();
		$response = $qryFindCimera->get_result();
		$qryFindCimera->close();	
		if($response->num_rows <= 0 ) return -1;
		$cimer = $response->fetch_assoc();
		return $cimer['CimerID'];}
	public function GetAllCimere($conn){
		$qryGetCimere = $conn->prepare("SELECT C.CimerID,C.Ime,C.Prezime,S.KolicinaZaUplatit  FROM Cimeri AS C JOIN Stanuje AS S on C.CimerID = S.CimerID WHERE S.MjesecID = ? AND S.Godina = ?");
		$mjesec = date('m');
		$godina = date('Y');
		$qryGetCimere->bind_param("ii",$mjesec,$godina);
		$qryGetCimere->execute();
		$results = $qryGetCimere->get_result()->fetch_all(MYSQLI_ASSOC);
		return $results;
	} 
	public function DodajUplatu($conn,$id,$iznos){
		$datum = date("Y-m-d");
		$qryDodajUplatu = $conn->prepare("INSERT INTO Uplate(CimerID,Kolicina,DatumUplate) VALUES(?,?,?)");
		$qryDodajUplatu->bind_param("ids",$id,$iznos,$datum);
		$qryDodajUplatu->execute();
		$qryDodajUplatu->close();
	}
	public static function GetUplacenoZaCimer($conn,$id){
		$qryGetUplaceno = $conn->prepare("SELECT CimerID,SUM(Kolicina) AS Uplaceno FROM Uplate WHERE CimerID = ? AND EXTRACT(MONTH FROM DatumUplate) = ? AND EXTRACT(YEAR FROM DatumUplate) = ? GROUP BY CimerID ");
		$mjesec = date('m');
		$godina = date('Y');
		$qryGetUplaceno->bind_param("iss",$id,$mjesec,$godina);
		$qryGetUplaceno->execute();
		$uplaceno = $qryGetUplaceno->get_result()->fetch_assoc();
		$qryGetUplaceno->close();
		return $uplaceno['Uplaceno'];
	}
	public static function GetUplate($conn){
		$qryGetUplate = $conn->prepare("SELECT SUM(Kolicina) AS uplaceno FROM Uplate WHERE EXTRACT(MONTH FROM DatumUplate) = ? AND EXTRACT(YEAR FROM DatumUplate) =?");
		$mjesec = date('m');
		$godina = date('Y');
		$qryGetUplate->bind_param("ii",$mjesec,$godina);
		$qryGetUplate->execute();
		$uplate = $qryGetUplate->get_result()->fetch_assoc();
		return $uplate['uplaceno'];
	}
}


?>