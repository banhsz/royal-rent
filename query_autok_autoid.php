<?php
	$id = json_decode($_POST['id']);
	$adatok = array();
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
		WHERE `id` = ".$id." AND `aktiv` LIKE 1
		";
	}
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
	  	while($row = mysqli_fetch_assoc($result)) 
	  	{
	    	array_push($adatok, $row);
	  	}
	}
	mysqli_close($conn);
	echo json_encode($adatok ,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
?>