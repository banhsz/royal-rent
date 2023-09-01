<?php
	session_start(); 
	if (!isset($_SESSION["jogosultsag"])) 
	{
		$_SESSION["jogosultsag"]="vendeg";
		$_SESSION["belepett_id"]="";
		$_SESSION["belepett_felhasznalonev"]="";
	}
	$_SESSION["oldal"]="profil";
	//Ha valaki vendégként idejön akkor a főoldalra irányítuk vissza
	if ($_SESSION["jogosultsag"]=="vendeg") 
	{
		echo "<script>window.location.replace('index.php')</script>";
	}
	//képfeltöltés, nem kell adatbázis hozzá
	function autokKepFeltoltes($id)
	{
		//ha nincs mappa, akkor azokat létrehozzuk
		if(!is_dir("kepek/autok/$id/")) 
		{
			mkdir("kepek/autok/$id/");
		}
		if(!is_dir("kepek/autok/$id/thumbnail/")) 
		{
			mkdir("kepek/autok/$id/thumbnail/");
		}
		for($i = 0; $i <= 5; $i++)
		{
			$help = "fileToUpload".$i."";
			if($_FILES[$help]['size'] == 0)
			{
				//echo "nincs itt semmi";
			}
			else
			{
				//echo "van itt valami";
				if ($i == 0)
				{
					/*
					$seged = basename($_FILES[$help]["name"]);
					$ext = strtolower(pathinfo($seged,PATHINFO_EXTENSION));
					*/
					$seged = "thumbnail.png";
					$target_dir = "kepek/autok/$id/thumbnail/";
				}
				else
				{
					$seged = "".$i.".jpg";
					$target_dir = "kepek/autok/$id/";
				}
				$target_file = $target_dir . $seged;
				$uploadOk = 1; // 1 = OKÉ
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				if(isset($_POST["action"])&&($_POST["action"]=="autoKepFeltoltes")) 
				{
					$check = getimagesize($_FILES[$help]["tmp_name"]);
					if($check !== false) 
					{
						//echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} 
					else 
					{
						//echo "File is not an image.";
						$uploadOk = 0;
					}
				}
				//nem kell mert felül akarom írni a korábbi fájlokat
				//
				// Check if file already exists
				//if (file_exists($target_file)) 
				//{
				//  echo "Sorry, file already exists.";
				//  $uploadOk = 0;
				//}
				// Check file size
				if ($_FILES[$help]["size"] > 20000000) 
				{
					//echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) 
				{
					//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) 
				{
					//echo "Sorry, your file was not uploaded.";
				} 
				// if everything is ok, try to upload file
				else 
				{
					if (move_uploaded_file($_FILES[$help]["tmp_name"], $target_file)) 
					{
						//echo "The file ". htmlspecialchars($seged). " has been uploaded.";
					} 
					else 
					{
						//echo "Sorry, there was an error uploading your file.";
					}
				}
			}
		}	
	}
	//bizonylat feltöltés, nem kell adatbázis hozzá
	function bizonylatFeltoltes($id)
	{
		//echo "bizonylat modosul ennek a rendelésnek:".$id."";
		$help = "fileToUploadBizonylat";
		if($_FILES[$help]['size'] == 0)
		{
			echo "<script>window.alert('Nincs kiválasztott fájl!')</script>";
		}
		else
		{
			//echo "van itt valami";
			$datetime = new DateTime();
			$datetime->setTimezone(new DateTimeZone('Europe/Budapest'));
			$seged = basename($datetime->format('Y-m-d-h-i-s').$_FILES[$help]["name"]);
			$target_dir = "bizonylatok/$id/";
			$target_file = $target_dir . $seged;
			$uploadOk = 1; // 1 = OKÉ
			$target_file = $target_dir . $seged;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check file size
			if ($_FILES[$help]["size"] > 20000000) 
			{
				//echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "pdf" ) 
			{
				//echo "Sorry, only JPG, JPEG, PNG & PDF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) 
			{
				//echo "Sorry, your file was not uploaded.";
				return "sikertelen";
			} 
			// if everything is ok, try to upload file
			else 
			{
				//ha nincs mappa, akkor azokat létrehozzuk
				if(!is_dir("bizonylatok")) 
				{
					mkdir("bizonylatok");
				}
				if(!is_dir("bizonylatok/$id")) 
				{
					mkdir("bizonylatok/$id");
				}
				if (move_uploaded_file($_FILES[$help]["tmp_name"], $target_file)) 
				{
					return "sikeres";
				} 
				else 
				{
					return "sikertelen";
				}
			}
		}
	}
	//
	//Adatbázis osztály
	class Adatbazis
	{
		private $servername;
		private $username;
		private $password;
		private $dbname;
		private $conn;
		private $sql;
		private $result;
		private $row;

		function __construct()
		{
			include ("adatbazisKapcsolodas.php");
			$this->servername = $servername;
			$this->username = $username;
			$this->password = $password;
			$this->dbname = $dbname;
		}
		//
		//Adatbázis kapcsolodás/kapcsolat bontás
		function kapcsolatNyitasa()
		{
			$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
			if ($this->conn->connect_error)
			{
		  		die("Connection failed: " . $this->conn->connect_error);
			}
		}
		function kapcsolatBontasa()
		{
			$this->conn->close();
		}
		//
		//felhasznalok tábla függvényei
		function felhasznalokLista()
		{
			if ($_SESSION["jogosultsag"]=="admin" || $_SESSION["jogosultsag"]=="moderátor")
			{
				//GET VÁLTOZÓK LEKEZELÉSE
				$whereFelhasznalok = 1;
				$orderByFelhasznalok = "felhasznalok.id desc";
				
				//ÁLLAPOT
				if(isset($_GET["admin"])&&$_GET["admin"]==1)
				{
					if($whereFelhasznalok==1)
					{
						$whereFelhasznalok = "(jogosultsag like 'admin'";
					}
					else
					{
						$whereFelhasznalok = $whereFelhasznalok." or jogosultsag like 'Függőben'";
					}
				}
				if(isset($_GET["moderator"])&&$_GET["moderator"]==1)
				{
					if($whereFelhasznalok==1)
					{
						$whereFelhasznalok = "(jogosultsag like 'moderátor'";
					}
					else
					{
						$whereFelhasznalok = $whereFelhasznalok." or jogosultsag like 'moderátor'";
					}
				}
				if(isset($_GET["felhasználó"])&&$_GET["felhasználó"]==1)
				{
					if($whereFelhasznalok==1)
					{
						$whereFelhasznalok = "(jogosultsag like 'felhasználó'";
					}
					else
					{
						$whereFelhasznalok = $whereFelhasznalok." or jogosultsag like 'felhasználó'";
					}
				}
				if($whereFelhasznalok!=1)
				{
					$whereFelhasznalok = $whereFelhasznalok.")";
				}

				//AKTIVITÁS
				if((isset($_GET["aktivFelhasznalok"])&&$_GET["aktivFelhasznalok"]!="") || (isset($_GET["kitiltottFelhasznalok"])&&$_GET["kitiltottFelhasznalok"]!=""))
				{

					if(isset($_GET["aktivFelhasznalok"]) && ($_GET["aktivFelhasznalok"]!=""))
					{
						if(isset($_GET["kitiltottFelhasznalok"]) && ($_GET["kitiltottFelhasznalok"]!=""))
						{
							if($whereFelhasznalok==1)
							{
								$whereFelhasznalok = "(felhasznalok.aktiv = 1  or felhasznalok.aktiv = 0";
							}
							else
							{
								$whereFelhasznalok = $whereFelhasznalok." and (
								felhasznalok.aktiv = 1 or felhasznalok.aktiv = 0
							";
							}
						}
						else
						{
							if($whereFelhasznalok==1)
							{
								$whereFelhasznalok = "(felhasznalok.aktiv = 1";
							}
							else
							{
								$whereFelhasznalok = $whereFelhasznalok." and (
								felhasznalok.aktiv = 1
							";
							}
						}
					}
					else if(isset($_GET["kitiltottFelhasznalok"]) && ($_GET["kitiltottFelhasznalok"]!=""))
					{
						if($whereFelhasznalok==1)
						{
							$whereFelhasznalok = "(felhasznalok.aktiv = 0";
						}
						else
						{
							$whereFelhasznalok = $whereFelhasznalok." and (
							 felhasznalok.aktiv = 0
						";
						}
					}
					if($whereFelhasznalok!=1)
					{
						$whereFelhasznalok = $whereFelhasznalok.")";
					}
				}

				//KERESÉS
				if(isset($_GET["keresesFelhasznalok"])&&$_GET["keresesFelhasznalok"]!="")
				{
					if($whereFelhasznalok==1)
					{
						$whereFelhasznalok = "
							felhasznalok.felhasznalonev like '%".$_GET["keresesFelhasznalok"]."%'
						";
					}
					else
					{
						$whereFelhasznalok = $whereFelhasznalok." and (
							felhasznalok.felhasznalonev like '%".$_GET["keresesFelhasznalok"]."%'
						)";
					}
				}

				//RENDEZÉS
				if(isset($_GET["rendezesFelhasznalok"]))
				{
					if($_GET["rendezesFelhasznalok"]=="legujabb")
					{
						$orderByFelhasznalok = "felhasznalok.id desc";
					}
					else if($_GET["rendezesFelhasznalok"]=="legregebbi")
					{
						$orderByFelhasznalok = "felhasznalok.id asc";
					}
					else if($_GET["rendezesFelhasznalok"]=="abc")
					{
						$orderByFelhasznalok = "felhasznalok.felhasznalonev";
					}
				}

				$this->sql = "
					SELECT `id`, `felhasznalonev`, `e-mail`, `jogosultsag`, `aktiv` FROM `felhasznalok`

					WHERE $whereFelhasznalok
					ORDER BY $orderByFelhasznalok
				";
				//echo($this->sql);
				$this->result = $this->conn->query($this->sql);

				if ($this->result->num_rows > 0) {
					// $this->felhDB = $this->result->num_rows;
				  	// output data of each row
					echo'<div class="container m-0 p-0 mt-4 mx-auto">';
					echo'<div class="row m-0 p-0">';

				  	while($this->row = $this->result->fetch_assoc()) 
				  	{
					  	echo'<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 m-0 p-2">';
						  	echo'<div class="card w-100">';
							  	echo'<div class="card-header">';
								echo"
							    	<span class='font-weight-bold'>".$this->row["felhasznalonev"]."</span>
							    	";
								echo'</div>';

								echo'<div class="card-body">';
								echo"
									<div class='container p-0 m-0'>
										<div class='row'>
											<div class='col-5'>
												ID:
											</div>

											<div class='col-7'>
												".$this->row["id"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Név:
											</div>

											<div class='col-7'>
												".$this->row["felhasznalonev"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												E-mail:
											</div>

											<div class='col-7'>
												".$this->row["e-mail"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Jogosultság:
											</div>

											<div class='col-7'>
												".$this->row["jogosultsag"]."";
												/*
												if ($this->row["jogosultsag"]=="admin")
												{
													$this->adminJogDB++;
												}
												if ($this->row["jogosultsag"]=="moderátor")
												{
													$this->moderatorJogDB++;
												}
												if ($this->row["jogosultsag"]=="felhasználó")
												{
													$this->felhasznaloJogDB++;
												}
												*/
											echo"
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Beléphet?
											</div>

											<div class='col-7'>";
											echo $this->row["aktiv"]==1?'<td>igen</td>':'<td>nem</td>';
											/*
											if ($this->row["aktiv"]==1)
											{
												$this->aktivFelhDB++;
											}
											*/
											echo"</div>
										</div>
							    	</div>
							    	";
								echo'</div>';

								echo '<div class="card-footer">';
									echo'<div class="container m-0 p-0">';
										echo'<div class="row m-0 p-0">';

											if ($_SESSION["jogosultsag"]=="admin" || $_SESSION["jogosultsag"]=="moderátor")
											{
												echo'<div class="col-sm-6 m-0 p-0">';
												/*
													echo '<form method="POST" class="m-1 p-0">
														<input type="hidden" name="action" value="lathatosag">
														<input type="hidden" name="lathatosag_id" value="'.$this->row["id"].'" >
														<input type="hidden" name="lathatosag_ertek" value="'.$this->row["aktiv"].'">
														<input type="submit" name="submit_lathatosag" value="Ban / Unban" class="form-control btn btn-warning">
														</form>';
												*/
												echo '<form method="POST" class="m-1 p-0">';
														echo '<input type="hidden" name="action" value="lathatosag">';
														echo '<input type="hidden" name="lathatosag_id" value="'.$this->row["id"].'" >';
														echo '<input type="hidden" name="lathatosag_ertek" value="'.$this->row["aktiv"].'">';
														echo '<button type="submit" name="submit_lathatosag" class="form-control btn btn-warning">';
														echo $this->row["aktiv"]==1?'<i class="fas fa-user-times">&nbsp&nbsp</i>Tiltás':'<i class="fas fa-user-check">&nbsp&nbsp</i>Aktiválás';
														echo '</button>';
														echo '</form>';
												echo'</div>';
											}	

											if ($_SESSION["jogosultsag"]=="admin")
											{
												echo'<div class="col-sm-6 m-0 p-0">';
												    	echo '<form method="POST" class="m-1 p-0" onsubmit="return Megerosites()">';
														echo '<input type="hidden" name="action" value="torles">';
														echo '<input type="hidden" name="torles_id" value="'.$this->row["id"].'">';
														echo '<button type="submit" name="submit_torles" class="form-control btn btn-danger"><i class="fas fa-user-slash">&nbsp&nbsp</i>Törlés</button>';
														echo '</form>';
												echo'</div>';	

												echo'<div class="col-sm-6 m-0 p-0">';
													echo '<div class="m-1 p-0">
														<button class="form-control btn btn-primary" data-toggle="collapse" href="#modositasFormokFelhasznalo'.$this->row["id"].'"><i class="fas fa-user-edit">&nbsp&nbsp</i>Módosítás</button>
														</div>';
												echo'</div>';						

											/*
											echo'<div class="col-sm-12 m-0 p-0">';
												echo '<form method="POST" class="m-1 p-0">
													<input type="text" name="input_jogosultsag" placeholder="Új jogosultság" class="m-1 mt-4 form-control">
													<input type="hidden" name="jogosultsag_id" value="'.$this->row["id"].'">
													<input type="hidden" name="action" value="jogosultsag">
													<input type="submit" name="submit_jogosultsag" value="Alkalmazás" class="form-control btn btn-primary btn-block">
													</form>';
											echo'</div>';
											*/
												echo'<div class="col-sm-12 m-0 p-0 collapse" id="modositasFormokFelhasznalo'.$this->row["id"].'">';
												    echo '<form method="POST" class="m-1 p-0">
												    	Felhasználónév:
														<input type="text" name="felhasznalonev_modosit" value="'.$this->row["felhasznalonev"].'" class="form-control">
														Új Jelszó:
														<input type="password" name="jelszo_modosit" class="form-control">
														E-mail:
														<input type="email" name="email_modosit" value="'.$this->row["e-mail"].'" class="form-control">
														Jogosultság:
														<select class="form-control" name="jogosultsag_modosit">';
															echo"<option ".(($this->row["jogosultsag"]=="admin")?"selected":"").">admin</option>";
														 	echo "<option ".(($this->row["jogosultsag"]=="moderátor")?"selected":"").">moderátor</option>";
													    	echo "<option ".(($this->row["jogosultsag"]=="felhasználó")?"selected":"").">felhasználó</option>";
														/*
														if($this->row["jogosultsag"]=="admin")
														{
															echo"<option selected>admin</option>";
														 	echo "<option>moderátor</option>";
													    	echo "<option>felhasználó</option>";
														}
														else if($this->row["jogosultsag"]=="moderátor")
														{
															echo"<option>admin</option>";
														 	echo "<option selected>moderátor</option>";
													    	echo "<option>felhasználó</option>";
														}
														else if($this->row["jogosultsag"]=="felhasználó")
														{
														    echo"<option>admin</option>";
														    echo "<option>moderátor</option>";
														    echo "<option selected>felhasználó</option>";
														}
														*/
												  		echo '</select>
												  		Beléphet?:
														
														<select class="form-control" name="aktivitas_modosit">';
															echo"<option ".(($this->row["aktiv"]=="1")?"selected":"")." value='1'>igen</option>";
														 	echo "<option ".(($this->row["aktiv"]=="0")?"selected":"")." value='0'>nem</option>";
														echo '</select>
														<input type="hidden" name="action" value="modositas">
														<input type="hidden" name="modosit_id" value="'.$this->row["id"].'">

														<button type="submit" name="submit_modosit" class="form-control btn btn-primary mt-2"><i class="fas fa-save">&nbsp&nbsp</i>Mentés</button>
														</form>';
												echo'</div>';
											}	

										echo'</div>';
									echo'</div>';
								echo'</div>';
							echo'</div>';
						echo'</div>';
				  	}
				  	echo'</div>';
					echo'</div>';
				} 
				else 
				{
				  echo "0 results";
				}
			}				
		}
		function felhasznalokInsert()
		{

			$stmt = $this->conn->prepare("
			INSERT INTO `felhasznalok`(`felhasznalonev`, `jelszo`, `e-mail`,`jogosultsag`, `aktiv`) 
			VALUES 
			  (
				?,
				?,
				?,
				?,
				?
			  )
			");

			if ($stmt !== FALSE) 
			{
			  //adatok tisztítása
			  $cleanFelh = htmlspecialchars($_POST["inputFelhasznaloNev"]);
			  $cleanJelszo = password_hash($_POST["inputJelszo"], PASSWORD_DEFAULT);
			  $cleanEmail = htmlspecialchars($_POST["inputEmail"]);

			  //paraméteres értékátadás
			  $stmt->bind_param("ssssi", $cleanFelh, $cleanJelszo, $cleanEmail,$_POST["inputJogosultsag"],$_POST["inputLathatosag"]);

			  //lekérdezés
			  if($stmt->execute())
			  {
				echo "<script>window.alert('Sikeres regisztráció!')</script>";
			  }
			  else
			  {
				echo "<script>window.alert('Sikertelen regisztráció!')</script>";
			  }
			}

			/*
			$cleanedUsername = htmlspecialchars($_POST["inputFelhasznaloNev"]);
			$cleanedEmail = htmlspecialchars($_POST["inputEmail"]);
			$titkositottJelszo = password_hash($_POST["inputJelszo"], PASSWORD_DEFAULT);
			$this->sql = "INSERT INTO felhasznalok (`felhasznalonev`, `jelszo`, `e-mail`,`jogosultsag`, `aktiv`)
					VALUES 
					(
					'".$_POST["inputFelhasznaloNev"]."', 
					'".$titkositottJelszo."', 
					'".$_POST["inputEmail"]."',
					'".$_POST["inputJogosultsag"]."',
					".$_POST["inputLathatosag"]."
					)
					";

			if ($this->conn->query($this->sql) === TRUE) 
			{
			  echo "<script>window.alert('Sikeres regisztráció!')</script>";
			} 
			else 
			{
			  echo "<script>window.alert('Sikertelen regisztráció!')</script>";
			}
			*/
		}
		function felhasznalokDelete()
		{
			$this->sql = "DELETE FROM felhasznalok WHERE id = ".$_POST['torles_id']."";

			if ($this->conn->query($this->sql) === TRUE) 
			{
			  echo "<script>window.alert('Sikeres törlés!')</script>";
			} 
			else 
			{
			  echo "<script>window.alert('Sikertelen törlés!')</script>";
			}
		}
		function felhasznalokLathatosagCsere()
		{
			$ujErtek;
			if ($_POST["lathatosag_ertek"]==1) 
			{
				$ujErtek=0;
			}
			else
			{
				$ujErtek=1;
			}

			$this->sql = "UPDATE felhasznalok SET aktiv=".$ujErtek." WHERE id=".$_POST['lathatosag_id']."";

			if ($this->conn->query($this->sql) === TRUE) 
			{

			  echo "<script>window.alert('Sikeres ban / unban!')</script>";
			} 
			else 
			{
			  echo "<script>window.alert('Sikertelen ban / unban!')</script>";
			}
		}
		function felhasznalokUpdate()
		{
			$cleanedUsername = htmlspecialchars($_POST["felhasznalonev_modosit"]);
			$cleanedEmail = htmlspecialchars($_POST["email_modosit"]);

			if(isset($_POST["jelszo_modosit"])&&!empty($_POST["jelszo_modosit"]))
			{
				$titkositottJelszo = password_hash($_POST["jelszo_modosit"], PASSWORD_DEFAULT);

				$stmt = $this->conn->prepare("
				UPDATE `felhasznalok` 
				SET
				`felhasznalonev`=?,
				`jelszo`=?,
				`e-mail`=?,
				`jogosultsag`=?,
				`aktiv`=?
				WHERE id=".$_POST["modosit_id"]."
				");

				$stmt->bind_param("ssssi", $cleanedUsername, $titkositottJelszo, $cleanedEmail,$_POST["jogosultsag_modosit"],$_POST["aktivitas_modosit"]);

				if($stmt->execute())
				{
				  echo "<script>window.alert('Sikeres adat frissítés!')</script>";
				}
				else
				{
				  echo "<script>window.alert('Sikertelen adat frissítés!')</script>";
				}
			}
			else
			{
				$stmt = $this->conn->prepare("
				UPDATE `felhasznalok` 
				SET
				`felhasznalonev`=?,
				`e-mail`=?,
				`jogosultsag`=?,
				`aktiv`=?
				WHERE id=".$_POST["modosit_id"]."
				");

				$stmt->bind_param("sssi", $cleanedUsername, $cleanedEmail,$_POST["jogosultsag_modosit"],$_POST["aktivitas_modosit"]);

				if($stmt->execute())
				{
				  echo "<script>window.alert('Sikeres adat frissítés!')</script>";
				}
				else
				{
				  echo "<script>window.alert('Sikertelen adat frissítés!')</script>";
				}
			}

			/*
			$cleanedUsername = htmlspecialchars($_POST["felhasznalonev_modosit"]);
			$cleanedEmail = htmlspecialchars($_POST["email_modosit"]);

			if(isset($_POST["jelszo_modosit"])&&!empty($_POST["jelszo_modosit"]))
			{
				$titkositottJelszo = password_hash($_POST["jelszo_modosit"], PASSWORD_DEFAULT);

				$this->sql = "
				UPDATE felhasznalok 
				SET 
				`felhasznalonev`='".$cleanedUsername."', 
				`jelszo`='".$titkositottJelszo."', 
				`e-mail`='".$cleanedEmail."',
				`jogosultsag`='".$_POST["jogosultsag_modosit"]."', 
				`aktiv`=".$_POST["aktivitas_modosit"]."
				WHERE id=".$_POST["modosit_id"]."
				";
			}
			else
			{
				$this->sql = "
				UPDATE felhasznalok 
				SET 
				`felhasznalonev`='".$cleanedUsername."',
				`e-mail`='".$cleanedEmail."',
				`jogosultsag`='".$_POST["jogosultsag_modosit"]."', 
				`aktiv`=".$_POST["aktivitas_modosit"]."
				WHERE id=".$_POST["modosit_id"]."
				";
			}

			if ($this->conn->query($this->sql) === TRUE) 
			{
			  echo "<script>window.alert('Sikeres adat frissítés!')</script>";
			} else 
			{
			  echo "<script>window.alert('Sikertelen adat frissítés!')</script>";
			}
			*/
		}
		function felhasznalokStatisztika()
		{
			$this->sql = "
			SELECT count(`id`) as 'adat' FROM `felhasznalok`
			UNION ALL
			SELECT count(`id`) FROM `felhasznalok` where `aktiv` = 1
			UNION ALL
			SELECT count(`id`) FROM `felhasznalok` where `aktiv` = 0
			UNION ALL
			SELECT count(`id`) FROM `felhasznalok` where `jogosultsag` like 'admin'
			UNION ALL
			SELECT count(`id`) FROM `felhasznalok` where `jogosultsag` like 'moderator'
			UNION ALL
			SELECT count(`id`) FROM `felhasznalok` where `jogosultsag` like 'felhasznalo'
			";
			$this->result = $this->conn->query($this->sql);

			if ($this->result->num_rows > 0) 
			{
				// output data of each row
				//1. sor 
				echo'<tr>
					<td class="w-50 font-weight-bold">Felhasználók száma:</td>

					<td class="w-50">';
						$this->row = $this->result->fetch_assoc();
						echo $this->row["adat"];
					echo'</td>
				</tr>';

				//2. sor
				echo'<tr>
					<td class="font-weight-bold">Aktív:</td>
					<td>';
						$this->row = $this->result->fetch_assoc();
						echo $this->row["adat"];
					echo'</td>
				</tr>';

				//3. sor
				echo'<tr>
					<td class="font-weight-bold">Kitiltott:</td>
					<td>';
						$this->row = $this->result->fetch_assoc();
						echo $this->row["adat"];
					echo'</td>
				</tr>';

				//4. sor
				echo'<tr>
				<td class="font-weight-bold">Adminok:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//5. sor
				echo'<tr>
				<td class="font-weight-bold">Moderátorok:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//6. sor
				echo'<tr>
				<td class="font-weight-bold">Felhasználók:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';
				
			} 
			else 
			{
				echo "0 results";
			}
							
		}
		//
		//autok tábla függvényei
		function autokLista()
		{
			if ($_SESSION["jogosultsag"]=="admin" || $_SESSION["jogosultsag"]=="moderátor")
			{
				//GET VÁLTOZÓK LEKEZELÉSE
				$whereAutok = 1;
				$orderByAutok = "autok.id desc";
				
				//KATEGORIA
				if(isset($_GET["sport"])&&$_GET["sport"]==1)
				{
					if($whereAutok==1)
					{
						$whereAutok = "(kategoria like 'sport'";
					}
					else
					{
						$whereAutok = $whereAutok." or kategoria like 'sport'";
					}
				}
				if(isset($_GET["luxus"])&&$_GET["luxus"]==1)
				{
					if($whereAutok==1)
					{
						$whereAutok = "(kategoria like 'luxus'";
					}
					else
					{
						$whereAutok = $whereAutok." or kategoria like 'luxus'";
					}
				}
				if(isset($_GET["cabrio"])&&$_GET["cabrio"]==1)
				{
					if($whereAutok==1)
					{
						$whereAutok = "(kategoria like 'cabrio'";
					}
					else
					{
						$whereAutok = $whereAutok." or kategoria like 'cabrio'";
					}
				}
				if(isset($_GET["suv"])&&$_GET["suv"]==1)
				{
					if($whereAutok==1)
					{
						$whereAutok = "(kategoria like 'suv'";
					}
					else
					{
						$whereAutok = $whereAutok." or kategoria like 'suv'";
					}
				}
				if($whereAutok!=1)
				{
					$whereAutok = $whereAutok.")";
				}

				//AKTIVITÁS
				if((isset($_GET["aktivAutok"])&&$_GET["aktivAutok"]!="") || (isset($_GET["kitiltottAutok"])&&$_GET["kitiltottAutok"]!=""))
				{

					if(isset($_GET["aktivAutok"]) && ($_GET["aktivAutok"]!=""))
					{
						if(isset($_GET["kitiltottAutok"]) && ($_GET["kitiltottAutok"]!=""))
						{
							if($whereAutok==1)
							{
								$whereAutok = "(autok.aktiv = 1  or autok.aktiv = 0";
							}
							else
							{
								$whereAutok = $whereAutok." and (
									autok.aktiv = 1 or autok.aktiv = 0
							";
							}
						}
						else
						{
							if($whereAutok==1)
							{
								$whereAutok = "(autok.aktiv = 1";
							}
							else
							{
								$whereAutok = $whereAutok." and (
									autok.aktiv = 1
							";
							}
						}
					}
					else if(isset($_GET["kitiltottAutok"]) && ($_GET["kitiltottAutok"]!=""))
					{
						if($whereAutok==1)
						{
							$whereAutok = "(autok.aktiv = 0";
						}
						else
						{
							$whereAutok = $whereAutok." and (
								autok.aktiv = 0
						";
						}
					}
					if($whereAutok!=1)
					{
						$whereAutok = $whereAutok.")";
					}
				}

				//KERESÉS
				if(isset($_GET["keresesAutok"])&&$_GET["keresesAutok"]!="")
				{
					if($whereAutok==1)
					{
						$whereAutok = "
							autok.marka like '%".$_GET["keresesAutok"]."%' or
							autok.tipus like '%".$_GET["keresesAutok"]."%'
						";
					}
					else
					{
						$whereAutok = $whereAutok." and (
							autok.marka like '%".$_GET["keresesAutok"]."%' or
							autok.tipus like '%".$_GET["keresesAutok"]."%'
						)";
					}
				}

				//RENDEZÉS
				if(isset($_GET["rendezesAutok"]))
				{
					if($_GET["rendezesAutok"]=="legujabb")
					{
						$orderByAutok = "autok.id desc";
					}
					else if($_GET["rendezesAutok"]=="legregebbi")
					{
						$orderByAutok = "autok.id asc";
					}
					else if($_GET["rendezesAutok"]=="leggyorsabb")
					{
						$orderByAutok = "autok.teljesitmeny desc";
					}
					else if($_GET["rendezesAutok"]=="legdragabb")
					{
						$orderByAutok = "autok.ar desc";
					}
					else if($_GET["rendezesAutok"]=="abc")
					{
						$orderByAutok = "autok.marka";
					}
				}

				$this->sql = "
					SELECT `id`, `kategoria`, `marka`, `tipus`, `motortipus`, `teljesitmeny`, `hajtas`, `sebessegvalto`, `szin`, `ajtokszama`, `ferohely`, `ar`, `aktiv` FROM `autok`

					WHERE $whereAutok
					ORDER BY $orderByAutok
				";
				//echo($this->sql);
				$this->result = $this->conn->query($this->sql);

				if ($this->result->num_rows > 0) {
					//$this->autoDB = $this->result->num_rows;
				  	// output data of each row
					echo'<div class="container m-0 p-0 mt-4 mx-auto">';
					echo'<div class="row m-0 p-0">';

				  	while($this->row = $this->result->fetch_assoc()) 
				  	{
					  	echo'<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 m-0 p-2">';
						  	echo'<div class="card w-100">';
							  	echo'<div class="card-header">';
								echo"
									<img src='./kepek/autok/".$this->row["id"]."/thumbnail/thumbnail.png' class='border img img-fluid'>
									<span class='font-weight-bold'>".$this->row["marka"]."
							    	".$this->row["tipus"]."</span>
							    	";
								echo'</div>';

								echo'<div class="card-body">';
								echo"
									<div class='container p-0 m-0'>
										<div class='row'>
											<div class='col-5'>
												ID:
											</div>

											<div class='col-7'>
												".$this->row["id"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Kategoria:
											</div>

											<div class='col-7'>
												".$this->row["kategoria"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Márka:
											</div>

											<div class='col-7'>
												".$this->row["marka"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Típus:
											</div>

											<div class='col-7'>
												".$this->row["tipus"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Motortípus:
											</div>

											<div class='col-7'>
												".$this->row["motortipus"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Teljesítmény:
											</div>

											<div class='col-7'>
												".$this->row["teljesitmeny"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Hajtás:
											</div>

											<div class='col-7'>
												".$this->row["hajtas"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Váltó:
											</div>

											<div class='col-7'>
												".$this->row["sebessegvalto"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Szín:
											</div>

											<div class='col-7'>
												".$this->row["szin"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Ajtók száma:
											</div>

											<div class='col-7'>
												".$this->row["ajtokszama"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Férőhely:
											</div>

											<div class='col-7'>
												".$this->row["ferohely"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Ár:
											</div>

											<div class='col-7'>
												".$this->row["ar"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Látható?
											</div>

											<div class='col-7'>";
												echo $this->row["aktiv"]==1?'<td>igen</td>':'<td>nem</td>';
											echo"</div>
										</div>
							    	</div>
							    	";
								echo'</div>';

								echo '<div class="card-footer">';
									echo'<div class="container m-0 p-0">';
										echo'<div class="row m-0 p-0">';
											if ($_SESSION["jogosultsag"]=="admin" || $_SESSION["jogosultsag"]=="moderátor")
											{
												echo'<div class="col-sm-6 m-0 p-0">';
													echo '<form method="POST" class="m-1 p-0">';
														echo '<input type="hidden" name="action" value="autoLathatosag">';
														echo '<input type="hidden" name="lathatosag_id" value="'.$this->row["id"].'" >';
														echo '<input type="hidden" name="lathatosag_ertek" value="'.$this->row["aktiv"].'">';
														//echo '<input type="submit" name="autoLathatosag" value="Aktív / Inaktív" class="form-control btn btn-warning">';
														echo '<button type="submit" name="autoLathatosag" class="form-control btn btn-warning">';
														echo $this->row["aktiv"]==1?'<i class="fas fa-user-times">&nbsp&nbsp</i>Tiltás':'<i class="fas fa-user-check">&nbsp&nbsp</i>Aktiválás';
														echo '</button>';
													echo '</form>';
												echo'</div>';

											}	

											if ($_SESSION["jogosultsag"]=="admin")
											{
												echo'<div class="col-sm-6 m-0 p-0">';
												    echo '<form method="POST" class="m-1 p-0" onsubmit="return Megerosites()">';
														echo '<input type="hidden" name="action" value="autoTorles">';
														echo '<input type="hidden" name="torles_id" value="'.$this->row["id"].'">';
														//echo '<input type="submit" name="autoTorles" value="Törlés" class="form-control btn btn-danger">';
														echo '<button type="submit" name="autoTorles" class="form-control btn btn-danger"><i class="fas fa-user-slash">&nbsp&nbsp</i>Törlés</button>';
													echo '</form>';
												echo'</div>';	

												echo'<div class="col-sm-6 m-0 p-0">';
													echo '<div class="m-1 p-0">
															<button class="form-control btn btn-primary" data-toggle="collapse" href="#modositasFormokAuto'.$this->row["id"].'"><i class="fas fa-user-edit">&nbsp&nbsp</i>Módosítás</button>
													</div>';
												echo'</div>';						

												/*
												echo'<div class="col-sm-12 m-0 p-0">';
													echo '<form method="POST" class="m-1 p-0">
														<input type="text" name="input_jogosultsag" placeholder="Új jogosultság" class="m-1 mt-4 form-control">
														<input type="hidden" name="jogosultsag_id" value="'.$this->row["id"].'">
														<input type="hidden" name="action" value="jogosultsag">
														<input type="submit" name="submit_jogosultsag" value="Alkalmazás" class="form-control btn btn-primary btn-block">
														</form>';
												echo'</div>';
												*/

												echo'<div class="col-sm-6 m-0 p-0">';
													echo '<div class="m-1 p-0">
														<button class="form-control btn LilaGomb" data-toggle="collapse" href="#modositasAutoKepek'.$this->row["id"].'"><i class="fas fa-image">&nbsp&nbsp</i>Képek</button>
													</div>';
												echo'</div>';	

												echo'<div class="col-sm-12 m-0 p-0 collapse" id="modositasFormokAuto'.$this->row["id"].'">';
													echo '<form method="POST" class="m-1 p-0">
														Kategória:
														<select class="form-control" name="kategoria_modosit">';
															echo"<option ".(($this->row["kategoria"]=="Sport")?"selected":"").">Sport</option>";
															echo "<option ".(($this->row["kategoria"]=="Luxus")?"selected":"").">Luxus</option>";
															echo "<option ".(($this->row["kategoria"]=="Cabrio")?"selected":"").">Cabrio</option>";
															echo "<option ".(($this->row["kategoria"]=="SUV")?"selected":"").">SUV</option>";
														echo '</select>
														Márka:
														<input type="text" name="marka_modosit" value="'.$this->row["marka"].'" class="form-control">
														Típus:
														<input type="text" name="tipus_modosit" value="'.$this->row["tipus"].'" class="form-control">
														Motortípus:
														<input type="text" name="motortipus_modosit" value="'.$this->row["motortipus"].'" class="form-control">
														Teljesítmény:
														<input type="number" name="teljesitmeny_modosit" value="'.$this->row["teljesitmeny"].'" class="form-control">
														Hajtás:
														<input type="text" name="hajtas_modosit" value="'.$this->row["hajtas"].'" class="form-control">
														Sebességváltó:
														<input type="text" name="sebessegvalto_modosit" value="'.$this->row["sebessegvalto"].'" class="form-control">
														Szín:
														<input type="text" name="szin_modosit" value="'.$this->row["szin"].'" class="form-control">
														Ajtók száma:
														<input type="number" name="ajtokszama_modosit" value="'.$this->row["ajtokszama"].'" class="form-control">
														Férőhely:
														<input type="number" name="ferohely_modosit" value="'.$this->row["ferohely"].'" class="form-control">
														Ár:
														<input type="number" name="ar_modosit" value="'.$this->row["ar"].'" class="form-control">
														Látható?:	
														<select class="form-control" name="aktiv_modosit">';
															echo"<option ".(($this->row["aktiv"]=="1")?"selected":"")." value='1'>igen</option>";
															echo "<option ".(($this->row["aktiv"]=="0")?"selected":"")." value='0'>nem</option>";
														echo '</select>

														<input type="hidden" name="action" value="autoModositas">
														<input type="hidden" name="modosit_id" value="'.$this->row["id"].'">

														<button type="submit" name="submit_modosit" value="Mentés" class="form-control btn btn-primary mt-2">
														<i class="fas fa-save">&nbsp&nbsp</i>Mentés
														</button>
													</form>';
												echo'</div>';

												echo'<div class="col-sm-12 m-0 p-0 collapse" id="modositasAutoKepek'.$this->row["id"].'">';
													echo"
													<form method='POST' class='m-1 p-0' enctype='multipart/form-data'>
														Thumbnail (500x300):
														<div class='custom-file'>
															<input type='file' name='fileToUpload0' class='custom-file-input'>
															<label class='custom-file-label' for='fileToUpload0'>Kép kiválasztása...</label>
														</div>

														További képek:
														<div class='custom-file mb-2'>
															<input type='file' name='fileToUpload1' class='custom-file-input'>
															<label class='custom-file-label' for='fileToUpload1'>Kép kiválasztása...</label>
														</div>

														<div class='custom-file mb-2'>
															<input type='file' name='fileToUpload2' class='custom-file-input'>
															<label class='custom-file-label' for='fileToUpload2'>Kép kiválasztása...</label>
														</div>

														<div class='custom-file mb-2'>
															<input type='file' name='fileToUpload3' class='custom-file-input'>
															<label class='custom-file-label' for='fileToUpload3'>Kép kiválasztása...</label>
														</div>

														<div class='custom-file mb-2'>
															<input type='file' name='fileToUpload4' class='custom-file-input'>
															<label class='custom-file-label' for='fileToUpload4'>Kép kiválasztása...</label>
														</div>

														<div class='custom-file'>
															<input type='file' name='fileToUpload5' class='custom-file-input'>
															<label class='custom-file-label' for='fileToUpload5'>Kép kiválasztása...</label>
														</div>

														<input type='hidden' name='kepModositAutoID' value='".$this->row['id']."'>

														<input type='hidden' name='action' value='autoKepFeltoltes'>

														<button type='submit' class='form-control btn LilaGomb mt-2'>
														<i class='fas fa-image'>&nbsp&nbsp</i>Képek feltöltése
														</button>
													</form>";
												echo '</div>';
											}
										echo'</div>';
									echo'</div>';
								echo'</div>';
							echo'</div>';
						echo'</div>';
				  	}
				  	echo'</div>';
					echo'</div>';
				} 
				else 
				{
				  echo "0 results";
				}
			}				
		}
		function autokInsert()
		{
			$this->sql = "INSERT INTO autok (`kategoria`, `marka`, `tipus`, `motortipus`, `teljesitmeny`, `hajtas`, `sebessegvalto`, `szin`, `ajtokszama`, `ferohely`, `ar`, `aktiv`)
			VALUES 
			(
			'".$_POST["inputKategoria"]."', 
			'".$_POST["inputMarka"]."', 
			'".$_POST["inputTipus"]."',
			'".$_POST["inputMotor"]."',
			".$_POST["inputTeljesitmeny"].",
			'".$_POST["inputHajtas"]."',
			'".$_POST["inputSebessegvalto"]."',
			'".$_POST["inputSzin"]."',
			".$_POST["inputAjtok"].",
			".$_POST["inputFerohely"].",
			".$_POST["inputAr"].",
			".$_POST["inputAktiv"]."
			)
			";

			if ($this->conn->query($this->sql) === TRUE) 
			{
			  echo "<script>window.alert('Sikeres regisztráció!')</script>";
			} 
			else 
			{
			  echo "<script>window.alert('Sikertelen regisztráció!')</script>";
			}
		}
		function autokDelete()
		{
			$this->sql = "DELETE FROM autok WHERE id = ".$_POST['torles_id']."";

			if ($this->conn->query($this->sql) === TRUE) 
			{
			  echo "<script>window.alert('Sikeres törlés!')</script>";
			} 
			else 
			{
			  echo "<script>window.alert('Sikertelen törlés!')</script>";
			}
		}
		function autokLathatosagCsere()
		{
			$ujErtek;
			if ($_POST["lathatosag_ertek"]==1) 
			{
				$ujErtek=0;
			}
			else
			{
				$ujErtek=1;
			}

			$this->sql = "UPDATE autok SET aktiv=".$ujErtek." WHERE id=".$_POST['lathatosag_id']."";

			if ($this->conn->query($this->sql) === TRUE) 
			{

			  echo "<script>window.alert('Sikeres ban / unban!')</script>";
			} 
			else 
			{
			  echo "<script>window.alert('Sikertelen ban / unban!')</script>";
			}
		}
		function autokUpdate()
		{
			$this->sql = "
			UPDATE autok 
			SET
			kategoria='".$_POST["kategoria_modosit"]."', 
			marka='".$_POST["marka_modosit"]."', 
			tipus='".$_POST["tipus_modosit"]."',
			motortipus='".$_POST["motortipus_modosit"]."',
			teljesitmeny=".$_POST["teljesitmeny_modosit"].",
			hajtas='".$_POST["hajtas_modosit"]."',
			sebessegvalto='".$_POST["sebessegvalto_modosit"]."',
			szin='".$_POST["szin_modosit"]."',
			ajtokszama=".$_POST["ajtokszama_modosit"].",
			ferohely=".$_POST["ferohely_modosit"].",
			ar=".$_POST["ar_modosit"].",
			aktiv=".$_POST["aktiv_modosit"]."
			WHERE id = ".$_POST["modosit_id"]."
			";

			if ($this->conn->query($this->sql) === TRUE) 
			{
			  echo "<script>window.alert('Sikeres adat frissítés!')</script>";
			} else 
			{
			  echo "<script>window.alert('Sikertelen adat frissítés!')</script>";
			}
		}
		function autokStatisztika()
		{
			$this->sql = "
			SELECT count(`id`) as 'adat' FROM `autok`
			UNION ALL
			SELECT count(`id`) FROM `autok` WHERE `aktiv` = 1
			UNION ALL
			SELECT count(`id`) FROM `autok` WHERE `aktiv` = 0
			UNION ALL
			SELECT count(`id`) FROM `autok` WHERE `kategoria` like 'Sport'
			UNION ALL
			SELECT count(`id`) FROM `autok` WHERE `kategoria` like 'Luxus'
			UNION ALL
			SELECT count(`id`) FROM `autok` WHERE `kategoria` like 'Cabrio'
			UNION ALL
			SELECT count(`id`) FROM `autok` WHERE `kategoria` like 'SUV'
			UNION ALL
			SELECT CONCAT(autok.marka, ' ', autok.tipus) from `autok` where `ar` = (SELECT MAX(`ar`) FROM `autok`)
			UNION ALL
			SELECT CONCAT(autok.marka, ' ', autok.tipus) from `autok` where `teljesitmeny` = (SELECT MAX(`teljesitmeny`) FROM `autok`)
			UNION ALL
			(SELECT count(foglalasok.id) FROM `autok` INNER JOIN foglalasok on foglalasok.auto_id = autok.id where foglalasok.allapot like 'Autó elvíve')

			";
			$this->result = $this->conn->query($this->sql);

			if ($this->result->num_rows > 0) 
			{
				// output data of each row
				//1. sor 
				echo'<tr>
					<td class="w-50 font-weight-bold">Autók száma:</td>

					<td class="w-50">';
						$this->row = $this->result->fetch_assoc();
						echo $this->row["adat"];
					echo'</td>
				</tr>';

				//2. sor
				echo'<tr>
					<td class="font-weight-bold">Látható:</td>
					<td>';
						$this->row = $this->result->fetch_assoc();
						echo $this->row["adat"];
					echo'</td>
				</tr>';

				//3. sor
				echo'<tr>
					<td class="font-weight-bold">Rejtett:</td>
					<td>';
						$this->row = $this->result->fetch_assoc();
						echo $this->row["adat"];
					echo'</td>
				</tr>';

				//4. sor
				echo'<tr>
				<td class="font-weight-bold">Sport:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//5. sor
				echo'<tr>
				<td class="font-weight-bold">Luxus:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//6. sor
				echo'<tr>
				<td class="font-weight-bold">Cabrio:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//7. sor
				echo'<tr>
				<td class="font-weight-bold">SUV:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//8. sor
				echo'<tr>
				<td class="font-weight-bold">Legdrágább:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//9. sor
				echo'<tr>
				<td class="font-weight-bold">Leggyorsabb:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//10. sor
				echo'<tr>
				<td class="font-weight-bold">Bérlés alatt:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';
				
			} 
			else 
			{
				echo "0 results";
			}
		}
		//
		//foglalások tábla függvényei
		function foglalasListazasFelhasznaloknak($id)
		{
			$this->sql = "
			SELECT 
			foglalasok.id as 'fogl_id',
			felhasznalok.id as 'felh_id',
			felhasznalok.felhasznalonev as 'felh_nev',
			autok.id as 'auto_id',
			autok.marka as 'marka',
			autok.tipus as 'tipus',
			foglalasok.elsonap as 'elsonap',
			foglalasok.utolsonap as 'utolsonap',
			foglalasok.allapot as 'allapot',
			foglalasok.ar as 'ar',
			foglalasok.fizetve as 'fizetve',
			foglalasok.idopont as 'idopont'
			FROM `foglalasok`

			INNER JOIN autok on autok.id = foglalasok.auto_id
			INNER JOIN felhasznalok on felhasznalok.id = foglalasok.felhasznalo_id
			
			WHERE felhasznalok.id = ".$_SESSION["belepett_id"]."

			ORDER BY foglalasok.idopont desc
			";
			$this->result = $this->conn->query($this->sql);
		
			echo '<div class="container m-0 p-0 mx-auto mt-4">';
			echo '<div class="row m-0 p-0">';	
				if ($this->result->num_rows > 0) 
				{
					while($this->row = $this->result->fetch_assoc()) 
					{
						echo'<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 m-0 p-2">';
							echo'<div class="card w-100">';

								echo'<div class="card-header">';
									echo"
										<span class='font-weight-bold'>".$this->row["fogl_id"]." - </span>
										<a href='autoProfil.php?id=".$this->row["auto_id"]."'><span class='font-weight-bold text-dark'>".$this->row["marka"]." ".$this->row["tipus"]."</span></a>
									";
								echo'</div>';

								echo'<div class="card-body">';
									echo"
									<div class='container p-0 m-0'>
										<div class='row'>
											<div class='col-5'>
												Rendelésszám:
											</div>

											<div class='col-7'>
												".$this->row["fogl_id"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Felhaszáló:
											</div>

											<div class='col-7'>
												".$this->row["felh_nev"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Autó:
											</div>

											<div class='col-7'>
											".$this->row["marka"]." ".$this->row["tipus"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Első nap:
											</div>

											<div class='col-7'>
												".$this->row["elsonap"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Utolsó nap:
											</div>

											<div class='col-7'>
												".$this->row["utolsonap"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Állapot:
											</div>

											<div class='col-7'>
												".$this->row["allapot"]."
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Ár:
											</div>

											<div class='col-7'>
												".number_format ($this->row["ar"],0,',','.')." Ft
											</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Fizetve:
											</div>

											<div class='col-7'>";
												echo $this->row["fizetve"]==1?'<span class="text-success">igen</span>':'<span class="text-danger">nem</span>';
											echo"</div>
										</div>

										<div class='row'>
											<div class='col-5'>
												Időpont:
											</div>

											<div class='col-7'>
												".$this->row["idopont"]."
											</div>
										</div>
									</div>
									";
								echo'</div>';
									echo '<div class="card-footer">';
										echo'<div class="container m-0 p-0">';
											echo'<div class="row m-0 p-0">';
												if ($_SESSION["jogosultsag"]=="felhasználó")
												{
													if ($this->row["allapot"]=="Függőben" || $this->row["allapot"]=="Bizonylat feltöltve")
													{
														echo'<div class="col-sm-6 m-0 p-0">';
														echo '<div class="m-1 p-0">
															<button class="form-control btn LilaGomb" data-toggle="collapse" href="#modositasBizonylat'.$this->row["fogl_id"].'"><i class="fas fa-file-alt">&nbsp&nbsp</i>Bizonylat</button>
														</div>';
														echo'</div>';
														
													}
													
													if ($this->row["allapot"]=="Függőben" || $this->row["allapot"]=="Fizetve")
													{
														echo'<div class="col-sm-6 m-0 p-0">';
															echo '<form method="POST" class="m-1 p-0">';
																echo '<input type="hidden" name="action" value="allapotCsereFelhasznalo">';
																echo '<input type="hidden" name="foglalasID" value="'.$this->row["fogl_id"].'" >';
																echo '<input type="hidden" name="fizetve" value="'.$this->row["fizetve"].'" >';
																echo '<input type="hidden" name="ujAllapot" value="Lemondás" >';
																
																echo '<button type="submit" class="form-control btn btn-danger">';
																	echo '<i class="fas fa-times">&nbsp&nbsp</i>Lemondás';
																echo '</button>';
															echo '</form>';
														echo'</div>';
													}

													if ($this->row["allapot"]=="Függőben" || $this->row["allapot"]=="Bizonylat feltöltve")
													{
														echo'<div class="col-sm-12 m-0 p-0 collapse" id="modositasBizonylat'.$this->row["fogl_id"].'">';
														echo"
														<form method='POST' class='m-1 p-0' enctype='multipart/form-data'>
															A fálj formátuma .PDF, .JPG, .JPEG, .PNG lehet!
															<div class='custom-file'>
																<input type='file' name='fileToUploadBizonylat' class='custom-file-input'>
																<label class='custom-file-label' for='fileToUploadBizonylat'>Fájl kiválasztása...</label>
															</div>

															<input type='hidden' name='bizonylatFeltoltID' value='".$this->row['fogl_id']."'>
	
															<input type='hidden' name='action' value='bizonylatFeltoltese'>
	
															<button type='submit' class='form-control btn LilaGomb mt-2'>
																<i class='fas fa-upload'>&nbsp&nbsp</i>Bizonylat Felöltése
															</button>
														</form>";
														echo '</div>';
													}
												}
											echo'</div>';
										echo'</div>';
									echo'</div>';
								echo'</div>';
							echo'</div>';
						}
					} 
					else 
					{
						
					}	
				echo '</div>';
			echo '</div>';
		}
		function foglalasLista()
		{
			//GET VÁLTOZÓK LEKEZELÉSE
			$where = 1;
			$orderBy = "foglalasok.idopont desc";
			
			//ÁLLAPOT
			if(isset($_GET["fuggoben"])&&$_GET["fuggoben"]==1)
			{
				if($where==1)
				{
					$where = "(allapot like 'Függőben'";
				}
				else
				{
					$where = $where." or allapot like 'Függőben'";
				}
			}
			if(isset($_GET["bizonylatFeltoltve"])&&$_GET["bizonylatFeltoltve"]==1)
			{
				if($where==1)
				{
					$where = "(allapot like 'Bizonylat feltöltve'";
				}
				else
				{
					$where = $where." or allapot like 'Bizonylat feltöltve'";
				}
			}
			if(isset($_GET["fizetve"])&&$_GET["fizetve"]==1)
			{
				if($where==1)
				{
					$where = "(allapot like 'Fizetve'";
				}
				else
				{
					$where = $where." or allapot like 'Fizetve'";
				}
			}
			if(isset($_GET["visszautalasraVar"])&&$_GET["visszautalasraVar"]==1)
			{
				if($where==1)
				{
					$where = "(allapot like 'Visszautalásra vár'";
				}
				else
				{
					$where = $where." or allapot like 'Visszautalásra vár'";
				}
			}
			if(isset($_GET["visszautalva"])&&$_GET["visszautalva"]==1)
			{
				if($where==1)
				{
					$where = "(allapot like 'Visszautalva'";
				}
				else
				{
					$where = $where." or allapot like 'Visszautalva'";
				}
			}
			if(isset($_GET["ervenytelen"])&&$_GET["ervenytelen"]==1)
			{
				if($where==1)
				{
					$where = "(allapot like 'Érvénytelen'";
				}
				else
				{
					$where = $where." or allapot like 'Érvénytelen'";
				}
			}
			if(isset($_GET["autoElvive"])&&$_GET["autoElvive"]==1)
			{
				if($where==1)
				{
					$where = "(allapot like 'Autó elvíve'";
				}
				else
				{
					$where = $where." or allapot like 'Autó elvíve'";
				}
			}
			if(isset($_GET["autoVisszahozva"])&&$_GET["autoVisszahozva"]==1)
			{
				if($where==1)
				{
					$where = "(allapot like 'Autó visszahozva'";
				}
				else
				{
					$where = $where." or allapot like 'Autó visszahozva'";
				}
			}
			if($where!=1)
			{
				$where = $where.")";
			}

			//KERESÉS
			if(isset($_GET["kereses"])&&$_GET["kereses"]!="")
			{
				if($where==1)
				{
					$where = "
						felhasznalok.felhasznalonev like '%".$_GET["kereses"]."%' or
						autok.marka like '%".$_GET["kereses"]."%' or
						autok.tipus like '%".$_GET["kereses"]."%'
					";
				}
				else
				{
					$where = $where." and (
						felhasznalok.felhasznalonev like '%".$_GET["kereses"]."%' or
						autok.marka like '%".$_GET["kereses"]."%' or
						autok.tipus like '%".$_GET["kereses"]."%'
					)";
				}
			}

			//RENDEZÉS
			if(isset($_GET["rendezes"]))
			{
				if($_GET["rendezes"]=="legujabb")
				{
					$orderBy = "foglalasok.idopont desc";
				}
				else if($_GET["rendezes"]=="legregebbi")
				{
					$orderBy = "foglalasok.idopont asc";
				}
				else if($_GET["rendezes"]=="legdragabb")
				{
					$orderBy = "foglalasok.ar desc";
				}
				else if($_GET["rendezes"]=="legolcsobb")
				{
					$orderBy = "foglalasok.ar asc";
				}
			}

			$this->sql = "
				SELECT 
				foglalasok.id as 'fogl_id',
				felhasznalok.id as 'felh_id',
				felhasznalok.felhasznalonev as 'felh_nev',
				autok.id as 'auto_id',
				autok.marka as 'marka',
				autok.tipus as 'tipus',
				foglalasok.elsonap as 'elsonap',
				foglalasok.utolsonap as 'utolsonap',
				foglalasok.allapot as 'allapot',
				foglalasok.ar as 'ar',
				foglalasok.fizetve as 'fizetve',
				foglalasok.idopont as 'idopont'
				FROM `foglalasok`

				INNER JOIN autok on autok.id = foglalasok.auto_id
				INNER JOIN felhasznalok on felhasznalok.id = foglalasok.felhasznalo_id

				WHERE $where
				ORDER BY $orderBy
			";
			$this->result = $this->conn->query($this->sql);
			
			echo '<div class="container m-0 p-0 mx-auto mt-4">';
				echo '<div class="row m-0 p-0">';	
					if ($this->result->num_rows > 0) 
					{
						$this->foglDB = $this->result->num_rows;
						while($this->row = $this->result->fetch_assoc()) 
						{
							echo'<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 m-0 p-2">';
								echo'<div class="card w-100">';

									echo'<div class="card-header">';
										echo"
											<span class='font-weight-bold'>".$this->row["fogl_id"]." - (".$this->row["felh_id"].") ".$this->row["felh_nev"]." - (".$this->row["auto_id"].")</span>
											<a href='autoProfil.php?id=".$this->row["auto_id"]."'><span class='font-weight-bold text-dark'>".$this->row["marka"]." ".$this->row["tipus"]."</span></a>
											";
									echo'</div>';

									echo'<div class="card-body">';
										echo"
										<div class='container p-0 m-0'>
											<div class='row'>
												<div class='col-5'>
													ID:
												</div>

												<div class='col-7'>
													".$this->row["fogl_id"]."
												</div>
											</div>

											<div class='row'>
												<div class='col-5'>
													(ID) Felhaszáló:
												</div>

												<div class='col-7'>
													(".$this->row["felh_id"].") ".$this->row["felh_nev"]."
												</div>
											</div>

											<div class='row'>
												<div class='col-5'>
													(ID) Autó:
												</div>

												<div class='col-7'>
												(".$this->row["auto_id"].") ".$this->row["marka"]." ".$this->row["tipus"]."
												</div>
											</div>

											<div class='row'>
												<div class='col-5'>
													Első nap:
												</div>

												<div class='col-7'>
													".$this->row["elsonap"]."
												</div>
											</div>

											<div class='row'>
												<div class='col-5'>
													Utolsó nap:
												</div>

												<div class='col-7'>
													".$this->row["utolsonap"]."
												</div>
											</div>

											<div class='row'>
												<div class='col-5'>
													Állapot:
												</div>

												<div class='col-7'>
													".$this->row["allapot"]."
												</div>
											</div>

											<div class='row'>
												<div class='col-5'>
													Ár:
												</div>

												<div class='col-7'>
													".number_format ($this->row["ar"],0,',','.')." Ft
												</div>
											</div>

											<div class='row'>
												<div class='col-5'>
													Fizetve:
												</div>

												<div class='col-7'>";
													echo $this->row["fizetve"]==1?'<span class="text-success">igen</span>':'<span class="text-danger">nem</span>';
												echo"</div>
											</div>

											<div class='row'>
												<div class='col-5'>
													Időpont:
												</div>

												<div class='col-7'>
													".$this->row["idopont"]."
												</div>
											</div>
										</div>
										";
									echo'</div>';
								
								
									echo '<div class="card-footer">';
										echo'<div class="container m-0 p-0">';
											echo'<div class="row m-0 p-0">';
												if ($_SESSION["jogosultsag"]=="admin" || $_SESSION["jogosultsag"]=="moderátor")
												{
													echo'<div class="col-sm-6 m-0 p-0">';
														echo '<form method="POST" class="m-1 p-0">';
															echo '<input type="hidden" name="action" value="allapotCsere">';
															echo '<input type="hidden" name="foglalasID" value="'.$this->row["fogl_id"].'" >';
															echo '<input type="hidden" name="ujAllapot" value="Fizetve" >';

															echo '<button type="submit" class="form-control btn btn-success">';
																echo '<i class="fas fa-check">&nbsp&nbsp</i>Fizetve';
															echo '</button>';
														echo '</form>';
													echo'</div>';

													echo'<div class="col-sm-6 m-0 p-0">';
														echo '<form method="POST" class="m-1 p-0">';
															echo '<input type="hidden" name="action" value="allapotCsere">';
															echo '<input type="hidden" name="foglalasID" value="'.$this->row["fogl_id"].'" >';
															echo '<input type="hidden" name="ujAllapot" value="Érvénytelen" >';

															echo '<button type="submit" class="form-control btn btn-danger">';
																echo '<i class="fas fa-times">&nbsp&nbsp</i>Érvénytelen';
															echo '</button>';
														echo '</form>';
													echo'</div>';

													echo'<div class="col-sm-6 m-0 p-0">';
														echo '<form method="POST" class="m-1 p-0">';
															echo '<input type="hidden" name="action" value="allapotCsere">';
															echo '<input type="hidden" name="foglalasID" value="'.$this->row["fogl_id"].'" >';
															echo '<input type="hidden" name="ujAllapot" value="Függőben" >';
															
															echo '<button type="submit" class="form-control btn btn-warning">';
																echo '<i class="fas fa-question">&nbsp&nbsp</i>Függőben';
															echo '</button>';
														echo '</form>';
													echo'</div>';

													echo'<div class="col-sm-6 m-0 p-0">';
														echo '<form method="POST" class="m-1 p-0">';
															echo '<input type="hidden" name="action" value="allapotCsere">';
															echo '<input type="hidden" name="foglalasID" value="'.$this->row["fogl_id"].'" >';
															echo '<input type="hidden" name="ujAllapot" value="Visszautalva" >';
															
															echo '<button type="submit" class="form-control btn btn-primary">';
																echo '<i class="fas fa-money-bill-wave">&nbsp&nbsp</i>Visszautalva';
															echo '</button>';
														echo '</form>';
													echo'</div>';

													echo'<div class="col-sm-6 m-0 p-0">';
													echo '<form method="POST" class="m-1 p-0">';
														echo '<input type="hidden" name="action" value="allapotCsere">';
														echo '<input type="hidden" name="foglalasID" value="'.$this->row["fogl_id"].'" >';
														echo '<input type="hidden" name="ujAllapot" value="Autó elvíve" >';
														
														echo '<button type="submit" class="form-control btn btn-info">';
															echo 'Autó elvíve';
														echo '</button>';
													echo '</form>';
													echo'</div>';

													echo'<div class="col-sm-6 m-0 p-0">';
													echo '<form method="POST" class="m-1 p-0">';
														echo '<input type="hidden" name="action" value="allapotCsere">';
														echo '<input type="hidden" name="foglalasID" value="'.$this->row["fogl_id"].'" >';
														echo '<input type="hidden" name="ujAllapot" value="Autó visszahozva">';
														
														echo '<button type="submit" class="form-control btn btn-info">';
															echo 'Autó visszahozva';
														echo '</button>';
													echo '</form>';
													echo'</div>';

													echo'<div class="col-sm-6 m-0 p-0">';
														echo '<form method="POST" class="m-1 p-0">';
															if(is_dir('bizonylatok/'.$this->row["fogl_id"].'')) 
															{
																echo '<a class="form-control btn LilaGomb" href="letoltes.php?foglalasID='.$this->row["fogl_id"].'">';
																echo '<span class="fas fa-download">&nbsp&nbsp</span>Bizonylat';
															}
															else
															{
																echo '<a class="form-control btn LilaGomb disabled">';
																echo '<span class="fas fa-download">&nbsp&nbsp</span>Bizonylat';
															}
															echo '</a>';
														echo '</form>';
													echo'</div>';
													
													/*
													echo'<div class="col-sm-6 m-0 p-0">';
													echo '<form method="POST" class="m-1 p-0">';
														//echo '<input type="hidden" name="action" value="allapotCsere">';
														//echo '<input type="hidden" name="foglalasID" value="'.$this->row["fogl_id"].'" >';
														//echo '<input type="hidden" name="ujAllapot" value="Autó visszahozva">';
														
														echo '<button type="submit" class="form-control btn LilaGomb">';
															echo '<span class="fas fa-upload">&nbsp&nbsp</span>Számla';
														echo '</button>';
													echo '</form>';
													echo'</div>';
													*/
												}
											echo'</div>';
										echo'</div>';
									echo'</div>';
								echo'</div>';
					  		echo'</div>';
						}
					} 
					else 
					{

					}	
				echo '</div>';
			echo '</div>';
		}
		function foglalasAllapotCsere($id,$allapot)
		{
			if($allapot == "Fizetve")
			{
				$this->sql = "
				UPDATE `foglalasok` 
				SET `allapot`= '$allapot', fizetve = 1
				WHERE `id` = $id
				";
			}
			else if ($allapot == "Visszautalva")
			{
				$this->sql = "
				UPDATE `foglalasok` 
				SET `allapot`= '$allapot', fizetve = 0
				WHERE `id` = $id
				";
			}
			else
			{
				$this->sql = "
				UPDATE `foglalasok` 
				SET `allapot`= '$allapot' 
				WHERE `id` = $id
				
			";
			}
			if ($this->conn->query($this->sql) === TRUE) 
			{
			  echo "<script>window.alert('Sikeres állapot módosítás!')</script>";
			} else 
			{
			  echo "<script>window.alert('Sikertelen állapot módosítás!')</script>";
			}
		}
		function foglalasAllapotCsereFelhasznalo($id,$allapot,$fizetve)
		{
			if($allapot == "Lemondás" && $fizetve == 1)
			{
				$this->sql = "
				UPDATE `foglalasok` 
				SET `allapot`= 'Visszautalásra vár'
				WHERE `id` = $id
				";
			}
			else if ($allapot == "Lemondás" && $fizetve == 0)
			{
				$this->sql = "
				UPDATE `foglalasok` 
				SET `allapot`= 'Érvénytelen'
				WHERE `id` = $id
				";
			}
			else if ($allapot == "Bizonylat feltöltve")
			{
				$this->sql = "
				UPDATE `foglalasok` 
				SET `allapot`= 'Bizonylat feltöltve'
				WHERE `id` = $id
				";
			}

			if ($this->conn->query($this->sql) === TRUE) 
			{
			  echo "<script>window.alert('Sikeres állapot módosítás!')</script>";
			} else 
			{
			  echo "<script>window.alert('Sikertelen állapot módosítás!')</script>";
			}
		}
		function foglalasStatisztika()
		{
			$this->sql = "
			SELECT COUNT(*) as 'adat' FROM `foglalasok`
			UNION ALL
			SELECT COUNT(*) as 'adat' FROM `foglalasok` where `allapot` like 'Függőben'
			UNION ALL
			SELECT COUNT(*) as 'adat' FROM `foglalasok` where `allapot` like 'Bizonylat feltöltve'
			UNION ALL
			SELECT COUNT(*) as 'adat' FROM `foglalasok` where `allapot` like 'Fizetve'
			UNION ALL
			SELECT COUNT(*) as 'adat' FROM `foglalasok` where `allapot` like 'Érvénytelen'
			UNION ALL
			SELECT COUNT(*) as 'adat' FROM `foglalasok` where `allapot` like 'Visszautalva'
			UNION ALL
			SELECT COUNT(*) as 'adat' FROM `foglalasok` where `allapot` like 'Visszautalásra vár'
			UNION ALL
			SELECT COUNT(*) as 'adat' FROM `foglalasok` where `allapot` like 'Autó elvíve'
			UNION ALL
			SELECT COUNT(*) as 'adat' FROM `foglalasok` where `allapot` like 'Autó visszahozva'
			";
			$this->result = $this->conn->query($this->sql);

			if ($this->result->num_rows > 0) 
			{
				// output data of each row
				//1. sor 
				echo'<tr>
					<td class="w-50 font-weight-bold">Foglalások száma:</td>

					<td class="w-50">';
						$this->row = $this->result->fetch_assoc();
						echo $this->row["adat"];
					echo'</td>
				</tr>';

				//2. sor
				echo'<tr>
					<td class="font-weight-bold">Függőben lévő:</td>
					<td>';
						$this->row = $this->result->fetch_assoc();
						echo $this->row["adat"];
					echo'</td>
				</tr>';

				//2.2 sor
				echo'<tr>
					<td class="font-weight-bold">Bizonylat feltöltve:</td>
					<td>';
						$this->row = $this->result->fetch_assoc();
						echo $this->row["adat"];
					echo'</td>
				</tr>';

				//3. sor
				echo'<tr>
					<td class="font-weight-bold">Fizetve:</td>
					<td>';
						$this->row = $this->result->fetch_assoc();
						echo $this->row["adat"];
					echo'</td>
				</tr>';

				//4. sor
				echo'<tr>
				<td class="font-weight-bold">Érvénytelen:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//5. sor
				echo'<tr>
				<td class="font-weight-bold">Visszautalva:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//6. sor
				echo'<tr>
				<td class="font-weight-bold">Visszautalásra vár:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//7. sor
				echo'<tr>
				<td class="font-weight-bold">Autó elvíve:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';

				//8. sor
				echo'<tr>
				<td class="font-weight-bold">Autó visszahozva:</td>
				
				<td>';
					$this->row = $this->result->fetch_assoc();
					echo $this->row["adat"];
				echo'</td>
				</tr>';	
			} 
			else 
			{
				echo "0 results";
			}
		}

	}

	//Új adatbázis 
	$royalRentDb = new Adatbazis();
	//
	//Action események (gomblenyomás)
	if (isset($_POST["action"])) 
    {	
        //Felhasználó action gombok
        if ($_POST["action"]=="regisztracio") 
        {
        	if (isset($_POST["inputFelhasznaloNev"])&&!empty($_POST["inputFelhasznaloNev"])&&
        		isset($_POST["inputJelszo"])&&!empty($_POST["inputJelszo"])&&
        		isset($_POST["inputEmail"])&&!empty($_POST["inputEmail"])&&
        		isset($_POST["inputJogosultsag"])&&!empty($_POST["inputJogosultsag"])&&
        		isset($_POST["inputLathatosag"])&&is_numeric($_POST["inputLathatosag"])) 
        	{
        		$royalRentDb->kapcsolatNyitasa();
        		$royalRentDb->felhasznalokInsert();
        		$royalRentDb->kapcsolatBontasa();
        	}
        	else
        	{
        		echo "<script>window.alert('Minden mező kitöltése kötelező!')</script>";
        	}
        }
        else if ($_POST["action"]=="torles") 
        {
        	if (isset($_POST["torles_id"])&&is_numeric($_POST["torles_id"])) 
        	{
        		$royalRentDb->kapcsolatNyitasa();
        		$royalRentDb->felhasznalokDelete();
        		$royalRentDb->kapcsolatBontasa();
        	}
        	else
        	{
        		echo "<script>window.alert('Törlési hiba.')</script>";
        	}
        }
        else if ($_POST["action"]=="lathatosag") 
        {
        	if (isset($_POST["lathatosag_id"])&&is_numeric($_POST["lathatosag_id"])&&
        		isset($_POST["lathatosag_ertek"])&&is_numeric($_POST["lathatosag_ertek"]))
        	{
        		$royalRentDb->kapcsolatNyitasa();
        		$royalRentDb->felhasznalokLathatosagCsere();
        		$royalRentDb->kapcsolatBontasa();
        	}
        	else
        	{
        		echo "<script>window.alert('Láthatóság módosítási hiba.')</script>";
        	}
        }
        else if ($_POST["action"]=="modositas") 
        {
        	if (isset($_POST["felhasznalonev_modosit"])&&!empty($_POST["felhasznalonev_modosit"])&&
        		//isset($_POST["jelszo_modosit"])&&!empty($_POST["jelszo_modosit"])&&
        		isset($_POST["email_modosit"])&&!empty($_POST["email_modosit"])&&
        		isset($_POST["jogosultsag_modosit"])&&!empty($_POST["jogosultsag_modosit"])&&
        		isset($_POST["aktivitas_modosit"])&&is_numeric($_POST["aktivitas_modosit"]))
        	{
        		$royalRentDb->kapcsolatNyitasa();
        		$royalRentDb->felhasznalokUpdate();
        		$royalRentDb->kapcsolatBontasa();
        	}
        	else
        	{
        		echo "<script>window.alert('A mezők kitöltése kötelező!')</script>";
        	}
        }
        //Autó action gombok
        else if ($_POST["action"]=="autoFelvetel") 
        {
        	if (isset($_POST["inputKategoria"])&&!empty($_POST["inputKategoria"])&&
        		isset($_POST["inputMarka"])&&!empty($_POST["inputMarka"])&&
        		isset($_POST["inputTipus"])&&!empty($_POST["inputTipus"])&&
        		isset($_POST["inputMotor"])&&!empty($_POST["inputMotor"])&&
        		isset($_POST["inputTeljesitmeny"])&&is_numeric($_POST["inputTeljesitmeny"])&&
        		isset($_POST["inputHajtas"])&&!empty($_POST["inputHajtas"])&&
        		isset($_POST["inputSebessegvalto"])&&!empty($_POST["inputSebessegvalto"])&&
        		isset($_POST["inputSzin"])&&!empty($_POST["inputSzin"])&&
        		isset($_POST["inputAjtok"])&&is_numeric($_POST["inputAjtok"])&&
        		isset($_POST["inputFerohely"])&&is_numeric($_POST["inputFerohely"])&&
        		isset($_POST["inputAr"])&&is_numeric($_POST["inputAr"])&&
        		isset($_POST["inputAktiv"])&&is_numeric($_POST["inputAktiv"])) 
        	{
        		$royalRentDb->kapcsolatNyitasa();
        		$royalRentDb->autokInsert();
        		$royalRentDb->kapcsolatBontasa();
        	}
        	else
        	{
        		echo "<script>window.alert('Minden mező kitöltése kötelező!')</script>";
        	}
        }
        else if ($_POST["action"]=="autoTorles")
        {
        	if (isset($_POST["torles_id"])&&is_numeric($_POST["torles_id"])) 
        	{
        		$royalRentDb->kapcsolatNyitasa();
        		$royalRentDb->autokDelete();
        		$royalRentDb->kapcsolatBontasa();
        	}
        	else
        	{
        		echo "<script>window.alert('Törlési hiba.')</script>";
        	}
        } 
        else if ($_POST["action"]=="autoLathatosag")
        {
        	if (isset($_POST["lathatosag_id"])&&is_numeric($_POST["lathatosag_id"])&&
        		isset($_POST["lathatosag_ertek"])&&is_numeric($_POST["lathatosag_ertek"]))
        	{
        		$royalRentDb->kapcsolatNyitasa();
        		$royalRentDb->autokLathatosagCsere();
        		$royalRentDb->kapcsolatBontasa();
        	}
        	else
        	{
        		echo "<script>window.alert('Láthatóság módosítási hiba.')</script>";
        	}
        } 
        else if ($_POST["action"]=="autoModositas")
        {
        	if (isset($_POST["kategoria_modosit"])&&!empty($_POST["kategoria_modosit"])&&
        		isset($_POST["marka_modosit"])&&!empty($_POST["marka_modosit"])&&
        		isset($_POST["tipus_modosit"])&&!empty($_POST["tipus_modosit"])&&
        		isset($_POST["motortipus_modosit"])&&!empty($_POST["motortipus_modosit"])&&
        		isset($_POST["teljesitmeny_modosit"])&&is_numeric($_POST["teljesitmeny_modosit"])&&
        		isset($_POST["hajtas_modosit"])&&!empty($_POST["hajtas_modosit"])&&
        		isset($_POST["sebessegvalto_modosit"])&&!empty($_POST["sebessegvalto_modosit"])&&
        		isset($_POST["szin_modosit"])&&!empty($_POST["szin_modosit"])&&
        		isset($_POST["ajtokszama_modosit"])&&is_numeric($_POST["ajtokszama_modosit"])&&
        		isset($_POST["ferohely_modosit"])&&is_numeric($_POST["ferohely_modosit"])&&
        		isset($_POST["ar_modosit"])&&is_numeric($_POST["ar_modosit"])&&
        		isset($_POST["aktiv_modosit"])&&is_numeric($_POST["aktiv_modosit"]))
        	{
        		$royalRentDb->kapcsolatNyitasa();
        		$royalRentDb->autokUpdate();
        		$royalRentDb->kapcsolatBontasa();
        	}
        	else
        	{
        		echo "<script>window.alert('A mezők kitöltése kötelező!')</script>";
        	}
		} 
		else if ($_POST["action"]=="autoKepFeltoltes")
        {
			autokKepFeltoltes($_POST["kepModositAutoID"]);
		} 
		//Foglalás action gombok
		else if ($_POST["action"]=="allapotCsere")
		{
			if(isset($_POST["foglalasID"]) && is_numeric($_POST["foglalasID"]) &&
				isset($_POST["ujAllapot"]) && !empty($_POST["ujAllapot"]))
			{
				$royalRentDb->kapcsolatNyitasa();
				$royalRentDb->foglalasAllapotCsere($_POST["foglalasID"],$_POST["ujAllapot"]);
				$royalRentDb->kapcsolatBontasa();
			}
		}
		else if ($_POST["action"]=="allapotCsereFelhasznalo")
		{
			if(isset($_POST["foglalasID"]) && is_numeric($_POST["foglalasID"]) &&
				isset($_POST["ujAllapot"]) && !empty($_POST["ujAllapot"]) &&
				isset($_POST["fizetve"]) && is_numeric($_POST["fizetve"]))
			{
				$royalRentDb->kapcsolatNyitasa();
				$royalRentDb->foglalasAllapotCsereFelhasznalo($_POST["foglalasID"],$_POST["ujAllapot"],$_POST["fizetve"]);
				$royalRentDb->kapcsolatBontasa();
			}
		}
		else if ($_POST["action"]=="bizonylatFeltoltese")
        {
			if(bizonylatFeltoltes($_POST["bizonylatFeltoltID"])=="sikeres")
			{
				echo "<script>window.alert('Sikeres feltöltés!')</script>";
				$royalRentDb->kapcsolatNyitasa();
				$royalRentDb->foglalasAllapotCsereFelhasznalo($_POST["bizonylatFeltoltID"],"Bizonylat feltöltve",0);
				$royalRentDb->kapcsolatBontasa();
			}
			else
			{
				echo "<script>window.alert('Sikertelen feltöltés. Ellenőrizd a fájl formátumát!')</script>";
			}
		} 
    }
?>
<!DOCTYPE html>
<html lang="hu">
	<head>
		<title>Royal Rent - Profil</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Külső könyvtárak -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="./css/szinek.css">
        <link rel="stylesheet" href="./fontawesome/css/all.css"> 
		<script src="./bootstrap/js/jquery.js"></script>
		<script src="./bootstrap/js/popper.js"></script>
		<script src="./bootstrap/js/bootstrap.js"></script>
	</head>
	<body>
		<!-- Menü -->
		<?php include ("navbar.php"); ?>
		<!-- Nav tabok (csak admin és moderátor) -->
		<!-- Felhaszálóknál a saját foglalások jellenek csak meg -->
		<?php 
			if (($_SESSION["jogosultsag"]=="admin")||($_SESSION["jogosultsag"]=="moderátor")) 
			{
				// Nav tabs
				echo '<div class="container m-0 p-0 mt-4 mx-auto">';
					echo '<div class="row m-0 p-0">';
						echo '<div class="col-sm-12 m-0 p-2">';
							//Nav pills
							echo '<ul class="nav nav-pills nav-justified border" id="myTab">';
								echo '<li class="nav-item">';
									echo '<a class="nav-link active" data-toggle="tab" href="#felhasznalokTab"><i class="fas fa-user"></i></br>Felhasználók</a>';
								echo '</li>';

								echo '<li class="nav-item">';
									echo '<a class="nav-link" data-toggle="tab" href="#autokTab"><i class="fas fa-car"></i></br>Autók</a>';
								echo '</li>';

								echo '<li class="nav-item">';
									echo '<a class="nav-link" data-toggle="tab" href="#foglalasokTab"><i class="fas fa-file-signature"></i></br>Foglalások</a>';
								echo '</li>';

								echo '<li class="nav-item">';
									echo '<a class="nav-link" data-toggle="tab" href="#statisztikaTab"><i class="fas fa-chart-bar"></i></br>Statisztika</a>';
								echo '</li>';
								
							echo '</ul>';
						echo '</div>';
					echo '</div>';

					echo '<div class="row m-0 p-0">';
						echo '<div class="col-sm-12 m-0 p-0">';
							//Tab panes
							echo '<div class="tab-content">';
								//Felhasználók panel
								echo '<div id="felhasznalokTab" class="tab-pane active fade show">';
									?>
									<!-- Szűrők -->
									<div class="mx-auto p-2" id="szurokFelhasznalok">
										<form method="GET">
											<fieldset class="border m-0 p-2">
												<legend class="w-auto"><h6 class="">Szűrés</h6></legend>
												<div class="container m-0 p-0 mx-auto">
													<div class="row m-0 p-0">
														<div class="col-6 m-0 p-2"> 
															<span>Jogosultság:</span>
															<div class="form-group">
																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox1_1" name="admin" value="1">
																<label class="form-check-label" for="inlineCheckbox1_1">Admin</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox1_2" name="moderator" value="1">
																<label class="form-check-label" for="inlineCheckbox1_2">Moderátor</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox1_3" name="felhasználó" value="1">
																<label class="form-check-label" for="inlineCheckbox1_3">Felhasználó</label>
																</div>
															</div>
														</div>

														
														<div class="col-6 m-0 p-2" style="border:0px solid red"> 
															<span>Aktivitás:</span>
															<div class="form-group">
																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox1_4" name="aktivFelhasznalok" value="1">
																<label class="form-check-label" for="inlineCheckbox1_4">Aktív</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox1_5" name="kitiltottFelhasznalok" value="1">
																<label class="form-check-label" for="inlineCheckbox1_5">Kitiltott</label>
																</div>
															</div>
														</div>
													</div>

													<div class="row m-0 p-0">
														<div class="col-6 m-0 p-2" style="border:0px solid red"> 
															<span>Rendezés:</span>
															<div class="form-group">
																<select id="rendezesFelhasznalok" class="form-control" name="rendezesFelhasznalok">
																	<option value="legujabb">Legújabb elől</option>
																	<option value="legregebbi">Legrégebbi elől</option>
																	<option value="abc">ABC sorrendben</option>
																</select>
															</div>
														</div>

														<div class="col-6 m-0 p-2" style="border:0px solid red">
															<span>Keresés:</span>
															<div class="form-group">
																<input id="keresesFelhasznalok" class="form-control" type="text" placeholder="Keresés..." name="keresesFelhasznalok">
															</div>
														</div>
													</div>

													<div class="row m-0 p-0">
														<div class="col-12 m-0 p-2" style="border:0px solid red"> 
															<div class="form-group">
																<button type="submit" class="btn LilaGomb btn-block"><span class="fa fa-filter"></span>&nbsp&nbspSzűrés</button>
															</div>
														</div>
													</div>
												</div>
											</fieldset>
										</form>
									</div>
									<?php
									//regisztráció
									if ($_SESSION["jogosultsag"]=="admin")
									{
									echo'
									<div class="p-2">
										<div class="container m-0 p-0 mt-4 mx-auto">
											<div class="row m-0 p-0">
												<div class="col-12 m-0 p-0">
													<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#felhasznalokInsertForm" aria-expanded="false" aria-controls="collapseExample">
														<i class="fa fa-user-plus">&nbsp&nbsp</i>Új felhasználó felvétele
													</button>
												</div>
											</div>
										</div>';
										
										echo'
										<div class="container p-0 m-0 mx-auto">
											<form method="POST">
												<div class="collapse border m-0 p-0" id="felhasznalokInsertForm">
													<div class="row m-0 p-0">
														<div class="col-12 m-0 p-2">
															<h4 class="">Új felhasználó:</h4>
														</div>	
													</div>

													<div class="row m-0 p-0">
														<div class="col-6 col-lg-4 m-0 p-2">
															<div class="form-group row">
																<label class="col-3 col-form-label">Név:</label>

																<div class="col-9">
																	<input class="form-control" type="text" name="inputFelhasznaloNev">
																</div>
															</div>
														</div>

														<div class="col-6 col-lg-4 m-0 p-2">
															<div class="form-group row">
																<label class="col-3 col-form-label">Jelszó:</label>

																<div class="col-9">
																	<input class="form-control" type="password" name="inputJelszo">
																</div>
															</div>
														</div>

														<div class="col-12 col-lg-4 m-0 p-2">
															<div class="form-group row">
																<label class="col-3 col-form-label">Email:</label>

																<div class="col-9">
																	<input class="form-control" type="email" name="inputEmail">
																</div>
															</div>
														</div>
													</div>

													<div class="row m-0 p-0">
														<div class="col-6 col-lg-4 m-0 p-2">
															<div class="form-group row">
																<label class="col-3 col-form-label">Jog:</label>

																<div class="col-9">
																	<select class="form-control" name="inputJogosultsag">
																		<option>admin</option>
																		<option>moderátor</option>
																		<option selected>felhasználó</option>
																	</select>
																</div>
															</div>
														</div>

														<div class="col-6 col-lg-4 m-0 p-2">
															<div class="form-group row">
																<label class="col-5 col-form-label">Beléphet:</label>
																<div class="col-7">
																	<select class="form-control" name="inputLathatosag">
																			<option selected value="1">igen</option>
																			<option value="0">nem</option>
																	</select>
																</div>
															</div>
														</div>
													</div>

													<div class="row m-0 p-0">
														<div class="col-12 m-0 p-2">
															<input class="form-control" type="hidden" name="action" value="regisztracio">
															<button class="form-control btn-success" type="submit" name="submit_regisztracio"><i class="fa fa-user-plus">&nbsp&nbsp</i>Felvétel</button>
														</div>	
													</div>
												</div>
											</form>
										</div>
									</div>';
									}
									//listázás
									$royalRentDb->kapcsolatNyitasa();
									$royalRentDb->felhasznalokLista();
									$royalRentDb->kapcsolatBontasa();
								echo '</div>';

								//Autók panel
								echo '<div id="autokTab" class="tab-pane fade">';
									//regisztráció
									?>
									<!-- Szűrők -->
									<div class="mx-auto p-2" id="szurokAutok">
										<form method="GET">
											<fieldset class="border m-0 p-2">
												<legend class="w-auto"><h6 class="">Szűrés</h6></legend>
												<div class="container m-0 p-0 mx-auto">
													<div class="row m-0 p-0"> 
														<div class="col-6 m-0 p-2">
															<span>Kategória:</span>
															<div class="form-group">
																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox2_1" name="sport" value="1">
																<label class="form-check-label" for="inlineCheckbox2_1">Sport</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox2_2" name="luxus" value="1">
																<label class="form-check-label" for="inlineCheckbox2_2">Luxus</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox2_3" name="cabrio" value="1">
																<label class="form-check-label" for="inlineCheckbox2_3">Cabrio</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox2_4" name="suv" value="1">
																<label class="form-check-label" for="inlineCheckbox2_3">SUV</label>
																</div>
															</div>
														</div>

																
														<div class="col-6 m-0 p-2" style="border:0px solid red"> 
															<span>Láthatóság:</span>
															<div class="form-group">
																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox2_5" name="aktivAutok" value="1">
																<label class="form-check-label" for="inlineCheckbox2_4">Látható</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox2_6" name="kitiltottAutok" value="1">
																<label class="form-check-label" for="inlineCheckbox2_5">Rejtett</label>
																</div>
															</div>
														</div>
													</div>

													<div class="row m-0 p-0">
														<div class="col-6 m-0 p-0 p-2" style="border:0px solid red"> 
															<span>Rendezés:</span>
															<div class="form-group">
																<select id="rendezesAutok" class="form-control" name="rendezesAutok">
																	<option value="legujabb">Legújabb elől</option>
																	<option value="legregebbi">Legrégebbi elől</option>
																	<option value="leggyorsabb">Leggyorsabb elől</option>
																	<option value="legdragabb">Legdrágább elől</option>
																	<option value="abc">ABC sorrendben</option>
																</select>
															</div>
														</div>

														<div class="col-6 m-0 p-0 p-2" style="border:0px solid red">
															<span>Keresés:</span>
															<div class="form-group">
																<input id="keresesAutok" class="form-control" type="text" placeholder="Keresés..." name="keresesAutok">
															</div>
														</div>
													</div>

													<div class="row m-0 p-0">
														<div class="col-12 m-0 p-2" style="border:0px solid red"> 
															<div class="form-group">
																<button type="submit" class="btn LilaGomb btn-block"><span class="fa fa-filter"></span>&nbsp&nbspSzűrés</button>
															</div>
														</div>
													</div>
												</div>
											</fieldset>
										</form>
									</div>
									<?php
									if ($_SESSION["jogosultsag"]=="admin")
									{
										echo'
										<div class="p-2">
											<div class="container m-0 p-0 mt-4 mx-auto">
												<div class="row m-0 p-0">
													<div class="col-12 m-0 p-0">
														<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#autokInsertForm" aria-expanded="false" aria-controls="collapseExample">
															<i class="fa fa-user-plus">&nbsp&nbsp</i>Új autó felvétele
														</button>
													</div>
												</div>	
											</div>';

											echo'
											<div class="p-0 m-0">
												<form method="POST">
													<div class="container m-0 p-0 collapse border" id="autokInsertForm">
														<div class="row m-0 p-0">
															<div class="col-12 m-0 p-2">
																<h4 class="">Új autó:</h4>
															</div>	
														</div>

														<div class="row m-0 p-0">
															<div class="col-6 col-lg-4 m-0 p-2">
																<div class="form-group row">
																	<label class="col-4 col-form-label">Kategória:</label>
																	<div class="col-8">
																		<select class="form-control" name="inputKategoria">
																			<option selected>Sport</option>
																			<option>Luxus</option>
																			<option>Cabrio</option>
																			<option>SUV</option>
																		</select>
																	</div>
																</div>
															</div>

															<div class="col-6 col-lg-4 m-0 p-2">
																<div class="form-group row">
																	<label class="col-4 col-form-label">Márka:</label>
																	<div class="col-8">
																		<input class="form-control" type="text" name="inputMarka">
																	</div>
																</div>
															</div>

															<div class="col-12 col-lg-4 m-0 p-2">
																<div class="form-group row">
																	<label class="col-4 col-form-label">Típus:</label>
																	<div class="col-8">
																		<input class="form-control" type="text" name="inputTipus">
																	</div>
																</div>
															</div>
														</div>

														<div class="row m-0 p-0">
															<div class="col-6 col-lg-4 m-0 p-2">
																<div class="form-group row">
																	<label class="col-4 col-form-label">Motor:</label>
																	<div class="col-8">
																		<input class="form-control" type="text" name="inputMotor">
																	</div>
																</div>
															</div>

															<div class="col-6 col-lg-4 m-0 p-2">
																<div class="form-group row">
																	<label class="col-5 col-form-label">Teljesítmény:</label>
																	<div class="col-7">
																		<input class="form-control" type="number" name="inputTeljesitmeny" min=0>
																	</div>
																</div>
															</div>

															<div class="col-6 col-lg-4 m-0 p-2">
																<div class="form-group row">
																	<label class="col-4 col-form-label">Hajtás:</label>
																	<div class="col-8">
																		<input class="form-control" type="text" name="inputHajtas">
																	</div>
																</div>
															</div>
														</div>

														<div class="row m-0 p-0">
															<div class="col-6 col-lg-4 m-0 p-2">
																<div class="form-group row">
																	<label class="col-4 col-form-label">Váltó:</label>
																	<div class="col-8">
																		<input class="form-control" type="text" name="inputSebessegvalto">
																	</div>
																</div>
															</div>

															<div class="col-6 col-lg-4 m-0 p-2">
																<div class="form-group row">
																	<label class="col-4 col-form-label">Szín:</label>
																	<div class="col-8">
																		<input class="form-control" type="text" name="inputSzin">
																	</div>
																</div>
															</div>

															<div class="col-6 col-lg-4 m-0 p-2">
																<div class="form-group row">
																	<label class="col-4 col-form-label">Ajtók:</label>
																	<div class="col-8">
																		<input class="form-control" type="number" name="inputAjtok" min=0>
																	</div>
																</div>
															</div>
														</div>

														<div class="row m-0 p-0">
															<div class="col-6 col-lg-4 m-0 p-2">
																	<div class="form-group row">
																	<label class="col-4 col-form-label">Férőhely:</label>
																	<div class="col-8">
																		<input class="form-control" type="number" name="inputFerohely" min=0>
																	</div>
																</div>
															</div>

															<div class="col-6 col-lg-4 m-0 p-2">
																	<div class="form-group row">
																	<label class="col-4 col-form-label">Ár:</label>
																	<div class="col-8">
																		<input class="form-control" type="number" name="inputAr" min=0>
																	</div>
																</div>
															</div>

															<div class="col-6 col-lg-4 m-0 p-2">
																<div class="form-group row">
																	<label class="col-4 col-form-label">Látható?</label>
																	<div class="col-8">
																		<select class="form-control" name="inputAktiv">
																			<option selected value="1">igen</option>
																			<option value="0">nem</option>
																		</select>
																	</div>
																</div>	
															</div>
														</div>

														<div class="row m-0 p-0">
															<div class="col-12 m-0 p-2">
																<input class="form-control" type="hidden" name="action" value="autoFelvetel">
																<button class="form-control mt-3 mb-3 btn-success" type="submit" name="submit_autoFelvetel"><i class="fa fa-user-plus">&nbsp&nbsp</i>Felvétel</button>
															</div>	
														</div>
													</div>
												</form>
											</div>
										</div>';
									}
									//listázás
									$royalRentDb->kapcsolatNyitasa();
									$royalRentDb->autokLista();
									$royalRentDb->kapcsolatBontasa();
								echo '</div>';
								
								//Foglalasok panel
								echo '<div id="foglalasokTab" class="tab-pane fade">';
								?>
									<!-- Szűrők -->
									<div class="mx-auto p-2" id="szurok">
										<form method="GET">
											<fieldset class="border m-0 p-2">
												<legend class="w-auto"><h6 class="">Szűrés</h6></legend>
												<div class="container m-0 p-0 mx-auto">
													<div class="row m-0 p-0">
														<div class="col-12 m-0 p-2"> 
															<span>Állapot:</span>
															<div class="form-group">
																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="fuggoben" value="1">
																<label class="form-check-label" for="inlineCheckbox1">Függőben</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="bizonylatFeltoltve" value="1">
																<label class="form-check-label" for="inlineCheckbox2">Bizonylat feltöltve</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="fizetve" value="1">
																<label class="form-check-label" for="inlineCheckbox3">Fizetve</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox4" name="visszautalasraVar" value="1">
																<label class="form-check-label" for="inlineCheckbox4">Visszautalásra vár</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox5" name="visszautalva" value="1">
																<label class="form-check-label" for="inlineCheckbox5">Visszautalva</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox6" name="ervenytelen" value="1">
																<label class="form-check-label" for="inlineCheckbox6">Érvénytelen</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox7" name="autoElvive" value="1">
																<label class="form-check-label" for="inlineCheckbox7">Autó elvíve</label>
																</div>

																<div class="form-check form-check-inline">
																<input class="form-check-input" type="checkbox" id="inlineCheckbox8" name="autoVisszahozva" value="1">
																<label class="form-check-label" for="inlineCheckbox8">Autó visszahozva</label>
																</div>
															</div>
														</div>
													</div>

													<div class="row m-0 p-0">
														<div class="col-6 m-0 p-0 p-2" style="border:0px solid red"> 
															<span>Rendezés:</span>
															<div class="form-group">
																<select id="rendezes" class="form-control" name="rendezes">
																	<option value="legujabb">Legújabb rendelés elől</option>
																	<option value="legregebbi">Legrégebbi rendelés elől</option>
																	<option value="legdragabb">Ár szerint csökkenően</option>
																	<option value="legolcsobb">Ár szerint növekvően</option>
																</select>
															</div>
														</div>

														<div class="col-6 m-0 p-0 p-2" style="border:0px solid red">
															<span>Keresés:</span>
															<div class="form-group">
																<input id="kereses" class="form-control" type="text" placeholder="Keresés..." name="kereses">
															</div>
														</div>
													</div>

													<div class="row m-0 p-0">
														<div class="col-12 m-0 p-2" style="border:0px solid red"> 
															<div class="form-group">
																<button type="submit" class="btn LilaGomb btn-block"><span class="fa fa-filter"></span>&nbsp&nbspSzűrés</button>
															</div>
														</div>
													</div>
												</div>
											</fieldset>
										</form>
									</div>
								<?php
									$royalRentDb->kapcsolatNyitasa();
									$royalRentDb->foglalasLista();
									$royalRentDb->kapcsolatBontasa();
								echo '</div>';

								//Statisztika panel
								echo '<div id="statisztikaTab" class=" tab-pane fade">';
								echo '<div class="mx-auto p-2">';
									echo'<div class="container p-0 m-0 mx-auto">
										<fieldset class="m-0 p-2 border">
											<legend class="w-auto"><h4>Statisztika</h4></legend>
											<div class="row m-0 p-0">
												<div class="col-12 m-0 p-2">
												</div>
											</div>';
											echo'
											<div class="row m-0 p-0">
												<div class="col-12 col-md-6 col-lg-4 m-0 p-2">
													<table class="table table-hover table-sm border">
														<h4>Felhasználók:</h4>
														<tbody>';
															$royalRentDb->kapcsolatNyitasa();
															$royalRentDb->felhasznalokStatisztika();
															$royalRentDb->kapcsolatBontasa();
														echo'</tbody>
													</table>
												</div>';

												echo'<div class="col-12 col-md-6 col-lg-4 m-0 p-2">	
													<table class="table table-hover table-sm border">
														<h4>Autók:</h4>
														<tbody>';
															$royalRentDb->kapcsolatNyitasa();
															$royalRentDb->autokStatisztika();
															$royalRentDb->kapcsolatBontasa();
														echo'</tbody>
													</table>
												</div>

												<div class="col-12 col-md-6 col-lg-4 m-0 p-2">
													<table class="table table-hover table-sm border">
														<h4>Foglalások:</h4>
														<tbody>';
															$royalRentDb->kapcsolatNyitasa();
															$royalRentDb->foglalasStatisztika();
															$royalRentDb->kapcsolatBontasa();
														echo'</tbody>
													</table>
												</div>
										</fieldset>
									</div>
								</div>
								</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
			else if ($_SESSION["jogosultsag"]=="felhasználó")
			{
				?>
				<div class="container m-0 p-0 mt-4 mx-auto">
					<div class="row m-0 p-0">
						<div class="col-12 m-0 p-2">
							<div class="alert alert-primary m-0 p-4" role="alert">
								<span>A foglalás érvényesítéséhez utalja el a megfelelő összeget számlánkra és töltse fel az utalás bizonylatát!</span>
								<a href="segitseg.php#berles_menete_utalas">Részletek</a>
							</div>
						</div>
					</div>
				</div>
				<?php
				$royalRentDb->kapcsolatNyitasa();
				$royalRentDb->foglalasListazasFelhasznaloknak($_SESSION["belepett_id"]);
				$royalRentDb->kapcsolatBontasa();
			}
		?>
		<!-- Footer -->
		<?php include ("footer.php"); ?>
	</body>
	<script type="text/javascript">
		//
		//ez azt csinálja, hogy submitolás után is arra az oldalra tesz vissza ahol voltam a nav-tab elemen belül
		$(document).ready(function()
		{
			$('a[data-toggle="tab"]').on('show.bs.tab', function(e) 
			{
				localStorage.setItem('activeTab', $(e.target).attr('href'));
			});
			var activeTab = localStorage.getItem('activeTab');
			if(activeTab){
				$('#myTab a[href="' + activeTab + '"]').tab('show');
			}
		});
		//beirja a kiválasztott fájl nevét a képek inputokhoz.
		$(".custom-file-input").on("change", function() 
		{
			var fileName = $(this).val().split("\\").pop();
			fileName = fileName.substring(0,25);
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
		//törlés megerosités
		function Megerosites()
		{
			return confirm("Biztosan törölni szeretnéd?");
		}
	</script>
</html>