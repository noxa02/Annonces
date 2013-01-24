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
                    <h6><?=$member->getElementsByTagName('firstname')->item(0)->nodeValue?> <?=$member->getElementsByTagName('name')->item(0)->nodeValue?></h6>
                    <h6>Membre depuis le <?=date("d/m/Y", strtotime($member->getElementsByTagName('subscription_date')->item(0)->nodeValue))?></h6> 
                    <a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;Contacter</a>
                    <a href="#" class="btn btn-success"><i class="icon-eye-open icon-white"></i>&nbsp;Suivre</a>
                </div>
            </div>
        </div>
    </div>
</div>

        