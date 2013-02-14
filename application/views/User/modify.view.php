<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
            <div class="container">
                <h1>Modifier mon compte</h1>
            </div>
        </header>
        <div class="container" id="user-modify"> 
            <div class="row">
                <div class="span12">
                    <form action="" method="POST" id="form-user-modify" class="form-horizontal" name="user-register">
                        <fieldset class="first well pull-left ">
                            <h3 style="text-align:center;">Identité</h3><hr>
                            <div class="control-group">
                                <label class="control-label">Nom :                </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="name"
                                                                                                     placeholder="<?=$user->getName()?>"
                                                                                                     data-type="varchar"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Prénom :             </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="firstname"
                                                                                                     placeholder="<?=$user->getFirstname()?>"
                                                                                                     data-type="varchar"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email :              </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="mail"
                                                                                                     placeholder="<?=$user->getMail()?>"
                                                                                                     data-type="email"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Rue :                </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="address"
                                                                                                     placeholder="<?=$user->getAddress()?>"
                                                                                                     data-type="address"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CP :                 </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="zipcode"
                                                                                                     placeholder="<?=$user->getZipcode()?>"
                                                                                                     data-type="zipcode"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Ville :              </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="city"
                                                                                                     placeholder="<?=$user->getCity()?>"
                                                                                                     data-type="varchar"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Téléphone :          </label>    <input class="input-large" 
                                                                                                     type="tel" 
                                                                                                     name="phone"
                                                                                                     placeholder="<?=$user->getPhone()?>"
                                                                                                     data-type="tel"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Portable :           </label>    <input class="input-large" 
                                                                                                     type="tel" 
                                                                                                     name="portable"
                                                                                                     placeholder="<?=$user->getPortable()?>"
                                                                                                     data-type="tel"/>
                            </div>
                        </fieldset>
                        <fieldset class="second well pull-right">
                            <h3 style="text-align:center;">Compte</h3><hr>
                            <div class="control-group">
                                <label class="control-label">Identifiant :        </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="login"
                                                                                                     placeholder="<?=$user->getLogin()?>"
                                                                                                     data-type="varchar"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Mot de passe :       </label>    <input class="input-large" 
                                                                                                     type="password" 
                                                                                                     name="password"
                                                                                                     data-type="varchar"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Confirmer :          </label>    <input class="input-large" 
                                                                                                     type="password" 
                                                                                                     name="c-password"
                                                                                                     data-type="varchar"/>
                            </div>
                            <label class="checkbox">
                                <input type="checkbox" name="newsletter" value="<?=$user->getNewsletter()?>">
                                    S'inscire à la newsletter
                            </label>
                            <div class="control-group center">
                                <input  type="hidden" data-id-user="<?=$user->getId()?>" id="user-info" />
                                <button type="button" id="submit" class="btn btn-primary">S'inscrire</button>
                           </div>   
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=BASE_URL?>/js/Form/UserModify.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/User.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/Announcement.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Model/Comment.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>/js/Form/AnnouncementCommentForm.js"></script>