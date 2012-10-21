<?php 
	global $PARAM_host,$PARAM_port,$PARAM_user,$PARAM_dbname,$PARAM_password; 
	$PARAM_host = 'localhost';
	$PARAM_port = '3307';
	$PARAM_user = 'root'; 
	$PARAM_dbname = 'projet_1'; 
	$PARAM_password = 'root'; 

	define("APPLICATION_PATH", dirname(__FILE__).'/application');
	define("PUBLIC_PATH", dirname(__FILE__).'/public');
	define("APPLICATION_PATH_LOCATION", '/Projets/Sites/Exercice_1/application');
	define("PUBLIC_PATH_LOCATION", '/Projets/Sites/Exercice_1/public');
	define("UPLOAD_FILES",dirname(__FILE__).'/data/upload');
	define("AVATAR_PATH",'data/upload/avatar');
