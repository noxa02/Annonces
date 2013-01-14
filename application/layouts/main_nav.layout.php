<div class="navbar navbar-fixed-top nav-top-custom">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>P
            </a>
            <a class="brand" href="#"> A Simple Trade  <img src="images/logo_64x64.png" class="img-polaroid"> </a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a href="#"> Accueil </a></li>                  
                    <li><a href="#about">A Propos</a></li>
                    <li><a href="?p=inscription">Inscription</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <?php // Manage Member Account [Need to be connected] ?>
                    <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>
                    <li class="divider-vertical"></li>                          
                    <ul class="nav">
                        <div class="pull-left padding-top5 padding-bottom5">
                            <img class="thumbnail" src="http://placehold.it/50x50" alt="" width="50" height="50">
                        </div>
                        <div class="btn-group pull-left padding-left5 padding-top15">
                          <a class="btn" href="#"><i class="icon-user"></i> Mon Compte </a>
                          <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="#"><i class="icon-pencil"></i> Modifier mon compte </a></li
                            <li><a href="#"><i class="icon-th-list"></i> Mes Annonces </a></li>
                            <li><a href="#"><i class="icon-eye-open"></i> Mes Trocs </a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-off"></i> Se deconnecter </a></li>
                          </ul>
                        </div>
                    </ul>
                    <li class="divider-vertical"></li>
                    <?php } else { ?>
                    <li>
                    <?php
                        if($layouts_['connexion'] == true) {
                            include APPLICATION_PATH . '/layouts/connexion.layout.php';
                        }
                    ?>                       
                    </li>
                    <?php } ?>
                </ul>
                <form class="navbar-search form-search pull-right padding-top15">
                    <div class="input-prepend">
                      <button class="btn btn-primary" type="submit">Recherche <i class="icon-search icon-white"></i></button>
                      <input type="text" class="search-query">
                    </div>
                </form>                        
            </div>
        </div>
    </div>
</div>