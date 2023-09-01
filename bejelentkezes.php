<?php 
    session_start(); 
    if (!isset($_SESSION["jogosultsag"])) 
    {
        $_SESSION["jogosultsag"]="vendeg";
        $_SESSION["belepett_id"]="";
        $_SESSION["belepett_felhasznalonev"]="";
    }
    $_SESSION["oldal"]="bejelentkezes";
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>Royal Rent - Bejelentkezés</title>
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
        <!-- Foglalást visszajelző üzenet -->
        <div class="container m-0 p-0 mt-4 mx-auto">
            <div class="row m-0 p-0" hidden id="info_div">
                <div class="col-12 m-0 p-2">
                    <div id="info" class="alert alert-danger m-0 p-4" hidden role="alert">
                    </div>
                </div>
            </div>
        </div>
        <div class="container m-0 p-0 mt-4 mx-auto">
			<div class="row m-0 p-0">
				<div class="col-12 m-0 p-2">
					<div id="info" class="alert alert-danger m-0 p-4" role="alert">
					    <span class="text-danger">A honlap csak oktatási céllal jött létre. Nem valódi. Nem folytat kereskedelmi tevékenységet. Ne küldjön pénzt sehova.</span>
					</div>
				</div>
			</div>
        </div>
        <!-- Bejelentkezés, regisztráció -->
        <div class="container m-0 p-0 mt-4 mx-auto">
            <div class="row m-0 p-0">
                <!-- Bejelentkezés -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h4>Bejelentkezés</h4></legend>
                        <form method="POST" name="form_bejelentkezes" id="form_bejelentkezes" onsubmit="return bejelentkezes_ellenorzes()">
                            <div class="form-group">
                                <label for="form_felhasznalonev_bej">Felhasználónév:</label>
                                <input class="form-control" type="text" name="form_felhasznalonev_bej" id="form_felhasznalonev_bej" required>
                            </div>
                            <div class="form-group">
                                <label for="form_jelszo_bej">Jelszó:</label>
                                <input class="form-control" type="password" name="form_jelszo_bej" id="form_jelszo_bej" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="action" value="form_bejelentkezes_submit_action">
                                <button class="form-control btn LilaGomb" type="submit" name="form_bejelentkezes_submit" id="form_bejelentkezes_submit"><i class='fas fa-sign-in-alt'>&nbsp&nbsp</i>Bejelentkezés</button>
                            </div>
                        </form>
                    </fieldset>
                </div>
                <!-- Regisztráció -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h4>Regisztráció</h4></legend>
                        <form method="POST" name="form_regisztracio" id="form_regisztracio" onsubmit="return regisztracio_ellenorzes()">
                            <div class="form-group">
                                <label for="form_felhasznalonev_reg">Felhasználónév:</label>
                                <input class="form-control" type="text" name="form_felhasznalonev_reg" id="form_felhasznalonev_reg" required required>
                            </div>
                            <div class="form-group">
                                <label for="form_jelszo_reg">Jelszó:</label>
                                <input class="form-control" type="password" name="form_jelszo_reg" id="form_jelszo_reg" required>
                            </div>
                            <div class="form-group">
                                <label for="form_email">E-mail:</label>
                                <input class="form-control" type="email" name="form_email" id="form_email" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="action" value="form_regisztracio_submit_action">
                                <button class="form-control btn LilaGomb" type="submit" name="form_regisztracio_submit" id="form_regisztracio_submit" class="btn LilaGomb"><i class='fas fa-file-signature'>&nbsp&nbsp</i>Regisztráció</button>
                            </div>
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
    function bejelentkezes_ellenorzes()
    {
        var nev = document.forms["form_bejelentkezes"]["form_felhasznalonev_bej"].value;
        var jelszo = document.forms["form_bejelentkezes"]["form_jelszo_bej"].value;
        if (nev=="") 
        {
            alert("A felhasználónév mező kitöltése kötelező");
            return false;
        }
        else if (jelszo=="") 
        {
            alert("A jelszó mező kitöltése kötelező");
            return false;
        }
    }
    function regisztracio_ellenorzes()
    {
        var nev = document.forms["form_regisztracio"]["form_felhasznalonev_reg"].value;
        var jelszo = document.forms["form_regisztracio"]["form_jelszo_reg"].value;
        var email = document.forms["form_regisztracio"]["form_email"].value;
        if (nev=="") 
        {
            alert("A felhasználónév mező kitöltése kötelező");
            return false;
        }
        else if (jelszo=="") 
        {
            alert("A jelszó mező kitöltése kötelező");
            return false;
        }
        else if (email=="")
        {
            alert("Az e-mail mező kitöltése kötelező")
            return false;
        }
    }
</script>
<?php
    include ("adatbazisKapcsolodas.php");
    if (isset($_POST["action"])) 
    {
        if ($_POST["action"]=="form_bejelentkezes_submit_action") 
        {
            //akkor lépünk be ide ha legnyomtunk egy submit gombot és az a form_bejelentkezes_submit_action submit gomb volt
            //itt egyesével kell ellenőrizni hogy az egyes bemeneti mezők be lettek-e állitva és ha be lettek állitva akkor NEM üresek-e.( számoknál ez speciális ott az isnumeric() fv-t használjuk. máshol lehet az !empty() fv-t használni )
            //hibaüzeneteim
            if (!(isset($_POST["form_felhasznalonev_bej"])&&!empty($_POST["form_felhasznalonev_bej"]))) 
            {
                echo "A név mező kitöltése kötelező<br/>";
            }
            if (!(isset($_POST["form_jelszo_bej"])&&!empty($_POST["form_jelszo_bej"]))) 
            {
                echo "A jelszó mező kitöltése kötelező<br/>";
            }
            //ha minden jól meg lett adva:
            if ((isset($_POST["form_felhasznalonev_bej"])&&!empty($_POST["form_felhasznalonev_bej"]))&&
                (isset($_POST["form_jelszo_bej"])&&!empty($_POST["form_jelszo_bej"]))) 
            {
                //Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                //Check connection
                if (!$conn) 
                {
                    die("Connection failed: " . mysqli_connect_error());
                }
                //MySQL lekérdezés prepare
                $stmt = $conn->prepare("
                    SELECT `id`, `felhasznalonev`, `jelszo`, `e-mail`, `jogosultsag`, `aktiv` 
                    FROM `felhasznalok` 
                    WHERE felhasznalonev LIKE (?) AND aktiv=1
                ");
                //adatok tisztítása
                $clean = htmlspecialchars($_POST["form_felhasznalonev_bej"]);
                //paraméteres értékátadás
                $stmt->bind_param("s", $clean);
                //lekérdezés
                $stmt->execute();
                //eredmény
                $result = $stmt->get_result();
                if (mysqli_num_rows($result) > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        if(password_verify($_POST["form_jelszo_bej"], $row["jelszo"]))
                        {
                            echo "Sikeres bejelentkezés";
                            $_SESSION["jogosultsag"]=$row["jogosultsag"];
                            $_SESSION["belepett_id"]=$row["id"];
                            $_SESSION["belepett_felhasznalonev"]=$row["felhasznalonev"];
                            echo "<script>window.location.replace('index.php')</script>";
                        }
                        else
                        {
                            echo "<script>
                            $(document).ready(function(){
                                var hiba = 'Hibás jelszó!'
                                $('#info').text(hiba);
                                $('#info').removeAttr('hidden');
                                $('#info_div').removeAttr('hidden');
                            });
                            </script>";
                        }
                    }
                }
                else 
                {
                    echo "<script>
                        $(document).ready(function(){
                            var hiba = 'Nem létező vagy kitiltott felhasználó!'
                            $('#info').text(hiba);
                            $('#info').removeAttr('hidden');
                            $('#info_div').removeAttr('hidden');
                        });
                        </script>";
                    //echo "Hibás felhasználónév vagy jelszó";
                }
                mysqli_close($conn);
            }
        }
        else if ($_POST["action"]=="form_regisztracio_submit_action") 
        {
            //akkor lépünk be ide ha legnyomtunk egy submit gombot és az a form_regisztracio_submit_action submit gomb volt
            //itt egyesével kell ellenőrizni hogy az egyes bemeneti mezők be lettek-e állitva és ha be lettek állitva akkor NEM üresek-e.( számoknál ez speciális ott az isnumeric() fv-t használjuk. máshol lehet az !empty() fv-t használni )
            //hibaüzeneteim
            if (!(isset($_POST["form_felhasznalonev_reg"])&&!empty($_POST["form_felhasznalonev_reg"]))) 
            {
                echo "A név mező kitöltése kötelező<br/>";
            }
            if (!(isset($_POST["form_jelszo_reg"])&&!empty($_POST["form_jelszo_reg"]))) 
            {
                echo "A jelszó mező kitöltése kötelező<br/>";
            }
            if (!(isset($_POST["form_email"])&&!empty($_POST["form_email"]))) 
            {
                echo "Az e-mail mező kitöltése kötelező<br/>";
            }
            //ha minden jól meg lett adva:
            if ((isset($_POST["form_felhasznalonev_reg"])&&!empty($_POST["form_felhasznalonev_reg"]))&&
                (isset($_POST["form_jelszo_reg"])&&!empty($_POST["form_jelszo_reg"]))&&
                (isset($_POST["form_email"])&&!empty($_POST["form_email"]))) 
            {
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) 
                {
                    die("Connection failed: " . $conn->connect_error);
                }
                //Van már ilyen felhasználónév vagy e-mail?
                $stmt = $conn->prepare("
                SELECT `id` FROM `felhasznalok` 
                WHERE `felhasznalonev` LIKE ? OR `e-mail` LIKE ?
                ");
                //adatok tisztítása
                $clean = htmlspecialchars($_POST["form_felhasznalonev_reg"]);
                $clean2 = htmlspecialchars($_POST["form_email"]);
                //paraméteres értékátadás
                $stmt->bind_param("ss", $clean,$clean2);
                //lekérdezés
                $stmt->execute();
                //eredmény
                $result = $stmt->get_result();
                if ($result->num_rows > 0)
                {
                    echo "<script>
                    $(document).ready(function(){
                        var hiba = 'Ez a felhasználónév / e-mail már foglalt!'
                        $('#info').text(hiba);
                        $('#info').removeAttr('hidden');
                        $('#info_div').removeAttr('hidden');
                    });
                    </script>";
                }
                else
                {
                    //ha minden rendben akkor megtörténik a regisztráció
                    //MySQL lekérdezés prepare
                    $stmt = $conn->prepare("
                    INSERT INTO `felhasznalok`(`id`, `felhasznalonev`, `jelszo`, `e-mail`, `jogosultsag`, `aktiv`) 
                    VALUES 
                        (
                        NULL,
                        ?,
                        ?,
                        ?,
                        'felhasználó',
                        '1'
                        )
                    ");
                    if ($stmt !== FALSE) 
                    {
                        //adatok tisztítása
                        $cleanFelh = htmlspecialchars($_POST["form_felhasznalonev_reg"]);
                        $cleanJelszo = password_hash($_POST["form_jelszo_reg"], PASSWORD_DEFAULT);
                        $cleanEmail = htmlspecialchars($_POST["form_email"]);
                        //paraméteres értékátadás
                        $stmt->bind_param("sss", $cleanFelh, $cleanJelszo, $cleanEmail);
                        //lekérdezés
                        $stmt->execute();
                        echo "<script>
                        $(document).ready(function(){
                            var hiba = 'Sikeres regisztráció!'
                            $('#info').text(hiba);
                            $('#info').toggleClass('alert-danger');
                            $('#info').toggleClass('alert-success');
                            $('#info').removeAttr('hidden');
                            $('#info_div').removeAttr('hidden');
                        });
                        </script>";
                    }
                    else
                    {
                        echo "Sikertelen regisztráció.";
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                $conn->close();
            }
        }
    }
?>