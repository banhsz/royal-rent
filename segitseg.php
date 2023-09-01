<?php session_start(); 
    if (!isset($_SESSION["jogosultsag"])) 
    {
        $_SESSION["jogosultsag"]="vendeg";
        $_SESSION["belepett_id"]="";
        $_SESSION["belepett_felhasznalonev"]="";
    }
    $_SESSION["oldal"]="segitseg";
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>Royal Rent - Segítség</title>
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
        <?php include ("navbar.php"); ?>
        <!-- Lista -->
        <div class="container m-0 p-0 mx-auto mt-4">
            <div class="row m-0 p-0">
                <div class="col-12 m-0 p-2">
                    <div class="list-group">
                        <a href="#altalanos_informaciok" class="list-group-item list-group-item-action"><h4>1. Általános információk</h4></a>
                        <a href="#berles_menete" class="list-group-item list-group-item-action"><h4>2. Bérlés menete</h4></a>
                        <a href="#jogi_informaciok" class="list-group-item list-group-item-action"><h4>3. Jogi információk</h4></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container m-0 p-0 mx-auto mt-4" id="altalanos_informaciok">
            <div class="row m-0 p-0">
                <div class="col-12 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h4 class="">Általános információk</h4></legend>
                        <ul>
                            <li><p>Autó bérléséhez regisztráció szükséges.</p></li>
                            <li><p>Autót 18. életévét betöltött és "B" kategóriás jogosítvánnyal rendelkező személy bérelhet.</p></li>
                            <li><p>A bérlési idő alatt a bérlő teljes felelősséget vállal saját és az autó épségéért (Kivétel: lopás, normál használat mellett keletkező
                            műszaki hiba, nem általa okozott közúti baleset). Az autóval az aktuális KRESZ szabályoknak megfelelően kell közlekedni.</p></li>
                            <li><p>Autóinkat kizárólag a <a href="index.php">www.royalrent.tk</a> weboldalról lehet kölcsönözni.</p></li>
                            <li><p>Fizetni csak banki átutalással lehet. A bizonylatot 24 órán belül fel kell tölteni a <a href="profil.php">profil</a> oldalon, különben a 
                            foglalás érvényét veszíti.</p></li>
                            <li><p>Az autót a bérlés első napján 8:00-tól lehet átvenni szalonunkban: 9999 Budapest, Royal-Rent utca 9. Visszahozni ugyan ide kell legkésőbb az utolsó napon 23:59-ig.</p></li>
                            <li><p>Autóinkat rendszeresen karbantartjuk, azonban előfurdulhatnak váratlan műszaki hibák. Ebben az esetbetben az aznapi bérleti díj visszautalásra kerül és
                            közös megegyezés alapján csereautót biztosítunk 5 órán belül vagy visszautaljuk a hátralévő napoknak megfelelő bérösszeget.</p></li>
                        </ul>
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- Tartalom -->
        <div class="container m-0 p-0 mx-auto mt-4" id="berles_menete">
            <div class="row m-0 p-0">
                <div class="col-12 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h4 class="">Bérlés menete</h4></legend>
                        <ul>
                            <li>
                                <span class="pt-2 font-weight-bold">1. Regisztráció</span>
                                <p>A <a href="bejelentkezes.php">bejelentkezés</a> oldalon töltse ki a regiszráció mezőket, majd nyomjon a <button class="btn LilaGomb"><i class='fas fa-file-signature'></i>&nbsp&nbspRegisztráció</button> gombra!</p>
                            </li>
                            <li>
                                <span class="font-weight-bold">2. Bejelentkezés</span>
                                <p>Sikeres regisztráció után a <a href="bejelentkezes.php">bejelentkezés</a> oldalon töltse ki a bejelentkezés mezőket a korábban megadott adataival, majd nyomjon a <button class="btn LilaGomb"><i class='fas fa-sign-in-alt'></i>&nbsp&nbspBejelentkezés</button> gombra!</p>
                            </li>
                            <li>
                                <span class="font-weight-bold">3. Autó kiválasztása</span>
                                <p>Válassza ki a bérelni kívánt autót! Használja a navigációs sáv "<i class='fas fa-car'>&nbsp&nbsp</i>Modellek" menüpontját vagy kattintson <a href="autoink.php">ide. </a>
                                Kattintson a bérelni kívánt autó képére vagy az alatta lévő <button class="btn LilaGomb" ><i class="fas fa-file-signature">&nbsp&nbsp</i>Foglalás</button> gombra!</p>
                            </li>
                            <li>
                                <span class="font-weight-bold">4. Autó foglalása</span>
                                <p>A foglalási naplóban nézze meg, hogy melyik napokon szabad a kiválasztott autó! Ahol <span style="color:red;font-weight:bold">piros</span> hátterű a nap, az a nap 
                                <span style="color:red;font-weight:bold">foglalt</span>. Ahol fehér hátterű a nap, az a nap szabad és foglalás adható le rá. Az év és hónap megváltoztatásához
                                kattintson az évre vagy hónapra és válasszon a listából!</p>

                                <p>Amennyiben talált önnek megfelelő szabad időtartamot, válassza ki a bérlés első és utolsó napját. Ha egy napra szeretne bérelni, akkor az első és utolsó napnak is
                                ugyan azt a dátumot adja meg! A maximális bérlési időszak 2 hónap.
                                </p>

                                <p>Ha kiválasztott egy időtartamot, a bérlés végleges ára a <span style="color:green;font-weight:bold">zöld</span> hátterű információs feliraton jelenik meg.
                                Kattintson a <button class="btn LilaGomb"><i class="fas fa-file-signature">&nbsp&nbsp</i>Foglalás</button> gombra, hogy véglegesítse foglalását!
                                A foglalás sikerességéről üzenet jelenik meg a navigációs sáv alatt.
                                </p>
                            </li>
                            <li>
                                <span class="font-weight-bold" id="berles_menete_utalas">5. Utalás</span>
                                <p>Amennyiben sikeres volt a foglalás, a <a href="profil.php">profil</a> oldalon további információt talál foglalásairól. Egy foglalás akkor érvényesül ha az állapota "Fizetve" státuszban van.</p> 
                                
                                <p>Ehhez kérjük utalja el a megfelelő összeget a lent található bankszámlára és 
                                töltse fel az utalásról az igazolást a <button class="btn LilaGomb"><i class="fas fa-file-alt">&nbsp&nbsp</i>Bizonylat</button> gombra kattintva,
                                majd nyomjon a "Fájl kiválasztása..." feliratra, válassza ki a fájlt, <span class="font-weight-bold">(csak .jpg, .jpeg, .png és .pdf fájl tölthető fel!)</span> végül pedig
                                kattintson a <button class="btn LilaGomb"><i class="fas fa-file-upload">&nbsp&nbsp</i>Bizonylat feltöltése</button> gombra. A bizonylatot az utalas@royal-rent.hu címre is elküldheti. 
                                Utalását hamarosan feldolgozzuk. Ha minden rendeben volt, a foglalás státuszát "Fizetve" állapotra módosítjuk. Önnek más teendője nincs. </p>
                                
                                <p>Amennyiben a bérlés első napja a rendelés leadásának napját követi (másképpen, ha holnaptól bérelt), a bizonylatot személyesen is bemutathatja. Azon rendeléseket melyekre 24 órán belül 
                                nem érkezik utalást igazoló bizonylat, töröljük. A bérelt autó, a bérlés első napján 8:00-tól átvehető szalonunkban:<span class="font-weight-bold"> 9999 Budapest, Royal-Rent utca 9.</span> Visszahozni 
                                ugyan ide kell az utolsó napon legkésőbb 23:59-ig.</p>
                    
                                <p class="font-weight-bold">Royal Rent Bankszámlaszám:<br>99999999-99999999<br>Megjegyzés:ROYALRENT - "rendelésszám"<br>(Pld: A rendelésszám 99, akkor a megjegyzésbe ez kerüljön:ROYALRENT - 99)</p>
                                <p class="text-danger">A weboldal kizárólag oktatási céllal jött létre. Nem valódi. Kitalált céget reprezentál. Nem folytat kereskedelmi tevékenységet. Ne küldjön pénzt sehova.</p>
                            </li>
                            <li>
                                <span class="font-weight-bold">6. Bérlés lemondása</span>
                                <p>Bérlés lemondásához kattintson a <button class="btn btn-danger"><i class="fas fa-times">&nbsp&nbsp</i>Lemondás</button> gombra! A már befizetett bérlést is le lehet mondani. 
                                Az elküldött összeg 3 munkanapon belül visszautalásra kerül.</p>
                            </li>
                        </ul>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="container m-0 p-0 mx-auto mt-4" id="jogi_informaciok">
            <div class="row m-0 p-0">
                <div class="col-12 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h4 class="">Jogi információk</h4></legend>
                        <ul>
                            <li>
                                <span class="font-weight-bold">Általános szerződési feltételek (ÁSZF):</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at lorem in felis imperdiet auctor id a tortor. Maecenas purus ante, cursus vitae sapien id,
                                facilisis molestie lacus. Sed in orci malesuada, rutrum justo luctus, sodales eros. Nullam elit urna, porta id massa et, aliquet pulvinar erat. Sed 
                                condimentum porta leo sit amet congue. Duis pretium eu nunc ut consectetur. Mauris ac ipsum purus. Etiam et lorem eu magna pulvinar porttitor. Etiam 
                                laoreet faucibus ligula vitae pulvinar. Phasellus condimentum mauris est, gravida sollicitudin nibh pellentesque at. Fusce ullamcorper felis eu justo mattis,
                                eu rutrum nisi imperdiet.</p>
                                <p>Donec facilisis varius diam feugiat rutrum. Proin luctus laoreet pellentesque. Morbi finibus risus id varius tincidunt. Fusce lacinia erat a mi 
                                faucibus condimentum. Quisque semper gravida venenatis. Nam euismod ultricies lectus, et ultrices nisi feugiat eu. In sit amet odio lacinia, tincidunt 
                                purus et, faucibus mi. Pellentesque vulputate nisl non mollis lacinia. Aliquam faucibus tellus dolor, eget fringilla lectus blandit nec. Nam at 
                                tortor condimentum dui volutpat tincidunt. Vestibulum eleifend eros non pulvinar accumsan. Ut vitae commodo arcu. Nunc vel venenatis erat.
                                </p>
                                <p>Sed vel porttitor felis, id tincidunt nunc. Suspendisse accumsan tellus at turpis lobortis eleifend. Morbi non leo placerat, pellentesque mi non, tincidunt
                                ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas in justo lectus. Donec ac convallis diam. Nulla facilisi. 
                                Donec congue lacus eu sollicitudin semper. Aenean eu risus quam. Donec quis magna vestibulum tortor venenatis tempus. Vivamus tempus sit amet tortor sed accumsan. 
                                Quisque a libero libero. In nec hendrerit diam, sed fermentum metus. Integer vitae iaculis sem. Donec volutpat, elit vitae ornare ultricies, mauris neque posuere 
                                erat, et tincidunt nulla est sit amet massa. Cras volutpat ante ut facilisis feugiat.</p>
                                <p>Phasellus pretium bibendum lorem, ornare placerat urna. Mauris aliquam eget massa et pharetra. Aliquam viverra, risus vel tristique bibendum, libero dolor 
                                iaculis diam, et rutrum metus lectus sed ligula. Nunc nec ex libero. Etiam blandit, mauris sed fringilla mattis, leo leo lobortis lorem, vel faucibus turpis 
                                felis ut leo. Nam metus mauris, facilisis quis mi ut, bibendum euismod enim. Etiam laoreet ligula ut leo suscipit molestie. Morbi ornare, ante sed tempor 
                                ullamcorper, enim lorem pellentesque nunc, sed viverra ex turpis a tellus.</p>
                            </li>
                            <li>
                                <span class="font-weight-bold">Általános adatvédelmi rendelet (GDPR):</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at lorem in felis imperdiet auctor id a tortor. Maecenas purus ante, cursus vitae sapien id,
                                facilisis molestie lacus. Sed in orci malesuada, rutrum justo luctus, sodales eros. Nullam elit urna, porta id massa et, aliquet pulvinar erat. Sed 
                                condimentum porta leo sit amet congue. Duis pretium eu nunc ut consectetur. Mauris ac ipsum purus. Etiam et lorem eu magna pulvinar porttitor. Etiam 
                                laoreet faucibus ligula vitae pulvinar. Phasellus condimentum mauris est, gravida sollicitudin nibh pellentesque at. Fusce ullamcorper felis eu justo mattis,
                                eu rutrum nisi imperdiet.</p>
                                <p>Donec facilisis varius diam feugiat rutrum. Proin luctus laoreet pellentesque. Morbi finibus risus id varius tincidunt. Fusce lacinia erat a mi 
                                faucibus condimentum. Quisque semper gravida venenatis. Nam euismod ultricies lectus, et ultrices nisi feugiat eu. In sit amet odio lacinia, tincidunt 
                                purus et, faucibus mi. Pellentesque vulputate nisl non mollis lacinia. Aliquam faucibus tellus dolor, eget fringilla lectus blandit nec. Nam at 
                                tortor condimentum dui volutpat tincidunt. Vestibulum eleifend eros non pulvinar accumsan. Ut vitae commodo arcu. Nunc vel venenatis erat.
                                </p>
                                <p>Sed vel porttitor felis, id tincidunt nunc. Suspendisse accumsan tellus at turpis lobortis eleifend. Morbi non leo placerat, pellentesque mi non, tincidunt
                                ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas in justo lectus. Donec ac convallis diam. Nulla facilisi. 
                                Donec congue lacus eu sollicitudin semper. Aenean eu risus quam. Donec quis magna vestibulum tortor venenatis tempus. Vivamus tempus sit amet tortor sed accumsan. 
                                Quisque a libero libero. In nec hendrerit diam, sed fermentum metus. Integer vitae iaculis sem. Donec volutpat, elit vitae ornare ultricies, mauris neque posuere 
                                erat, et tincidunt nulla est sit amet massa. Cras volutpat ante ut facilisis feugiat.</p>
                                <p>Phasellus pretium bibendum lorem, ornare placerat urna. Mauris aliquam eget massa et pharetra. Aliquam viverra, risus vel tristique bibendum, libero dolor 
                                iaculis diam, et rutrum metus lectus sed ligula. Nunc nec ex libero. Etiam blandit, mauris sed fringilla mattis, leo leo lobortis lorem, vel faucibus turpis 
                                felis ut leo. Nam metus mauris, facilisis quis mi ut, bibendum euismod enim. Etiam laoreet ligula ut leo suscipit molestie. Morbi ornare, ante sed tempor 
                                ullamcorper, enim lorem pellentesque nunc, sed viverra ex turpis a tellus.</p>
                            </li>
                        </ul>
                    </div>
                </fieldset>
            </div>
        </div>
        <!-- Footer -->
		<?php include ("footer.php"); ?>
    </body>
</html>