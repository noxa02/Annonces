<?php

class User {
    
    private $_id;
    private $_login;
    private $_password;
    private $_name;
    private $_firstname;
    private $_mail;
    private $_address;
    private $_phone;
    private $_portable;
    private $_subscriptionDate;
    private $_hash;
    private $_newsletter;
    private $_role;
      
    /**
     * Méthodes GET
     */

    public 
    function getId() 
    {
            return $this->_id;
    }

    public 
    function getName()
    {
            return $this->_name;
    }

    public 
    function getFirstname()
	{
		return $this->_firstname;
	}

    public 
    function getLogin()
    {
            return $this->_login;
    }

    public 
    function getPassword()
    {
            return $this->_password;
    }
    
    public 
    function getMail()
    {
            return $this->_mail;
    }
    
    public 
    function getAddress()
	{
		return $this->_address;
	}
    
    public 
    function getPhone()
	{
		return $this->_phone;
	}
    
    public 
    function getPortable()
    {
        return $this->_portable;
    }
    
    public 
    function getSubscriptionDate()
    {
        return $this->_subscriptionDate;
    }
    
    public 
    function getHash()
    {
        return $this->_hash;
    }
    
    public 
    function getNewsletter()
    {
        return $this->_newsletter;
    }
    
    public 
    function getRole()
    {
        return $this->_role;
    }

    /**
     * Méthodes SET
     */

    public 
    function setId($_id) 
    {
        $this->_id = $_id;
    }

    public 
    function setName($_name)
    {
        $this->_name = $_name;
    }

    public 
    function setFirstname($_firstname)
    {
        $this->_firstname = $_firstname;
    }

    public 
    function setLogin($_login)
    {
        $this->_login = $_login;
    }

    public 
    function setPassword($_password, $encrypt = false)
    {
        if($encrypt) {
            $this->_password = sha1_password($_password);
        } else {
            $this->_password = $_password;
        }
    }

    public 
    function setMail($mail_)
    {
        $this->_mail = $mail_;
    }
    
    public 
    function setAddress($address_)
    {
        $this->_address = $address_;
    }
    
    public 
    function setPhone($phone_)
    {
        $this->_phone = $phone_;
    }
    
    public 
    function setPortable($portable_)
    {
        $this->_portable = $portable_;
    }
    
    public 
    function setSubscriptionDate($subscriptionDate_)
	{
		$this->_subscriptionDate = $subscriptionDate_;
	}
    
    public 
    function setHash($hash_)
    {
        $this->_hash = $hash_;
    }
    
    public 
    function setNewsletter($newsletter_)
    {
        $this->_newsletter = $newsletter_;
    }
    
    public 
    function setRole($role_)
    {
        $this->_role = $role_;
    }
    
  	public 
    function setUserData($data) 
    {
		Hydrate::init($data); 
	}
    
/**
 * Méthodes diverses
 */
    
    public 
    function initSessionUser() 
    {    
        $me = $this;
        if(method_exists($me, 'getLogin') && !is_null($me->getLogin())) {
            $_SESSION['user']['id']      = $me->getId();
            $_SESSION['user']['login']   = $me->getLogin();
            $_SESSION['user']['AuthKey'] = base64_encode($me->getLogin().':'.$me->getPassword());
        } 
    }
    
    public
    function destroySessionUser() {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }
    
//    public 
//    function initUserCookies() {
//        $me = $this;
//        if(method_exists($me, 'getLogin') && !is_null($me->getLogin())) {
//            $_COOKIE['user']['id']      = $me->getId();
//            $_COOKIE['user']['login']   = $me->getLogin();
//        } 
//    }
    
    public 
    function destroyCookies() 
    {
        unset($_COOKIE['login']);
        unset($_COOKIE['ajaxRequest']);
        unset($_COOKIE['AuthKey']);
    }
    
    public
    function getFollowers() 
    {
        if(isset($_COOKIE['AuthKey']) && !empty($_COOKIE['AuthKey'])) {
           $me = $this;
           $curl = new Curl_Custom();
           $curl->setUrl(WS_PATH.'/users/'.$me->getId().'/followers');
           $curl->setAuthToken($_COOKIE['AuthKey']);
           $curl->setHeaders($curl->getAuthToken());
           $curl->curlGetRequest();

           return $curl->getData();           
        }

    }
    
    public
    function getComments($conditions = null) 
    {
        if(isset($_COOKIE['AuthKey']) && !empty($_COOKIE['AuthKey'])) {
            $me = $this;
            $url = WS_PATH.'/comments/?id_user='.$me->getId();
            
            if(!is_null($conditions)) 
                $url .= $conditions;
            
            $curl = new Curl_Custom();
            $curl->setUrl($url);
            $curl->setAuthToken($_COOKIE['AuthKey']);
            $curl->setHeaders($curl->getAuthToken());
            $curl->curlGetRequest();
            
            return $curl->getData(); 
        }
    }

    public
    function getAnnouncements($conditions = null) 
    {
        if(isset($_COOKIE['AuthKey']) && !empty($_COOKIE['AuthKey'])) {
            $me = $this;
            $url = WS_PATH.'/announcements/?id_user='.$me->getId();
            if(!is_null($conditions)) 
                $url .= $conditions;

            $curl = new Curl_Custom();
            $curl->setUrl($url);
            $curl->setAuthToken($_COOKIE['AuthKey']);
            $curl->setHeaders($curl->getAuthToken());
            $curl->curlGetRequest();

            return $curl->getData();
        }
    }
    
    public 
    function getUsers($conditions = null) 
    {
        if(isset($_COOKIE['AuthKey']) && !empty($_COOKIE['AuthKey'])) {
            
            $url = WS_PATH.'/users/';
            if(!is_null($conditions)) 
                $url .= $conditions;

            $curl = new Curl_Custom();
            $curl->setUrl($url);
            $curl->setAuthToken($_COOKIE['AuthKey']);
            $curl->setHeaders($curl->getAuthToken());
            $curl->curlGetRequest();

            return $curl->getData();    
        }
        

    }
    
    public 
    function initUserData() 
    {
        if(isset($_COOKIE['AuthKey']) && !empty($_COOKIE['AuthKey'])) {
            $me = $this;
            if($me->getId()) {

                $curl = new Curl_Custom();
                $curl->setUrl(WS_PATH.'/users/'.$me->getId());
                $curl->setAuthToken($_COOKIE['AuthKey']);
                $curl->setHeaders($curl->getAuthToken());
                $curl->curlGetRequest();
                $data = XML_Custom::unserialize($curl->getData());
                $me->setUserData($data);

            }             
        }
    }
    
    public 
    function isAuthentified() 
    {
        if(isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }
}