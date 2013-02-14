<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
         <div class="container">
           <h1>Les dernières annonces</h1>
         </div>
        </header>
        <div class="container">          
            <div class="row">
              <div id="list-announcements" class="span12">
                Retrouvez ici les dernières annonces postées par les utilisateurs. <br />
                <div class="row-fluid padding-top15">
                    <div id="loading"></div>
                    <div id="content-announcements" class="thumbnails"></div>
                    <div class="pagination pagination-large">
                        <ul id="pagination"></ul>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/User.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/Announcement.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/Comment.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Ajax/Announcement.js"></script>