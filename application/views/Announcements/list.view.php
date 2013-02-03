<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
         <div class="container">
           <h1>Les dernières annonces</h1>
         </div>
        </header>
        <div class="container">          
            <div class="row">
              <div class="span12">
                Retrouvez ici les dernières annonces postées par les utilisateurs. <br />
                <div class="row-fluid padding-top15">
                    <ul class="thumbnails">
                      <?php foreach($announcements->getElementsByTagName('announcement') as $announcement): ?>
                      <li class="thumbnail">
                        <div class="date">
                           Date de mise en ligne : <?=date("d/m/Y", strtotime($announcement->getElementsByTagName('post_date')->item(0)->nodeValue))?>
                        </div>
                          <h4><a href="?m=announcements&amp;a=announcement&amp;id=<?=$announcement->getElementsByTagName('id')->item(0)->nodeValue?>"><?=$announcement->getElementsByTagName('title')->item(0)->nodeValue?></a></h4>
                        <h6><?=$announcement->getElementsByTagName('subtitle')->item(0)->nodeValue?></h6>
                        <a href="#">
                          <img src="http://placehold.it/260x180" alt="">
                        </a>
                        <p class="description"> Description de l'annonce. Ceci est la description correspondant à cette annonce.
                          Description de l'annonce. Ceci est la description correspondant à cette annonce.
                          Description de l'annonce. Ceci est la description correspondant à cette annonce.Description de l'annonce. 
                          Ceci est la description correspondant à cette annonce.
                          Description de l'annonce. Ceci est la description correspondant à cette annonce.
                        </p> 
                        <div class="lienAnnonce">
                          <div style="padding-top:30px;"></div>
                          <a href="<?=BASE_URL?>/announcement/announcement/" class="btn btn-primary float-right">Voir</a>
                        </div>
                      </li>
                      <?php endforeach;?> 
                      <div class="clear"></div>
                    </ul>
                    <script type="text/javascript">
                    (function($) {
                        $(function() {
                            customPagination.init(1, $.cookie('AuthKey'));
                        })
                    })(jQuery);
                    </script>
                    <div class="pagination pagination-large">
                        <ul id="pagination"></ul>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>