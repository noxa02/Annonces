<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
            <br />
        </header>
        <div class="container"> 
            <div class="row">
                <!--Identité -->
                <div class="span7 well">
                    <?php if($current_user->getId() != $user->getId()): ?>
                    <div id="social-buttons">
                     <hr class="court">
                        <a href="#" class="btn btn-primary">
                            <i class="icon-pencil icon-white"></i>Contacter par message privé</a>
                        <div class="padding-button"></div>
                        <a href="#" class="btn btn-primary ">
                            <i class="icon-envelope icon-white"></i>Contacter par mail</a>
                        <div class="padding-button"></div>
                        <a href="javascript:void(0)" class="btn btn-success follow" id="button-follow"
                                                                            data-user="<?=$user->getId()?>" 
                                                                            data-current-user="<?=$current_user->getId()?>"
                        >
                            <i class="icon-eye-open icon-white"></i> <span>Suivre</span>
                        </a>       
                    </div>
                    <?php endif; ?>
                    <hr /><h4 class="blue center">Profil de <?=$user->getLogin()?></h4><hr />
                    <h6 class="block blue">Nom :                </h6> <?=$user->getName()?>
                    <h6 class="block blue">Prénom :             </h6> <?=$user->getFirstname()?>
                    <h6 class="block blue">Membre depuis le :   </h6> <?=date("d/m/Y", strtotime($user->getSubscriptionDate()))?>
                    <h6 class="block blue">Localisation :       </h6> <?=$user->getAddress()?>
                </div>
                <?php if(isset($followers)): ?>
                <!--Bloc followers droite-->
                <div class="span4 align-right well">
                    <?php if(count($followers) > 0): ?> 
                    <h5>
                        <i class="icon-star"></i> <?=count($followers)?> followers 
                        <?php if(count($followers) >= 5) {?><a class="float-right" href="#">Voir tous -></a><?php } ?>
                    </h5>
                    <?php 
                        foreach($followers as $follower) {
                            print '<a href="'.BASE_URL.'/user/account/'.$follower->getId().'">
                                        <i class="icon-user"></i> '.$follower->getLogin().'
                                   </a>';
                        }
                    ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if(isset($announcements) && !empty($announcements)): ?>
                <!--Bloc annonces droite-->
                <div class="span4 align-right well">
                    <h4 class="blue center">Dernières annonces : </h4>
                    <hr />
                    <ul class="nav">
                    <?php foreach($announcements as $announcement): ?>
                        <li>
                            <a href="<?=BASE_URL.'/announcement/show/'.$announcement->getId()?>">
                                <i class="icon-bookmark"></i><?=$announcement->getTitle()?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if(isset($comments) && !empty($comments)): ?>
                <!--Derniers commentaires-->
                <div class="span7 well">
                    <hr /><h4 class="blue center">Derniers commentaires : </h4><hr />
                    <?php foreach($comments as $comment): ?>
                    <?php $announcement = $comment->getAnnouncement(); ?>
                    <h6> 
                        <a href="<?=BASE_URL.'/announcement/show/'.$announcement->getId()?>">
                            <?=$announcement->getTitle()?>
                        </a>,
                        le <?=date("d/m/Y", strtotime($comment->getPostDate()))?>
                    </h6>
                    <p><?=$comment->getContent()?></p>
                    <hr />
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=BASE_URL?>/js/Action/User.js"></script>