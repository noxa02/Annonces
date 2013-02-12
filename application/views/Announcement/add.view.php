<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
         <div class="container">
           <h1>Modifier votre annonce</h1>
        </div>
        </header>
        <div class="container" id="announcement-add"> 
            <div class="row">
                <div class="span10">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data" name="announcement-add">
                        <fieldset class="well">
                            <div class="control-group">
                                <label class="control-label">Titre :         </label>    <input 
                                                                                                type="text" 
                                                                                                name="title"
                                                                                                data-type="varchar"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Sous-titre :    </label>    <input 
                                                                                                type="text" 
                                                                                                name="subtitle"
                                                                                                data-type="varchar"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description :   </label>   <textarea   
                                                                                                name="content"
                                                                                                data-type="text">
                                                                                        </textarea>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Type :          </label>   <select
                                                                                                name="type"
                                                                                                data-type="text">
                                                                                            <option value="Service">Service     </option>
                                                                                            <option value="Logement">Logement   </option>
                                                                                            <option value="Objet">Objet         </option>
                                                                                        </select>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Image :         </label>    <input type="file" 
                                                                                                id="files"
                                                                                                name="picture[]"
                                                                                                data-type="picture"
                                                                                                multiple/>
                            </div>
                            <div id="preview"></div>
                            <div class="control-group center">
                                <button type="button" id="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </fieldset>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=BASE_URL?>/js/Form/AnnouncementAdd.js"></script>