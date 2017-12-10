<?php 

/**
* 
*/
class ArtikalController
{
	
	public static function AddArtikal($conn,$artikal){
		$qryAddArtikal = $conn->prepare("INSERT INTO Artikli(Naziv,Kupljen,DatumDodavanja) VALUES(?,0,?)");
		$datum = date("Y-m-d");
		$qryAddArtikal->bind_param("ss",$artikal,$datum);
		$qryAddArtikal->execute();
		$qryAddArtikal->close();
	} 
	public static function SetArtikleToKupljen($conn,$artikli,$trosak){
		$qryKupiArtikal = $conn->prepare("UPDATE Artikli SET DatumKupovine = ?,Kupljen = '1', TrosakID = ? WHERE ArtikalID = ?");
		$AID = null;
		$datum = date("Y-m-d");
		$qryKupiArtikal->bind_param("sii",$datum,$trosak,$AID);
		foreach ($artikli as $artikal) {
			$AID = $artikal;
			$qryKupiArtikal->execute();
		}
		$qryKupiArtikal->close();


	}
	public static function GetArtikle($conn){
		$qryGetArtikle = $conn->prepare("SELECT ArtikalID,Naziv FROM Artikli WHERE Kupljen = 0");
		$qryGetArtikle->execute();
		$artikli = $qryGetArtikle->get_result()->fetch_all(MYSQLI_ASSOC);
		$qryGetArtikle->close();
		return $artikli;	
	}
	public static function DodajTrosak($conn,$iznos){
		$qryDodajTrosak = $conn->prepare("INSERT INTO Troskovi(Iznos,Mjesec,Godina) VALUES(?,?,?)");
		$godina = date("Y");
		$mjesec = date("m");
		$qryDodajTrosak->bind_param("dss",$iznos,$mjesec,$godina);
		$qryDodajTrosak->execute();
		$qryDodajTrosak->close();
	    return $conn->insert_id;
	}
	public static function GetSumTroskova($conn){
		$qrySumTroskove = $conn->prepare("SELECT SUM(Iznos) AS potroseno FROM Troskovi WHERE Mjesec=? AND Godina = ?");
		$mjesec = date('m');
		$godina = date('Y');
		$qrySumTroskove->bind_param("ii",$mjesec,$godina);
		$qrySumTroskove->execute();
		$trosak = $qrySumTroskove->get_result()->fetch_assoc();
		return $trosak['potroseno'];
	}
}

 ?>
