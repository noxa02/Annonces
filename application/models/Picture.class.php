<?php

class Picture {
    
     private $_id;
     private $_file_title;
     private $_title;
     private $_alternative;
     private $_path;
     private $_extension;
     private $_tmp_name;
     private $_size;
     private $_type;
     private $_width;
     private $_height;
     private $_id_announcement;
     
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
    function getFileTitle()
	{
		return $this->_file_title;
	}
    
	public 
    function getTitle()
	{
		return $this->_title;
	}

	public 
    function getAlternative()
	{
		return $this->_alternative;
	}

	public 
    function getPath()
	{
		return $this->_path;
	}

	public 
    function getTmpName()
	{
		return $this->_tmp_name;
	}

    public 
    function getSize()
	{
		return $this->_size;
	}
    
	public 
    function getType()
	{
		return $this->_type;
	}

	public 
    function getWidth()
	{
		return $this->_width;
	}
    
	public 
    function getHeight()
	{
		return $this->_height;
	}    
    
    public
    function getIdAnnouncement() {
        return $this->_id_announcement;
    }
    
    public
    function getExtension() {
        return $this->_extension;
    }
    
    public
    function getUrlWs() {
        return WEBSERVICE_UPLOAD.$this->getPath().$this->getTitle().'.'.$this->getExtension();
    }
/**
 * Méthodes SET
 */

	public 
    function setId($_id) {
		$this->_id = $_id;
	}

	public 
    function setFileTitle($_file_title)
	{
		$this->_file_title = $_file_title;
	}
    
	public 
    function setTitle($_title)
	{
		$this->_title = $_title;
	}

	public 
    function setPath($_path)
	{
		$this->_path = $_path;
	}

	public 
    function setAlternative($_alternative)
	{
		$this->_alternative = $_alternative;
	}
   
	public 
    function setTmpName($tmp_name_)
	{
		$this->_tmp_name = $tmp_name_;
	}

    public 
    function setSize($size_)
	{
		$this->_size = $size_;
	}
    
	public 
    function setType($type_)
	{
		$this->_type = $type_;
	}
    
	public 
    function setWidth($width)
	{
		$this->_width = $width;
	}
    
	public 
    function setHeight($height)
	{
		$this->_height = $height;
	}
    
    public
    function setIdAnnouncement($idAnnouncement_) {
        $this->_id_announcement = $idAnnouncement_;
    }
    
    public
    function setExtension($extension_) {
        $this->_extension = $extension_;
    }
    
  	public 
    function setPictureData($data) 
    {
		Hydrate::init($data); 
	}
    
    public 
    function getResized($width, $height) 
    {
        $me = $this;
        $url  = 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/pictures/48/resize';
        $url .= '/?width='.$width.'&height='.$height.'&id_announcement='.$me->getIdAnnouncement();
        $url .= '&extension='.$me->getExtension().'&title='.$me->getTitle();
       
        $curl = new Curl_Custom();
        $curl->setUrl($url);
        $curl->setAuthToken($_COOKIE['AuthKey']);
        $curl->setHeaders($curl->getAuthToken());
        $curl->curlGetRequest();
        $data = XML_Custom::unserialize($curl->getData());
        
        $picture = new Picture();
        $picture->setPictureData($data);
        return $picture;
    }
}
