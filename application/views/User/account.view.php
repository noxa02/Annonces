<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
            <br />
        </header>
        <div class="container content"> 
            <div class="row">
                <!--Identité -->
                <div class="span7 well">
                    <?php if($current_user->getId() != $user->getId()): ?>
                    <div id="social-buttons">
                     <hr class="court">
                        <a href="javascript:void(0)" class="btn btn-success follow" id="button-follow"
                                                                            data-user="<?=$user->getId()?>" 
                                                                            data-current-user="<?=$current_user->getId()?>"
                        >
                            <i class="icon-white icon-thumbs-up"></i><span>Suivre</span>
                        </a>
                    </div>
                    <?php endif; ?>
                    <hr /><h4 class="blue center">Profil de <?=$user->getLogin()?></h4><hr />
                    <h6 class="block blue">Nom :                </h6> <?=$user->getName()?>
                    <h6 class="block blue">Prénom :             </h6> <?=$user->getFirstname()?>
                    <h6 class="block blue">Membre depuis le :   </h6> <?=date("d/m/Y", strtotime($user->getSubscriptionDate()))?>
                    <h6 class="block blue">Localisation :       </h6> <?=$user->getAddress()?>
                </div>
                
                <?php if(isset($comments) && !empty($comments) 
                        || isset($announcements) && !empty($announcements)
                        || isset($followers) && !empty($followers) ): ?>
                <!--Bloc droite-->
                <div class="span4 align-right well">
                    <div class="span4 sidebar" style="margin: 0;">      
                        <div class="widget">
                            <ul id="myTab" class="nav nav-tabs three-tabs fancy">
                                <?php if(isset($comments) && !empty($comments)): ?>
                                    <li class="active"><a href="#comments" data-toggle="tab">Comments</a></li>
                                <?php endif; ?>
                                <?php if(isset($followers) && !empty($followers)): ?>
                                    <li><a href="#followers" data-toggle="tab"><i class="icon-user icon-thumbs-up"></i>Followers</a></li>
                                <?php endif; ?>
                                <?php if(isset($announcements) && !empty($announcements)): ?>            
                                    <li class="dropdown">
                                      <a href="#announcements" data-toggle="tab">Annonces</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <div class="tab-content">
                                <?php if(isset($comments) && !empty($comments)): ?>
                                <div class="tab-pane fade in active" id="comments">
                                    <div class="posts">
                                        <div class="comments well">
                                            <ul id="comments-list" class="media-list">
                                            <?php foreach($comments as $comment):?>
                                                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-6">
                                                    <div class="comment-box">
                                                        <div class="comment-author">
                                                            <a href="<?=BASE_URL?>/announcement/show/<?=$comment->getAnnouncement()->getId()?>">
                                                                <strong><?=$comment->getAnnouncement()->getTitle()?></strong>
                                                            </a>
                                                        </div>
                                                        <div class="cmeta"><?=$comment->getPostDate()?></div>
                                                        <div class="clearfix"></div>
                                                            <p>&ldquo;<i><?=$comment->getContent()?></i>&rdquo;</p>
                                                        <div class="clearfix"></div>
                                                        <div class="clear"></div>
                                                    </div>
                                                 </li>
                                            <?php endforeach;?>  
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($followers)): ?>
                                <!--Bloc followers-->
                                <div class="tab-pane fade" id="followers">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr><i class="icon-thumbs-up"></i> <?=count($followers)?> Followers</tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($followers) > 0): ?> 
                                            <?php foreach($followers as $follower): ?>
                                            <tr>
                                                <td>
                                                   <a href="<?=BASE_URL?>/user/account/<?=$follower->getId()?>">
                                                        <i class="icon-user"></i> <?=$follower->getLogin()?>
                                                   </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <?php endif; ?>
                                    </table>
                                </div>
                                <?php endif; ?>

                                <?php if(isset($announcements)): ?>
                                <!--Bloc Announcements-->
                                <div class="tab-pane fade" id="announcements">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr><i class="icon-white icon-list-alt"></i> <?=count($announcements)?> annonces</tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($announcements) > 0): ?> 
                                            <?php foreach($announcements as $announcement): ?>
                                            <tr>
                                                <td>
                                                    <a href="<?=BASE_URL.'/announcement/show/'.$announcement->getId()?>">
                                                        <i class="icon-bookmark"></i><?=$announcement->getTitle()?>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <?php endif; ?>
                                    </table>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div> 
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=BASE_URL?>/js/Action/User.js"></script>