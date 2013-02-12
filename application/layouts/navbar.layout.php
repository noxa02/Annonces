<div class="navbar nav-top-custom">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?=BASE_URL?>"><img src="<?=BASE_URL?>/images/logo_64x64.png" > </a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a href="<?=BASE_URL?>"> Accueil </a></li>                  
                    <li><a href="<?=BASE_URL?>/announcements/list">Annonces</a></li>
                    <li><a href="<?=BASE_URL?>/search/show">Recherche</a></li>
                    <?php if(!$current_user->isAuthentified()): ?>
                    <li><a href="<?=BASE_URL?>/user/register">Inscription</a></li>
                    <?php endif; ?>
                    <li><a href="<?=BASE_URL?>/Common/contact" >Contact</a></li>
                    <?php if($current_user->isAuthentified()): ?>
                    <li class="divider-vertical"></li>                          
                    <ul id="account-user" class="nav">
                        <div id="user-picture" class="pull-left">
                            <img class="thumbnail" src="http://placehold.it/50x50" alt="" width="50" height="50">
                        </div>
                        <div class="btn-group pull-left">
                          <a class="btn" href="<?=BASE_URL?>/user/account/<?=$current_user->getId()?>"><i class="icon-user"></i> Mon Compte </a>
                          <a class="btn dropdown-toggle" data-toggle="dropdown" href=""><span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="icon-pencil"></i> Modifier mon compte </a></li
                            <li><a href="javascript:void(0)"><i class="icon-th-list"></i> Mes Annonces </a></li>
                            <li><a href="javascript:void(0)"><i class="icon-eye-open"></i> Mes Trocs </a></li>
                            <li class="divider"></li>
                            <li><a id="logout" href="<?=BASE_URL?>/user/logout"><i class="icon-off"></i> Se deconnecter </a></li>
                          </ul>
                        </div>
                    </ul>
                    <li class="divider-vertical"></li>
                    <?php else : ?>
                    <li>
                    <?php
                        if(isset($layouts['connexion']) && $layouts['connexion']) {
                            include APPLICATION_PATH . '/layouts/connexion.layout.php';
                        }
                    ?>                       
                    </li>
                    <?php endif ?>
                   </ul>
            </div>
        </div>
    </div>
</div>
<div id="deroule"></div>