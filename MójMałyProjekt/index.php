<?php 
session_start();
if (!isset($order)){
	if (isset($_SESSION['order'])) $order=$_SESSION['order'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF=8">
<title>Strona Główna</title>
<link rel="stylesheet" type="text/css" href="css.css"/>
<style type=text/css>
body
{
	font-family:"Comic Sans MS", "Comic Sans";
}
.tab td
{
	border-style: solid;
	border-color: #00004d;
	border-width: 0px 0px 5px 0px;
}
.td2
{
	background-color: blue;
}
.td0komentarz
{
	background-color: #141414;
	width:200px;
	height:30px;
	font-size:12px;
	overflow:auto;
}
.td2komentarz
{
	background-color: #1414ff;
	width:200px;
	height:30px;
	font-size:12px;
	overflow:auto;
}
.infotd
{
	border-width:2px;  
    border-style:inset;
	border-color:#00004d;
}
.sortowanie
{
	border-color:cyan;
	border-style:ridged;
	border-width:3px;
}
.sortowanie:hover
{
	background-color:#008080;
}
.sub
{
	font-size:20px;
	background-color:#00004d;
	border-color:cyan;
	border-style:ridged;
	border-width:5px;
}
.sub:hover
{
	background-color:#008080;
}
</style>
</head>
<body>
	<div id="box">
		<div id="baner"><!--Formularze pomocnicze-->
			<form method=POST action=index.php>
				<h2><input class=sub type=submit value='Odśwież stronę'></h2>
			</form>
			<form method=POST action=index.php>
				<h2 style="float:left; position:absolute; top:10px;"><input class=sub name=czcionka type=submit value='Powiększ czcionkę strony'></h2>
			</form>
			<?php //Powiększenie czcionki strony
			if(isset($_POST['czcionka'])){
				echo "<style type=text/css>body{font-size:24px;}</style>";
			}
			?>
			<form method=POST action=index.php><!--Formularz szukający-->
				<table style="text-align:center;">
					<tr><td><h2><input type=submit value='Szukaj:' name=szukaj class=sub></h2></td></tr>
					<tr><td>Nazwa produktu</td> <td>Cena</td> <td>Jednostka ceny</td> <td>Jednostka towaru</td> <td>Typ</td> <td>Sklep</td></tr>
					<tr><td><input name=nazwa_produktu_szukaj></td> <td><input name=cena_szukaj></td> <td><input name=jednostka_ceny_szukaj></td> <td><input name=jednostka_towaru_szukaj></td> <td><input name=typ_szukaj></td> <td><input name=sklep_szukaj></td></tr>
				</table>
			</form>
			<div style="float:right;">
			<table><tr><td>Zalogowano jako</td></tr>
			<tr><td><?php
			if(isset($_SESSION['login'])) $_SESSION['login'];
			else echo "admin";
			?></td></tr>
			</table>
			</div>
		</div>
	
		<div id="pL"><!--Połączenie z bazą-->
			<?php
				$host="localhost";
				$db_user="root";
				$db_pass="";
				$db_name="vorwi_vorwi";
				require_once "connect.php";
				$c=new mysqli($host, $db_user, $db_pass, $db_name);
				if (!$c){
					echo "Błąd".mysqli_error();
				}
				$c->set_charset('utf8mb4');
				//ORDER BY
				if(isset($_POST['ID_produktu_order'])) {$order='ID_produktu'; echo "<style type=text/css>#ID_produktu_order{background-color:#008080;}</style>";}
				elseif(isset($_POST['nazwa_produktu_order'])) {$order='nazwa_produktu'; echo "<style type=text/css>#nazwa_produktu_order{background-color:#008080;}</style>";}
				elseif(isset($_POST['cena_order'])) {$order='cena'; echo "<style type=text/css>#cena_order{background-color:#008080;}</style>";}
				elseif(isset($_POST['jednostka_ceny_order'])) {$order='jednostka_ceny'; echo "<style type=text/css>#jednostka_ceny_order{background-color:#008080;}</style>";}
				elseif(isset($_POST['jednostka_towaru_order'])) {$order='jednostka_towaru'; echo "<style type=text/css>#jednostka_towaru_order{background-color:#008080;}</style>";}
				elseif(isset($_POST['typ_order'])) {$order='typ'; echo "<style type=text/css>#typ_order{background-color:#008080;}</style>";}
				elseif(isset($_POST['sklep_order'])) {$order='sklep'; echo "<style type=text/css>#sklep_order{background-color:#008080;}</style>";}
				elseif(!isset($order)) $order='ID_produktu';
				$_SESSION['order']=$order;
			?>
			<form method=POST action=index.php><!--Formularz dodający-->
				<h2><input type=submit value='Dodaj produkt:' name=dodaj class=sub></h2>
				<table>
					<tr>	<td class=lewetd>Nazwa produktu:</td><td class=prawetd><input type=text name=nazwa_produktu_dodaj value=kajzerka> </td>	</tr>
					<tr>	<td class=lewetd>Cena:</td><td class=prawetd><input type=text name=cena_dodaj value="0.5"> </td>	</tr>
					<tr>	<td class=lewetd>Jednostka ceny:</td><td class=prawetd><input type=text name=jednostka_ceny_dodaj value=zł> </td>	</tr>
					<tr>	<td class=lewetd>Jednostka towaru:</td><td class=prawetd><input type=text name=jednostka_towaru_dodaj value=szt.> </td>	</tr>
					<tr>	<td class=lewetd>Typ:</td><td class=prawetd><input type=text name=typ_dodaj value=pieczywo> </td>	</tr>
					<tr>	<td class=lewetd>Sklep:</td><td class=prawetd><input type=text name=sklep_dodaj value='Piekarnia Tyrolska'> </td>	</tr>
					<tr>	<td class=lewetd>Komentarz:</td><td class=prawetd><textarea name=komentarz_dodaj rows="4" cols="25">Informacje które mogą być istotne</textarea></td>	</tr>
				</table>
			</form>
			<?php
				//Dodaj produkt
				if(isset($_POST['dodaj'])){
					$nazwa_produktu=$_POST["nazwa_produktu_dodaj"];
					$cena=$_POST["cena_dodaj"];
					$jednostka_ceny=$_POST["jednostka_ceny_dodaj"];
					$jednostka_towaru=$_POST["jednostka_towaru_dodaj"];
					$typ=$_POST["typ_dodaj"];
					$sklep=$_POST["sklep_dodaj"];
					$komentarz=$_POST["komentarz_dodaj"];
					$czy_istnieje=$c->query("SELECT * FROM produkt WHERE nazwa_produktu='$nazwa_produktu' AND typ='$typ' AND sklep='$sklep' AND jednostka_towaru='$jednostka_towaru'");
					$row=mysqli_fetch_array($czy_istnieje);
					if(!empty($row['nazwa_produktu']) AND !empty($row['typ']) AND !empty($row['sklep']) AND !empty($row['jednostka_towaru'])){
						echo "<span style='color:red;'>Produkt który próbujesz dodać istnieje już w bazie o numerze ID=".$row['ID_produktu']."</span>";
					}
					else{
						$c->query("INSERT INTO produkt (nazwa_produktu,cena,jednostka_ceny,jednostka_towaru,typ,sklep,komentarz) VALUES ('$nazwa_produktu','$cena','$jednostka_ceny','$jednostka_towaru','$typ','$sklep','$komentarz')");
						$dodany_produkt=$c->query("SELECT * FROM produkt WHERE nazwa_produktu='$nazwa_produktu' AND typ='$typ' AND sklep='$sklep' AND jednostka_towaru='$jednostka_towaru'");
						$row=mysqli_fetch_array($dodany_produkt);
						echo "<span style='color:red;'>Dodano produkt:</span>
						<table>
							<tr>	<td class=lewetd>ID produktu:</td><td class=infotd>".$row['ID_produktu']."</td>	</tr>
							<tr>	<td class=lewetd>Nazwa produktu:</td><td class=infotd>".$row['nazwa_produktu']."</td>	</tr>
							<tr>	<td class=lewetd>Cena:</td><td class=infotd>".$row['cena']."</td>	</tr>
							<tr>	<td class=lewetd>J.C.:</td><td class=infotd>".$row['jednostka_ceny']."</td>	</tr>
							<tr>	<td class=lewetd>J.T.:</td><td class=infotd>".$row['jednostka_towaru']."</td>	</tr>
							<tr>	<td class=lewetd>Typ:</td><td class=infotd>".$row['typ']."</td>	</tr>
							<tr>	<td class=lewetd>Sklep:</td><td class=infotd>".$row['sklep']."</td>	</tr>
							<tr>	<td class=lewetd>Komentarz:</td><td class=infotd>".$row['komentarz']."</td>	</tr>
						</table>
						";
					}
				}
			?>
			<form method=POST action=index.php><!--Formularz edytujący-->
				<h2><input type=submit value='Edytuj produkt:' name=edytuj class=sub></h2>
				<table>
					<tr>	<td class=lewetd>ID produktu:</td><td class=prawetd><input type=text name=ID_produktu_edytuj value='1'> </td>	</tr>
				</table>
			</form>
			<?php
				//Edytuj produkt
				if(isset($_POST['edytuj'])){//jeśli przycisk edytuj kliknięty to nastąpi sprawdzenie czy istnieje szukany produkt oraz wyświetlenie formularza edytującego jeśli produkt zostanie znaleziony lub odpowiedzi w przypadku gdy nie zostanie znaleziony.
					$ID_produktu=$_POST["ID_produktu_edytuj"];
					$czy_istnieje=$c->query("SELECT * FROM produkt WHERE ID_produktu='$ID_produktu'");
					$wybrany_produkt=mysqli_fetch_array($czy_istnieje);
					if($ID_produktu=$wybrany_produkt['ID_produktu']){//wyświetlanie panelu edycji
						echo "
						<form method=POST action=index.php>
							<h2><input type=submit value='Zatwierdź:' name=edytuj_zatwierdz class=sub></h2>
							<table>
							<tr>	<td class=lewetd>ID produktu:</td><td class=prawetd><input type=text name=ID_produktu_edytuj value=".$wybrany_produkt['ID_produktu']." readonly> </td>	</tr>
							<tr>	<td class=lewetd>Nazwa produktu:</td><td class=prawetd><input type=text name=nazwa_produktu_edytuj value='".$wybrany_produkt['nazwa_produktu']."'> </td>	</tr>
							<tr>	<td class=lewetd>Cena:</td><td class=prawetd><input type=text name=cena_edytuj value=".$wybrany_produkt['cena']."> </td>	</tr>
							<tr>	<td class=lewetd>Jednostka ceny:</td><td class=prawetd><input type=text name=jednostka_ceny_edytuj value=".$wybrany_produkt['jednostka_ceny']."> </td>	</tr>
							<tr>	<td class=lewetd>Jednostka towaru:</td><td class=prawetd><input type=text name=jednostka_towaru_edytuj value=".$wybrany_produkt['jednostka_towaru']."> </td>	</tr>
							<tr>	<td class=lewetd>Typ:</td><td class=prawetd><input type=text name=typ_edytuj value='".$wybrany_produkt['typ']."'> </td>	</tr>
							<tr>	<td class=lewetd>Sklep:</td><td class=prawetd><input type=text name=sklep_edytuj value='".$wybrany_produkt['sklep']."'> </td>	</tr>
							<tr>	<td class=lewetd>Komentarz:</td><td class=prawetd><textarea name=komentarz_edytuj rows='4' cols='25'>".$wybrany_produkt['komentarz']."</textarea></td>	</tr>
							</table>
						</form>";
					}
					else{
						echo "<span style='color:red;'>Podane ID(".$_POST['ID_produktu_edytuj'].") nie należy do żadnego produktu z listy.</span>";
					}
				}
				elseif(isset($_POST['edytuj_zatwierdz'])){//wyświetlanie panelu podsumowującego edycję oraz skrypt edytujący dane w bazie
							$ID_produktu=$_POST["ID_produktu_edytuj"];
							$czy_istnieje=$c->query("SELECT * FROM produkt WHERE ID_produktu='$ID_produktu'");
							$wybrany_produkt=mysqli_fetch_array($czy_istnieje);
							$ID_produktu=$_POST["ID_produktu_edytuj"];
							$nazwa_produktu=$_POST["nazwa_produktu_edytuj"];
							$cena=$_POST["cena_edytuj"];
							$jednostka_ceny=$_POST["jednostka_ceny_edytuj"];
							$jednostka_towaru=$_POST["jednostka_towaru_edytuj"];
							$typ=$_POST["typ_edytuj"];
							$sklep=$_POST["sklep_edytuj"];
							$komentarz=$_POST["komentarz_edytuj"];
							$c->query("UPDATE produkt SET nazwa_produktu='$nazwa_produktu',cena='$cena',jednostka_ceny='$jednostka_ceny',jednostka_towaru='$jednostka_towaru',typ='$typ',sklep='$sklep',komentarz='$komentarz' WHERE ID_produktu='$ID_produktu'");
							$zmieniony_produkt=$c->query("SELECT * FROM produkt WHERE ID_produktu='$ID_produktu'");
							$row=mysqli_fetch_array($zmieniony_produkt);
							echo "<span style='color:red;'>Zmodyfikowano produkt:</span>
							<table>
							<tr> <td class=lewetd style='background-color:#100983;'>Nazwa pola</td> <td class=infotd style='background-color:#100983;'>Stare</td> <td class=infotd style='background-color:#100983;'>Aktualne</td></tr>
							<tr> <td class=lewetd style='background-color:#100920;'>Nazwa produktu:</td> <td class=infotd>".$wybrany_produkt['nazwa_produktu']."</td> <td class=infotd>".$row['nazwa_produktu']."</td></tr>
							<tr> <td class=lewetd style='background-color:#100920;'>Cena:</td> <td class=infotd>".$wybrany_produkt['cena']."</td> <td class=infotd>".$row['cena']."</td></tr>
							<tr> <td class=lewetd style='background-color:#100920;'>J.C.:</td> <td class=infotd>".$wybrany_produkt['jednostka_ceny']."</td> <td class=infotd>".$row['jednostka_ceny']."</td></tr>
							<tr> <td class=lewetd style='background-color:#100920;'>J.T.:</td> <td class=infotd>".$wybrany_produkt['jednostka_towaru']."</td> <td class=infotd>".$row['jednostka_towaru']."</td></tr>
							<tr> <td class=lewetd style='background-color:#100920;'>Typ:</td> <td class=infotd>".$wybrany_produkt['typ']."</td> <td class=infotd>".$row['typ']."</td></tr>
							<tr> <td class=lewetd style='background-color:#100920;'>Sklep:</td> <td class=infotd>".$wybrany_produkt['sklep']."</td> <td class=infotd>".$row['sklep']."</td></tr>
							<tr> <td class=lewetd style='background-color:#100920;'>Komentarz:</td> <td class=infotd>".$wybrany_produkt['komentarz']."</td> <td class=infotd>".$row['komentarz']."</td></tr>
							</table>";
				}
			?>
		</div>
	
		<div id="index"><!--Lista produktów spełniających kryteria z formularza szukającego-->
			<?php
			if(isset($_POST['szukaj'])){
				$lista_produktów=$c->query("SELECT * FROM produkt ORDER BY $order");
				$tmp=0;
				$sql="";
				$nazwa_produktu_sql="";
				$cena_sql="";
				$jednostka_ceny_sql="";
				$jednostka_towaru_sql="";
				$typ_sql="";
				$sklep_sql="";
				if(!empty($_POST['nazwa_produktu_szukaj'])){
					$tmp=$tmp+1;
					$nazwa_produktu=$_POST['nazwa_produktu_szukaj'];
					$lista_produktów=$c->query("SELECT * FROM produkt WHERE nazwa_produktu='$nazwa_produktu' ORDER BY $order");
					$nazwa_produktu_sql="nazwa_produktu LIKE '%$nazwa_produktu%'";
					$sql=$sql." AND ".$nazwa_produktu_sql;
				}
				if(!empty($_POST['cena_szukaj'])){
					$tmp=$tmp+1;
					$cena=$_POST['cena_szukaj'];
					$cena_sql="cena='$cena'";
					$sql=$sql." AND ".$cena_sql;
				}
				if(!empty($_POST['jednostka_ceny_szukaj'])){
					$tmp=$tmp+1;
					$jednostka_ceny=$_POST['jednostka_ceny_szukaj'];
					$jednostka_ceny_sql="jednostka_ceny='$jednostka_ceny'";
					$sql=$sql." AND ".$jednostka_ceny_sql;
				}
				if(!empty($_POST['jednostka_towaru_szukaj'])){
					$tmp=$tmp+1;
					$jednostka_towaru=$_POST['jednostka_towaru'];
					$jednostka_towaru_sql="jednostka_towaru='$jednostka_towaru'";
					$sql=$sql." AND ".$jednostka_towaru_sql;
				}
				if(!empty($_POST['typ_szukaj'])){
					$tmp=$tmp+1;
					$typ=$_POST['typ_szukaj'];
					$typ_sql="typ='$typ'";
					$sql=$sql." AND ".$typ_sql;
				}
				if(!empty($_POST['sklep_szukaj'])){
					$tmp=$tmp+1;
					$sklep=$_POST['sklep_szukaj'];
					$sklep_sql="sklep='$sklep'";
					$sql=$sql." AND ".$sklep_sql;
				}
				if($tmp>0){
					$sql = substr($sql, 4);
					$lista_produktów=$c->query("SELECT * FROM produkt WHERE $sql ORDER BY $order");
				}
			}
			else{
				$lista_produktów=$c->query("SELECT * FROM produkt ORDER BY $order");//Lista zarejestrowanych produktów
			}
			//Tytuły kolumn wykorzystane jako formularze do ORDER BY
			echo "<table class=tab><tr><td><form method=POST action=index.php><input id=ID_produktu_order class=sortowanie type=submit value=ID name=ID_produktu_order></form></td> <td><form method=POST action=index.php><input id=nazwa_produktu_order class=sortowanie type=submit value='Nazwa produktu' name=nazwa_produktu_order></form></td> <td><form method=POST action=index.php><input id=cena_order class=sortowanie type=submit value=Cena name=cena_order></form></td> <td><form method=POST action=index.php><input id=jednostka_ceny_order class=sortowanie type=submit value='J.C.' name=jednostka_ceny_order></form></td> <td><form method=POST action=index.php><input id=jednostka_towaru_order class=sortowanie type=submit value='J.T.' name=jednostka_towaru_order></form></td> <td><form method=POST action=index.php><input id=typ_order class=sortowanie type=submit value=Typ name=typ_order></form></td> <td><form method=POST action=index.php><input id=sklep_order class=sortowanie type=submit value=Sklep name=sklep_order></form></td> <td>Komentarz</td> </tr>";
				$i=0;//wyświetlanie listy produktów
				while($row=mysqli_fetch_array($lista_produktów)){
					if($i%2==0){
						echo "<tr><td>".$row['ID_produktu'];echo "</td> <td>".$row['nazwa_produktu'];echo "</td> <td>".$row['cena'];echo "</td> <td>".$row['jednostka_ceny'];echo "</td> <td>".$row['jednostka_towaru'];echo "</td> <td>".$row['typ'];echo "</td> <td>".$row['sklep'];echo "</td> <td><div class=td0komentarz>".$row['komentarz'];echo "</div></td> </tr>";
					}
					else{
						echo "<tr><td class=td2>".$row['ID_produktu'];echo "</td> <td class=td2>".$row['nazwa_produktu'];echo "</td> <td class=td2>".$row['cena'];echo "</td> <td class=td2>".$row['jednostka_ceny'];echo "</td> <td class=td2>".$row['jednostka_towaru'];echo "</td> <td class=td2>".$row['typ'];echo "</td> <td class=td2>".$row['sklep'];echo "</td> <td><div class=td2komentarz>".$row['komentarz'];echo "</div></td> </tr>";
					}
					$i=$i+1;
				}
			echo "</table>";
			?>
		</div>
	
		<div id="pP">
			<form method=POST action=index.php><!--Formularz usuwający-->
				<h2><input type=submit value='Usuń produkt:' name=usun class=sub></h2>
				<table>
					<tr>	<td class=lewetd>ID produktu:</td><td class=prawetd><input type=text name=ID_produktu_usun> </td>	</tr>
				</table>
			</form>
			<?php
				//Usuń produkt
				if(isset($_POST['usun'])){
					$ID_produktu=$_POST["ID_produktu_usun"];
					$usuniete=$c->query("SELECT * FROM produkt WHERE ID_produktu='$ID_produktu'");
					$c->query("DELETE FROM produkt WHERE ID_produktu='$ID_produktu'");
					$row=mysqli_fetch_array($usuniete);
					echo "<span style='color:red;'>Usunięto produkt:</span>
						<table>
							<tr>	<td class=lewetd>ID produktu:</td><td class=infotd>".$row['ID_produktu']."</td>	</tr>
							<tr>	<td class=lewetd>Nazwa produktu:</td><td class=infotd>".$row['nazwa_produktu']."</td>	</tr>
							<tr>	<td class=lewetd>Cena:</td><td class=infotd>".$row['cena']."</td>	</tr>
							<tr>	<td class=lewetd>J.C.:</td><td class=infotd>".$row['jednostka_ceny']."</td>	</tr>
							<tr>	<td class=lewetd>J.T.:</td><td class=infotd>".$row['jednostka_towaru']."</td>	</tr>
							<tr>	<td class=lewetd>Typ:</td><td class=infotd>".$row['typ']."</td>	</tr>
							<tr>	<td class=lewetd>Sklep:</td><td class=infotd>".$row['sklep']."</td>	</tr>
							<tr>	<td class=lewetd>Komentarz:</td><td class=infotd>".$row['komentarz']."</td>	</tr>
						</table>
						";
				}
			?>
		</div>
	
		<div id="stop">
			Tutaj jest stopka
		</div>
	</div>
</body>
</html>
<?php
mysqli_close($c);
?>