<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
            <br />
        </header>
        <div class="container"> 
            <div class="row">
                <div class="span7 well">
                    <div style="text-align: center;">
                        <img src="http://placehold.it/350x250" alt="">
                    </div>
                    <br />
                    <!--Identité -->
                    <hr /><h4 class="blue center">Identité</h4><hr />
                    <h6 class="blue">Nom complet :</h6>&nbsp; <?=$member->getElementsByTagName('firstname')->item(0)->nodeValue?> <?=$member->getElementsByTagName('name')->item(0)->nodeValue?>
                    <h6 class="blue">Membre depuis le :</h6><?=date("d/m/Y", strtotime($member->getElementsByTagName('subscription_date')->item(0)->nodeValue))?>
                    <h6 class="blue">Localisation :</h6> <?=$member->getElementsByTagName('address')->item(0)->nodeValue?>
                    
                    <!--Commentaires-->
                    <hr /><h4 class="blue center">Derniers commentaires : </h4><hr />
                    <h6><a>Annonce lambda</a>, le 19/12/2012</h6>
                    Bonjour, j'aimerais en savoir plus. Bonne soirée
                    <hr />
                    <h6><a>Annonce Omega</a>, le 19/12/2012</h6>
                    Bonjour, j'aimerais en savoir plus. Bonne journée
                    <hr />
                    <h6><a>aiPhone 4 bloqué Orange</a>, le 15/12/2012</h6>
                    Bonjour, y a-t-il possibilité de le faire débloquer ? Cordialement.
                    <hr />
                    <h6><a>Le véritable sabre laser de Darth Vader</a>, le 11/12/2012</h6>
                    Sériously ? ... 
                </div>
                
                <div class="span4 align-right well">
                    <h5><i class="icon-user"></i>Toto</h5>
                    <hr />
                    <h5><i class="icon-star"></i>Followers</h5>
                    12 personnes suivent Toto
                    <h5><i class="icon-star-empty"></i>Following</h5>
                    Toto suit 5 personnes
                    <hr class="court">
                    <a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;Contacter</a>
                    <a href="#" class="btn btn-success"><i class="icon-eye-open icon-white"></i>&nbsp;Suivre</a> 
                </div>
                <div class="span4 align-right well">
                    <h4 class="blue center">Dernières annonces postées : </h4>
                    <hr />
                    <ul class="nav">
                        <li><a href="#"><i class="icon-bookmark"></i>&nbsp;Pelouse à tondre</a></li>
                        <li><a href="#"><i class="icon-bookmark"></i>Téléphone portable Samsung</a></li>
                        <li><a href="#"><i class="icon-bookmark"></i>Covoiturage Rouen-Paris</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

        