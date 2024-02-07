<?php

session_start();
if(empty($_SESSION['logged'])){
	header("Location: login.php");
}

require_once('subscript_conf.php');
require_once('libs/core.lib.php');
require_once('libs/gg.lib.php');

error_reporting(0);

$subscript=new Subscript(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$subscript->Db_ready();
$targets=$subscript->Get_uids();

$gg=new GG();
if(isset($_POST['send'])&&!empty($_POST['message'])){

$gginfo=$gg->Get_server();
$gg->Debug("Trwa laczenie z serwerem: {$gginfo['server_name']}:{$gginfo['port_1']}");
$ggkey=$gg->Connect($gginfo['server_name'], $gginfo['port_1']);
if(!$ggkey){
	$gg->Debug("Nie mozna nawiazac polaczenia z serwerem: {$gginfo['server_name']}:{$gginfo['port_1']}.");
	$ggkey=$gg->Connect($gginfo['server_name'], $gginfo['port_2']);
	if(!$ggkey){
		$gg->Debug("Trwa laczenie z serwerem: {$gginfo['server_name']}:{$gginfo['port_1']}");
		$gg->Debug("Nie mozna nawiazac polaczenia z serwerem: {$gginfo['server_name']}:{$gginfo['port_2']}.", 1);
	}else{
		$gg->Debug("Nawiazano polaczenie z serwerem: {$gginfo['server_name']}:{$gginfo['port_2']}.");
	}
}else{
	$gg->Debug("Nawiazano polaczenie z serwerem: {$gginfo['server_name']}:{$gginfo['port_1']}.");
}

$ggauth=$gg->Login(GG_UIN, $gg->Get_hash(GG_PASSWORD, $ggkey), 0x0002, false, GG_VERSION);
if(!$ggauth){
	$gg->Debug("Blad autoryzacji. Upewnij sie czy podany numer i haslo uzytkownika sa poprawne.", 1);
}
$gg->Debug("Zalogowano do serwera.");

foreach($targets AS $user_id => $user_uid){
	$uids++;

	$dd=$gg->Send_message((int)$user_uid, $_POST['message']);

}

$uids=($uids) ? $uids : 0;

$gg->Debug("Wszystkich numerow w bazie danych: $uids.");
$gg->Debug("Wiadomosci zostaly rozeslane.");

}else{

$gg->Debug("Subskrypcja Gadu Gadu.");
$gg->Debug("Skrypt gotowy do rozsylania wiadomosci.");

}

?>
