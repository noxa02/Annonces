<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
            <br />
        </header>
        <div class="container"> 
            <div class="row">
                <!--Identité -->
                <div class="span7 well">
                    <hr /><h4 class="blue center">Identité de Toto</h4><hr />
                    <h6 class="inline-block blue">Nom complet :</h6>&nbsp; <?=$member->getElementsByTagName('firstname')->item(0)->nodeValue?> <?=$member->getElementsByTagName('name')->item(0)->nodeValue?>
                    <br />
                    <h6 class="inline-block blue">Membre depuis le :</h6>&nbsp; <?=date("d/m/Y", strtotime($member->getElementsByTagName('subscription_date')->item(0)->nodeValue))?>
                    <br />
                    <h6 class="inline-block blue">Localisation :</h6>&nbsp; <?=$member->getElementsByTagName('address')->item(0)->nodeValue?>
                </div>
                
                <!--Bloc followers droite-->
                <div class="span4 align-right well">
                    <h5>
                        <i class="icon-star"></i>&nbsp;12 followers <a class="float-right" href="#">Voir tous -></a>
                    </h5>
                        <a href="#"><i class="icon-user"></i> Eric</a> 
                        <a href="#"><i class="icon-user"></i> Jean</a> 
                        <a href="#"><i class="icon-user"></i> Paul</a>
                        <a href="#">...</a>
                        
                    <h5>
                        <i class="icon-star-empty"></i>&nbsp;5 following <a class="float-right" href="#"> Voir tous -></a>
                    </h5>
                        <a href="#"><i class="icon-user"></i> Eric</a> 
                        <a href="#"><i class="icon-user"></i> Edouard</a> 
                        <a href="#"><i class="icon-user"></i> Albert</a>
                        <a href="#">...</a>
                        
                    <hr class="court">
                    <a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;Contacter par message privé</a>
                    <div class="padding-button"></div>
                    <a href="#" class="btn btn-primary "><i class="icon-envelope icon-white"></i>&nbsp;Contacter par mail</a>
                    <div class="padding-button"></div>
                    <a href="#" class="btn btn-success"><i class="icon-eye-open icon-white"></i>&nbsp;Suivre</a> 
                </div>
                <div style="clear:both;"></div>
                
                <!--Bloc annonces droite-->
                <div class="span4 align-right well">
                    <h4 class="blue center">Dernières annonces postées : </h4>
                    <hr />
                    <ul class="nav">
                        <li><a href="#"><i class="icon-bookmark"></i>&nbsp;Pelouse à tondre</a></li>
                        <li><a href="#"><i class="icon-bookmark"></i>Téléphone portable Samsung</a></li>
                        <li><a href="#"><i class="icon-bookmark"></i>Covoiturage Rouen-Paris</a></li>
                    </ul>
                </div>
               
                <!--Derniers commentaires-->
                <div class="span7 well">
                    <hr /><h4 class="blue center">Derniers commentaires : </h4><hr />
                    <h6><a href="#">Annonce lambda</a>, le 19/12/2012</h6>
                    Bonjour, j'aimerais en savoir plus. Bonne soirée
                    <hr />
                    <h6><a href="#">Annonce Omega</a>, le 19/12/2012</h6>
                    Bonjour, j'aimerais en savoir plus. Bonne journée
                    <hr />
                    <h6><a href="#">aiPhone 4 bloqué Orange</a>, le 15/12/2012</h6>
                    Bonjour, y a-t-il possibilité de le faire débloquer ? Cordialement.
                    <hr />
                    <h6><a href="#">Le véritable sabre laser de Darth Vader</a>, le 11/12/2012</h6>
                    Sériously ? ... 
                </div>
                
            </div>
        </div>
    </div>
</div>

