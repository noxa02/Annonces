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
                    <div id="loading"></div>
                    <ul id="content-announcements" class="thumbnails"></ul>
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