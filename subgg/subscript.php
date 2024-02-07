<?php

require_once('subscript_conf.php');
require_once('libs/core.lib.php');

error_reporting(0);

switch($_POST['mode']){

	default:
		$subscript=new Subscript(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$subscript->Db_ready();
		if($subscript->Add_uid($_POST['uid'])){

		require_once('libs/gg.lib.php');
		$gg=new GG();
		$gginfo=$gg->Get_server();
		$ggkey=$gg->Connect($gginfo['server_name'], $gginfo['port_1']);
		$ggauth=$gg->Login(GG_UIN, $gg->Get_hash(GG_PASSWORD, $ggkey), 0x0002, false, GG_VERSION);
		$gg->Send_message($_POST['uid'], 'Numer zostal dodany. Aby otrzymywac pelne
		wiadomosci z naszego serwisu musisz dodac numer naszego robota do swojej
		listy kontaktow. Numer Gadu Gadu: '.GG_UIN);

		print 'Numer zostal dodany. Aby otrzymywac pelne
wiadomosci z naszego serwisu musisz dodac numer naszego robota do swojej
listy kontaktow. Numer Gadu Gadu: '.GG_UIN;
		}else{
			print 'Numer nie zostal dodany! Prawdopodobnie taki numer juz znajduje sie w naszej bazie danych lub podany przez Ciebie numer jest 			niepoprawny!';
		}
	break;

	case 'del':
		$subscript=new Subscript(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$subscript->Db_ready();
		if($subscript->Delete_uid($_POST['uid'])){
			print 'Numer zostal usuniety z bazy danych';
		}else{
			print 'Numer nie zostal usuniety z bazy danych. Prawdopodobnie taki numer nie znajduje sie w naszej bazie danych.';
		}
	break;

}

?>
