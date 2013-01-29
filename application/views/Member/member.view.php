<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
         <div class="container">
           <h1>Fiche de <?=$member->getElementsByTagName('login')->item(0)->nodeValue?></h1>
         </div>
        </header>
        <div class="container"> 
            <div class="row">
                <div class="span4">
                    <img src="http://placehold.it/200x100" alt="">
                    <br />
                    <h6>Nom complet : <?=$member->getElementsByTagName('firstname')->item(0)->nodeValue?> <?=$member->getElementsByTagName('name')->item(0)->nodeValue?></h6>
                    <h6>Membre depuis le :<?=date("d/m/Y", strtotime($member->getElementsByTagName('subscription_date')->item(0)->nodeValue))?></h6> 
                    <h6>Localisation :<?=$member->getElementsByTagName('address')->item(0)->nodeValue?></h6> 
                    <!--Commentaires-->
                    <h4>Derniers commentaires : </h4>
                    <h6>Annonce lambda, le 19/12/2012</h6>
                    Bonjour, j'aimerais en savoir plus. Bonne soirée
                    <hr />
                    <h6>Annonce Omega, le 19/12/2012</h6>
                    Bonjour, j'aimerais en savoir plus. Bonne journée
                </div>
                
                <div class="span4 align-right well">
                    <h5><i class="icon-user"></i>Toto</h5>
                    <hr />
                    <h5><i class="icon-star"></i>Followers</h5>
                    12 personnes suivent Toto
                    <h5><i class="icon-star-empty"></i>Following</h5>
                    Toto suit 5 personnes
                    <hr class="court"><h5>Action</h5>
                    <a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;Contacter</a>
                    <a href="#" class="btn btn-success"><i class="icon-eye-open icon-white"></i>&nbsp;Suivre</a> 
                </div>
            </div>
        </div>
    </div>
</div>

        