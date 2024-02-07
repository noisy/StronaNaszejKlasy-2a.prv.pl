<?php

class DB {

	var $db_handle;
	var $db_host;
	var $db_user;
	var $db_pass;
	var $db_type;
	var $db_name;

		function DB ($db_host, $db_user, $db_pass, $db_name){
		$this->db_host=$db_host;
		$this->db_user=$db_user;
		$this->db_pass=$db_pass;
		$this->db_name=$db_name;
		}

		function db_ready(){
		$this->db_handle= mysql_connect($this->db_host, $this->db_user, $this->db_pass);
		if($this->db_handle && mysql_select_db($this->db_name, $this->db_handle)){ return true; }else{ return 		false; }
		}

		function db_query($query){
		return mysql_query($query, $this->db_handle);
		}

		function db_fetch_assoc($result){
		return mysql_fetch_assoc($result);
		}

		function db_fetch_array($result){
		return mysql_fetch_array($result);
		}

		function db_result($result, $row, $field=0){
		return mysql_result($result, $row, $field);
		}

		function db_num_rows($result){
		return mysql_num_rows($result);
		}

		function db_insert_id(){
		return mysql_insert_id();
		}

		function db_close(){
		return mysql_close($this->db_handle);
		}

}

?>
