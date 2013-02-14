<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );

    if(isset($current_user) && !$current_user->isAuthentified()) header('Location:'.BASE_URL);

    if($router->id) {

        $user = new User();
        $user->setId($router->id);
        $user->initUserData();
        $document_title = ' | Compte de '.$user->getLogin();

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

        $conditions = '&limit=3&order=id DESC';
        $userComments = XML_Custom::unserialize($user->getComments($conditions));
        if(!is_object($userComments)) {
            if(isset($userComments['comment'][0])) {
                foreach ($userComments['comment'] as $key => $comment) {
                    $userComment =  new Comment();
                    $userComment->setCommentData($comment);
                    $userComment->initAnnouncement();
                    $userComment->initUser();
                    $comments[] = $userComment;
                }
            } else {
                $userComment =  new Comment();
                $userComment->setCommentData($userComments['comment']);
                $userComment->initAnnouncement();
                $userComment->initUser();
                $comments[] = $userComment;
            } 
        }
        
        $conditions = '&limit=5&order=post_date+DESC';
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
    }