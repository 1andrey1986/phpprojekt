<HTML>
<HEAD>
<link rel="stylesheet" href="formatierungen.css" />
</HEAD>

<BODY>
<background=RED>

<?php

session_start();
if(isset($_GET['absenden']) && $_GET['absenden'] != '')
{
	if(isset($_GET['Gericht']) && $_GET['Gericht'] != '')	$_SESSION['Gericht'] = $_GET['gericht'];
	if(isset($_GET['Rechnung']) && $_GET['Rechnung'] != '')	$_SESSION['Rechnung'] = $_GET['rechnung'];
	if(isset($_GET['Absagen']) && $_GET['Absagen'] != '')	$_SESSION['Absagen'] = $_GET['Absagen'];
	
	if($_GET['absenden']=='kuche'){header('location:kuchi1.php');}
	if($_GET['absenden']=='bestellen')
		{
		$mysqli = new mysqli("localhost","root","root","projekt2");
		$ergebniss2 = "insert into bestellte(id_karte,id_rechnung) values (?,?);";
		$stmt = $mysqli->prepare($ergebniss2);
		$stmt->bind_param('ii',$_SESSION['Gericht'],$_SESSION['Rechnung']);
		$stmt->execute();
	}
	if($_GET['absenden']=='absagen')
	{
		$mysqli = new mysqli("localhost","root","root","projekt2");
		$statment = $mysqli->query("delete from bestellte where id_karte = {$_SESSION['Absagen']} && id_rechnung = {$_SESSION['Rechnung']} limit 1;");
		echo "angekommen";
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
	$ergebniss1 = $mysqli->query("select * from speisekarte;");
	
	echo "<center><div><form action='offi1.php' id='person' METHOD='GET'>";
	echo "<table border=\"1\" width=\"300\" height= \"400\">";
	echo "<tr><td ><label class='h2' form='person'>TischNR.:</label></td>
	<td  colspan = 2><center><input type='numeric' name='rechnung' ></center></td></tr></BR>";
	while($zeile = $ergebniss1->fetch_array())
	{
		echo "<tr><td>{$zeile["speise_name"]}</td><td>{$zeile["preis"]}</td>"."<td><input type='radio' name='gericht' value={$zeile["speise_id"]} />
		</td></tr>";
		echo "</BR>";
	}
	echo "<tr><td colspan = 3><center><button type='submit' name='absenden' value='bestellen'>bestellen</button></center></td></tr>";
	echo "<tr><td colspan = 3><center><button type='submit' name='absenden' value='kuche'>EnterKuche</button></center></td></tr>";
	echo "</table></form></center>";

//<input type='numeric' name={$zeile["speise_name"]} id='anzahl' value='0'>

	echo "<center><form action='offi1.php'  METHOD='GET'>";
	echo "<table border=\"1\" width=\"300\" height= \"150\">";
	echo "<tr><td  colspan = 2><center>Bestellung absagen</td></tr>
	<tr><td ><label class='h2' form='person'>RechnungNR.:</label></td>
	<td  colspan = 2><center><input type='numeric' name='rechnung' ></center></td></tr>
	<tr><td ><label class='h2' form='person'>Speise Name:</label></td>
	<td  colspan = 2><center><input type='numeric' name='Absagen' ></center></td></tr></BR>";
	echo "<tr><td colspan = 2><center><button type='submit' name='absenden' value='absagen'>absagen</button></td></tr>";
	echo "</table></div></center>";
	
	
	
	?>






</BODY>
</html>