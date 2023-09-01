<?php 
    session_start(); 
    if (!isset($_SESSION["jogosultsag"])) 
    {
        $_SESSION["jogosultsag"]="vendeg";
        $_SESSION["belepett_id"]="";
        $_SESSION["belepett_felhasznalonev"]="";
    }
    $_SESSION["oldal"]="elerhetoseg";
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>Royal Rent - Elérhetőség</title>
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
        <div class="container m-0 p-0 mt-4 mx-auto">
            <div class="row m-0 p-0">
                <div class="col-12 col-lg-6 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h4>Szalon, iroda és szervíz címe</h4></legend>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2266.3938849656347!2d19.088466261772002!3d47.50526761138544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc8645265a5f%3A0x509abda64d383b7b!2sBudapesti%20M%C5%B1szaki%20SzC%20Petrik%20Lajos%20K%C3%A9t%20tan%C3%ADt%C3%A1si%20Nyelv%C5%B1%20Technikuma!5e0!3m2!1shu!2shu!4v1611781103321!5m2!1shu!2shu" width="100%" height="500px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </fieldset>
                </div>
                <div class="col-12 col-lg-6 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h4>Elérhetőségeink</h4></legend>
                        <ul>
                            <li>
                                <p><i class='fas fa-phone'>&nbsp&nbsp</i>+36 99 9999999</p>
                            </li>
                            <li>
                                <p><i class='fas fa-at'>&nbsp&nbsp</i>info@royal-rent.hu</p>
                            </li>
                            <li>
                                <p><i class='fas fa-building'>&nbsp&nbsp</i>9999 Budapest, Royal-Rent utca 9.</p>
                            </li>
                        </ul>
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- Footer -->
		<?php include ("footer.php"); ?>
    </body>
</html>