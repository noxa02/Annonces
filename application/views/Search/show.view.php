<div id="side" class="sidebar-nav span5 block-search">
    <form method="POST" action="#" id="search-form" class="form-inline">
        <fieldset class="first well">
            <div class="control-group" style="height: 25px;">
                <h4 class="pull-left">Annonce</h4> 
                    <select name="order-column" data-select="filter" style="width: auto;" class="pull-right">
                        <option value="title">Titre</option>
                        <option value="subtitle">Sous-titre</option>
                        <option value="post_date">Date</option>
                    </select>
                    <select name="order-type" data-select="filter" style="width: auto;" class="pull-right">
                        <option value="DESC">Décroissant</option>
                        <option value="ASC">Croissant</option>
                    </select>
                    <select name="limit" data-select="filter" style="width: 50px;" class="pull-right">
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                    </select>
            </div>
            <hr/>
                <div class="control-group first-group">
                    <input class="input-medium margin-10" type="text" data-table="announcement"
                           data-type="varchar" data-column="title" placeholder="Titre"/>
                    <input class="input-medium margin-10" type="text" data-table="announcement"
                           data-type="varchar" data-column="subtitle" placeholder="Sous-titre"/>   
<!--                    <select name="type" data-select="filter" class="margin-10" style="width:150px;margin-bottom: 10px;">
                        <option value=""> Tous </option>
                        <option value="Service">Service</option>
                        <option value="Logement">Logement</option>
                        <option value="Objet">Objet</option>
                    </select>-->
                </div>
                <div class="control-group">
                    <div class="controls margin-10 inline pull-left">
                        <label class="radio">
                         <input type="radio" name="date" id="date-u" value="date-unique" checked>
                            Date unique
                        </label>
                    </div>
                    <div class="controls margin-10 inline pull-left">
                        <label class="radio">
                          <input type="radio" name="date" id="date-b" value="date-between">
                            Entre deux dates
                        </label>
                    </div>                 
                </div>
                <div class="control-group">
                    <input class="input-medium pull-left" id="date-1" type="date" data-table="announcement" 
                           data-type="date" data-column="post_date" />
                    <input class="input-medium pull-right" id="date-2" type="date" data-table="announcement" 
                           data-type="date" data-column="post_date" /> 
                </div>
        </fieldset>
    </form>
</div>
<div id="wrap">
    <div id="main" class="container clear-top search">
        <header id="header">
           <h1>Recherche</h1>
        </header>
        <div id="search">      
            <div id="loading"></div>
            <div id="content-announcements" class="pagination pagination-large">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/User.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/Announcement.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/Comment.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Ajax/Announcement.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Ajax/Search.js"></script>