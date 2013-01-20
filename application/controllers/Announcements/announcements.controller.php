<?php 
    $layouts_ = array(
      'header'      => true,
      'main_nav'    => true,
      'connexion'   => true,
      'footer'      => true,
    );
    
    $url = 'http://rest.asimpletrade.fr:8086/announcements';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Client web Annonces - annonces');
    $result = utf8_decode(curl_exec ($ch));
    curl_close($ch);

    $announcements = new DOMDocument();
    @$announcements->loadHTML($result);