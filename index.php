<?php 
	session_start(); 
	if (!isset($_SESSION["jogosultsag"])) 
	{
		$_SESSION["jogosultsag"]="vendeg";
		$_SESSION["belepett_id"]="";
		$_SESSION["belepett_felhasznalonev"]="";
	}
	$_SESSION["oldal"]="index";
?>
<!DOCTYPE html>
<html lang="hu">
	<head>
		<title>Royal Rent</title>
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
		<!-- Lapozható blokkok 1 -->
		<div class="container m-0 p-0 mt-4 mx-auto ">
			<div class="row m-0 p-0">
				<div class="col-sm-12 m-0 p-2">
					<div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators1" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators1" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators1" data-slide-to="2"></li>
                        </ol>
					    <div class="carousel-inner">
						    <div class="carousel-item active">
                                <picture>
                                    <source class="d-block w-100" srcset="./kepek/index/carousel1_1.png" media="(min-width: 992px)" alt="First slide"/>
                                    <img class="d-block w-100" src="./kepek/index/carousel1_1_small.png" alt="First slide"/>
                                </picture>
							    <div class="carousel-caption">
                                    <div class="d-lg-none">
                                        <h5 class="shadow p-2" style="background: rgba(0,0,0,50%);color:#ffffff">Minőségi luxusautók</h5>
                                        <a class="btn LilaGomb" href="autoink.php"><i class='fas fa-car'>&nbsp&nbsp</i>Modellek</a>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <h3 class="shadow p-2" style="background: rgba(0,0,0,50%);color:#ffffff">Minőségi luxusautók</h3>
                                        <a class="btn LilaGomb" href="autoink.php"><i class='fas fa-car'>&nbsp&nbsp</i>Modellek</a>
                                    </div>
							    </div>
						    </div>
                            <div class="carousel-item">
                                <picture>
                                    <source class="d-block w-100" srcset="./kepek/index/carousel1_2.png" media="(min-width: 992px)" alt="First slide"/>
                                    <img class="d-block w-100" src="./kepek/index/carousel1_2_small.png" alt="Second slide"/>
                                </picture>
                                <div class="carousel-caption">
                                    <div class="d-lg-none">
                                        <h5 class="shadow p-2" style="background: rgba(0,0,0,50%);color:#ffffff">Egyszerű és gyors foglalás</h5>
                                        <a class="btn LilaGomb" href="segitseg.php"><i class='fas fa-info'>&nbsp&nbsp</i>Részletek</a>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <h3 class="shadow p-2" style="background: rgba(0,0,0,50%);color:#ffffff">Egyszerű és gyors foglalás</h3>
                                        <a class="btn LilaGomb" href="segitseg.php"><i class='fas fa-info'>&nbsp&nbsp</i>Részletek</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <picture>
                                    <source class="d-block w-100" srcset="./kepek/index/carousel1_3.png" media="(min-width: 992px)" alt="Third slide"/>
                                    <img class="d-block w-100" src="./kepek/index/carousel1_3_small.png" alt="Second slide"/>
                                </picture>
                                <div class="carousel-caption">
                                    <div class="d-lg-none">
                                        <h5 class="shadow p-2" style="background: rgba(0,0,0,50%);color:#ffffff">Valódi élményvezetés</h5>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <h3 class="shadow p-2" style="background: rgba(0,0,0,50%);color:#ffffff">Valódi élményvezetés</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
					</div>
				</div>
			</div>
		</div>
		<!-- Pörgő számok -->
		<div class="container m-0 p-0 mt-4 mx-auto text-center align-middle">
			<div class="row m-0 p-0">
				<div class="col-sm-4 m-0 p-2">
					<h1 class="LilaSzoveg font-weight-bold"><i class='fas fa-user'>&nbsp&nbsp</i><span class="count">274</span></h1>
					<h5>Regisztrált felhasználó</h5>
				</div>
				<div class="col-sm-4 m-0 p-2">
					<h1 class="LilaSzoveg font-weight-bold"><i class='fas fa-car'>&nbsp&nbsp</i><span class="count">36</span></h1>
					<h5>Bérelhető autó</h5>
				</div>
				<div class="col-sm-4 m-0 p-2">
					<h1 class="LilaSzoveg font-weight-bold"><i class='fas fa-file-signature'>&nbsp&nbsp</i><span class="count">613</span></h1>
					<h5>Kölcsönzés</h5>
				</div>
			</div>
		</div>
		<!-- Fő szolgáltatások kártyái -->
		<div class="container m-0 p-0 mx-auto">
			<div class="row m-0 p-0">
				<div class="m-0 p-2 col-12 col-lg-4 d-flex align-self-stretch mt-4">
					<div class="card w-100">
						<div class="card-header m-0 p-0">
							<img src=".\kepek\index\kartya_1_1.png" class="img img-fluid w-100" alt="">
						</div>
						<div class="card-body">
							<h3 class="LilaSzoveg font-weight-bold">Luxusautó kölcsönzés</h3>
							<p>Több mint 30 prémium luxusjármű közül választhat.</p>
							<p>Találja meg az önhöz legjobban illőt!</p>
						</div>
						<div class="card-footer border-0 bg-white">
							<a class="btn btn-block LilaGomb" href="autoink.php"><i class='fas fa-car'>&nbsp&nbsp</i>Modellek</a>
						</div>
					</div>
				</div>
				<div class="m-0 p-2 col-12 col-lg-4 d-flex align-self-stretch mt-4">
					<div class="card w-100">
						<div class="card-header m-0 p-0">
							<img src=".\kepek\index\kartya_1_2.png" class="img img-fluid w-100" alt="">
						</div>
						<div class="card-body">
							<h3 class="LilaSzoveg font-weight-bold">Különleges alkalmakra</h3>
							<p>Esküvőre, szalagavatóra, születésnapi ajándékba, versenypályára, speciális alkalmakra is biztosítunk autókat, akár sofőrrel is.</p> 
							<p>Ezek egyedi szervezést igényelnek, ezért kérjük foglalás előtt előzetesen egyeztessen velünk.</p>
						</div>
						<div class="card-footer bg-white border-0">
						<a class="btn btn-block LilaGomb" href="elerhetoseg.php"><i class='fas fa-phone'>&nbsp&nbsp</i>Elérhetőség</a>
						</div>
					</div>
				</div>
				<div class="m-0 p-2 col-12 col-lg-4 d-flex align-self-stretch mt-4">
					<div class="card w-100">
						<div class="card-header m-0 p-0">
							<img src=".\kepek\index\kartya_1_3.png" class="img img-fluid w-100" alt="">
						</div>
						<div class="card-body">
							<h3 class="LilaSzoveg font-weight-bold">Garantált minőség</h3>
							<p>Autóinkat rendszeresen szervízeljük, saját műhelyünkben.</p>
							<p>Kínálatunk folyamatosan bővül a legfiatalabb prémium autókkal szerte a világ minden pontjáról.</p>
						</div>
						<div class="card-footer bg-white border-0">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Lapozható blokkok 2 -->
		<div class="container m-0 p-0 mt-4 mx-auto">
			<div class="row m-0 p-0">
				<div class="col-sm-12 m-0 p-2">
					<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators2" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <picture>
                                    <source class="d-block w-100" srcset="./kepek/index/carousel2_1.png" media="(min-width: 992px)" alt="First slide"/>
                                    <img class="d-block w-100" src="./kepek/index/carousel2_1_small.png" alt="First slide"/>
                                </picture>
                                <div class="carousel-caption">
                                    <div class="d-sm-none">
                                        <a class="btn btn bg-transparent LilaGomb" href="autoProfil.php?id=12"><i class='fas fa-car'>&nbsp&nbsp</i>Ferrari LaFerrari</a>
                                    </div>
                                    <div class="d-none d-sm-block">
                                        <h4 class="shadow p-2" style="background: rgba(0,0,0,50%);color:#ffffff">Ferrari LaFerrari</h4>
                                        <a class="btn LilaGomb" href="autoProfil.php?id=12"><i class='fas fa-car'>&nbsp&nbsp</i>Érdekel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                            <picture>
                                    <source class="d-block w-100" srcset="./kepek/index/carousel2_2.png" media="(min-width: 992px)" alt="Second slide"/>
                                    <img class="d-block w-100" src="./kepek/index/carousel2_2_small.png" alt="Second slide"/>
                            </picture>
                                <div class="carousel-caption">
                                    <div class="d-sm-none">
                                        <a class="btn btn bg-transparent LilaGomb" href="autoProfil.php?id=9"><i class='fas fa-car'>&nbsp&nbsp</i>Bugatti Chiron</a>
                                    </div>
                                    <div class="d-none d-sm-block">
                                        <h4 class="shadow p-2" style="background: rgba(0,0,0,50%);color:#ffffff">Bugatti Chiron</h4>
                                        <a class="btn LilaGomb" href="autoProfil.php?id=9"><i class='fas fa-car'>&nbsp&nbsp</i>Érdekel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <picture>
                                    <source class="d-block w-100" srcset="./kepek/index/carousel2_3.png" media="(min-width: 992px)" alt="Third slide"/>
                                    <img class="d-block w-100" src="./kepek/index/carousel2_3_small.png" alt="Third slide"/>
                                </picture>
                                <div class="carousel-caption">
                                    <div class="d-sm-none">
                                        <a class="btn btn bg-transparent LilaGomb" href="autoProfil.php?id=2"><i class='fas fa-car'>&nbsp&nbsp</i>Lamborghini Aventador</a>
                                    </div>
                                    <div class="d-none d-sm-block">
                                        <h4 class="shadow p-2" style="background: rgba(0,0,0,50%);color:#ffffff">Lamborghini Aventador</h4>
                                        <a class="btn LilaGomb" href="autoProfil.php?id=2"><i class='fas fa-car'>&nbsp&nbsp</i>Érdekel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <picture>
                                    <source class="d-block w-100" srcset="./kepek/index/carousel2_4.png" media="(min-width: 992px)" alt="Fourth slide"/>
                                    <img class="d-block w-100" src="./kepek/index/carousel2_4_small.png" alt="Fourth slide"/>
                                </picture>
                                <div class="carousel-caption">
                                    <div class="d-sm-none">
                                        <a class="btn btn bg-transparent LilaGomb" href="autoProfil.php?id=13"><i class='fas fa-car'>&nbsp&nbsp</i>Koenigsegg Agera</a>
                                    </div>
                                    <div class="d-none d-sm-block">
                                        <h4 class="shadow p-2" style="background: rgba(0,0,0,50%);color:#ffffff">Koenigsegg Agera</h4>
                                        <a class="btn LilaGomb" href="autoProfil.php?id=13"><i class='fas fa-car'>&nbsp&nbsp</i>Érdekel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<?php include ("footer.php"); ?>
	</body>
</html>
<script>
	// Pörgő számok
	$('.count').each(function ()
    {
		$(this).prop('Counter',0).animate
        (
            {
			    Counter: $(this).text()
		    }, 
            {
			    duration: 4000,
			    easing: 'swing',
			    step: function (now) 
                {
				    $(this).text(Math.ceil(now));
			    }
		    }
        );
	});
</script>