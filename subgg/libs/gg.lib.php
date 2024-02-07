<?php

class GG {

var $cd=false;
var $sd=false;
var $msg_states=array();
var $ping_time=false;

	function GG(){
	/* Konstruktor klasy */
	mt_srand((double)microtime() * 1000000);
	}

	function Get_hash($password, $key) {
	/*
	Funkcja oblicza i zwraca hash hasla na podstawie podanego klucza.
	Autor: nieznany
	Ostatnia modyfikacja: brak
	*/
	$x0=0;$x1=0;$y0=0;$y1=0;$z=0;$tmp=0;
	$y0=($key<<16)>>16;$y1=$key>>16;
	for($i=0;$i<strlen($password);$i++){
		$x0=($x0&0xFF00)|ord($password[$i]);$x1&=0xFFFF;
		$y0^=$x0;$y1^=$x1;
		$y0+=$x0;$y1+=$x1;
		$x1<<=8;$x1|=($x0>>8);$x0<<=8;
		$y0^=$x0;$y1^=$x1;
		$x1<<=8;$x1|=($x0>>8);$x0<<=8;
		$y0-=$x0;$y1-=$x1;
		$x1<<=8;$x1|=($x0>>8);$x0<<=8;
		$y0^=$x0;$y1^=$x1;
		$z=$y0&0x1F;
		$y0&=0xFFFF;$y1&=0xFFFF;
	if($z<=16){
		$tmp=($y1<<$z)|($y0>>(16-$z));
		$y0=($y1>>(16-$z))|($y0<<$z);
		$y1=$tmp;
	}else{
		$tmp=$y0<<($z-16);
		$y0=($y0>>(32-$z))|((($y1<<$z)>>$z)<<($z-16));
		$y1=($y1>>(32-$z))|$tmp;
	}
		$y0&=0xFFFF;$y1&=0xFFFF;
	}
	$hash=hexdec(sprintf("%04x%04x", $y1, $y0));
	settype($hash, 'integer');
	return $hash;
	} /* Koniec Get_hash() */


	function Get_server(){
	/*
	Funkcja zwraca tablice asocjacyjna z adresem i numerami portow dostepnych serwerow gadu gadu.
	Autor: Radoslaw Nowakowski
	Ostatnia modyfikacja: 2004-08-15
	*/
	$rcvpack=@ file_get_contents("http://appmsg.gadu-gadu.pl/appsvc/appmsg4.asp?fmnumber=&version=0x22&fmt=2&lastmsg=");
	if(!$rcvpack){
		return false;
	}
	$rcvarray=sscanf($rcvpack, "%d %d %s %s");
	$server['server_name']=$rcvarray[3];
	$server['port_1']=8074;
	$server['port_2']=443;
	return $server;
	} /* Koniec Get_server() */

	function Connect($server, $port){
	/*
	Funkcja nawiazujaca polaczenie z serwerem gadu gadu. Jesli operacja zakonczy sie powodzeniem zwracany jest klucz.
	Autor: Radoslaw Nowakowski
	Ostatnia modyfikacja: 2004-08-15
	*/
	$this->sd=@ socket_create(AF_INET, SOCK_STREAM, 0);
	if(!$this->sd){
		return false;
	}
	$sec = Array("sec" => 5, "usec" => 0);
	socket_set_option($this->sd, SOL_SOCKET, SO_RCVTIMEO, $sec);
	$this->cd=@ socket_connect($this->sd, $server, (int) $port);
	if(!$this->cd){
		return false;
	}
	$rcvdata=@ unpack('Vtype/Vsize/Vkey', @ socket_read($this->sd, 12));
	return ($rcvdata['key']) ? $rcvdata['key'] : false;
	} /* Koniec Connect() */


	function Login($uin, $hash, $state=0x0002, $description=false, $version=0x22){
	/*
	Funkcja probujaca zalogowac uzytkownika na serwerze ustawiajac przy tym odpowiedni status gadu gadu.
	Autor: Radoslaw Nowakowski
	Ostatnia modyfikacja: 2004-08-15
	*/
	socket_write($this->sd, @ pack("VVVVVVvVvVvCCa".strlen($description), GG_LOGIN60, 0x20 + strlen($description), $uin, $hash, $state, $version, 0, 0, 0, 	0, 0, 0x14, 0xbe, $description));
	$rcvdata=@ unpack('Vstate/Vtype', @ socket_read($this->sd, 8));
	switch($rcvdata['state']){
		case GG_LOGIN_OK:
		return true;
		break;

		default:
		return false;
		break;
	}
	} /* Koniec Login() */


	function Send_message($to, $content){
	/*
	Funkcja wysyla wiadomosc pod wskazany numer gadu gadu.
	Autor: Radoslaw Nowakowski
	Ostatnia modyfikacja: 2004-08-17
	*/
	$seq=mt_rand();
	@ socket_write($this->sd, pack('VVVVVa'.strlen($content).'C', GG_SEND_MSG, 0x0d+strlen($content), $to, $seq, 0x0004, $content, 0));
	return true;
	} /* Koniec Send_message() */

	
	function Debug($content, $lavel=false){
	/*
	Funkcja raportujaca bledy i wstrzymujaca dzialanie programu w zaleznosci od poziomu bledu.
	Autor: Radoslaw Nowakowski
	Ostatnia modyfikacja: 2004-08-15
	*/
	switch((int) $lavel){
			case	1:
			die("::".date("H:i")." $content<br/>");
			break;

			case 0:
			print("::".date("H:i")." $content<br/>");
			break;
	}
	} /* Koniec Debug() */


}

?>
