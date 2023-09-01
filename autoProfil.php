<?php 
	session_start(); 
	if (!isset($_SESSION["jogosultsag"])) 
	{
		$_SESSION["jogosultsag"]="vendeg";
		$_SESSION["belepett_id"]="";
		$_SESSION["belepett_felhasznalonev"]="";
	}
	$_SESSION["oldal"]="autoProfil";
?>
<!--Ez ellenőrzi hogy a GET-ben lévő id érvényes-e. Azaz nincs-e hibás adat benne pld: szöveg, nem pozitív szám, nem létező ID vagy tiltott autó-->
<?php
	//forditva jobban nézne ki de mostmár igy marad
	if (isset($_GET["id"])&&is_numeric($_GET["id"])&&($_GET["id"]>=1)&&LetezikEzAzID($_GET["id"])) 
	{
		//ebben az esetben értelmes adat van a GET-ben. olyan ID ami létezik az autok adatbázisban
		//úgyhogy csak simán továbbmegy a kód
	} 
	else
	{
		//ha nem létezik akkor ne is töltsük tovább az oldalt hanem átirányítjuk máshova
		echo "<script>window.location.replace('index.php')</script>";
	}
	function LetezikEzAzId($id_input)
	{
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
			WHERE `id` = ".$id_input." AND `aktiv` LIKE 1
			";
		}
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
?>
<!DOCTYPE html>
<html lang="hu">
	<head>
		<title>Royal Rent - Autó profil</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Külső könyvtárak -->
		<link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="./css/szinek.css">
        <link rel="stylesheet" href="./fontawesome/css/all.css"> 
        <link rel="stylesheet" href="./datepicker/css/jquery-ui.css">
		<script src="./bootstrap/js/jquery.js"></script>
		<script src="./bootstrap/js/popper.js"></script>
		<script src="./bootstrap/js/bootstrap.js"></script>
		<script src="./datepicker/js/jquery-ui.js"></script>
	</head>
	<!-- Action listener a foglalás gombra -->
	<?php
		if (isset($_POST["action"])) 
		{
			if ($_POST["action"]=="foglalas")
			{
				if(isset($_SESSION["belepett_id"]) && is_numeric($_SESSION["belepett_id"]))
				{
					if(isset($_POST["from"]) && isset($_POST["to"]) && !empty($_POST["from"]) && !empty($_POST["to"]))
					{
						include ("adatbazisKapcsolodas.php");
						$conn = new mysqli($servername, $username, $password, $dbname);
						if ($conn->connect_error) 
						{
							die("Connection failed: " . $conn->connect_error);
						}
						$sql = "SELECT * FROM `foglalasok` 
						        WHERE `auto_id` = ".$_GET["id"]."
                                and
                                (
                                    ('".$_POST["from"]."' <= `utolsonap` AND '".$_POST["to"]."' >= `elsonap`)
                                )
                                AND allapot not like 'Visszautalásra vár' and allapot not like 'Visszautalva' and allapot not like 'Érvénytelen'
                                ";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) 
						{
							echo "<script>
							$(document).ready(function(){
								var hiba = 'Ez az időtartam sajnos foglalt. Lehettséges, hogy valaki épp lefoglalta. Kérlek ellenőrizd a naptárban!'
								$('#foglalas_info').text(hiba);
								$('#foglalas_info').removeAttr('hidden');
								$('#foglalas_info_div').removeAttr('hidden');
							});
							</script>";
							$conn->close();
						}
						else 
						{
							$datetime = new DateTime();
							$datetime->setTimezone(new DateTimeZone('Europe/Budapest'));
							$sql = "INSERT INTO `foglalasok` 
                                    (`id`, `felhasznalo_id`, `auto_id`, `elsonap`, `utolsonap`, `allapot`, `ar` ,`fizetve`, `idopont`) 
                                    VALUES 
                                    (NULL, ".$_SESSION["belepett_id"].", 
                                            ".$_GET["id"].", 
                                            '".$_POST["from"]."', 
                                            '".$_POST["to"]."', 
                                            'Függőben', 
                                            ".$_POST["formAr"].",
                                            0,
                                            '".$datetime->format('Y\-m\-d\ H:i:s')."');";
							if ($conn->query($sql) === TRUE) 
							{
								echo "<script>
								$(document).ready(function(){
									var hiba = 'A foglalást sikeresen rögzítettük! A foglalás és az utalás részleteit megtekintheti a profil oldalon. A profil oldal eléréséhez kattintson a felhasználónevére a menüben! További segítséget a Segítség menüpont alatt talál.'
									$('#foglalas_info').text(hiba);
									$('#foglalas_info').toggleClass('alert-danger');
									$('#foglalas_info').toggleClass('alert-success');
									$('#foglalas_info').removeAttr('hidden');
									$('#foglalas_info_div').removeAttr('hidden');
								});
								</script>";
							} 
							else 
							{
								echo "<script>
								$(document).ready(function(){
									var hiba = 'Hiba történt foglalás rögzítésekor!'
									$('#foglalas_info').text(hiba);
									$('#foglalas_info').removeAttr('hidden');
									$('#foglalas_info_div').removeAttr('hidden');
								});
								</script>";
							}
							$conn->close();
						}
					}
					else
					{
						echo "<script>
						$(document).ready(function(){
							var hiba = 'A dátumokat kötelező megadni! (Mindkét időpontot)'
							$('#foglalas_info').text(hiba);
							$('#foglalas_info').removeAttr('hidden');
							$('#foglalas_info_div').removeAttr('hidden');
						});
						</script>";
					}
				}
				else
				{
					echo "<script>
					$(document).ready(function(){
						var hiba = 'A foglaláshoz jelentkezzen be!'
						$('#foglalas_info').text(hiba);
						$('#foglalas_info').removeAttr('hidden');
						$('#foglalas_info_div').removeAttr('hidden');
					});
					</script>";
				}
			} 
		}
	?>
	<body>
		<!-- Menü -->
		<?php include ("navbar.php"); ?>
		<!-- Foglalást visszajelző üzenet -->
		<div class="container m-0 p-0 mt-4 mx-auto">
			<div class="row m-0 p-0" hidden id="foglalas_info_div">
				<div class="col-12 m-0 p-2">
					<div id="foglalas_info" class="alert alert-danger m-0 p-4" hidden role="alert">
					</div>
				</div>
			</div>
		</div>
		<!-- Képek + műszadki adatok -->
		<div class="container m-0 p-0 mt-4 mx-auto">
			<div class="row m-0 p-0">
				<div class="col-12 col-lg-6 m-0 p-2 text-center">
					<?php 
						echo "<img src='./kepek/autok/".$_GET["id"]."/thumbnail/thumbnail.png' class='img img-fluid w-100 border' alt='Nincs kép' data-toggle='modal' data-target='#autoKepekModal'>";
						echo '<button type="button" class="btn LilaGomb btn-block mt-2 mb-2" data-toggle="modal" data-target="#autoKepekModal"><i class="fas fa-image">&nbsp&nbsp</i>További képek</button>';
					?>
				</div>
				<div class="col-12 col-lg-6 m-0 p-2">
					<table class="table table-hover table-sm border">
						<tbody>
							<tr>
								<td class="font-weight-bold">Kategória:</td>
								<td id="adatok_kategoria"></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Márka:</td>
								<td id="adatok_marka"></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Típusnév:</td>
								<td id="adatok_tipusnev"></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Motor:</td>
								<td id="adatok_motor"></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Hajtás:</td>
								<td id="adatok_hajtas"></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Sebességváltó:</td>
								<td id="adatok_sebessegvalto"></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Szín:</td>
								<td id="adatok_szin"></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Ajtók száma:</td>
								<td id="adatok_ajtokszama"></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Szállítható személyek:</td>
								<td id="adatok_szallithatoszemelyek"></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Ár:</td>
								<td id="adatok_ar"></td>
							</tr>
						</tbody>
				    </table>
				</div>
			</div>
		</div>
		<!-- Előugró képnézegető -->
		<div class="modal fade" id="autoKepekModal" tabindex="-1" role="dialog" aria-labelledby="autoKepekModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
				<div class="modal-content" >
					<button type="button" class="close text-right pr-1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="modal-body">
                        <div class="container m-0 p-0">
                            <div class="row m-0 p-0">
                                <div class="col-sm-12 m-0 p-0">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                        </ol>
                                        <div class="carousel-inner">
                                            <?php 
                                                $dirname = "./kepek/autok/".$_GET["id"]."/";
                                                $images = glob($dirname."*.*");
                                                $i=1;
                                                foreach($images as $image) 
                                                {
                                                    if ($i==1) 
                                                    {
                                                        echo '<div class="carousel-item text-center active">';
                                                        $i++;
                                                    }
                                                    else
                                                    {
                                                        echo '<div class="carousel-item text-center">';
                                                    }
                                                    echo '<img src="'.$image.'" class="img img-fluid" alt="..." style="height: 75vh;object-fit: scale-down">';
                                                    echo '</div>';
                                                }
                                            ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <h3><i class="fa fa-angle-left bg-dark rounded p-3" aria-hidden="true"></i></h3>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <h3><i class="fa fa-angle-right bg-dark rounded p-3" aria-hidden="true"></i></h3>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<!-- Bérlés naptár + dátum választó -->
		<div class="container m-0 p-0 mt-4 mx-auto">
			<div class="row m-0 p-0">
				<!-- Bérlés naptár -->
				<div class="col-lg-7 m-0 p-2">
					<fieldset class="border m-0 p-2">
						<legend class="w-auto">
							<h4 class="">Foglalás naptár</h4>
						</legend>								
                        <div class="container m-0 p-0">
                            <div id="honap_nap">
                                <div class="row m-0 p-0">
                                    <div class="col-6 m-0 p-0 mx-auto mb-2 pr-1">
                                        <form>
                                            Év:
                                            <select id="ev" class="form-control">
                                                <?php
                                                    echo "<option>".(Date("Y"))."</option>";
                                                    echo "<option>".(Date("Y")+1)."</option>";
                                                    echo "<option>".(Date("Y")+2)."</option>";
                                                ?>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="col-6 m-0 p-0 mx-auto mb-2 pl-1">
                                        <form>
                                            Hónap:
                                            <select id="honap" class="form-control">
                                                <?php 
                                                    echo (Date("M"))=="Jan"?'<option value="1" selected>Január</option>':'<option value="1">Január</option>';
                                                    echo (Date("M"))=="Feb"?'<option value="2" selected>Február</option>':'<option value="2">Február</option>';
                                                    echo (Date("M"))=="Mar"?'<option value="3" selected>Március</option>':'<option value="3">Március</option>';
                                                    echo (Date("M"))=="Apr"?'<option value="4" selected>Április</option>':'<option value="4">Április</option>';
                                                    echo (Date("M"))=="May"?'<option value="5" selected>Május</option>':'<option value="5">Május</option>';
                                                    echo (Date("M"))=="Jun"?'<option value="6" selected>Június</option>':'<option value="6">Június</option>';
                                                    echo (Date("M"))=="Jul"?'<option value="7" selected>Július</option>':'<option value="7">Július</option>';
                                                    echo (Date("M"))=="Aug"?'<option value="8" selected>Augusztus</option>':'<option value="8">Augusztus</option>';
                                                    echo (Date("M"))=="Sep"?'<option value="9" selected>Szeptember</option>':'<option value="9">Szeptember</option>';
                                                    echo (Date("M"))=="Oct"?'<option value="10" selected>Október</option>':'<option value="10">Október</option>';
                                                    echo (Date("M"))=="Nov"?'<option value="11" selected>November</option>':'<option value="11">November</option>';
                                                    echo (Date("M"))=="Dec"?'<option value="12" selected>December</option>':'<option value="12">December</option>';
                                                ?>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>H</th>
                                    <th>K</th>
                                    <th>Sz</th>
                                    <th>Cs</th>
                                    <th>P</th>
                                    <th class="text-danger">Sz</th>
                                    <th class="text-danger">V</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="nap1">1</td>
                                    <td id="nap2">2</td>
                                    <td id="nap3">3</td>
                                    <td id="nap4">4</td>
                                    <td id="nap5">5</td>
                                    <td id="nap6">6</td>
                                    <td id="nap7">7</td>
                                </tr>
                                <tr>
                                    <td id="nap8">8</td>
                                    <td id="nap9">9</td>
                                    <td id="nap10">10</td>
                                    <td id="nap11">11</td>
                                    <td id="nap12">12</td>
                                    <td id="nap13">13</td>
                                    <td id="nap14">14</td>
                                </tr>
                                <tr>
                                    <td id="nap15">15</td>
                                    <td id="nap16">16</td>
                                    <td id="nap17">17</td>
                                    <td id="nap18">18</td>
                                    <td id="nap19">19</td>
                                    <td id="nap20">20</td>
                                    <td id="nap21">21</td>
                                </tr>
                                <tr>
                                    <td id="nap22">22</td>
                                    <td id="nap23">23</td>
                                    <td id="nap24">24</td>
                                    <td id="nap25">25</td>
                                    <td id="nap26">26</td>
                                    <td id="nap27">27</td>
                                    <td id="nap28">28</td>
                                </tr>
                                <tr>
                                    <td id="nap29">29</td>
                                    <td id="nap30">30</td>
                                    <td id="nap31">31</td>
                                    <td id="nap32">32</td>
                                    <td id="nap33">33</td>
                                    <td id="nap34">34</td>
                                    <td id="nap35">35</td>
                                </tr>
                                <tr>
                                    <td id="nap36">36</td>
                                    <td id="nap37">37</td>
                                    <td id="nap38">38</td>
                                    <td id="nap39">39</td>
                                    <td id="nap40">40</td>
                                    <td id="nap41">41</td>
                                    <td id="nap42">42</td>
                                </tr>
                            </tbody>
                        </table>
						<div class="alert alert-primary" role="alert">
							<span class="font-weight-bold">Jelmagyarázat:</span></br>
							Fehér négyzet: szabad időpont<br>
							<span class="text-danger font-weight-bold">Piros</span> négyzet: <span class="text-danger font-weight-bold">foglalt</span> időpont
						</div>
					</fieldset>
				</div>
				<!-- Foglalás panel -->
				<div class="col-lg-5 m-0 p-2">
					<fieldset class="border border m-0 p-2">
						<legend class="w-auto m-0 p-0">
							<h4>Bérlési idő (max 2 hónap)</h4>
						</legend>
						<form method="POST">
							<div class="form-group idotartam">
								<label for="from">Első nap:</label>
								<input class="form-control" type="text" id="from" name="from" readonly placeholder="Időpont választása...">
							</div>
							<div class="form-group idotartam">
								<label for="from">Utolsó nap:</label>
								<input class="form-control" type="text" id="to" name="to" readonly placeholder="Időpont választása...">
							</div>
							<div class="form-group">
								<button class="btn btn-dark btn-block" type="button" id="alaphelyzet" value="Dátumok törlése">
									<i class='fas fa-trash-alt'>&nbsp&nbsp</i>Dátumok törlése
								</button>
							</div>	
							<div class="alert alert-success" role="alert">
								<span id="ar">Ár: A kiszámításhoz válasszon ki 2 dátumot!</span>
							</div>
							<?php
								if ($_SESSION["jogosultsag"]=="vendeg")
								{
									echo'
                                        <div class="form-group">
                                            <div class="alert alert-primary" role="alert">
                                                A foglaláshoz <a href="bejelentkezes.php">bejelentkezés</a> szükséges!
                                            </div>
                                        </div>
									';
								}
								else
								{
									echo'
										<div class="alert alert-primary" role="alert">
											A foglalás gomb lenyomásával elfogadja az <span class="font-weight-bold"><a href="segitseg.php#jogi_informaciok">általános szerződési feltételeinket</a></span>!
										</div>
										<div class="form-group">
											<button class="btn LilaGomb btn-block btn-lg" type="submit" value="Foglalás">
												<i class="fas fa-file-signature">&nbsp&nbsp</i>Foglalás
											</button>
										</div>
										<input id="formAr" type="hidden" name="formAr">
										<input type="hidden" name="action" value="foglalas">
									';
								}
							?>
						</form>
					</fieldset>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<?php include ("footer.php"); ?>
	</body>
</html>

<script type="text/javascript">
	//segédfüggvény amivel GET változókat lehet kiolvasni
	$.urlParam = function(name)
	{
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
		return results[1] || 0;
	}
	//ha volt a GET-be szűrő akkor azt elküldjük a fetch.php-nak
	let searchParams = new URLSearchParams(window.location.search);
	let valid = false;
	var autoID;
	if (searchParams.has("id"))
	{
		autoID = $.urlParam("id");
		valid=true;
	}
	if (valid)
	{
		//kiszedjük a megfelelő autó adatait
		$(document).ready(function()
        {
			$.post("query_autok_autoid.php",
			{
				id:JSON.stringify(autoID)
			},
			function(data){
				adatok = JSON.parse(data);
				//betöltjük a megfelelő helyre az adatokat
				$("#adatok_kategoria").text(adatok[0].kategoria);
				$("#adatok_marka").text(adatok[0].marka);
				$("#adatok_tipusnev").text(adatok[0].tipus);
				$("#adatok_motor").text(adatok[0].motortipus+" ("+adatok[0].teljesitmeny+" LE)");
				$("#adatok_hajtas").text(adatok[0].hajtas);
				$("#adatok_sebessegvalto").text(adatok[0].sebessegvalto);
				$("#adatok_szin").text(adatok[0].szin);
				$("#adatok_ajtokszama").text(adatok[0].ajtokszama);
				$("#adatok_szallithatoszemelyek").text(adatok[0].ferohely+" fő");
				$("#adatok_ar").text(szamFormazo(adatok[0].ar)+" Ft / nap");
				$(".autonev_cime").text(adatok[0].marka+" "+adatok[0].tipus);
			});
		});
		//kiszedjük a megfelelő autó foglalásait, de csak a mai dátum utánit mert csak annak van értelme.
		$(document).ready(function()
        {
			$.post("query_foglalasok_autoid.php",
			{
				id:JSON.stringify(autoID)
			},
			function(data)
            {
				a = JSON.parse(data);
				//console.log(a);
				$("#honap_nap").trigger("change");
			});
		});
		//itt szinezzük be a naptárat
		$(document).ready(function()
        {
			$("#honap_nap").change(function()
            {
				//először mindenhol eltávolitani ahol szines
				for (var i = 1; i <= 42; i++) 
				{
					document.getElementById("nap"+i).classList.remove('bg-danger');
				}
				//és a napokat is törölni kell, majd az új offsettel kiosztani
				for (var i = 1; i <= 42; i++) 
				{
					//document.getElementById("nap"+i).text('');
					var seged = "#nap"+i
					$(seged).text("-");
				}
				//év?
				var ev = document.getElementById("ev");
				ev = ev.value;
				//hónap?
				var honap = document.getElementById("honap");
				honap = honap.value;
				//ez azért kell hogy megtudjam hogy mennyivel kell eltolni az egész naptárat, azaz elseje milyyen napra esik? hétfő,kedd,szerda stb...
				var seged = new Date(ev+"-"+honap+"-01");
				var offset = seged.getDay();
				//ami a seged.getDay()-be van. az az a szám ami hét napjával kezdődik a hónap. ha 1 akkor hétfő, ha 7 akkor vasárnap.
				//feltölti a napok számaival
				for (var i = 1; i <= 42; i++) 
				{
					if(i<=new Date(ev, honap, 0).getDate())
					{
						var seged = "#nap"+(offset+i-1);
						$(seged).text(i);
					}
				}
				//bejárjuk a tömböt és minden rekord ahol az év és hónap egyezik ott a napot szinezzük
				//ha foglalt akkor piros
				for (var i = 0; i < a.length; i++) 
				{
					var kezdonap = new Date(a[i].elsonap);
					var vegnap = new Date(a[i].utolsonap);
					var seged = new Date(a[i].elsonap);
					while(seged<=vegnap)
					{
						if (parseInt(seged.getFullYear())==ev && parseInt((seged.getMonth()+1))==honap) 
						{
							var seged2 = seged.getDate()+offset-1;
							document.getElementById("nap"+seged2).classList.add('bg-danger');
						}
						seged.setDate(seged.getDate()+1);
					}
				}
			});
		});
	}
	//ár kiszámoló függvény View-ba
	$(document).ready(function()
    {
		$(".idotartam").change(function()
		{
			var seged = new Date($("#from").val());
			var seged2 = new Date($("#to").val());
			if(isNaN(seged) || isNaN(seged2))
			{
				$("#ar").text("Ár: A kiszámításhoz válasszon ki 2 dátumot!");
			}
			else
			{
				var diff = dateDiffInDays(seged,seged2); 
				diff+=1;
				var osszeg=diff*adatok[0].ar;
				$("#ar").text("Ár: "+szamFormazo(osszeg)+" Ft ("+diff+" nap)");
				$("#formAr").val(osszeg);
			}
		});
	});
	//szám formázó segédfüggvény
	function szamFormazo(x) 
	{
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}
	//dátumok közötti napok száma, segédfüggvény
	const _MS_PER_DAY = 1000 * 60 * 60 * 24;
	//a and b are javascript Date objects
	function dateDiffInDays(a, b) 
	{
		const utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
		const utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());
		return Math.floor((utc2 - utc1) / _MS_PER_DAY);
	}
	//Ezek mind a datepicker függvényei:
	//
	//Ez a datepickereket kezeli
 	$(function() 
    {
	    var dateFormat = 'yy-mm-dd',
	    from = $( "#from" )
        .datepicker(
        {
            //defaultDate: "+1w",
            changeYear: true,
            changeMonth: true,
            numberOfMonths: 1,
            minDate: +1,
            showButtonPanel: true,
            yearRange: "0:+2"
        })
        .on( "change", function() 
        {
            //ha beállítasz egy FROM időpontot
            //
            //akkor a TO minimum értéke a FROM értéke lesz. (hogy az utolsó nap ne eshessen az első nap elé)
            to.datepicker( "option", "minDate", getDate( this ) );
            //akkor a TO maximum értéke a FROM+30nap lesz. (mert 30 nap a maximális bérlési idő, ne lehessen 2090-ig kibérelni egy kocsit)
            to.datepicker( "option", "maxDate", getDate2( this ) );
        }),
        to = $( "#to" ).datepicker(
        {
            //defaultDate: "+1w",
            changeYear: true,
            changeMonth: true,
            numberOfMonths: 1,
            minDate: +1,
            showButtonPanel: true,
            yearRange: "0:+2"
        })
        .on( "change", function() 
        {
            //ha TO időpontot adsz meg
            //
            //akkor a FROM maximum értéke a TO lesz. (hogy az első nap ne eshessen az utolsó nap utánra)
            from.datepicker( "option", "maxDate", getDate( this ) );
            //akkor a FROM minimum értéke a TO-30 nap lesz, vagy a holnapi nap (hogy a kezdeti idő 30 nappal korábban legyen, vagy ha az a holnapi nap előttre esik akkor a kezdeti idő az a holnap)
            from.datepicker( "option", "minDate", getDate3( this ) );
        });
        function getDate( element ) 
        {
            var date;
            try 
            {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } 
            catch( error ) 
            {
                date = null;
            }
            return date;
        }
        function getDate2( element ) 
        {
            var date;
            try 
            {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } 
            catch( error ) 
            {
                date = null;
            }
            date.setDate(date.getDate()+60);
            return date;
        }
        function getDate3( element ) 
        {
            var date;
            try 
            {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } 
            catch( error ) 
            {
                date = null;
            }
            var today = new Date();
            today.setDate(today.getDate()+1);
            date.setDate(date.getDate()-60);
            if (today>date) 
            {
                date=today;
            }
            return date;
        }
  	});
	//Magyarra fordítja a datepickert
  	jQuery(function($)
    {
        $.datepicker.regional['hu'] = 
        {
            closeText: 'Bezárás',
            prevText: '&laquo;&nbsp;vissza',
            nextText: 'előre&nbsp;&raquo;',
            currentText: 'ma',
            monthNames: ['Január', 'Február', 'Március', 'Április', 'Május', 'Június',
            'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'],
            monthNamesShort: ['Jan', 'Feb', 'Már', 'Ápr', 'Máj', 'Jún',
            'Júl', 'Aug', 'Szep', 'Okt', 'Nov', 'Dec'],
            dayNames: ['Vasárnap', 'Hétfö', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat'],
            dayNamesShort: ['Vas', 'Hét', 'Ked', 'Sze', 'Csü', 'Pén', 'Szo'],
            dayNamesMin: ['V', 'H', 'K', 'Sz', 'Cs', 'P', 'Sz'],
            weekHeader: 'Hé',
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: true,
            yearSuffix: ''};
        $.datepicker.setDefaults($.datepicker.regional['hu']);
    });
	//Datepicker dátumokat alaphelyzetbe állítja
 	$(function()
    {
	  	$("#alaphelyzet").click(function()
        {
	  		$("#from").val("");
	  		$("#to").val("");
	  		$("#from").datepicker("option","minDate",+1);
	  		$("#from").datepicker("option","maxDate",null);
	  		$("#to").datepicker("option","minDate",+1);
	  		$("#to").datepicker("option","maxDate",null);
			$("#ar").text("Ár: A kiszámításhoz válasszon ki 2 dátumot!");
	  		//magától nem akarja meghívni ezt amikor nullázom az értékeket úgyhogy manuálisan kell.
	  		$('#szurok').trigger('change');
	  	});
  	});
</script>