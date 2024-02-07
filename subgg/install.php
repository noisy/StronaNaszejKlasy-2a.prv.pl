<?php

if(file_exists("./subscript_conf.php")){
die("Skrypt jest juz zainstalowany. Prosze usunac plik konfiguracyjny w 
celu ponownej instalacji.");
}else{

if(!isset($_POST['submit'])){
print "<form action=install.php method=post>Admin Password: <input type=text name=password><br>Host: <input type=text name=host><br>User: <input type=text name=user><br>Password: <input type=text name=dbpassword><br>Database: <input type=text name=database><br>UIN: <input type=text name=uin><br>Password: <input type=text name=ggpassword><br><input type=submit name=submit value=Install></form>";
}else{
require_once('libs/db.lib.php');
@$db=new DB($_POST['host'], $_POST['user'], $_POST['dbpassword'], $_POST['database']);
@$db->db_ready() or die("Podales nieprawidlowe dane dotyczace bazy danych.");
$fp=@fopen("subscript_conf.php", "w") or die("Blad uprawnien. Skrypt nie ma uprawnien do utworzenia pliku konfiguracyjnego.");
fwrite($fp, "<?php
define('ADMIN_PASSWORD', '".$_POST['password']."');
define('DB_HOST', '".$_POST['host']."');
define('DB_USER', '".$_POST['user']."');
define('DB_PASS', '".$_POST['dbpassword']."');
define('DB_NAME', '".$_POST['database']."');
define('GG_UIN', ".$_POST['uin'].");
define('GG_PASSWORD', '".$_POST['ggpassword']."');
define('GG_WELCOME', 0x0001);
define('GG_VERSION', 0x22);
define('GG_LOGIN60', 0x0015);
define('GG_LOGIN_OK', 0x0003);
define('GG_NEW_STATUS', 0x0002);
define('GG_STATUS_NOT_AVAIL', 0x0001);
define('GG_STATUS_NOT_AVAIL_DESCR', 0x0015);
define('GG_STATUS_AVAIL', 0x0002);
define('GG_STATUS_AVAIL_DESCR', 0x0004);
define('GG_STATUS_BUSY', 0x0003);
define('GG_STATUS_BUSY_DESCR', 0x0005);
define('GG_STATUS_INVISIBLE', 0x0014);
define('GG_STATUS_INVISIBLE_DESCR', 0x0016);
define('GG_STATUS_BLOCKED', 0x0006);
define('GG_SEND_MSG', 0x000b);
define('GG_RECV_MSG', 0x000a);
define('GG_PING', 0x0008);
define('GG_PONG', 0x0007);
define('GG_CLASS_MSG', 0x0004);
define('GG_CLASS_CHAT', 0x0008);
define('GG_ACK_BLOCKED', 0x0001);
define('GG_ACK_DELIVERED', 0x0002);
define('GG_ACK_QUEUED', 0x0003);
define('GG_ACK_MBOXFULL', 0x0004);
define('GG_ACK_NOT_DELIVERED', 0x0006);
define('GG_SEND_MSG_ACK', 0x0005);
define('GG_DISCONNECTING', 0x000b);
?>");
$db->db_query("CREATE TABLE `gg_subscript` (
  `ggid` int(11) NOT NULL auto_increment,
  `gguid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ggid`),
  UNIQUE KEY `gguid` (`gguid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;") or die("Blad w bazie danych. Utworzenie tabeli nie bylo mozliwe.");
print "SKRYPT ZAINSTALOWANY!";
}

}

?>
