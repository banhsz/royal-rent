<?php 
	session_start(); 
	if (!isset($_SESSION["jogosultsag"])) 
	{
		$_SESSION["jogosultsag"]="vendeg";
		$_SESSION["belepett_id"]="";
		$_SESSION["belepett_felhasznalonev"]="";
	}
	$_SESSION["oldal"]="autoink";
?>
<!DOCTYPE html>
<html lang="hu">
	<head>
		<title>Royal Rent - Autóink</title>
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
	<body>
		<!-- Menü -->
		<?php include ("navbar.php"); ?>
		<!-- Szűrő megjelenító legördülő menü -->
		<div class="container m-0 p-0 mt-4 mx-auto">
			<div class="row m-0 p-0">
				<div class="col-sm-12 m-0 p-2" id="szuro_megjelenites_div">
					<button type="button" value="Szűrők megjelenítése" class="btn LilaGomb btn-block" data-toggle="collapse" href="#szurok" role="button" id="szuro_megjelenites">
						<i class='fas fa-sort-down'>&nbsp&nbsp</i>Szűrők megjelenítése
					</button>
				</div>
				<div class="col-sm-12 m-0 p-2" id="szuro_elrejtes_div" hidden="true">
					<button type="button" value="Szűrők elrejtése" class="btn LilaGomb btn-block" data-toggle="collapse" href="#szurok" role="button" id="szuro_elrejtes">
						<i class='fas fa-sort-up'>&nbsp&nbsp</i>Szűrők elrejtése
					</button>
				</div>
				<div class="col-sm-12 m-0 p-2" id="szurok_torlese_div" hidden="true">
					<button type="button" value="Szűrők törlése" class="btn btn-dark btn-block" id="szurok_torlese" role="button">
						<i class='fas fa-trash-alt'>&nbsp&nbsp</i>Szűrők törlése
					</button>
				</div>
			</div>
		</div>
		<!-- Szűrők -->
		<div class="container m-0 p-0 mx-auto collapse" id="szurok">
            <div class="row m-0 p-0">
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 m-0 p-2"> 
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h6 class="">Bérlési idő (max 2 hónap)</h6></legend>
                        <form>
                            <div class="form-group">
                                <label for="from">Első nap:</label>
                                <input class="form-control" type="text" id="from" name="from" readonly placeholder="Időpont választása...">
                            </div>
                            <div class="form-group">
                                <label for="from">Utolsó nap:</label>
                                <input class="form-control" type="text" id="to" name="to" readonly placeholder="Időpont választása...">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-dark btn-block" type="button" id="alaphelyzet" value="Dátumok törlése">
                                    <i class='fas fa-trash-alt'>&nbsp&nbsp</i>Dátumok törlése
                                </button>
                            </div>
                        </form>
                    </fieldset>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h6>Márka</h6></legend>
                        <form>
                            <div class="form-group">
                                <select id="markak" class="form-control">
                                    <option>Mindegyik</option>
                                </select>
                            </div>
                        </form>
                    </fieldset>
                    <fieldset class="border m-0 p-2">
                        <legend  class="w-auto"><h6>Férőhely</h6></legend>
                        <form>
                            <div class="form-group">
                                <select id="ferohely" class="form-control">
                                    <option>Mindegy</option>
                                </select>
                            </div>
                        </form>
                    </fieldset>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend  class="w-auto"><h6>Motor</h6></legend>
                            <div class="form-group">
                                <select id="uzemanyag" class="form-control">
                                    <option>Mindegy</option>
                                </select>
                            </div>
                    </fieldset>
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h6>Váltó</h6></legend>
                        <form>
                            <div class="form-group">
                                <select id="valto" class="form-control">
                                    <option>Mindegy</option>
                                </select>
                            </div>
                        </form>
                    </fieldset>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h6>Hajtás</h6></legend>
                        <form>
                            <div class="form-group">
                                <select id="hajtas" class="form-control">
                                    <option>Mindegy</option>
                                </select>
                            </div>
                        </form>
                    </fieldset>
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h6>Szín</h6></legend>
                        <form>
                            <div class="form-group">
                                <select id="szin" class="form-control">
                                    <option>Mindegy</option>
                                </select>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
            <div class="row m-0 p-0">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h6><span class="fas fa-sort">&nbsp</span>Rendezés</h6></legend>
                        <form>
                            <div class="form-group">
                                <select id="rendezes" class="form-control">
                                    <option>Név szerint</option>
                                    <option>Ár szerint csökkenő</option>
                                    <option>Ár szerint növekvő</option>
                                </select>
                            </div>
                        </form>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-63 col-xl-6 m-0 p-2">
                    <fieldset class="border m-0 p-2">
                        <legend class="w-auto"><h6><span class="fas fa-search">&nbsp</span>Keresés</h6></legend>
                        <form>
                            <div class="form-group">
                                <input id="kereses" class="form-control" type="text" placeholder="Keresés..." onkeypress="if (event.keyCode == 13) { return false;}">
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
		</div>
		<!-- Kocsik, ez a fő rész (azért üres mert majd a JQuery függvény tölti fel ezt a részt) -->
		<div class="container m-0 p-0 mt-4 mx-auto">
			<div id="sorok" class="row m-0 p-0">
			</div>
		</div>
		<!-- Footer -->
		<?php include ("footer.php"); ?>
	</body>
</html>
<script>
	/*üres jquery fuggveny minta
	$(document).ready(function(){
		$("").click(function(){

		});
	});
    */
	//Függvvény, amivel GET változókat lehet kiolvasni
	$.urlParam = function(name)
	{
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
		return results[1] || 0;
	}
	//Szám formázó függvény
	function szamFormazo(x) 
	{
   	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}
	//Az oldal betöltődésekor történő adatbázis lekérdezés
	$(document).ready(function()
	{
		//ha volt a GET-be szűrő akkor azt elküldjük a fetch.php-nak
		let searchParams = new URLSearchParams(window.location.search);
		var kat;
		if (searchParams.has("kategoria"))
		{
			kat = $.urlParam("kategoria");
			//console.log(kat);
		}
		else
		{
			kat = "";
		}
		$.post("query_autok_kategoria.php",
        {
            kategoria:JSON.stringify(kat)
        },
        function(data)
        {
            a = JSON.parse(data);
            //console.log(a);
            //Ez a rész kiír minden kocsit formázva a "sorok"-idjű div-be
            for (i = 0; i < a.length; i++)
            {
                var txt1="";
                txt1+='<div class="col-12 col-md-6 col-lg-4 m-0 p-2" id=id'+i+'>'
                    txt1+='<div class="card">'
                        txt1+='<div class="card-header m-0 p-0">'
                            txt1+='<a href="autoProfil.php?id='+a[i].id+'"><img src="./kepek/autok/'+a[i].id+'/thumbnail/thumbnail.png" class="img img-fluid w-100" alt=""></a>'
                        txt1+='</div>'
                        txt1+='<div class="card-body">'
                            txt1+='<h3 class="LilaSzoveg font-weight-bold">'+a[i].marka+" "+a[i].tipus+'</h3>'
                            txt1+='<p>'+a[i].teljesitmeny+" LE, "+a[i].ferohely+" személyes, "+a[i].szin+" színű, "+a[i].motortipus+" motor, "+a[i].sebessegvalto+" váltó, "+a[i].hajtas+" hajtás"+'</p>'
                        txt1+='</div>'
                        txt1+='<div class="card-footer border-0 bg-white">'
                            txt1+="<p class='LilaSzoveg font-weight-bold'>"+szamFormazo(a[i].ar)+" Ft&nbsp/&nbspnap"+"</p>"
                            txt1+='<a class="btn btn-block LilaGomb" href="autoProfil.php?id='+a[i].id+'"><i class="fas fa-file-signature">&nbsp&nbsp</i>Foglalás</a>'
                        txt1+='</div>'
                    txt1+='</div>'
                txt1+='</div>'
                $("#sorok").append(txt1);
            }
            //Ez feltölti a szűrő legördülő menük elemeit
            var brands = [];
            var uzemanyag = [];
            var hajtas = [];
            var valto = [];
            var ferohely = [];
            var szin = [];
            for (i = 0; i < a.length; i++)
            {
                if (!(brands.includes(a[i].marka))) 
                {
                    brands.push(a[i].marka);
                    var help ="<option value='"+a[i].marka+"'>"+a[i].marka+"</option>";
                    $("#markak").append(help);
                }
                if (!(uzemanyag.includes(a[i].motortipus))) 
                {
                    uzemanyag.push(a[i].motortipus);
                    var help ="<option>"+a[i].motortipus+"</option>";
                    $("#uzemanyag").append(help);
                }
                if (!(hajtas.includes(a[i].hajtas))) 
                {
                    hajtas.push(a[i].hajtas);
                    var help ="<option>"+a[i].hajtas+"</option>";
                    $("#hajtas").append(help);
                }
                if (!(valto.includes(a[i].sebessegvalto))) 
                {
                    valto.push(a[i].sebessegvalto);
                    var help ="<option>"+a[i].sebessegvalto+"</option>";
                    $("#valto").append(help);
                }
                if (!(ferohely.includes(a[i].ferohely))) 
                {
                    ferohely.push(a[i].ferohely);
                    var help ="<option>"+a[i].ferohely+"</option>";
                    $("#ferohely").append(help);
                }
                if (!(szin.includes(a[i].szin))) 
                {
                    szin.push(a[i].szin);
                    var help ="<option>"+a[i].szin+"</option>";
                    $("#szin").append(help);
                }
            }
            //keresek kategoria GET-et
            let searchParams = new URLSearchParams(window.location.search);
            //ha volt a linkben kategoria GET
            if (searchParams.has("kategoria"))
            {
                var kat = $.urlParam("kategoria");
                //ha érvényes érték van benne
                if (kat == "Sport" || kat == "Luxus" || kat == "Cabrio" || kat == "SUV") 
                {
                    kat += " modellek";
                }
                //ha csak trollság van benne
                else
                {
                    kat = "Összes modell";
                }
            }
            //ha nemvolt akkor minden autó megjelenik
            else
            {
                kat = "Összes modell";
            }
            $("#kategoria").text(kat);
        });
        //Kiszedi azokat a foglalásokat, amelyeket fel fogunk használni ahhoz, hogy a szűrőben megadott dátumok alapján elrejtsük azokat a kocsikat amik abban az időtartamban foglaltak
        $.post("query_foglalasok_mind.php",
        {
        },
        function(data)
        {
            foglalasok = JSON.parse(data);
            //console.log(foglalasok);
        });
	});
	//Szűrők változásakor kocsik elrejtése
	$(document).ready(function()
    {
		//Change az összes miatt, keyup a keresésnél minden karakter beütés után
		$("#szurok").on("change keyup",function()
        {
			var szuroTomb = 
			{
				elsonap : $("#from").val(),
				utolsonap : $("#to").val(),
				marka : $("#markak").find(":selected").text(),
				uzemanyag: $("#uzemanyag").find(":selected").text(),
				ferohely: $("#ferohely").find(":selected").text(),
				valto: $("#valto").find(":selected").text(),
				hajtas: $("#hajtas").find(":selected").text(),
				szin: $("#szin").find(":selected").text(),
				kereses: $("#kereses").val()
			};
			//Elrejtünk midnent, ami nem felel meg a kritériumoknak
			for (i = 0; i < a.length; i++)
			{
				help = "#id"+i;
				if ((a[i].marka==szuroTomb["marka"] || szuroTomb["marka"]=="Mindegyik")&&
					(a[i].motortipus==szuroTomb["uzemanyag"] || szuroTomb["uzemanyag"]=="Mindegy")&&
					(a[i].ferohely==szuroTomb["ferohely"] || szuroTomb["ferohely"]=="Mindegy")&&
					(a[i].sebessegvalto==szuroTomb["valto"] || szuroTomb["valto"]=="Mindegy")&&
					(a[i].hajtas==szuroTomb["hajtas"] || szuroTomb["hajtas"]=="Mindegy")&&
					(a[i].szin==szuroTomb["szin"] || szuroTomb["szin"]=="Mindegy")&&
					(KeresesnekMegfelel(a,i)&&
					IdopontnakMegfelel(a,i,szuroTomb))
					)
				{
					$(help).show();
				}
				else
				{
					$(help).hide();
				}
			}
			//Segédfüggvény a kereséshez
			function KeresesnekMegfelel(a,id)
			{
				//Ha számot ir be a keresőbe és nincs toString() akkor bugos
				if (a[id].marka.toString().toUpperCase().includes(szuroTomb["kereses"].toUpperCase())||
					a[id].tipus.toString().toUpperCase().includes(szuroTomb["kereses"].toUpperCase())||
					a[id].kategoria.toString().toUpperCase().includes(szuroTomb["kereses"].toUpperCase())||
					a[id].motortipus.toString().toUpperCase().includes(szuroTomb["kereses"].toUpperCase())||
					a[id].hajtas.toString().toUpperCase().includes(szuroTomb["kereses"].toUpperCase())||
					a[id].sebessegvalto.toString().toUpperCase().includes(szuroTomb["kereses"].toUpperCase())||
					a[id].szin.toString().toUpperCase().includes(szuroTomb["kereses"].toUpperCase())
					) 
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			//Segédfüggvény a dátumhoz
			function IdopontnakMegfelel(a,i,szuroTomb)
			{
				//ha nincs időpont beállítva akkor return true
				if (!((szuroTomb["elsonap"]!="") && (szuroTomb["utolsonap"]!=""))) 
				{
					return true;
				}
				else
				{
					var joAzIdopont=true;
					//ha van beirva akkor
					//azt fogjuk csinálni hogy az a[i] az egy autó, végigmegyünk a foglalásokon (foglalas)
					var j=0;
					while(joAzIdopont && j<foglalasok.length)
					{
						//és ha találunk olyat aminél az a[i].id és a foglalás autoid egyezik
						if (a[i].id == foglalasok[j].auto_id) 
						{
							//ott megnézzük hogy a foglalás.elsőnap - utolsónap és a szurotomb.elso - utolsónak van e metszete
							var foglalasTombNapok = new Array();
							var szuroTombNapok = new Array();
							var szuroTombElso = new Date(szuroTomb["elsonap"]);
							var szuroTombUtolso = new Date(szuroTomb["utolsonap"]);
							var seged = new Date(szuroTomb["elsonap"]);
							while(seged<=szuroTombUtolso)
							{
								szuroTombNapok.push(new Date(seged));

								seged.setDate(seged.getDate()+1);
							}
							//console.log(szuroTombNapok);
							var foglalasTombElso = new Date(foglalasok[j].elsonap);
							var foglalasTombUtolso = new Date(foglalasok[j].utolsonap);
							var seged = new Date(foglalasok[j].elsonap);
							while(seged<=foglalasTombUtolso)
							{
								foglalasTombNapok.push(new Date(seged));
								seged.setDate(seged.getDate()+1);
							}
							//console.log(foglalasTombNapok);
							//metszet keresése
							var k=0;
							while (joAzIdopont==true && k<foglalasTombNapok.length)
							{
								var l=0;
								while(joAzIdopont==true && l<szuroTombNapok.length)
								{
									//console.log(foglalasTombNapok[k]);
									//console.log(szuroTombNapok[l]);
									if (foglalasTombNapok[k].getTime()==szuroTombNapok[l].getTime()) 
									{
										//console.log("itt nemjo"+" "+foglalasTombNapok[k].getTime()+" "+szuroTombNapok[l].getTime());
										joAzIdopont=false;
									}
									l++;
								}
								k++;
							}
						}
						j++;
					}
					return joAzIdopont;
				}
				//console.log(foglalasok);
			}
			//console.log(szuroTomb);
		});
	});
	//Rendezés
	$(document).ready(function()
    {
		$("#rendezes").change(function()
        {
			for (i = 0; i < a.length; i++)
			{
				help = "#id"+i;
				$(help).remove();
			}
			if ($("#rendezes").find(":selected").text()=="Ár szerint növekvő") 
			{
				a.sort((a,b)=>parseInt(a.ar)-parseInt(b.ar));
			}
			else if ($("#rendezes").find(":selected").text()=="Ár szerint csökkenő") 
			{
				a.sort((a,b)=>parseInt(b.ar)-parseInt(a.ar));
			}
			else if ($("#rendezes").find(":selected").text()=="Név szerint") 
			{
				a.sort((a,b)=>(a.marka > b.marka) - (a.marka < b.marka));
			}
			for (i = 0; i < a.length; i++)
			{
				var txt1="";
				txt1+='<div class="col-12 col-md-6 col-lg-4 m-0 p-2" id=id'+i+'>'
					txt1+='<div class="card">'
						txt1+='<div class="card-header m-0 p-0">'
							txt1+='<a href="autoProfil.php?id='+a[i].id+'"><img src="./kepek/autok/'+a[i].id+'/thumbnail/thumbnail.png" class="img img-fluid w-100" alt=""></a>'
						txt1+='</div>'
						txt1+='<div class="card-body">'
							txt1+='<h3 class="LilaSzoveg font-weight-bold">'+a[i].marka+" "+a[i].tipus+'</h3>'
							txt1+='<p>'+a[i].teljesitmeny+" LE, "+a[i].ferohely+" személyes, "+a[i].szin+" színű, "+a[i].motortipus+" motor, "+a[i].sebessegvalto+" váltó, "+a[i].hajtas+" hajtás"+'</p>'
						txt1+='</div>'
						txt1+='<div class="card-footer border-0 bg-white">'
							txt1+="<p class='LilaSzoveg font-weight-bold'>"+szamFormazo(a[i].ar)+" Ft&nbsp/&nbspnap"+"</p>"
							txt1+='<a class="btn btn-block LilaGomb" href="autoProfil.php?id='+a[i].id+'"><i class="fas fa-file-signature">&nbsp&nbsp</i>Foglalás</a>'
						txt1+='</div>'
					txt1+='</div>'
				txt1+='</div>'
			  	$("#sorok").append(txt1);
			}
		});
	});
	//Szűrők,Rendezés,Keresés alaphelyzetbe állítása
	$(document).ready(function()
    {
		$("#szurok_torlese").click(function()
        {
			//dátum alaphelyzetbe állitás, ezt már korábban megcsináltam
			$("#alaphelyzet").trigger('click');
			//tobbi szuro alaphelyzetbe
			$("#markak").val("Mindegyik");
			$("#uzemanyag").val("Mindegy");
			$("#ferohely").val("Mindegy");
			$("#valto").val("Mindegy");
			$("#hajtas").val("Mindegy");
			$("#rendezes").val("Név szerint");
			$("#szin").val("Mindegy");
			$("#kereses").val("");
			//magától nem hivja meg
			$("#szurok").trigger('change');
			//ezt se
			$("#rendezes").trigger('change');
		});
	});
	//Ez a függvény kezeli a szürő megjelenítő / elrejtő gombot
	$(document).ready(function()
	{
		$("#szuro_megjelenites").click(function()
		{
			$('#szuro_megjelenites_div').attr('hidden',true);
			$("#szuro_elrejtes_div").removeAttr('hidden');
			$('#szurok_torlese_div').removeAttr('hidden');
		});
		$("#szuro_elrejtes").click(function()
		{
			$('#szuro_megjelenites_div').attr('hidden',true);
			$("#szuro_elrejtes_div").removeAttr('hidden');
			$('#szurok_torlese_div').removeAttr('hidden');
			$('#szuro_megjelenites_div').removeAttr('hidden');
			$("#szuro_elrejtes_div").attr('hidden',true);
			$('#szurok_torlese_div').attr('hidden',true);
		});
	});
	//Ezek mind a datepicker függvényei:
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
            yearSuffix: ''
        };
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
	  		//magától nem akarja meghívni ezt amikor nullázom az értékeket úgyhogy manuálisan kell.
	  		$('#szurok').trigger('change');
	  	});
  	});
</script>