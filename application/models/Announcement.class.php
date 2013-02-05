<?php
/**
 * Description of Member
 *
 * @author Hait
 */
class Announcement {
    
    private $_id;
    private $_title;
    private $_subtitle;
    private $_content;
    private $_post_date;
    private $_conclued;
    private $_id_user;
    private $_user;
    private $_pictures; 
    private $_comments;
    
/**
 * Méthodes GET
 */
    
	public 
    function getId()
	{
		return $this->_id;
	}

	public 
    function getTitle()
	{
		return $this->_title;
	}

	public 
    function getSubtitle()
	{
		return $this->_subtitle;
	}

	public 
    function getContent()
	{
		return $this->_content;
	}

	public 
    function getPostDate()
	{
		return $this->_post_date;
	}
    
	public 
    function getConclued()
	{
		return $this->_conclued;
	}
    
    public 
    function getIdUser() {
        return $this->_id_user;
    }
    
    public 
    function getUser() {
        return $this->_user;
    }
    
    public 
    function getPictures()
	{
		return $this->_pictures;
	}
/**
 * Méthodes SET
 */

	public 
    function setId($id_) {
		$this->_id = $id_;
	}

	public 
    function setTitle($title_)
	{
		$this->_title = $title_;
	}

	public 
    function setSubtitle($_subtitle)
	{
		$this->_subtitle = $_subtitle;
	}

	public 
    function setContent($content_)
	{
		$this->_content = $content_;
	}

	public 
    function setPostDate($postDate_)
	{
		$this->_post_date = $postDate_;
	}

    public 
    function setConclued($conclued_)
	{
		$this->_conclued = $conclued_;
	}
    
    public 
    function setIdUser($id_user)
	{
		$this->_id_user = $id_user;
	}

    public 
    function setUser($user)
	{
		$this->_user = $user;
	}
 
    public 
    function setPictures($pictures_)
	{
		$this->_pictures = $pictures_;
	}
    
  	public 
    function setAnnouncementData($data) 
    {
		Hydrate::init($data); 
	}
    
    public 
    function initAnnouncementData() 
    {
        if($this->getId()) {
            
            $curl = new Curl_Custom();
            $curl->setUrl('http://localhost:8888/projetcs/REST_ANNONCE_V2/web/announcements/'.$this->getId());
            $curl->setAuthToken($_COOKIE['AuthKey']);
            $curl->setHeaders($curl->getAuthToken());
            $curl->curlGetRequest();
            $data = XML_Custom::unserialize($curl->getData());
            $this->setAnnouncementData($data);
            
            if(!is_null($this->_id_user)) {
                $user = new User();
                $user->setId($this->getIdUser());
                $user->initUserData();
                $this->setUser($user);
            }
            
        } 
    }
    
    public
    function getAnnouncements($conditions = null) 
    {
        $url = 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/announcements/';
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