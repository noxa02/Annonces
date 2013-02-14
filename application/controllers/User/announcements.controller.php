<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );

    if(isset($current_user) && !$current_user->isAuthentified()) header('Location:'.BASE_URL);

        $user = new User();
        $user->setId($current_user->getId());
        $user->initUserData();
        $document_title = ' | Mes Annonces - '.$user->getLogin();
        
        $conditions = '&limit=5&order=post_date+DESC&id_user='.$user->getId();
        $userAnnouncements = XML_Custom::unserialize($user->getAnnouncements($conditions));
        if(!is_object($userAnnouncements)) {
            if(isset($userAnnouncements['announcement'][0])) {
                foreach ($userAnnouncements['announcement'] as $key => $announcement) {
                    $userAnnouncement =  new Announcement();
                    $userAnnouncement->setAnnouncementData($announcement);
                    $announcements[] = $userAnnouncement;
                }  
            } else {
                $userAnnouncement =  new Announcement();
                $userAnnouncement->setAnnouncementData($userAnnouncements['announcement']);
                $announcements[] = $userAnnouncement;
            }
        }