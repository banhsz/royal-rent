<?php
	$id = json_decode($_POST['id']);
	$foglalasok = array();
	include "adatbazisKapcsolodas.php";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) 
	{
	  	die("Connection failed: " . mysqli_connect_error());
	}
	else
	{
		$sql = "
		SELECT * 
		FROM `foglalasok` 
		WHERE auto_id = ".$id." AND allapot not like 'Visszautalásra vár' and allapot not like 'Visszautalva' and allapot not like 'Érvénytelen' and utolsonap >'".(new \DateTime())->format('Y-m-d')."'
		";
	}
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
	  	while($row = mysqli_fetch_assoc($result)) 
	  	{
	    	array_push($foglalasok, $row);
	  	}
	}
	mysqli_close($conn);
	echo json_encode($foglalasok ,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
?>