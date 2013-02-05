<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
         <div class="container">
           <h1><?=$announcement->getTitle()?></h1>
           <h6><?=$announcement->getSubtitle()?> - Mise en ligne par <?=$announcement->getUser()->getLogin();?>
               le <?=date("d/m/Y", strtotime($announcement->getPostDate()))?>
           </h6>
         </div>
        </header>
        <div class="container"> 
            <div class="row">
                <div class="span7 well">
                    <img src="http://placehold.it/800x600" alt="">
                    <br />
                    <hr class="court"><h4 class="blue center">Description</h4>
                    <?=$announcement->getContent()?>
                    <?php if(isset($comments) && !empty($comments)): ?>
                        <hr class="court">
                            <h4 class="blue center">Commentaires</h4>
                        <?php foreach($comments as $comment):?>
                            <h6>
                                <i class="icon-time"></i> 
                                Par <a href="<?=BASE_URL?>/user/account/<?=$comment->getUser()->getId()?>">
                                        <?=$comment->getUser()->getLogin()?>
                                    </a>
                                le <?=$comment->getPostDate()?> 
                            </h6>
                                <p><?=$comment->getContent()?></p>
                            <hr />
                        <?php endforeach;?>
                    <?php endif; ?>
                    
                </div>
                <div class="span4 well">
                    <h5>
                        <i class="icon-user"></i> 
                        <a href="<?=BASE_URL?>/user/account/<?=$announcement->getUser()->getId()?>">
                            <?=$announcement->getUser()->getLogin()?>
                        </a>
                    </h5>
                    <a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;Contacter</a>
                    <a href="#" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i>&nbsp;Postuler</a>
                </div>
            </div>
        </div>
    </div>
</div>

        