<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );
    
    if(isset($current_user) && !$current_user->isAuthentified()) {
        header('Location:'.BASE_URL);
    }
    $document_title = ' | Ajouter mon Annonce';