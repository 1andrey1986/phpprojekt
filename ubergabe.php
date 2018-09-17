<HTML>
<HEAD>
<META charset = "UTF-8" />
<TITLE>ubergabe</TITLE>
</HEAD>
<BODY>

<marquee> <img src = "bilder/spagetti.jpg"> </marquee>
<?php
if( isset($_GET["vorname"])	&& $_GET["vorname"] != "" && $_GET["zuname"] != "" && $_GET["mail"] != ""  )
{
	echo "Guten Tag\n";
	echo $_GET["vorname"];
	echo "\n";
	echo $_GET["zuname"];
	echo "\nIhre E-mail Adresse ist:\n";
	echo $_GET["mail"];
	echo "\t\nSie sind ein \t\n";
	echo $_GET["geschlecht"];
	
}
else
{
	echo "Keine Angabe beim Vornamen";
}
?>

</BODY>
</HTML>