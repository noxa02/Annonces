<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );
    
    if($router->id) {
        $user = new User();
        $user->setId($router->id);
        $user->initUserData();

        $followersArray = XML_Custom::unserialize($user->getFollowers());
        if(!is_object($followersArray)) {
            if(isset($followersArray['user'][0])) {
                foreach ($followersArray['user'] as $key => $follower) {
                    $userFollower =  new User();
                    $userFollower->setUserData($follower);
                    $followers[] = $userFollower;
                }  
            } else {
                $userFollower =  new User();
                $userFollower->setUserData($followersArray['user']);
                $followers[] = $userFollower;
            } 
        }

        

      $conditions = '&limit=3';
      $userComments = XML_Custom::unserialize($user->getComments($conditions));
      if(!is_object($userComments)) {
        foreach ($userComments['comment'] as $key => $comment) {
            $userComment =  new Comment();
            $userComment->setCommentData($comment);
            $announcement = new Announcement();
            $conditions = $userComment->getIdAnnouncement();
            $announcementArray = XML_Custom::unserialize($announcement->getAnnouncements($conditions));
            $announcement->setAnnouncementData($announcementArray);
            $userComment->setAnnouncement($announcement);
            $comments[] = $userComment;
        } 
      }
      
      $conditions = '&limit=5&order=post_date+DESC';
      $userAnnouncements = XML_Custom::unserialize($user->getAnnouncements($conditions));
      if(!is_object($userAnnouncements)) {
        foreach ($userAnnouncements['announcement'] as $key => $announcement) {
            $userAnnouncement =  new Announcement();
            $userAnnouncement->setAnnouncementData($announcement);
            $announcements[] = $userAnnouncement;
        } 
      }
    }