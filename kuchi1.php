<HTML>
<HEAD>
<link rel="stylesheet" href="formatierungen.css" />
</HEAD>

<BODY>
<?php
session_start();

/*if(isset($_GET["rechnung"])) { 
	$rechnung = $_GET["rechnung"]; } 
	
	
	else {
	echo "rechnung wurde nicht eingegeben";
}
if(isset($_GET["gericht"])){
	$speise = $_GET["gericht"];

	} else 
	echo "gericht wurde nicht eingegeben";*/




$mysqli = new mysqli("localhost","root","root","projekt2");
if( $mysqli->connect_error)
{
	echo "verbindungsfehler".mysqli_connect_error();
	exit();
}
	echo "verbindung hergestelt";	
$ergebniss2 = "insert into bestellte(id_karte,id_rechnung) values (?,?);";
$statement2 = $mysqli->prepare($ergebniss2);
$statement2->bind_param('ii', $speise,$rechnung);
$statement2->execute();
$statement2->close();

$mysqli = new mysqli("localhost","root","root","projekt2");
if( $mysqli->connect_error)
{
	echo "verbindungsfehler".mysqli_connect_error();
	exit();
}
	echo "verbindung hergestelt";
	echo "</BR>";

$ergebniss3 = "select speisekarte.speise_name,bestellte.id_karte,bestellte.id_rechnung 
from bestellte,speisekarte 
where speisekarte.speise_id=bestellte.id_karte 
order by bestellte.id_rechnung;";
$statement3 = $mysqli->query($ergebniss3);
//$statement3->execute();
echo "<form action='kuchi1.php' id='person' METHOD='GET'>";
echo "<center><table  border=\"1\" width=\"300\" height= \"400\">";

echo "<tr><td colspan = 3><center>Zum kochen:</center></td> 
		</tr>";
echo "<tr><td><label class='h2' form='person'>SpeiseName:</label></td><td><label class='h2' form='person'>SpeiseNR.:</label></td>".
"<td><label class='h2' form='person'>RechnungNR.:</label></td> 
		</tr>";
while($zeile = $statement3->fetch_array())
{
	echo "<tr><td>{$zeile["speise_name"]}</td><td>{$zeile["id_karte"]}</td>"."<td>{$zeile["id_rechnung"]}</td> 
		</tr>";		
}
echo "</table></center>";
echo "</form>";
$statement3->close();



echo "<form action='rechni.php' id='rechn' METHOD='POST'><center><table><center><tr><td colspan=1>Zum Kasse:</td>
<td><center><button type='submit'>Enter</button></center></td></tr></center>
	";
	
	//<form action='kuchi1.php' id='person' METHOD='POST'>;

echo "";
echo "</td></tr></table></center></form>";




	?>






</BODY>
</html>