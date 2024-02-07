
<?
$pozniej=$dzien=date("d");

$pozniej++;
 
echo("Na $pozniej.04 nie musza sie uczyc nr: <B>");

switch($dzien)
{ 
case 14: echo("18, 15"); break;
case 17: echo("32, 13"); break;
case 18: echo("37, 34"); break;
case 19: echo("19, 16"); break;
case 20: echo("25, 7"); break;
case 21: echo("26, 8"); break;
case 24: echo("33"); break;
case 25: echo("29"); break;
case 26: echo("2"); break;
case 27: echo("10"); break;
case 28: echo("24"); break;


}

echo("</b>");
?>