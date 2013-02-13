(function($) {
    $(function() {
        /**
         *  Front-Client Authentification 
         */
        authKey.initAuthKey();
        $('#submit-connexion').click(function(e) {
            e.preventDefault();
            toastr.clear();
            var username = $('#login-connexion').val(),
                password = $('#password-connexion').val(),
                url = WS_PATH+'/users/';
                
            if(username != '' && password != '') {
                authKey.setAuthKey(username, password);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType : 'json',
                    data: {
                      login : username
                    },
                    beforeSend: function (xhr){ 
                        xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                    },
                    statusCode : {
                        401: function (statusCode) {
                            notification.error(
                            'Erreur de connexion !', 
                            'Erreur de mot de passe/login.', 
                            {});
                        }
                    },
                    success : function(data) {
                        notification.success(
                        'Connexion réussie !', 
                        'Vous allez être redirigé dans 3 secondes', 
                        {}, function(data) {
                            $(this).delay(3000).queue(function() {
                                $.post(
                                    '/projetcs/Annonces/application/controllers/User/login.controller.php',data[0]
                                    , function(result) {
                                        if(result == 'ok') {
                                            $(location).attr('href',"http://localhost:8888/projetcs/Annonces/web/");
                                        } else if(result == 'fail') {
                                            notification.success(
                                            'Erreur de connexion !', 
                                            'Un problème est survenue lors de votre connexion.', 
                                            options);
                                        }
                                    }
                                );
                            })
                        }, data);
                    }
                });
            } else {
                notification.error(
                'Erreur de connexion !', 
                'Mot de passe/login non renseigné !', 
                {});
            }
        });
        
        /**
         *  Front-Client Logout button event
         */
        $('#logout').click(function() {
            authKey.deleteAuthKey();
        })
    })
})(jQuery);

   var url = {
        "current_uri": function(delimiter){
            var urlParts = window.location.pathname.split( '/' );
            var newPath = '';
            var result = false;
            for (i = 0;i < urlParts.length;i++) {
                if(result == true) {
                    newPath += "/";
                    newPath += urlParts[i];  
                }
                if(urlParts[i] == delimiter) {
                    result = true;
                }
            }
            return newPath;
        }
    }
    
    var authKey = {
        initAuthKey: function() {
            if(!$.cookie('AuthKey')) {
                this.setAuthKey('anonym', 'anonym');
            } 
        },
        getAuthKey: function() {
            if(!$.cookie('AuthKey')) {
                this.setAuthKey('anonym', 'anonym');
            }
            return $.cookie('AuthKey');
        },
        setAuthKey: function(username, password) {
            this.deleteAuthKey();
            $.cookie('AuthKey', base64.encode(username + ':' + password), { path: '/' });
        },
        deleteAuthKey: function() {
            $.removeCookie('AuthKey');
            if($.cookie('AuthKey')) {
                return true;
            }
            return false;
        },
        getOwner: function() {
            var array = base64.decode(this.getAuthKey());
            info = array.split(':');
            return info[0] || null;
        }
    }
    
    var verification = {
        accountRequieredCookie: function() {
            if($.cookie('user')) {
                $.each($.cookie('user'), function(key, value) {
                    console.debug(key, value);
                })
            }
        }
    }
    
    var compare = {
        object: function(object1, object2) {
            return false;
        }
    }
    
function datediff(fromDate,toDate,interval) { 
    var second=1000, minute=second*60, hour=minute*60, day=hour*24, week=day*7; 
    fromDate = new Date(fromDate); 
    toDate = new Date(toDate); 
    var timediff = toDate - fromDate; 
    if (isNaN(timediff)) return NaN; 
    switch (interval) { 
        case "years": return toDate.getFullYear() - fromDate.getFullYear(); 
        case "months": return ( 
            ( toDate.getFullYear() * 12 + toDate.getMonth() ) 
            - 
            ( fromDate.getFullYear() * 12 + fromDate.getMonth() ) 
        ); 
        case "weeks"  : return Math.floor(timediff / week); 
        case "days"   : return Math.floor(timediff / day);  
        case "hours"  : return Math.floor(timediff / hour);  
        case "minutes": return Math.floor(timediff / minute); 
        case "seconds": return Math.floor(timediff / second); 
        default: return undefined; 
    } 
}

function setCookie( name, value, expires, path, domain, secure ) { 
   // set time, it's in milliseconds 
   var today = new Date(); 
   today.setTime( today.getTime() ); 
   // if the expires variable is set, make the correct expires time, the 
   // current script below will set it for x number of days, to make it 
   // for hours, delete * 24, for minutes, delete * 60 * 24 
   if ( expires ) 
   { 
      expires = expires * 1000 * 60; 
   } 
   //alert( 'today ' + today.toGMTString() );// this is for testing purpose only 
   var expires_date = new Date( today.getTime() + (expires) ); 
   //alert('expires ' + expires_date.toGMTString());// this is for testing purposes only 

   document.cookie = name + "=" +escape( value ) + 
      ( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) + //expires.toGMTString() 
      ( ( path ) ? ";path=" + path : "" ) + 
      ( ( domain ) ? ";domain=" + domain : "" ) + 
      ( ( secure ) ? ";secure" : "" ); 
}