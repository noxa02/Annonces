<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
         <div class="container">
           <h1><?=$announcement->getElementsByTagName('title')->item(0)->nodeValue?></h1>
           <h6><?=$announcement->getElementsByTagName('subtitle')->item(0)->nodeValue?> - Mise en ligne par Toto le <?=date("d/m/Y", strtotime($announcement->getElementsByTagName('post_date')->item(0)->nodeValue))?></h6>
         </div>
        </header>
        <div class="container"> 
            <div class="row">
                <div class="span7 well">
                    <img src="http://placehold.it/800x600" alt="">
                    <br />
                    <hr class="court"><h4 class="blue center">Description</h4>
                    <?=$announcement->getElementsByTagName('content')->item(0)->nodeValue?>
                    <hr class="court"><h4 class="blue center">Commentaires</h4>
                    
                    <h6><i class="icon-time"></i>&nbsp;Par Jean dubéton, le 06/12/2012</h6>
                    Cette tondeuse à l'air déffectueuse non ? 
                    <hr />
                    <h6><i class="icon-time"></i>&nbsp;Par Chuck Norris, le 07/12/2012</h6>
                    Quand êtes-vous libre dans la semaine ? 
                    <?php foreach($announcementComments->getElementsByTagName('comment') as $comment):?>
                        <?=$comment->getElementsByTagName('title')->item(0)->nodeValue?><br />
                        <?=$comment->getElementsByTagName('content')->item(0)->nodeValue?>
                        <hr />
                   <?php endforeach;?>
                    
                </div>
                <div class="span4 align-right well">
                    <h5><i class="icon-user"></i>Toto</h5>
                    <a href="?m=Member&a=member&id=7" class="btn ">Voir son profil</a>
                    <a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;Contacter</a>
                    <br /><br />
                    <a href="#" class="btn btn-success"><i class="icon-eye-open icon-white"></i>&nbsp;Suivre</a>
                    <hr class="court">
                    <a href="#" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i>&nbsp;Postuler</a>
                    <a href="#" class="btn btn-warning"><i class="icon-star icon-white"></i>&nbsp;Ajouter aux favoris</a>  
                </div>
            </div>
        </div>
    </div>
</div>

        