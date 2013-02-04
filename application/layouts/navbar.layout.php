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
                    <li><a href="<?=BASE_URL?>/user/register">Inscription</a></li>
                    <li><a href="<?=BASE_URL?>/Common/contact" >Contact</a></li>
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
            </div>
        </div>
    </div>
</div>
<div id="deroule">
    <div class="container">
        <div class="icon-chevron-down icon-white" style="float:left;"></div><p>Rechercher une annonce</p>
    </div>

</div>
<div id="search-panel">
    <div class="container">
        <form id="search-bar" class="navbar-search form-search">
              <input type="text" class="search-query">
              <select>
                  <option>Objet</option>
                  <option>Service</option>
              </select>
              <select>
                  <option>01-Ain</option>
                  <option>02-Aisne</option>
                  <option>03-Allier</option>
                  <option>04-Alpes de Haute-Provence</option>
                  
              </select>
              <button class="btn btn-primary" type="submit">Recherche <i class="icon-search icon-white"></i></button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#search-panel").hide();
        $("#deroule").click(function(){
            if($(this).next().is(":hidden")){
			$(this).next().slideDown('slow');
			$(this).children().children(":first").removeClass("icon-chevron-down").addClass("icon-chevron-up");
                        $(this).children().children(":last").html("Cacher le volet");
		} else if($(this).next().is(":visible")) {
			$(this).next().slideUp('slow');
			$(this).children().children(":first").removeClass("icon-chevron-up").addClass("icon-chevron-down");
                        $(this).children().children(":last").html("Rechercher une annonce");
		}
        });
    });
</script>