<?php 

/**
*  Classe de connexion au site
*/
class Connexion 
{
	private  $SQL;

	public function __construct()
	{
		try {
			$this->SQL = PDO_Singleton::getInstance();
		} catch (Exception $e) {
			die('Erreur : '.$e->getMessage());
		}
	}
}