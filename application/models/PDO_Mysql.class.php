<?php 
/**
*  Classe PDO 
*/
class PDO_Mysql
{
	private static $_instancePDO = null;

	public static function init() {
		self::$_instancePDO  =  new PDO('mysql:host='.$GLOBALS['PARAM_host'].';port='.$GLOBALS['PARAM_port'].';dbname='.$GLOBALS['PARAM_dbname'], $GLOBALS['PARAM_user'], $GLOBALS['PARAM_password'], array(PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	}

	public static function getInstance() {
		if(is_null(self::$_instancePDO)):
			self::init();
		endif;

		return self::$_instancePDO;
	}
}