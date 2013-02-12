<?php

class Comment {
    
     private $_id;
     private $_content; 
     private $_date_post;
     private $_id_user;
     private $_id_announcement;
     private $_announcement;
     private $_user;
    
    /**
     * 
     * Méthodes GET
     */
    
	public 
    function getId()
	{
		return $this->_id;
	}

	public 
    function getContent()
	{
		return $this->_content;
	}

	public 
    function getPostDate()
	{
		return $this->_date_post;
	}

	public 
    function getIdUser()
	{
		return $this->_id_user;
	} 

    public 
    function getIdAnnouncement()
	{
		return $this->_id_announcement;
	} 
    
    public 
    function getAnnouncement()
	{
		return $this->_announcement;
	} 
    
    public 
    function getUser()
	{
		return $this->_user;
	} 
    
/**
 * Méthodes SET
 */

	public 
    function setId($id_) {
		$this->_id = $id_;
	}

	public 
    function setContent($content_)
	{
		$this->_content = $content_;
	}

	public 
    function setPostDate($date_post_)
	{
		$this->_date_post = $date_post_;
	}

	public 
    function setIdUser($id_user_)
	{
		$this->_id_user = $id_user_;
	}
    
 	public 
    function setIdAnnouncement($id_announcement_)
	{
		$this->_id_announcement = $id_announcement_;
	}
    
 	public 
    function setAnnouncement($announcement)
	{
		$this->_announcement = $announcement;
	}
  
 	public 
    function setUser($user)
	{
		$this->_user = $user;
	}
    
  	public 
    function setCommentData($data) 
    {
		Hydrate::init($data); 
	}
    
    public 
    function initCommentData() 
    {
        $me = $this;
        if($me->getId()) {
            
            $curl = new Curl_Custom();
            $curl->setUrl('http://localhost:8888/projetcs/REST_ANNONCE_V2/web/comments/'.$me->getId());
            $curl->setAuthToken($_COOKIE['AuthKey']);
            $curl->setHeaders($curl->getAuthToken());
            $curl->curlGetRequest();
            $data = XML_Custom::unserialize($curl->getData());
            $me->setCommentData($data);
            
            if(!is_null($me->_id_user)) {
                $user = new User();
                $user->setId($me->getIdUser());
                $user->initUserData();
                $me->setUser($user);
            }
            
            if(!is_null($me->_id_announcement)) {
                $announcement = new Announcement();
                $announcement->setId($me->getIdAnnouncement());
                $announcement->initAnnouncementData();
                $me->setUser($announcement);
            }
        } 
    }
    
    public
    function getComments($conditions = null) 
    {
        $url = 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/comments/';
        if(!is_null($conditions)) 
            $url .= $conditions;

        $curl = new Curl_Custom();
        $curl->setUrl($url);
        $curl->setAuthToken($_COOKIE['AuthKey']);
        $curl->setHeaders($curl->getAuthToken());
        $curl->curlGetRequest();
        
        return $curl->getData();
    }
    
    public 
    function initAnnouncement() 
    {
        $me = $this;
        $url  = 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/announcements/'.$me->getIdAnnouncement();
        $curl = new Curl_Custom();
        $curl->setUrl($url);
        $curl->setAuthToken($_COOKIE['AuthKey']);
        $curl->setHeaders($curl->getAuthToken());
        $curl->curlGetRequest();
        $data = XML_Custom::unserialize($curl->getData());
        
        $announcement = new Announcement();
        $announcement->setAnnouncementData($data);
        $me->setAnnouncement($announcement);
    }
    
    public 
    function initUser() 
    {
        $me = $this;
        $url  = 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/users/'.$me->getIdUser();
        $curl = new Curl_Custom();
        $curl->setUrl($url);
        $curl->setAuthToken($_COOKIE['AuthKey']);
        $curl->setHeaders($curl->getAuthToken());
        $curl->curlGetRequest();
        $data = XML_Custom::unserialize($curl->getData());

        $user = new User();
        $user->setUserData($data);
        $me->setUser($user);
    }
}
