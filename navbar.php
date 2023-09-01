<?php
    //Az aktuálisan aktív menüpont (amelyik oldalon vagyunk) színezése
    $seged="x";
    echo "<style>";
        if ($_SESSION["oldal"]=="autoink") 
        {
            $seged = "#NavLink #autoink";
        }
        else if ($_SESSION["oldal"]=="bejelentkezes") 
        {
            $seged = "#NavLink #bejelentkezes";
        }
        else if ($_SESSION["oldal"]=="profil") 
        {
            $seged = "#NavLink #profil";
        }
        else if ($_SESSION["oldal"]=="segitseg") 
        {
            $seged = "#NavLink #segitseg";
        }
        else if ($_SESSION["oldal"]=="elerhetoseg") 
        {
            $seged = "#NavLink #elerhetoseg";
        }
        echo "".$seged."";
        echo "{";
        echo "    background-color: #8032a0;";
        echo "    color:white;";
        echo "}";
        echo "".$seged.":hover";
        echo "{";
        echo "    background-color: #642579;";
        echo "    color:white;";
        echo "}";
    echo "</style>";
    //Kijelentkezéskor a SESSION változók alaphelyzetbe kerülnek és újratölt az oldal
    if (isset($_GET["kilepes"])) 
    {   
        if ($_GET["kilepes"]=="true") 
        {
            $_SESSION["jogosultsag"]="vendeg";
            $_SESSION["belepett_id"]="";
            $_SESSION["belepett_felhasznalonev"]="";
            echo "<script>window.location.replace('index.php')</script>";
        }
    }
?>
<div id="NavHatterSzin">
    <div class="container-xl m-0 p-0 mx-auto">
        <div class="col-sm-12 m-0 p-0">
            <nav class="navbar navbar-expand-xl navbar-dark m-0 p-0" id="NavHatterSzin">
                <!-- Logo -->
                <a class="navbar-brand m-0 p-0 pl-xl-2 ml-1 ml-xl-0" href="index.php">
                    <img src="kepek/index/logo_light.svg" alt="Logo" class="m-0 p-0" style="height:50px">
                </a>
                <!-- Burger menu (csak kis felbontáson) -->
                <button class="navbar-toggler p-2 m-2" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar linkek -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <!-- Link csoport 1, balra igazítva alapból -->
                    <ul id="NavLink" class="navbar-nav">
                        <!-- Modellek -->
                        <li class="nav-item">
                            <div class="dropdown">
                                <a id="autoink" class="nav-link dropdown-toggle p-4" type="button" data-toggle="dropdown"><i class='fas fa-car'>&nbsp&nbsp</i>Modellek</a>
                                <div id="autoink_drop" class="dropdown-menu m-0 p-0" style="border: 0px; border-radius: 0;"> 
                                    <a class="dropdown-item p-4" href="autoink.php" style="color:white">
                                        
                                        <img src="./kepek/kategoria/osszes.png" class="img img-fluid mr-4">
                                        Összes
                                    </a>
                                    <a class="dropdown-item p-4" href="autoink.php?kategoria=Sport" style="color:white">
                                        <img src="./kepek/kategoria/sport.png" class="img mr-4">
                                        Sport
                                    </a>
                                    <a class="dropdown-item p-4" href="autoink.php?kategoria=Luxus" style="color:white">
                                        <img src="./kepek/kategoria/luxus.png" class="img mr-4">
                                        Luxus
                                    </a>
                                    <a class="dropdown-item p-4" href="autoink.php?kategoria=Cabrio" style="color:white">
                                        <img src="./kepek/kategoria/cabrio.png" class="img mr-4">
                                        Cabrio
                                    </a>
                                    <a class="dropdown-item p-4" href="autoink.php?kategoria=SUV" style="color:white">
                                        <img src="./kepek/kategoria/suv.png" class="img mr-4">
                                        SUV
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!-- Segítség -->
                        <li class="nav-item">
                            <a id="segitseg" class="nav-link p-4" href="segitseg.php" style="border: 0px solid red;"><i class='fas fa-info'>&nbsp&nbsp</i>Segítség</a>
                        </li>
                        <!-- Kapcsolat -->
                        <li class="nav-item">
                            <a id="elerhetoseg" class="nav-link p-4" href="elerhetoseg.php" style="border: 0px solid red;"><i class='fas fa-phone'>&nbsp&nbsp</i>Elérhetőség</a>
                        </li>
                    </ul>
                    <!-- Link csoport 2, jobbra igazítva -->
                    <ul id="NavLink" class="navbar-nav ml-auto">
                        <!-- Bejelentkezés (ha vendég a jogosultság) / Profil (minden más esetben) -->
                        <?php 
                            if (($_SESSION["jogosultsag"])=="vendeg") 
                            {
                                echo'<li class="nav-item pr-xl-2">';
                                echo "<a id='bejelentkezes' class='nav-link p-4' href='bejelentkezes.php' style='border: 0px solid red;'><i class='fas fa-user-plus'>&nbsp&nbsp</i>Bejelentkezés</a>";
                                echo'</li>';
                            }
                            else
                            {
                                echo'<li class="nav-item">';
                                echo "<a id='profil' class='nav-link p-4' href='profil.php' style='border: 0px solid red;'><i class='fas fa-user'>&nbsp&nbsp</i>".$_SESSION["belepett_felhasznalonev"]."</a>";
                                echo'</li>';
                            }
                        ?>
                        <!-- Kijelentkezés (ha nem vendég a jogosultság) -->
                        <?php 
                            if (($_SESSION["jogosultsag"])!="vendeg") 
                            {
                                echo '<li class="nav-item pr-xl-2">';
                                    echo "<a id='lel' class='nav-link p-4' href='bejelentkezes.php?kilepes=true' style='border: 0px solid red;'><i class='fas fa-user-minus'>&nbsp&nbsp</i>Kijelentkezés</a>";
                                echo '</li>';
                            }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<script type="text/javascript">
    //Autóink legördülő menu animációja
    $(document).ready(function()
    {
        $("#autoink").click(function()
        {
            if ($("#autoink_drop").is(":hidden")) 
            {
                $("#autoink_drop").slideDown();
            }
            else
            {
                $("#autoink_drop").slideUp();
            }
        });
    });
</script>