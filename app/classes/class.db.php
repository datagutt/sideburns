<?php
class DB extends PDO{

	public function __construct(){
		global $config;
		$dsn = sprintf("%s:dbname=%s;host=%s", $config["db"]["type"], $config["db"]["database"], $config["db"]["host"]);
		try{
			parent::__construct($dsn, $config["db"]["username"], $config["db"]["password"], array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_PERSISTENT => true,
			));
		}catch(PDOException $e){
			die("Database is down.");
		}
	}
}