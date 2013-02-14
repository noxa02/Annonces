<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );
    
    if(isset($current_user) && !$current_user->isAuthentified()) header('Location:'.BASE_URL);
    if($router->id) {

        $announcement = new Announcement();
        $announcement->setId($_GET['id']);
        $announcement->initAnnouncementData();
        if($announcement->getTitle() == '') header('Location:'.BASE_URL);
        $document_title = ' | '.$announcement->getTitle().'-'.$announcement->getId();
        $announcement->initPictures();
        $announcement->initUser();
        $pictures = $announcement->getPictures();
        if(isset($pictures) && !empty($pictures)) {
            if(isset($pictures[0]) && !empty($pictures[0])) {
                $i = 0;
                foreach ($pictures as $picture) {
                    if(isset($i) && $i == 0) {
                        $mainPicture = $picture->getResized(800, 600);
                    } else {
                        if(!isset($thumbnailPictures) || !in_array($picture->getTitle(), $thumbnailPictures)
                                && $picture->getWidth() != 260 && $picture->getHeight() != 80) {
                            if($picture->getPath() == '/announcement/260x80/') {
                                $thumbnailPictures[$picture->getTitle()] = $picture;
                            } elseif($picture->getPath() == '/announcement/original/'){
                                $thumbnailPictures[$picture->getTitle()] = $picture->getResized(260, 80);
                            }
                        }
                    }
                    $i++;
                }
            } elseif($pictures && !empty($pictures)) {
                $mainPicture = $pictures->getResized(800, 600);
            }  
        }

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