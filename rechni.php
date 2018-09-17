<HTML>
<HEAD>
<META charset = "UTF-8" />
<link rel="stylesheet" href="formatierungen.css" />
</HEAD>

<BODY>
<?php
session_start();
if(isset($_GET['knopf']) && $_GET['knopf'] != '')
{
	$_SESSION['Rechnung'] = $_GET['rechnung'];
	
	if($_GET['knopf']=='beleg'){header('location:tisch.php');}
	if($_GET['knopf']=='abholen')
	{
		$mysqli = new mysqli("localhost","root","root","projekt2");
		$statment7 = $mysqli->query("delete from bestellte where id_rechnung = {$_SESSION['Rechnung']};");
	}
}	

$mysqli = new mysqli("localhost","root","root","projekt2");
if( $mysqli->connect_error)
{
	echo "\tverbindungsfehler".mysqli_connect_error();
	exit();
}
	echo "\tverbindung hergestelt";
	echo "</BR>";

	$ergebniss4= "select bestellte.id_rechnung,sum(speisekarte.preis) 
from bestellte,speisekarte 
where speisekarte.speise_id=bestellte.id_karte 
group by bestellte.id_rechnung;";
$statment4 = $mysqli->query($ergebniss4);
echo "<form action='rechni.php' id='rechnung' METHOD='GET'><tr><td colspan = 3><center>Zum Abholen:</center></td></tr>";
echo "<center><table  border=\"1\" width=\"300\" height= \"400\">";
echo "<tr><td colspan = 3><center>Zum kochen:</center></td></tr>";
echo "<tr><td>ReCHnunGNr:</td><td>PreIS:</TD><td>beleg anzeigen:</TD></tr>";
while($zeile = $statment4->fetch_array())
	
{
	echo "<tr><td>{$zeile["id_rechnung"]}</td><td>{$zeile["sum(speisekarte.preis)"]}</td><td><input type='radio' name='rechnung' id='rechnung' value={$zeile["id_rechnung"]} />
		</td></tr>";		
}
echo "<tr><td colspan = 3><center><button type='submit' name='knopf' value='beleg' >Beleg Anzeigen</button></center></td></tr>";
echo "<tr><td colspan = 3><center><button type='submit' name='knopf' value='abholen'>Abholen</button></center></td></tr>";
echo "</table></center>";
echo "</form>";
//echo "</table></center>";

echo "<form action='offi1.php' id='rechnung' METHOD='GET'><center><table  border=\"1\" width=\"300\" height= \"50\">
<tr><td><center><button type='submit'>EnterOffi</button></center></td></tr></table></center></form>";

echo "<form action='kuchi1.php' id='rechnung' METHOD='GET'><center><table  border=\"1\" width=\"300\" height= \"50\">
<tr><td><center><button type='submit'>EnterKuche</button></center></td></tr></table></center></form>";




	?>






</BODY>
</html>