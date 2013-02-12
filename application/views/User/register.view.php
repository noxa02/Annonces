<div id="wrap">
    <div id="main" class="container clear-top">
        <header id="header">
         <div class="container">
           <h1>Inscription</h1>
        </div>
        </header>
        <div class="container"> 
            <div class="row">
                <div class="span12">
                    <form action="" method="POST" id="user-register" class="form-horizontal" name="user-register">
                        <fieldset class="first well pull-left ">
                            <h3 style="text-align:center;">Identité</h3><hr>
                            <div class="control-group">
                                <label class="control-label">Nom :                </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="name"
                                                                                                     data-type="varchar"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Prénom :             </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="firstname"
                                                                                                     data-type="varchar"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email :              </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="mail"
                                                                                                     data-type="email"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Rue :                </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="address"
                                                                                                     data-type="address"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CP :                 </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="zipcode"
                                                                                                     data-type="zipcode"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Ville :              </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="city"
                                                                                                     data-type="varchar"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Téléphone :          </label>    <input class="input-large" 
                                                                                                     type="tel" 
                                                                                                     name="phone"
                                                                                                     data-type="tel"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Portable :           </label>    <input class="input-large" 
                                                                                                     type="tel" 
                                                                                                     name="portable"
                                                                                                     data-type="tel"/>
                            </div>
                        </fieldset>
                        <fieldset class="second well pull-right">
                            <h3 style="text-align:center;">Compte</h3><hr>
                            <div class="control-group">
                                <label class="control-label">Identifiant :        </label>    <input class="input-large" 
                                                                                                     type="text" 
                                                                                                     name="login"
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
                                <input type="checkbox" value="0">
                                    S'inscire à la newsletter
                            </label>
                           <div class="control-group center">
                                <button type="button" id="submit" class="btn btn-primary">S'inscrire</button>
                           </div>   
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=BASE_URL?>/js/Form/UserRegister.js"></script>