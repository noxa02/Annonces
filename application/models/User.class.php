<?php 
/**
* 
*/
class User
{
	
	public $_id,$_name,$_firstname,$_login,$_password;
	private $SQL;

	public function __construct() {
		$this->SQL = PDO_Singleton::getInstance();
		$_id = 0; 
		$_name = $_firstname = $_login = $_password = '';
	}

/***
*	Méthodes GET
***/

	public function getId()
	{
		return $this->_id;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function getFirstname()
	{
		return $this->_firstname;
	}

	public function getLogin()
	{
		return $this->_login;
	}

	public function getPassword()
	{
		return $this->_password;
	}


/***
*	Méthodes SET
***/

	public function setId($_id) {
		$this->_id = $_id;
	}

	public function setName($_name)
	{
		$this->_name = $_name;
	}

	public function setFirstname($_firstname)
	{
		$this->_firstname = $_firstname;
	}

	public function setLogin($_login)
	{
		$this->_login = $_login;
	}

	public function setPassword($_password)
	{
		$this->_password = $_password;
	}	

	public function insertUser()
	{
		try 
		{
			if(!$this->existUser($this->_login)):
				$this->SQL->beginTransaction();

				$q = $this->SQL->prepare('INSERT INTO user(name, firstname, login, password) 
										  VALUES("'.mysql_real_escape_string($this->_name).'","'.mysql_real_escape_string($this->_firstname).'",
										  "'.mysql_real_escape_string($this->_login).'","'.mysql_real_escape_string($this->_password).'")');
				$q->execute();

				$this->SQL->commit();
				return true;
			else:
				// A faire
			endif;

    	} 
    	catch (Exception $e) {
    		print 'Le Login '.$this->_login.' existe déjà.';
    	}
    	catch (PDOException $e) {
    		$this->SQL->rollback();
    	}
	}

	public function existUser($userLogin) {
		try {
			$this->SQL->beginTransaction();
			$q = $this->SQL->prepare('SELECT count(id) FROM user '.
									 'WHERE login = :login');
			$q->bindValue(':login', mysql_real_escape_string($userLogin));
			$q->execute();
			$this->SQL->commit();
			
			if($q->fetchColumn() > 0):
				return true;
			endif;
		} catch (PDOException $e) {
			$this->SQL->rollback();
		}
	}

	public function getUserData($_login,$bool) {
		try {
				if($bool):
					$this->SQL->beginTransaction();
					$q = $this->SQL->prepare('SELECT * FROM user '.
											 'WHERE login = :login');
					$q->bindValue(':login', mysql_real_escape_string($_login));
					$q->execute();
					$this->SQL->commit();
					return $q->fetch(PDO::FETCH_ASSOC);
				elseif(!$bool):
					$this->SQL->beginTransaction();
					$q = $this->SQL->prepare('SELECT login, password FROM user '.
											 'WHERE login = :login');
					$q->bindValue(':login', mysql_real_escape_string($_login));
					$q->execute();
					$this->SQL->commit();
					return array(0 => array('login'    => $q->fetch(),
										    'password' => $q->fetch()
							 	));
				endif;
		} catch (PDOException $e) {
			$this->SQL->rollback();
		}		
	}

	public function setUserData($_login) {
		$userData = $this->getUserData($_login,true);
		if(isset($userData) && count($userData) > 0):
			foreach ($userData as $key => $value):
				$_methodName = ucfirst($key);
				$_method = 'set'.ucfirst($key);
				if(method_exists($this, 'set'.$_methodName)):
					$this->$_method($value);
				endif;
			endforeach;
			return true;
		endif;
	}

	public function updateUserData() {		
		$dataToModify = func_get_args(0);
		$dataToModify = $dataToModify[0];
		$i = 0;
		$q = 'UPDATE user SET ';

		if(is_array($dataToModify)):
			foreach ($dataToModify as $key => $value) {
				if(!empty($value)):
					$_login = $dataToModify['login'];
					if(sizeof($dataToModify) == 1):
						$q .= $key.' = "'.$value.'"';
					elseif(sizeof($dataToModify) > 1 && $i != (sizeof($dataToModify) - 1)):
						$q .= $key.' = "'.$value.'", ';
					elseif($i == (sizeof($dataToModify) - 1)):
						$q .= $key.' = "'.$value.'" ';
					endif;	
				endif;
				$i++;
			}
			$q .= ' WHERE id = '.$this->getId();
			
			$this->SQL->beginTransaction();
			$q2 = $this->SQL->prepare($q);
			$q2->execute();
			$this->SQL->commit();

			$this->setUserData($_login); 
		endif;	
	}

	public function checkUserData($login, $password) {
		if($login != $this->getLogin() 
			|| $password != $this->getPassword()):
			return false;
		else:
			return true;
		endif;
	}

	public function idUser()
	{
		try 
		{
			$this->SQL->beginTransaction();
			$q = $this->SQL->prepare('SELECT id FROM user '.
									 'WHERE login = :login');
			$q->bindValue(':login', mysql_real_escape_string($this->_login));
			$q->execute();
			$this->SQL->commit();
			return true;		
    	} catch (PDOException $e) 
    	{
    		print 'Erreur : '.$e->getMessage();
    		$this->SQL->rollback();
    	}
	}

	public function initSessionUser($_login, $_password) {
		try {
			if($this->existUser($_login)):
				$bool = $this->setUserData($_login);
				if($bool):
					$_SESSION['user']['login'] = $this->getLogin();
					$_SESSION['user']['password'] = $this->getPassword();
				endif;
			endif;
		} catch (Exception $e) {
			print 'Erreur : '.$e->getMessage();
		}
	}

	public function setAvatarName($_login) {
		if(file_exists(UPLOAD_FILES.'/avatar/'.$_login.'.png')):
			rename (UPLOAD_FILES.'/avatar/'.$_login.'.png',
					UPLOAD_FILES.'/avatar/'.$this->getLogin().'.png'); 
		endif;
	}
}	