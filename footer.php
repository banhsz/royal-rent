<div id="NavHatterSzin">
    <div class="container m-0 p-0 mt-4 mx-auto text-secondary">
        <div class="row m-0 p-0">
            <!-- Oldalnavigacio -->
            <div class="col-sm-6 m-0 p-2 mx-auto d-flex justify-content-center">
                <nav class="navbar-nav navbar-dark">
                    <ul class="nav navbar-nav flex-column">
                        <li>
                            <a class="nav-link" href="index.php">Főoldal</a>
                        </li>
                        <li>
                            <a class="nav-link" href="autoink.php">Autóink</a>
                        </li>
                        <li>
                            <a class="nav-link" href="segitseg.php">Segítség</a>
                        </li>
                        <li>
                            <a class="nav-link" href="elerhetoseg.php">Elérhetőség</a>
                        </li>
                        <li>
                            <?php
                                if($_SESSION["jogosultsag"]=="vendeg")
                                {
                                    echo '<a class="nav-link" href="bejelentkezes.php">Bejelentkezés</a>';
                                }
                                else
                                {
                                    echo '<a class="nav-link" href="profil.php">Profil</a>';
                                }
                            ?>
                        </li>
                        <li>
                            <a class="nav-link" href="forrasok.php">Források</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Logo -->
            <div class="col-sm-6 m-0 p-2 text-center">
                 <img src="kepek/index/logo_light.svg" alt="Logo" class="img img-fluid m-0 p-0">
            </div>
        </div>
        <!-- Keszitő -->
        <div class="row m-0 p-0 text-center">
            <div class="col-sm-12 m-0 p-2">
                <p>Készítette: Bánhidi Szabolcs - 2021</p>
                <p>banhidi.szabolcs@gmail.com - <a href="https://github.com/banhsz">GitHub</a></p>
                <p><a href="forrasok.php">A honlapon található képek tulajdonosai</a></p>
                <p class="text-danger">A weboldal kizárólag oktatási céllal jött létre. Nem valódi. Kitalált céget reprezentál. Nem folytat kereskedelmi tevékenységet. Ne küldjön pénzt sehova.</p>
            </div>
        </div>
    </div>
</div>
<?php 
    /*
    echo "<pre>";
    var_dump($_GET);
    echo "</pre>";

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    */
?>

