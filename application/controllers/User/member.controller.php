<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );
    
    $url = 'http://rest.asimpletrade.fr:8086/users/7';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Client web Annonces - member');
    $result = utf8_decode(curl_exec ($ch));
    curl_close($ch);

    $member = new DOMDocument();
    @$member->loadHTML($result);