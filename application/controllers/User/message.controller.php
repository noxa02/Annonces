<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );
    /*
    $url = 'http://rest.asimpletrade.fr:8086/users/'.$_GET['id'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Client web Annonces - member');
    $result = utf8_decode(curl_exec ($ch));
    curl_close($ch);

    $member = new DOMDocument();
    @$member->loadHTML($result);
     */
    
    /**
     * METHODE POST
     */
    
    if(!empty($_POST)){
        $message = htmlspecialchars(nl2br($_POST['response']));
        $vars='content='.$message.'&subject=Votre_Annonce'.'&id_sender=1'.'&id_receiver=5';
        
        $ch=curl_init('http://rest.asimpletrade.fr:8086/messages/');
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        
        /**
         * Partie debug (Décommenter pour afficher les erreurs de cURL)
         */
            echo $vars;
        if (!$ret) {
            echo curl_error($ch);
        } else {
            echo $ret;
        }

        curl_close($ch);
    }
    