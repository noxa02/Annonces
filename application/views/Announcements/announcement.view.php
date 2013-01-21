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
                <div class="span4">
                    <img src="http://placehold.it/800x600" alt="">
                    <br />
                    <hr class="court"><h4>Description</h4>
                    <?=$announcement->getElementsByTagName('content')->item(0)->nodeValue?>
                    <hr class="court"><h4>Commentaires</h4>
                    
                    <?php foreach($announcementComments->getElementsByTagName('comment') as $comment):?>
                        <?=$comment->getElementsByTagName('title')->item(0)->nodeValue?><br />
                        <?=$comment->getElementsByTagName('content')->item(0)->nodeValue?>
                   <?php endforeach;?>
                    
                </div>
                <div class="span4 align-right well">
                    <h5><i class="icon-user"></i>Toto</h5>
                    <a href="#">Voir son profil</a>
                    <hr class="court"><h5>Action</h5>
                    <a href="#" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i>&nbsp;Postuler</a>
                    <a href="#" class="btn btn-primary"><i class="icon-pencil icon-white"></i>&nbsp;Contacter</a><br /><br />
                    <a href="#" class="btn btn-success"><i class="icon-eye-open icon-white"></i>&nbsp;Suivre</a>
                    <a href="#" class="btn btn-warning"><i class="icon-star icon-white"></i>&nbsp;Ajouter aux favoris</a>  
                </div>
            </div>
        </div>
    </div>
</div>

        