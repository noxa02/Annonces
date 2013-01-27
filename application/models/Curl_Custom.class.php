<?php

class Curl_Custom {
    
    private $url;
    private $ch;
    private $auth_token;
    private $headers;
    private $postfields;
    private $method;
    private $data;
    
    function __construct() {
        $this->ch = curl_init();
    }
    
    public
    function setUrl($url) {
        $this->url = $url;
    }
    
    public
    function setCh($ch) {
        $this->ch = $ch;
    }
    
    public
    function setAuthToken($authToken) {
        $this->auth_token = $authToken;
    }

    public
    function setHeaders($authToken) {
        $this->headers = array('Authorization: Basic ' . $authToken,
        'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3');
    }
    
    public
    function setPostFields($postfields) {
        $this->postfields = $postfields;
    }
    
    public 
    function setMethod($method) {
        $this->method = $method;
    }
    
    public 
    function setData($data) {
        $this->data = $data;
    }
    
    public 
    function getUrl() {
        return $this->url;
    }
    
    public
    function getCh() {
        return $this->ch;
    }
    
    public
    function getAuthToken() {
        return $this->auth_token;
    }
    
    public 
    function getHeaders() {
        return $this->headers;
    }
    
    public
    function getPostFields() {
        return $this->postfields;
    }
    
    public 
    function getData() {
        return $this->data;
    }
    
    public
    function getInfo() {
        return curl_getinfo($this->getCh());
    }
    
    public 
    function curlPostRequest() 
    {
        $this->setCh(curl_init());
        $ch = $this->getCh();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        curl_setopt($ch, CURLOPT_URL, $this->getUrl());
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getPostFields());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $this->setData(utf8_decode(curl_exec ($ch)));
        curl_close($ch);
    }
    
    public 
    function curlGetRequest() {
        
        $this->setCh(curl_init());
        $ch = $this->getCh();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        curl_setopt($ch, CURLOPT_URL, $this->getUrl());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $this->setData(utf8_decode(curl_exec ($ch)));
        curl_close($ch);
        
    }
}