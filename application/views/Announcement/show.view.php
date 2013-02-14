<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
            <div class="container">
                <h1><?=$announcement->getTitle()?></h1>
                <h6>
                    <?=$announcement->getSubtitle()?> - Mise en ligne par 
                    <a href="<?=BASE_URL?>/user/account/<?=$announcement->getUser()->getId()?>">
                        <?=$announcement->getUser()->getLogin()?>
                    </a>
                    le <?=date("d/m/Y", strtotime($announcement->getPostDate()))?>
                </h6>
            </div>
        </header>
        <div class="container content"> 
            <div class="row">
                <div id="wrapper-announcement-detail" class="span8 well">
                    <div>
                        <?php if(isset($pictures)): ?>
                            <?php if(isset($mainPicture) && !empty($mainPicture)): ?>
                                <img src="<?=$mainPicture->getUrlWs()?>" alt="">
                            <?php elseif(!empty($pictures)): ?>
                            <?php endif ?>
                        <?php endif; ?>
                        <div class="description">
                            <hr>
                            <h3><span class="comment-heading">Description</span></h3>
                            <p class="comment-box"><?=$announcement->getContent()?></p>
                        </div>
                    </div>
                </div>
                <div class="span4 well pull-right">
                    <h5>
                        <i class="icon-user"></i> 
                        <a href="<?=BASE_URL?>/user/account/<?=$announcement->getUser()->getId()?>">
                            <?=$announcement->getUser()->getLogin()?>
                        </a>
                    </h5>
                    <?php if($announcement->getUser()->getLogin() != $current_user->getLogin()) { ?>
                    <a href="javascript:void(0)" id="apply" class="btn btn-primary">
                        <i class="icon-plus-sign icon-white"></i>Postuler
                    </a>
                    <?php } ?>
                    <?php if(isset($thumbnailPictures) && !empty($thumbnailPictures)): ?>
                    <ul id="thumbnails" class="thumbnails ">
                        <?php foreach($thumbnailPictures as $thumbnailPicture): ?>
                            <?php if(!emptyObjectMethod($thumbnailPicture)): ?>
                                <li class="span3 thumbnail">
                                  <a href="#">
                                    <img src="<?=$thumbnailPicture->getUrlWs()?>" alt="<?=$thumbnailPicture->getAlternative()?>">
                                  </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <div class="span8">
                    <div class="posts">
                        <div class="comments well">
                            <?php if(isset($comments)): ?>
                            <h3><span class="comment-heading">Commentaires - </span> <?=count($comments)?> réponses </h3>
                            <ul id="comments-list" class="media-list <?php if(isset($comments) && empty($comments)): 'hide'; endif; ?>">
                            <?php if((isset($comments) && !empty($comments))):?>
                            <?php foreach($comments as $comment):?>
                                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-6">
                                    <div class="comment-box">
                                        <div class="comment-author">
                                            <a href="<?=BASE_URL?>/user/account/<?=$comment->getUser()->getId()?>">
                                                <strong><?=$comment->getUser()->getLogin()?></strong>
                                            </a>
                                        </div>
                                        <div class="cmeta"><?=$comment->getPostDate()?></div>
                                        <div class="clearfix"></div>
                                            <p><?=$comment->getContent()?></p>
                                        <div class="clearfix"></div>
                                        <div class="clear"></div>
                                    </div>
                                 </li>
                            <?php endforeach;?>  
                            </ul>
                            <?php endif; ?>`
                            `<?php endif; ?>
                            <div class="add-comment">
                                <h4 class="center">Ajouter un commentaire</h4>
                                <form id="form-announcement-comment">
                                    <div class="control-group">
                                        <textarea cols="70" rows="3" name="content" data-type="text"></textarea>
                                    </div>
                                    <input type="hidden" name="id_user" value="<?=$current_user->getId()?>"/>
                                    <input type="hidden" name="id_announcement" value="<?=$announcement->getId()?>"/>
                                    <div class="control-group center">
                                        <button type="button" id="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/User.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/Announcement.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/Comment.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Form/AnnouncementCommentForm.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Action/ApplyAnnouncement.js"></script>