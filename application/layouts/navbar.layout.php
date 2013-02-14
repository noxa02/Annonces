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
                    <li <?php if(strstr(strstr($_SERVER['REQUEST_URI'], "web", false), "/", false) == "/"){ echo 'class="active"';} ?>>
                        <a href="<?=BASE_URL?>"> Accueil </a></li>
                    <?php if($current_user->isAuthentified()): ?>
                    <li <?php if(strstr(strstr($_SERVER['REQUEST_URI'], "announcements", false), "/", true) == "announcements"){ echo 'class="active"';} ?>>
                        <a href="<?=BASE_URL?>/announcements/list">Annonces</a></li>
                    <li <?php if(strstr(strstr($_SERVER['REQUEST_URI'], "search", false), "/", true) == "search"){ echo 'class="active"';} ?>>
                        <a href="<?=BASE_URL?>/search/show">Recherche</a></li>
                    <?php endif; ?>
                    <?php if(!$current_user->isAuthentified()): ?>
                    <li <?php if(strstr(strstr($_SERVER['REQUEST_URI'], "user", false), "/", true) == "user"){ echo 'class="active"';} ?>>
                        <a href="<?=BASE_URL?>/user/register">Inscription</a></li>
                    <?php endif; ?>
                    <li <?php if(strstr(strstr($_SERVER['REQUEST_URI'], "Common", false), "/", true) == "Common"){ echo 'class="active"';} ?>>
                        <a href="<?=BASE_URL?>/Common/contact" >Contact</a></li>
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
                            <li>
                                <a href="<?=BASE_URL?>/user/modify/<?=$current_user->getId()?>">
                                    <i class="icon-edit"></i> Modifier mon compte 
                                </a>
                            </li>
                            <li>
                                <a href="<?=BASE_URL?>/announcement/add">
                                    <i class="icon-pencil"></i> Ajouter une annonce 
                                </a>
                            </li>
                            <li>
                                <a href="<?=BASE_URL?>/user/announcements">
                                    <i class="icon-th-list"></i> Mes Annonces 
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="icon-eye-open"></i> Mes Trocs
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a id="logout" href="<?=BASE_URL?>/user/logout">
                                    <i class="icon-off"></i> Se deconnecter 
                                </a>
                            </li>
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