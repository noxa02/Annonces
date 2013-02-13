<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
            <div class="container">
                <h1>Modifier <?=$announcement->getTitle()?></h1>
            </div>
        </header>
        <div class="container" id="announcement-modify"> 
            <div class="row">
                <div class="span10">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data" id="form-announcement-modify">
                        <fieldset class="well">
                            <div id="form-wrapper">
                                <div class="control-group">
                                    <label class="control-label">Titre :         </label>    <input 
                                                                                                    type="text" 
                                                                                                    name="title"
                                                                                                    data-type="varchar"
                                                                                                    placeholder="<?=$announcement->getTitle()?>"/>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Sous-titre :    </label>    <input 
                                                                                                    type="text" 
                                                                                                    name="subtitle"
                                                                                                    data-type="varchar"
                                                                                                    placeholder="<?=$announcement->getSubtitle()?>"/>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description :   </label>   <textarea   
                                                                                                    name="content"
                                                                                                    data-type="text"
                                                                                                    rows="10">
                                                                                            <?=$announcement->getContent()?>  
                                                                                            </textarea>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Type :          </label>   
                                    <select
                                            name="type"
                                            data-type="text">
                                        <?php $type = $announcement->getType(); ?>
                                        <option value="Service"  <?php if($type == 'Service')  print 'selected'?>>Service     </option>
                                        <option value="Logement" <?php if($type == 'Logement') print 'selected'?>>Logement    </option>
                                        <option value="Objet"    <?php if($type == 'Objet')    print 'selected'?>>Objet       </option>
                                    </select>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image :         </label>    <input type="file" 
                                                                                                    id="files"
                                                                                                    name="picture[]"
                                                                                                    data-type="picture"
                                                                                                    multiple/>
                                </div>
                            </div>
                            <div id="preview"></div>
                            <div class="control-group center">
                                <input  type="hidden" data-id-announcement="<?=$announcement->getId()?>" id="announcement-info" />
                                <button type="button" id="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </fieldset>
                        <fieldset class="well">
                            <h4>Mes images</h4>
                            <?php if(isset($thumbnailPictures) && !empty($thumbnailPictures)): ?>
                            <ul id="thumbnails" class="thumbnails ">
                                <?php foreach($thumbnailPictures as $thumbnailPicture): ?>
                                    <?php if(!emptyObjectMethod($thumbnailPicture)): ?>
                                    <?php $originalPictureId = $originalPicturesId[$thumbnailPicture->getTitle()]; ?>
                                        <li class="span3 thumbnail">
                                          <a href="javascript:void(0)">
                                            <img src="<?=$thumbnailPicture->getUrlWs()?>" alt="<?=$thumbnailPicture->getAlternative()?>">
                                            <a class="red-cross" data-original-id="<?=$originalPictureId?>" href="javascript:void(0)">
                                                <img src="<?=BASE_URL ?>/images/red-cross.png" alt="supprimer"/>
                                            </a>
                                          </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=BASE_URL?>/js/Form/AnnouncementModify.js"></script>