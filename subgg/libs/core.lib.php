<?php

require_once('libs/db.lib.php');

class Subscript extends DB {

	function Add_uid($uid){
		settype($uid, 'integer');
		if(strlen($uid)<2||strlen($uid)>11||substr($uid, 0, 1)=='0'){
			return false;
		}
		$db_query=$this->db_query("INSERT INTO gg_subscript VALUES ('', '$uid')");
		return ($db_query) ? true : false;
	}

	function Get_uids(){
		$db_query=$this->db_query("SELECT * FROM gg_subscript ORDER BY ggid");
		while($db_array=$this->db_fetch_assoc($db_query)){
			$db_end[$db_array['ggid']]=$db_array['gguid'];
		}
		return ($db_end) ? $db_end : false;
	}

	function Delete_uid($uid){
		settype($uid, 'integer');
		if(!$uid){
			return false;
		}
		$db_query=$this->db_query("DELETE FROM gg_subscript WHERE gguid='$uid'");
		return ($db_query) ? true : false;
	}

	function Count_uids(){
		$db_query=$this->db_query("SELECT COUNT(*) AS count FROM gg_subscript");
		$db_result=$this->db_result($db_query, 0, 'count');
		return $db_result;
	}

}

?>
