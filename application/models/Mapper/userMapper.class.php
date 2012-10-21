<?php
class UserMapper implements ModelMapperInterface{
	
	public static function save(User $user){
		$SQL = PDO_Singleton::getInstance();
		if(!empty($user->id)):
			$q = $SQL->prepare('
				UPDATE user 
				SET name = :name,
				firstname = :firstname,
				login = :login ,
				password = :password
				WHERE id = :id');
			$q->bindValue(':id', $user->getId(), PDO::PARAM_INT);
		else:
			$q = $SQL->prepare('
				INSERT INTO user(name, firstname, login, password) 
				VALUES(:name,:firstname,:login,:password)');
		endif;
		$q->bindValue(':name', $user->getName(), PDO::PARAM_STR);
		$q->bindValue(':firstname', $user->getFirstname(), PDO::PARAM_STR);
		$q->bindValue(':login', $user->getLogin(), PDO::PARAM_STR);
		$q->bindValue(':password', $user->getPassword());
		
		$q->execute();
	}
	
	public static function getAll($params = array()){
		$SQL = PDO_Singleton::getInstance();

		$qSELECT = 'SELECT ';
		$qFROM   = 'FROM ';
		$qWHERE  = 'WHERE 1 ';
		$qORDER  = 'ORDER BY ';
		$object = $params['values'];
		print_log($object);
		if(isset($params['options'])):
			$i = 0;
			foreach ($params['options'] as $key => $value) {
				switch ($key) {
					case 'SELECT':
						if(!is_array($value)):
							$qSELECT .= $value;
						elseif(is_array($value)):
							foreach ($value as $valueV):
								if(sizeof($value) == 1):
									$qSELECT .= $valueV;
								elseif(sizeof($value) > 1 && $i != (sizeof($value) - 1)):
									$qSELECT .= $valueV.',' ;
									$i++;
								elseif($i == (sizeof($value) - 1)):
									$qSELECT .= $valueV;
								endif;	
							endforeach;
						endif;
						break;
					case 'FROM':
						$qFROM .= $value;
						break;
					case 'ORDER':
						$qORDER .= $value;
						break;
				}
			}
		else:
			$qSELECT = 'SELECT * ';
			$qFROM   = 'FROM user ';
			$qWHERE  = 'WHERE 1';
			$qORDER  = 'ORDER BY DESC';
		endif;

		foreach ($object as $key => $value):
			switch ($key) {
				case '_id':
					$qWHERE .= ' AND id = :id';
					break;
				case '_name':
					$qWHERE .= ' AND name = :name';
					break;
				case '_firstname':
					$qWHERE .= ' AND firstname = :firstname';
					break;
				case '_login':
					$qWHERE .= ' AND login = :login';	
					break;
				case '_password':
					$qWHERE .= ' AND password = :password';
					break;
			}
		endforeach;

		$q = $qSELECT.' '.$qFROM.' '.$qWHERE.' '.$qORDER;
		$q = $SQL->prepare($q);	

		foreach ($object as $key => $value):
			$key = str_replace('_', '', $key);
			$method = 'get'.ucfirst($key);

			if(method_exists($object,$method)):
				$methodGet = $object->$method();
				switch ($key) {
					case 'id':
						$q->bindValue(':id', $methodGet);
						break;
					case 'name':
						$q->bindValue(':name', $methodGet);
						break;
					case 'firstname':
						$q->bindValue(':firstname', $methodGet);
						break;
					case 'login':
						$q->bindValue(':login', $methodGet);				
						break;
					case 'password':
						$q->bindValue(':password', $methodGet);
						break;
				}
			endif;
		endforeach;	
		
		$q->execute();
		$results = $q->fetchAll();
		print_log($results);
		$users = array();
		
		foreach($results as $result):
			$user = new User();
			$user->setId($result['id']);
			$user->setName($result['name']);
			$user->setFirstname($result['firstname']);
			$user->setLogin($result['login']);
			$user->setPassword($result['password']);
	
			$users[] = $user;
		endforeach;
		
		return $users;
	}

	public static function getStatut(User $user) {
		try {
			$SQL = PDO_Singleton::getInstance();
			$SQL->beginTransaction();
			$q = $SQL->prepare('SELECT admin '.
							   'FROM user '.
							   'WHERE id = :idUser');
			$q->bindValue(':idUser', mysql_real_escape_string($user->getID()));
			$q->execute();
			$SQL->commit();

			if($q->fetch() == 0):
				return 'admin';
			else:
				return 'member';
			endif;
		} catch (PDOException $e) {
			print 'Erreur : '.$e->getMessage();
			$SQL->rollback();
		}
	}
}