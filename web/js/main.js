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
                url = 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/users/';
                
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
                            var options = {
                                $fadeIn : 300,
                                $fadeOut : 4000,
                                $timeOut : 5000,
                                $extendedTimeOut : 1000
                            }

                            notification.error(
                            'Erreur de connexion !', 
                            'Erreur de mot de passe/login.', 
                            options);
                        }
                    },
                    success : function(data) {
                        var options = {
                            $fadeIn : 300,
                            $fadeOut : 4000,
                            $timeOut : 5000,
                            $extendedTimeOut : 1000
                        }

                        notification.success(
                        'Connexion réussie !', 
                        'Vous allez être redirigé dans 3 secondes', 
                        options, function(data) {
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
                var options = {
                    $fadeIn : 300,
                    $fadeOut : 4000,
                    $timeOut : 5000,
                    $extendedTimeOut : 1000
                }

                notification.error(
                'Erreur de connexion !', 
                'Mot de passe/login non renseigné !', 
                options);
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
        "current_uri": function(delimiter) {
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