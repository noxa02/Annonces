<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );
/**
 * Récupération de l'annonce
 */
    $url = 'http://rest.asimpletrade.fr:8086/announcements/48';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Client TEST Annonces - annonce');
    $result = utf8_decode(curl_exec ($ch));
    curl_close($ch);

    $announcement = new DOMDocument();
    @$announcement->loadHTML($result);

/**
 * Récupération des commentaires
 */

    $urlC = 'http://rest.asimpletrade.fr:8086/announcements/48/comments/';
    $chC = curl_init();
    curl_setopt($chC, CURLOPT_URL, $urlC);
    curl_setopt($chC, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($chC, CURLOPT_USERAGENT, 'Client TEST Annonces - commentaires');
    $resultC = utf8_decode(curl_exec ($chC));
    curl_close($chC);

    $announcementComments = new DOMDocument();
    @$announcementComments->loadHTML($resultC);
