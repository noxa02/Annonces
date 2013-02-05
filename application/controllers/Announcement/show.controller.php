<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );
    
    if($router->id) {

        $announcement = new Announcement();
        $announcement->setId($_GET['id']);
        $announcement->initAnnouncementData();
        
        $comment = new Comment();
        $conditions = '?id_announcement='.$announcement->getId();
        $announcementComments = XML_Custom::unserialize($comment->getComments($conditions));
        if(!is_object($announcementComments)) {
            if(isset($announcementComments['comment'][0])) {
                foreach ($announcementComments['comment'] as $key => $comment) {
                    $announcementComment =  new Comment();
                    $announcementComment->setCommentData($comment);
                    $announcementComment->initAnnouncement();
                    $announcementComment->initUser();
                    $comments[] = $announcementComment;
                }  
            } else {
                $announcementComment =  new Comment();
                $announcementComment->setCommentData($announcementComments['comment']);
                $announcementComment->initAnnouncement();
                $announcementComment->initUser();
                $comments[] = $announcementComment;
            }
        }
    }