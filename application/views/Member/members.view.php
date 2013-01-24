<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
         <div class="container">
           <h1>Liste des membres</h1>
         </div>
        </header>
        <div class="container">          
            <div class="row">
              <div class="span12">
                <br />
                <div class="row-fluid padding-top15">
                    <ul class="thumbnails">
                      <?php foreach($members->getElementsByTagName('user') as $member): ?>
                      <li class="thumbnail">
                          <div class="memberList">
                              <img src="http://placehold.it/60x80" alt="">
                              <br /><?=$member->getElementsByTagName('login')->item(0)->nodeValue?>
                              <br />Localisation
                              <br />Nombre d'annonces postées
                              <br /><a href="?m=member&amp;a=member&amp;id=1" class="btn btn-primary"><i class="icon-eye-open icon-white"></i>&nbsp;Fiche détaillée</a>
                          </div>
                      </li>
                      <?php endforeach; ?>
                      <div class="clear"></div>
                    </ul>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
