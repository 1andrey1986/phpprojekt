<HTML>
<HEAD>
<META charset = "UTF-8" />
<TITLE>PHP-Test</TITLE>
<link rel="stylesheet" href="formatphp.css" />
<style>


.gerade { color: red; }
.ungerade {color: green; }
</style>

</HEAD>
<BODY>
<?php
session_start();
/*if(isset($_GET["Rechnung"])) 
		{ 
	//$rechnung = $_GET["rechnung"];
	echo "variable ist angekommen";
		} 
	
	
	else {
	echo "rechnung wurde nicht eingegeben";
		 }
echo "</BR>";		*/ 
$mysqli = new mysqli("localhost","root","root","projekt2");
if( $mysqli->connect_error)
{
	echo "verbindungsfehler".mysqli_connect_error();
	exit();
}
	echo "\tverbindung hergestelt";	
	
$ergebniss5 = "select bestellte.id_rechnung,sum(speisekarte.preis)
from bestellte,speisekarte
where speisekarte.speise_id=bestellte.id_karte
&& id_rechnung = {$_SESSION['Rechnung']}
group by bestellte.id_rechnung;";

$statement5 = $mysqli->query($ergebniss5);
$mysqli->close();

//$statement5->bind_param('ii',$_SESSION['Rechnung'],sum(speisekarte.preis));
//$statement5->execute();
echo "<center><table border=\"1\" width=\"300\" height= \"100\">";
echo "<tr><td>Tisch Nr.:</td><td>preis</td></tr>";

while($zeile = $statement5->fetch_array())
{
	echo "<tr><td>{$zeile["id_rechnung"]}</td><td>{$zeile["sum(speisekarte.preis)"]}</td>"."</tr>";		
}

echo "</table></center>";
$statement5->close();


if(isset($_SESSION['Rechnung'])) 
		{ 
	//$rechnung = $_GET["rechnung"];
	echo "variable ist angekommen";
		} 
	
	
	else {
	echo "rechnung wurde nicht eingegeben";
		 }
echo "</BR>";		 
$mysqli = new mysqli("localhost","root","root","projekt2");
if( $mysqli->connect_error)
{
	echo "verbindungsfehler".mysqli_connect_error();
	exit();
}
	echo "\tverbindung hergestelt";	

$ergebniss6 = "select speisekarte.speise_name,speisekarte.preis
from bestellte,speisekarte
where speisekarte.speise_id=bestellte.id_karte
&& id_rechnung = {$_SESSION['Rechnung']};";


$statement6 = $mysqli->query($ergebniss6);

echo "<center><table border=\"1\" width=\"300\" height= \"100\">";

while($zeile = $statement6->fetch_array())
{
	echo "<tr><td>{$zeile["speise_name"]}</td><td>{$zeile["preis"]}</td></tr>";		
}

echo "</table></center>";

echo "<form action='rechni.php' id='rechnung' METHOD='GET'><center><table  border=\"1\" width=\"300\" height= \"50\">
<tr><td><center><button type='submit'>EnterKuche</button></center></td></tr></table></center>";

echo "<form action='rechni.php' id='rechnung' METHOD='GET'><center><table  border=\"1\" width=\"300\" height= \"50\">
<tr><td><center><button type='submit'>EnterKasse</button></center></td></tr></table></center>";

?>






</BODY>
</html>