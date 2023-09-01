<?php
	$kat = json_decode($_POST['kategoria']);
	if ($kat != "Sport" && $kat != "Luxus" && $kat != "Cabrio" && $kat != "SUV") 
	{
		$kat = "";
	}
	$Autok = array();
	include ("adatbazisKapcsolodas.php");
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) 
	{
	  	die("Connection failed: " . mysqli_connect_error());
	}
	else
	{
		$sql = "
		SELECT `id`, `kategoria`, `marka`, `tipus`, `motortipus`, `teljesitmeny`, `hajtas`, `sebessegvalto`, `szin`, `ajtokszama`, `ferohely`, `ar` 
		FROM `autok` 
		WHERE `kategoria` LIKE '%".$kat."%' AND `aktiv`=1
		ORDER BY marka ASC
		";
	}
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
	  	while($row = mysqli_fetch_assoc($result)) 
	  	{
	    	array_push($Autok, $row);
	  	}
	}
	mysqli_close($conn);
	echo json_encode($Autok ,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
?>