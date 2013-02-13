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
           $announcement->initPictures();
           $announcement->initUser();
         
           /**
            *  Check if current user is author of this announcement
            */
           //if($current_user->getLogin() != $announcement->getUser()->getLogin()) header('Location:'.BASE_URL);
           
           $pictures = $announcement->getPictures();
           $originalPicturesId = array();
           if(isset($pictures) && !empty($pictures)) {
               
               if(isset($pictures[0]) && !empty($pictures[0])) {
                    $i = 0;
                    foreach ($pictures as $picture) {
                        if($picture->getPath() == '/announcement/original/') {
                            $originalPicturesId[$picture->getTitle()] = $picture->getId();
                        }
                        if(!isset($thumbnailPictures) || !in_array($picture->getTitle(), $thumbnailPictures)) {
                            $thumbnailPictures[$picture->getTitle()] = $picture->getResized(260, 80);
                        }
                       $i++;
                   }
               } else if($pictures && !empty($pictures)) {
                    if(!isset($thumbnailPictures) || !in_array($picture->getTitle(), $thumbnailPictures)) {
                        $thumbnailPictures[$picture->getTitle()] = $picture->getResized(260, 80);
                    }
               }  
           }
       }