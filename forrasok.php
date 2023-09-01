<?php 
    session_start(); 
    if (!isset($_SESSION["jogosultsag"])) 
    {
        $_SESSION["jogosultsag"]="vendeg";
        $_SESSION["belepett_id"]="";
        $_SESSION["belepett_felhasznalonev"]="";
    }
    $_SESSION["oldal"]="forrasok";
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>Royal Rent - Források</title>
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
        <div class="container m-0 p-0 mt-4 mx-auto" style="word-wrap:break-word";>
            <div class="row m-0 p-0">
                <div class="col-12 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h4>Források</h4></legend>
                        <p>
                            A weboldalon található képek a <a href="https://search.creativecommons.org/">https://search.creativecommons.org/</a> és a <a href="https://pixabay.com/">https://pixabay.com/</a> oldalról származnak.
                        </p>
                        <p>
                            Pixabay licensz:<br><a href="https://pixabay.com/service/license/">https://pixabay.com/service/license/</a>
                        </p>
                        <p>
                            CreativeCommons.org licenszek: <br>
                            1.
                            CC0 1.0 Universal (CC0 1.0) Public Domain Dedication <br>
                            <a href="https://creativecommons.org/publicdomain/zero/1.0/?ref=ccsearch&atype=rich">https://creativecommons.org/publicdomain/zero/1.0/?ref=ccsearch&atype=rich</a><br>
                            2.
                            Attribution 4.0 International (CC BY 4.0) <br>
                            <a href="https://creativecommons.org/licenses/by/4.0/?ref=ccsearch&atype=rich">https://creativecommons.org/licenses/by/4.0/?ref=ccsearch&atype=rich</a> <br>
                        </p>
                        <p>
                            A CC BY licensz megköveteli a forrás és készítő feltüntetését, illetve ha változtatás történt. Ezek a következők:
                        </p>
                        <ul>
                            <li>
                                Toyota Supra:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/51811543@N08/36693997974">https://www.flickr.com/photos/51811543@N08/36693997974</a><br>
                                            "Toyota Supra" by FotoSleuth is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/78038571@N00/151087869">https://www.flickr.com/photos/78038571@N00/151087869</a><br>
                                            "2JZ-GTE tuned engine" by ducktail964 is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/76929828@N00/5545463222">https://www.flickr.com/photos/76929828@N00/5545463222</a><br>
                                            ""Supra" by The Pug Father is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Koenigsegg Agera:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://commons.wikimedia.org/w/index.php?curid=43762416">https://commons.wikimedia.org/w/index.php?curid=43762416</a><br>
                                            "File:2015 Koenigsegg Agera N (19886243212).jpg" by Edvvc from London, UK is licensed under CC BY 2.0<br>
                                            (a kép körbe lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/72752141@N00/5676260022">https://www.flickr.com/photos/72752141@N00/5676260022</a><br>
                                            "Koenigsegg Agera - first customer car in the UK!" by Supermac1961 is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/65540875@N08/5964655404">https://www.flickr.com/photos/65540875@N08/5964655404</a><br>
                                            "Koenigsegg Agera R @ London 2011" by Autospotting Crew is licensed under CC BY 2.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/60162857@N08/5488113699">https://www.flickr.com/photos/60162857@N08/5488113699</a><br>
                                            "Koenigsegg Agera R" by Autoviva.com is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/60162857@N08/5488112377">https://www.flickr.com/photos/60162857@N08/5488112377</a><br>
                                            "Koenigsegg Agera R" by Autoviva.com is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/181662702@N03/47942274026">https://www.flickr.com/photos/181662702@N03/47942274026</a><br>
                                            "Koenigsegg Family in Dusseldorf Germany" by born2create.de is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                LaFerrari:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://commons.wikimedia.org/w/index.php?curid=41194432">https://commons.wikimedia.org/w/index.php?curid=41194432</a><br>
                                            "File:Ferrari LaFerrari at the Beverly Wilshire (16561711896).jpg" by Axion23 is licensed under CC BY 2.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/26977717@N02/6735624825">https://www.flickr.com/photos/26977717@N02/6735624825</a><br>
                                            "Red Inserts." by Damian Morys Photography is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/14265068@N00/14663139522">https://www.flickr.com/photos/14265068@N00/14663139522</a><br>
                                            "Ferrari LaFerrari" by Dave Hamster is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/100368571@N08/16791493516">https://www.flickr.com/photos/100368571@N08/16791493516</a><br>
                                            "DSC_4988_1" by FAS Fotos is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Ford Mustang Shelby GT:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/50415738@N04/8453122716">https://www.flickr.com/photos/50415738@N04/8453122716</a><br>
                                            "2012 Ford Mustang Shelby GT 500 Super Snake coupe" by sv1ambo is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/50415738@N04/8452028801">https://www.flickr.com/photos/50415738@N04/8452028801</a><br>
                                            "2012 Ford Mustang Shelby GT 500 Super Snake coupe" by sv1ambo is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/25632349@N04/5458331358">https://www.flickr.com/photos/25632349@N04/5458331358</a><br>
                                            "2008 Ford Mustang Shelby GT500" by TheCarSpy is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/25632349@N04/5458330694">https://www.flickr.com/photos/25632349@N04/5458330694</a><br>
                                            "2008 Ford Mustang Shelby GT500" by TheCarSpy is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                BMW M5:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/49500824@N02/6280472725">https://www.flickr.com/photos/49500824@N02/6280472725</a><br>
                                            "BMW F10 5 Series Body kit, Front bumper, front lip, rear skirt and diffuser, side skirts and trunk spoiler" by Prior Design NA (priordesignusa.com) is licensed under CC BY 2.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/49500824@N02/6280989756">https://www.flickr.com/photos/49500824@N02/6280989756</a><br>
                                            "BMW F10 5 Series Body kit, Front bumper, front lip, rear skirt and diffuser, side skirts and trunk spoiler" by Prior Design NA (priordesignusa.com) is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/49500824@N02/6280473763">https://www.flickr.com/photos/49500824@N02/6280473763</a><br>
                                            "BMW F10 5 Series Body kit, Front bumper, front lip, rear skirt and diffuser, side skirts and trunk spoiler" by Prior Design NA (priordesignusa.com) is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/49500824@N02/6622987147">https://www.flickr.com/photos/49500824@N02/6622987147</a><br>
                                            "PRIOR-DESIGN BMW F10 5 Series PD-R Aerodynamic-Kit" by Prior Design NA (priordesignusa.com) is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/128326674@N06/16721598404">https://www.flickr.com/photos/128326674@N06/16721598404</a><br>
                                            "BMW 435i M Sport (F32) interior" by Pandamera1 is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Bugatti Chiron:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/92090133@N04/42457826882">https://www.flickr.com/photos/92090133@N04/42457826882</a><br>
                                            "42083 Bugatti Chiron" by Brickset is licensed under CC BY 2.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/146538874@N06/23628630808">https://www.flickr.com/photos/146538874@N06/23628630808</a><br>
                                            "Bugatti Chiron" by More Cars is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/99610616@N02/33922547205">https://www.flickr.com/photos/99610616@N02/33922547205</a><br>
                                            "Render - Bugatti Chiron By Alang7™" by Alang7™ is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/181662702@N03/47942265996">https://www.flickr.com/photos/181662702@N03/47942265996</a><br>
                                            "BUGATTI CHIRON | 1500PS CAR" by born2create.de is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/99610616@N02/33090042243">https://www.flickr.com/photos/99610616@N02/33090042243</a><br>
                                            "Render - Bugatti Chiron By Alang7™" by Alang7™ is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                AMG G63:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/8058098@N07/10157490943">https://www.flickr.com/photos/8058098@N07/10157490943</a><br>
                                            "Mercedes-Benz G63 Brabus" by nakhon100 is licensed under CC BY 2.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/51811543@N08/17987649035">https://www.flickr.com/photos/51811543@N08/17987649035</a><br>
                                            "Mercedes-Benz G63 AMG" by FotoSleuth is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/51811543@N08/23487751819">https://www.flickr.com/photos/51811543@N08/23487751819</a><br>
                                            "Mercedes-Benz G63 AMG" by FotoSleuth is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://commons.wikimedia.org/w/index.php?curid=30676325">https://commons.wikimedia.org/w/index.php?curid=30676325</a><br>
                                            "File:2013 Mercedes-Benz G63 AMG (8404342582).jpg" by Sarah Larson from Ann Arbor, MI, USA is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Tesla Model X:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/152930510@N02/39912982353">https://www.flickr.com/photos/152930510@N02/39912982353</a><br>
                                            "Tesla Model X" by crash71100 is marked with CC0 1.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/152930510@N02/31936518377">https://www.flickr.com/photos/152930510@N02/31936518377</a><br>
                                            "Tesla Model X" by crash71100 is marked with CC0 1.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://commons.wikimedia.org/w/index.php?curid=29785612">https://commons.wikimedia.org/w/index.php?curid=29785612</a><br>
                                            "File:Tesla Model X Design.jpg" by Steve Jurvetson is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/69214385@N04/16042113157">https://www.flickr.com/photos/69214385@N04/16042113157</a><br>
                                            "Tesla Model X front view" by Don McCullough is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/90136188@N02/27772779150">https://www.flickr.com/photos/90136188@N02/27772779150</a><br>
                                            "Tesla Model X (Intérieur)" by clementlambert67 is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/37283911@N08/31701374022">https://www.flickr.com/photos/37283911@N08/31701374022</a><br>
                                            "2016 Tesla Model X - interior" by NielsdeWit is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Ferrari Portofino:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/37804979@N00/47984562683">https://www.flickr.com/photos/37804979@N00/47984562683</a><br>
                                            "Ferrari Portofino" by ahisgett is licensed under CC BY 2.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/123760891@N03/36753252481">https://www.flickr.com/photos/123760891@N03/36753252481</a><br>
                                            "Ferrari Portofino, da Francoforte arriva la nuova Gran Turismo decapottabile di Maranell" by automobileitalia is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/146538874@N06/37121035360">https://www.flickr.com/photos/146538874@N06/37121035360</a><br>
                                            "Ferrari Portofino" by More Cars is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/146538874@N06/37330037396">https://www.flickr.com/photos/146538874@N06/37330037396</a><br>
                                            "Ferrari Portofino" by More Cars is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/30478819@N08/36569425474">https://www.flickr.com/photos/30478819@N08/36569425474</a><br>
                                            "Das Ferrari Portofino bei der IAA 2017 in Frankfurt am Main" by wuestenigel is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/44124348109@N01/7571378972">https://www.flickr.com/photos/44124348109@N01/7571378972</a><br>
                                            "Ferrari Spider 458, fresh off the lot" by jurvetson is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Rolls-Royce Wraith Black Badge:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/38891071@N00/34345589983">https://www.flickr.com/photos/38891071@N00/34345589983</a><br>
                                            "Rolls Royce Wraith" by FaceMePLS is licensed under CC BY 2.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/72752141@N00/13433945375">https://www.flickr.com/photos/72752141@N00/13433945375</a><br>
                                            "Rolls Royce Wraith in Dubai" by Supermac1961 is licensed under CC BY 2.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/119886413@N05/15780643526">https://www.flickr.com/photos/119886413@N05/15780643526</a><br>
                                            "Rolls Royce Wraith" by Michel Curi is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/152930510@N02/47657823781">https://www.flickr.com/photos/152930510@N02/47657823781</a><br>
                                            "Rolls-Royce Wraith Monaco Temporary plate" by crash71100 is marked with CC0 1.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/152930510@N02/47605077822">https://www.flickr.com/photos/152930510@N02/47605077822</a><br>
                                            "Rolls-Royce Wraith Monaco Temporary plate" by crash71100 is marked with CC0 1.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Lamborghini Aventador:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/51117559@N03/6650947323">https://www.flickr.com/photos/51117559@N03/6650947323</a><br>
                                            "Lamborghini Aventador" by Brett Levin Photography is licensed under CC BY 2.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/51117559@N03/6674853567">https://www.flickr.com/photos/51117559@N03/6674853567</a><br>
                                            "Lamborghini Aventador" by Brett Levin Photography is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/60162857@N08/5488244641">https://www.flickr.com/photos/60162857@N08/5488244641</a><br>
                                            "Lamborghini Aventador" by Autoviva.com is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/26977717@N02/6675860749">https://www.flickr.com/photos/26977717@N02/6675860749</a><br>
                                            "Aventador." by Damian Morys Photography is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/60162857@N08/5488245669">https://www.flickr.com/photos/60162857@N08/5488245669</a><br>
                                            "Lamborghini Aventador" by Autoviva.com is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/26977717@N02/6684101961">https://www.flickr.com/photos/26977717@N02/6684101961</a><br>
                                            "Aventador." by Damian Morys Photography is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Ferrari 488 GTB:
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/49529764@N02/30729130717">https://www.flickr.com/photos/49529764@N02/30729130717</a><br>
                                            "Ferrari 488 GTB" by xfiles_19 is licensed under CC BY 2.0<br>
                                            (a kép méretre lett vágva és át lett méretezve)
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/42220226@N07/37618606270">https://www.flickr.com/photos/42220226@N07/37618606270</a><br>
                                            "2016 Ferrari 488 GTB Berlinetta" by Sicnag is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/146538874@N06/38262625696">https://www.flickr.com/photos/146538874@N06/38262625696</a><br>
                                            "Ferrari 488 GTB" by More Cars is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/153137254@N02/33270073180">https://www.flickr.com/photos/153137254@N02/33270073180</a><br>
                                            "488 GTB inside 2" by IsaacMathewsPhotographer is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/153137254@N02/33497265262">https://www.flickr.com/photos/153137254@N02/33497265262</a><br>
                                            "488 GTB right side interior" by IsaacMathewsPhotographer is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Kezdőoldal + Menü (ezen a kategórián belül minden kép átméretezve és körbevágva lett)::
                                <ul>    
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/154073030@N05/41600981435">https://www.flickr.com/photos/154073030@N05/41600981435</a><br>
                                            "Rolls-Royce Ghost Black Badge - Premium Luxury Car - Free Car Picture - Give Credit Via Link" by MotorVerso is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/21484712@N00/3673390863">https://www.flickr.com/photos/21484712@N00/3673390863</a><br>
                                            "New Car" by Caitlinator is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/29233640@N07/3285710885">https://www.flickr.com/photos/29233640@N07/3285710885</a><br>
                                            "step 5" by Robert Couse-Baker is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://commons.wikimedia.org/w/index.php?curid=71083399">https://commons.wikimedia.org/w/index.php?curid=71083399</a><br>
                                            "File:Bugatti Chiron Sport at the New York International Auto Show NYIAS (40611956634).jpg" by Nan Palmero from San Antonio, TX, USA is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://www.flickr.com/photos/146538874@N06/48854655807">https://www.flickr.com/photos/146538874@N06/48854655807</a><br>
                                            "Bugatti Chiron" by More Cars is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <a href="https://commons.wikimedia.org/w/index.php?curid=33855555">https://commons.wikimedia.org/w/index.php?curid=33855555</a><br>
                                            "File:Orange Lamborghini Aventador LP700 (13958653933).jpg" by Axion23 is licensed under CC BY 2.0<br>
                                        </p>
                                    </li>
                                </ul>
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