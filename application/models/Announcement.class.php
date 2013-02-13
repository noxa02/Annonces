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
    function getType()
	{
		return $this->_type;
	}
    
	public 
    function getIdUser()
	{
		return $this->_id_user;
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
    function setType($type)
	{
		$this->_type = $type;
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
            $me = $this;
            $curl = new Curl_Custom();
            $curl->setUrl(WS_PATH.'/announcements/'.$me->getId());
            $curl->setAuthToken($_COOKIE['AuthKey']);
            $curl->setHeaders($curl->getAuthToken());
            $curl->curlGetRequest();
            $data = XML_Custom::unserialize($curl->getData());
            $me->setAnnouncementData($data);
        } 
    }
    
    public 
    function initUser() 
    {
        $me = $this;
        $url  = WS_PATH.'/users/'.$me->getIdUser();
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
    
    public
    function initPictures() 
    {
        $me = $this;
        $url = WS_PATH.'/pictures/?id_announcement='.$me->getId();
        $curl = new Curl_Custom();
        $curl->setUrl($url);
        $curl->setAuthToken($_COOKIE['AuthKey']);
        $curl->setHeaders($curl->getAuthToken());
        $curl->curlGetRequest();
        $data = XML_Custom::unserialize($curl->getData());
        $pictures = null;
        if(!is_object($data)) {
            if(isset($data['picture'][0])) {
                foreach ($data['picture'] as $key => $picture) {
                    $announcementPicture =  new Picture();
                    $announcementPicture->setPictureData($picture);
                    $pictures[] = $announcementPicture;
                }  
            } else {
                $announcementPicture =  new Picture();
                $announcementPicture->setPictureData($data['picture']);
                $pictures[] = $announcementPicture;
            }
        }
        
        $me->setPictures($pictures);
    }
    
    public
    function getAnnouncements($conditions = null) 
    {
        $url = WS_PATH.'/announcements/';
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