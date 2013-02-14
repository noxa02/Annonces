<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
         <div class="container">
           <h1>Mes Annonces</h1>
         </div>
        </header>
        <div class="container content">          
            <div class="row">
                <div class="box span12">
                    <div class="box-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Date de publication</th>
                                    <th>Type</th>
                                    <th></th>
                                </tr>
                            </thead>   
                            <tbody>
                            <?php if(isset($announcements) && !empty($announcements)): ?>
                                <?php foreach($announcements as $announcement): ?>
                                <tr>
                                    <td><?=$announcement->getTitle()?></td>
                                    <td class="center"><?=$announcement->getPostDate()?></td>
                                    <td class="center"><?=$announcement->getType()?></td>
                                    <td class="center">
                                        <a class="btn" href="<?=BASE_URL?>/announcement/modify/<?=$announcement->getId()?>">
                                            <i class="icon-edit"></i>                                            
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/User.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/Announcement.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/Comment.js"></script>