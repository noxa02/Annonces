(function($) {
    $(function() {
        $('#submit-connexion').click(function(e) {
            e.preventDefault();
            toastr.clear();
            var username = $('#login-connexion').val();
            var password = $('#password-connexion').val();
            var url = 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/users/';
            
            authKey.set(username, password);
            $.ajax({
                type: "GET",
                url: url,
                dataType : 'json',
                data: {
                  login : username
                },
                beforeSend: function (xhr){ 
                    xhr.setRequestHeader('Authorization', 'Basic '+authKey.get()); 
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
        });  
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
        "get": function() {
            if(!$.cookie('AuthKey')) {
                this.set('anonym', 'anonym');
            }
            return $.cookie('AuthKey');
        },
        "set": function(username, password) {
            $.cookie('AuthKey', base64.encode(username + ':' + password));
        },
        "delete": function() {
            $.cookie('AuthKey', null);
            if($.cookie(key)) {
                return true;
            }
            return false;
        }
    }