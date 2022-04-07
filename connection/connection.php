<?php

session_start();
date_default_timezone_set("Asia/Singapore");

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id18237090_elementary');
define('DB_PASSWORD', '1&D?Exf^@j?B<^1!');
define('DB_DATABASE', 'id18237090_pandacaqui');

class DB_con {
	public $connection;
	function __construct(){
		$this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

		if ($this->connection->connect_error) die('Database error -> ' . $this->connection->connect_error);
    
	}

	function ret_obj(){
		return $this->connection;
	}
}

?>