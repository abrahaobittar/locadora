<?php
require('Config.php');

class Connection 
{
	private static $instance;

	private static function getInstance() {
		if(!isset(self::$instance)) {
			try {
				self::$instance = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PWD);
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		return self::$instance;
	}

	public static function prepare($sql) {
		return self::getInstance()->prepare($sql);
	}
}