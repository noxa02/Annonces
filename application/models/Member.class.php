<?php


/**
 * Description of Member
 *
 * @author Hait
 */
class Member {
    
    private $_login ,$_password ,$_name ,$_firstname ,$_email;
    
    public function __construct() {
        $this->_login = $this->_password = '';
        $this->_name  = $this->_firstname  = $this->_email = '';
    }
    
	public function getId()
	{
		//return $this->_id;
        // or
        //getId in database
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
*	M√©thodes SET
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
    
    public function initSession($remember_me) {
        
        if(isset($this->_login) && !empty($this->_login)
                && isset($this->_password) && !empty($this->_password)) {
            
            $_SESSION['user']['login'] = $this->_login;
            $_SESSION['user']['password'] = sha1($this->_password);
            if($remember_me === true) {
                
                $this->initCookies();
            }
        }
    }
    
    public function initCookies() {
        
        if(isset($this->_login) && !empty($this->_login)
                && isset($this->_password) && !empty($this->_password)) {
        
            setcookie('user_login', $this->_login);
            setcookie('user_password', $this->_password);
        }
    }
}

?>
