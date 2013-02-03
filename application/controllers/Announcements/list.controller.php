<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );
    
    /**
    * Récupération des annonces
    */
    $url = 'http://rest.asimpletrade.fr:8086/announcements';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Client TEST Annonces - annonces');
    $result = utf8_decode(curl_exec ($ch));
    curl_close($ch);

    $announcements = new DOMDocument();
    @$announcements->loadHTML($result);