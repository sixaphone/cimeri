<?php session_start(); 

	if(!isset($_SESSION['set']) || $_SESSION['set']==false)
		header("Location: index.html");


	include '../php/db.php';
	include '../php/CimerController.php';
	include '../php/ArtikalController.php';
	$cimeri = new CimerController();
	$cimeri = $cimeri->GetAllCimere($conn);
	$ukupno = count($cimeri);
	$i = 0;
	$artikli = ArtikalController::GetArtikle($conn);
	$ukupnoUplaceno = CimerController::GetUplate($conn);
	$ukupnoPotroseno = ArtikalController::GetSumTroskova($conn);
	if($ukupnoPotroseno==null)$ukupnoPotroseno=0;
	if($ukupnoUplaceno==null)$ukupnoUplaceno=0;
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Budzet</title>
	<link rel="stylesheet" type="text/css" href="../CSS/stil.css">
</head>
<body>
		<form action="../php/DodajArtikal.php" method="post">
	<div class="Market">
	<div id="Cont_Kupit">

		<label id="Kupiti">
			Kupiti
		</label>
		<label id="labelArtikal">
			Artikal
		</label>
		<input type="text" name="artikal" id="Artikal">
		<input type="submit" name="submit" id="Dodaj" value="Dodaj"> 
		</form>
		<form action="../php/KupiArtikle.php" method="post">
		<ul>
			<?php foreach($artikli as $artikal){?>
			<li> <?php echo $artikal['Naziv'];?> <input value="<?php echo $artikal['ArtikalID'];?>" type="checkbox" name="artikli[]"></li>
			<?php }?>
		</ul>
</div>

<?php if($_SESSION['admin']==1):?>
	<div class="Cont_Kupit1">
		<label class="Lab">Potrošeno</label>
		<input type="text" name="potroseno" id="Potroseno">
		<input type="submit" name="submit" id="Potr" value="Potroši">
		</br>
	</div>
<?php endif;?>
</form>
	</div>


	<div id="Cont_Stanje">
		<div style="text-align: center;">

		<label id="ST">Stanje </label>

		<label id="Stanje"><?php echo $ukupnoUplaceno-$ukupnoPotroseno; ?> KM</label>
	</div>

	</br>
<?php if($_SESSION['admin']==1):?>
<form action="../php/DodajCimera.php" method="post">
<label class="Lab">
	Dodaj Cimera
</label>
<input type="text" name="novi" id="Stanar" >
<input type="hidden" name="kolicina" value="<?php echo $cimeri[0]['KolicinaZaUplatit'];?>">
<input type="submit" name="Stanar" placeholder="Stanar" id="Sta" value="Unesi" > <!--onclick="return onclickValidateDodaj()"-->
</br>
</form>
<label id="Mjes">
	Novi Mjesec
</label>
	<a href="novimjesec.html"><input type="Submit" name="Dugme" id="NoviMjesec" value="Unesi"></a>
<?php endif;?>	
</br>

</div>
<div id="Cont_Stanari">
	 <label id="Cimeri">
		Cimeri
	</label>

	<div class="Cont_Stanari1">

		<div class="cont1">
			<?php if($i<$ukupno):?>
			<p class="imee"> <?php echo $cimeri[$i]['Ime'] . " " . $cimeri[$i]['Prezime'];?> </p><br>
			<input type="text" placeholder="0" value="<?php echo CimerController::GetUplacenoZaCimer($conn,$cimeri[$i]['CimerID']);?>" disabled="true"><span> / </span> 
			<input type="text" placeholder="300" value="<?php echo $cimeri[$i]['KolicinaZaUplatit'];?>" disabled="true">
				<?php if($_SESSION['admin']==1):?>
				<input type="submit" name="uplata" data-value="<?php echo $cimeri[$i]['CimerID'];?>" id="uplataa" value=" + " class="plusic" onclick=" return onclickPlusici()">
				<?php endif;?>
			<br>
			<?php $i++;endif;?>
			<?php if($i<$ukupno):?>
			<p class="imee"> <?php echo $cimeri[$i]['Ime'] . " " . $cimeri[$i]['Prezime'];?> </p><br>
			<input type="text" placeholder="0" value="<?php echo CimerController::GetUplacenoZaCimer($conn,$cimeri[$i]['CimerID']);?>" disabled="true"><span> / </span> 
			<input type="text" placeholder="300" disabled="true" value="<?php echo $cimeri[$i]['KolicinaZaUplatit'];?>">
				<?php if($_SESSION['admin']==1):?>
				<input type="submit" name="uplata" data-value="<?php echo $cimeri[$i]['CimerID'];?>" id="uplataa" value=" + " class="plusic" onclick=" return onclickPlusici()">
				<?php endif;?>
			<?php $i++;endif;?>
		</div>

		<div class="cont2">
			<?php if($i<$ukupno):?>
			<p class="imee"> <?php echo $cimeri[$i]['Ime'] . " " . $cimeri[$i]['Prezime'];?> </p><br>
			<input type="text" placeholder="0" value="<?php echo CimerController::GetUplacenoZaCimer($conn,$cimeri[$i]['CimerID']);?>" disabled="true"><span> / </span> 
			<input type="text" placeholder="300" value="<?php echo $cimeri[$i]['KolicinaZaUplatit'];?>" disabled="true">
				<?php if($_SESSION['admin']==1):?>
				<input type="submit" name="uplata" data-value="<?php echo $cimeri[$i]['CimerID'];?>" id="uplataa" value=" + " class="plusic" onclick=" return onclickPlusici()">
				<?php endif;?>
			<br>
			<?php $i++;endif;?>
			<?php if($i<$ukupno):?>
			<p class="imee"> <?php echo $cimeri[$i]['Ime'] . " " . $cimeri[$i]['Prezime'];?> </p><br>
			<input type="text" placeholder="0" value="<?php echo CimerController::GetUplacenoZaCimer($conn,$cimeri[$i]['CimerID']);?>" disabled="true"><span> / </span> 
			<input type="text" placeholder="300" disabled="true" value="<?php echo $cimeri[$i]['KolicinaZaUplatit'];?>">
				<?php if($_SESSION['admin']==1):?>
				<input type="submit" name="uplata" data-value="<?php echo $cimeri[$i]['CimerID'];?>" id="uplataa" value=" + " class="plusic" onclick=" return onclickPlusici()">
				<?php endif;?>
			<?php $i++;endif;?>
		</div>

		<div class="cont3">
			<?php if($i<$ukupno):?>
			<p class="imee"> <?php echo $cimeri[$i]['Ime'] . " " . $cimeri[$i]['Prezime'];?> </p><br>
			<input type="text" placeholder="0" value="<?php echo CimerController::GetUplacenoZaCimer($conn,$cimeri[$i]['CimerID']);?>" disabled="true"><span> / </span> 
			<input type="text" placeholder="300" value="<?php echo $cimeri[$i]['KolicinaZaUplatit'];?>" disabled="true">
				<?php if($_SESSION['admin']==1):?>
				<input type="submit" name="uplata" data-value="<?php echo $cimeri[$i]['CimerID'];?>" id="uplataa" value=" + " class="plusic" onclick=" return onclickPlusici()">
				<?php endif;?>
			<br>
			<?php $i++;endif;?>
			<?php if($i<$ukupno):?>
			<p class="imee"> <?php echo $cimeri[$i]['Ime'] . " " . $cimeri[$i]['Prezime'];?> </p><br>
			<input type="text" placeholder="0" value="<?php echo CimerController::GetUplacenoZaCimer($conn,$cimeri[$i]['CimerID']);?>" disabled="true"><span> / </span> 
			<input type="text" placeholder="300" disabled="true" value="<?php echo $cimeri[$i]['KolicinaZaUplatit'];?>">
				<?php if($_SESSION['admin']==1):?>
				<input type="submit" name="uplata" data-value="<?php echo $cimeri[$i]['CimerID'];?>" id="uplataa" value=" + " class="plusic" onclick=" return onclickPlusici()">
				<?php endif;?>
			<?php $i++;endif;?>
		</div>

		<div class="cont4">
			<?php if($i<$ukupno):?>
			<p class="imee"> <?php echo $cimeri[$i]['Ime'] . " " . $cimeri[$i]['Prezime'];?> </p><br>
			<input type="text" placeholder="0" value="<?php echo CimerController::GetUplacenoZaCimer($conn,$cimeri[$i]['CimerID']);?>" disabled="true"><span> / </span> 
			<input type="text" placeholder="300" value="<?php echo $cimeri[$i]['KolicinaZaUplatit'];?>" disabled="true">
				<?php if($_SESSION['admin']==1):?>
				<input type="submit" name="uplata" data-value="<?php echo $cimeri[$i]['CimerID'];?>" id="uplataa" value=" + " class="plusic" onclick=" return onclickPlusici()">
				<?php endif;?>
			<br>
			<?php $i++;endif;?>
			<?php if($i<$ukupno):?>
			<p class="imee"> <?php echo $cimeri[$i]['Ime'] . " " . $cimeri[$i]['Prezime'];?> </p><br>
			<input type="text" placeholder="0" value="<?php echo CimerController::GetUplacenoZaCimer($conn,$cimeri[$i]['CimerID']);?>" disabled="true"><span> / </span> 
			<input type="text" placeholder="300" disabled="true" value="<?php echo $cimeri[$i]['KolicinaZaUplatit'];?>">
				<?php if($_SESSION['admin']==1):?>
				<input type="submit" name="uplata" data-value="<?php echo $cimeri[$i]['CimerID'];?>" id="uplataa" value=" + " class="plusic" onclick=" return onclickPlusici()">
				<?php endif;?>
			<?php $i++;endif;?>
		</div>
<!--
		<div class="cont2">
			<p class="imee">Mirsad Halilčević</p><br>
			<input type="text" placeholder=""><span> / </span>
			<input type="text" placeholder=" / 60">
			<input type="submit" name="uplata" id="uplataa" value=" + " class="plusic">
			<br>
			<p class="imee">Tarik Hodžić</p><br>
			<input type="text" placeholder=""><span> / </span>
			<input type="text" placeholder=" / 60">
			<input type="submit" name="uplata" id="uplataa" value=" + " class="plusic">
		</div>
		<div class="cont3">
			<p class="imee">Muriz Bošnjak</p><br>
			<input type="text" placeholder=""><span> / </span>
			<input type="text" placeholder=" / 60">
			<input type="submit" name="uplata" id="uplataa" value=" + " class="plusic">
			<br>
			<p class="imee">Emir Karić</p><br>
			<input type="text" placeholder=""><span> / </span>
			<input type="text" placeholder=" / 60">
			<input type="submit" name="uplata" id="uplataa" value=" + " class="plusic">
		</div>
		<div class="cont4">
			<p class="imee">Murat Hrnjić</p><br>
			<input type="text" placeholder=""><span> / </span>
			<input type="text" placeholder=" / 60">
			<input type="submit" name="uplata" id="uplataa" value=" + " class="plusic">
			<br>
			<p class="imee">Muamer Žabić</p><br>
			<input type="text" placeholder=""><span> / </span>
			<input type="text" placeholder=" / 60">
			<input type="submit" name="uplata" id="uplataa" value=" + " class="plusic">
		</div>-->
<?php if($_SESSION['admin']==1):?>
		<input type="text" name="doplata" id="Doplata" placeholder="Unesite novu uplatu">
<?php endif;?>
	</div>
</div>
</body>

<script type="text/javascript" src="../JavaScript/ValidacijaEvidencije.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script>
	$('.plusic').click(function(){
	 location.href = "../php/DodajUplatu.php?id="+$(this).data('value')+"&iznos="+$('#Doplata').val();
	});
</script>
</html>