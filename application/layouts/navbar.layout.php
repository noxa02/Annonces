<div class="navbar navbar-fixed-top nav-top-custom">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?=BASE_URL?>"> A Simple Trade  <img src="<?=BASE_URL?>/images/logo_64x64.png" class="img-polaroid"> </a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a href="<?=BASE_URL?>"> Accueil </a></li>                  
                    <li><a href="<?=BASE_URL?>/announcements/list" >Annonces</a></li>
                    <li><a href="javascript:void(0)">Inscription</a></li>
                    <li><a href="#contact" >Contact</a></li>
                    <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>
                    <li class="divider-vertical"></li>                          
                    <ul id="account-user" class="nav">
                        <div id="user-picture" class="pull-left">
                            <img class="thumbnail" src="http://placehold.it/50x50" alt="" width="50" height="50">
                        </div>
                        <div class="btn-group pull-left">
                          <a class="btn" href="#"><i class="icon-user"></i> Mon Compte </a>
                          <a class="btn dropdown-toggle" data-toggle="dropdown" href=""><span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="icon-pencil"></i> Modifier mon compte </a></li
                            <li><a href="javascript:void(0)"><i class="icon-th-list"></i> Mes Annonces </a></li>
                            <li><a href="javascript:void(0)"><i class="icon-eye-open"></i> Mes Trocs </a></li>
                            <li class="divider"></li>
                            <li><a href="<?=BASE_URL?>/user/logout"><i class="icon-off"></i> Se deconnecter </a></li>
                          </ul>
                        </div>
                    </ul>
                    <li class="divider-vertical"></li>
                    <?php } else { ?>
                    <li>
                    <?php
                        if(isset($layouts['connexion']) && $layouts['connexion']) {
                            include APPLICATION_PATH . '/layouts/connexion.layout.php';
                        }
                    ?>                       
                    </li>
                    <?php } ?>
                </ul>
                <form id="search-bar" class="navbar-search form-search pull-right">
                    <div class="input-prepend">
                      <button class="btn btn-primary" type="submit">Recherche <i class="icon-search icon-white"></i></button>
                      <input type="text" class="search-query">
                    </div>
                </form>                        
            </div>
        </div>
    </div>
</div>