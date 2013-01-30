(function($) {
    $(function() {
        if ($.browser.webkit) {
            $('input').attr('autocomplete', 'off');
        }
        /****
         * Validation on keyup for user form registration by
         * REGEX and check for login if no existent. 
         */
        $('#user-register input:not([type=checkbox],[type=button],[type=submit])').keyup(function() {
            var input = $(this);
            var type = $(this).attr('data-type');
            var value = $(this).val();
            
            var rules = {
                'varchar' : /^[a-zA-Z0-9-_]+$/i,
                'email'   : /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
                'tel'     : /^([0-9]{10})+$/i,
                'number'  : /^[0-9]+$/i,
                'zipcode' : /^([0-9]{5})$/i,
                'address' : /^[a-zA-Z0-9-_\s]+$/i
            }
            
            var iclass = {
                error :   {
                            'id' : 'inputError',
                            'class' : 'error'
                          },
                warning : {
                            'id' : 'inputWarning',
                            'class' : 'warning'
                          },
                success : {
                            'id' : 'inputSuccess',
                            'class' : 'success'
                          },
                info : {
                            'id' : 'inputInfo',
                            'class' : 'info'
                          }
            }
            
            var message = {
                error : {
                            'varchar' : 'Ce champ ne peut contenir que des caractères !',
                            'email'   : 'Votre e-mail doit être sous forme : exemple@fai.fr',
                            'zipcode' : 'Le code postal est composé de 5 chiffres !',
                            'tel'     : 'Ce champ doit être composé de 10 chiffres !',
                            'password': 'Les mots de passe doivent être identique !'
                        },
                info  : {
                            'exist-login': 'Cette identifiant est déjà existant, veuillez en choisir un autre.'
                        }
            }
            
            clean(input, iclass);
            if(rules.hasOwnProperty(type)) {
                var regex = rules[type];
                if(input.val().match(regex)) {
                    input.parent('div.control-group').addClass(iclass.success['class']);
                    input.attr('id', iclass.success['id']);
                    var password = $('input[name="password"]');
                    var cpassword = $('input[name="c-password"]');
                    if(input.attr('name') == 'password') {
                        clean(input, iclass);
                        clean(cpassword, iclass); 
                        if(cpassword.val() != '' && input.val() != cpassword.val()) {
                            input.parent('div.control-group').addClass(iclass.error['class']);
                            input.attr('id', iclass.error['id']);
                            cpassword.parent('div.control-group').addClass(iclass.error['class']);
                            cpassword.attr('id', iclass.error['id']);
                            cpassword.after('<span class="help-block">'+message.error['password']+'</span>');
                        } else {
                            clean(cpassword, iclass); 
                            input.parent('div.control-group').addClass(iclass.success['class']);
                            input.attr('id', iclass.error['id']);
                            cpassword.parent('div.control-group').addClass(iclass.success['class']);
                            cpassword.attr('id', iclass.error['id']);
                        }
                    }
                    if(input.attr('name') == 'c-password') {
                        if(password.val() != '' && input.val() != password.val()) {
                            clean(cpassword, iclass); 
                            cpassword.parent('div.control-group').addClass(iclass.error['class']);
                            cpassword.attr('id', iclass.error['id']);
                            cpassword.after('<span class="help-block">'+message.error['password']+'</span>');
                        } else {
                            clean(password, iclass); 
                            password.parent('div.control-group').addClass(iclass.success['class']);
                            password.attr('id', iclass.success['id']);
                            password.parent('div.control-group').addClass(iclass.success['class']);
                            password.attr('id', iclass.success['id']);
                        }
                    } 
                    if(input.attr('name') == 'login') {
                        var inputLogin  = input.val();
                        $.each(user.getAll(), function() {
                            if(this.login == inputLogin) {
                                clean(input, iclass); 
                                input.parent('div.control-group').addClass(iclass.info['class']);
                                input.attr('id', iclass.info['id']);
                                input.after('<span class="help-block">'+message.info['exist-login']+'</span>');
                            }
                        })
                    }
                } else if($(this).val() == '') {
                    clean($(this), iclass);
                } else {
                    $(this).parent('div.control-group').addClass(iclass.error['class']);
                    $(this).attr('id', iclass.error['id']);
                    $(this).after('<span class="help-block">'+message.error[type]+'</span>');
                }
            }
            valid.check();
        })
        
        $('#user-register #submit').click(function(e) {
            e.preventDefault();
            inputs = $('#user-register input:not([type=checkbox],[type=button],[type=submit])');
            var datas = {};
            $.each(inputs, function(key, value) {
                if(value.name != 'c-password') {
                   datas[value.name] = value.value; 
                }
            })
            
            $.ajax({
                url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/users',
                type: 'POST',
                data: datas,
                login: datas['login'],
                password: datas['password'],
                beforeSend: function (xhr){ 
                    xhr.setRequestHeader('Authorization', 'Basic '+authKey.get()); 
                },
                success: function(data) {
                    var options = {
                        $position : 'toast-top-center',
                        $fadeIn : 300,
                        $fadeOut : 4000,
                        $timeOut : 5000,
                        $extendedTimeOut : 1000
                    }
                    data = {login: this.login, password: this.password};
                    notification.success(
                    'Connexion réussie !', 
                    'Vous allez être redirigé dans 3 secondes', 
                    options, function(data) {
                        $(this).delay(3000).queue(function() {
                            $.post(
                                '/projetcs/Annonces/application/controllers/User/login.controller.php',data
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
            })
        })
    });

    var valid = {
        "check": function() {
            var valid = true;
            $('#user-register input:not([type=checkbox],[type=button],[type=submit])').each(function() {
                if($(this).attr('id') != 'inputSuccess') {
                    valid = false;
                }
            })
            if(valid) {
                this.message();
            }
        },
        "message": function() {
            toastr.clear();
            var options = {
                $position : 'toast-top-center', 
                $fadeIn : 300,
                $fadeOut : 4000,
                $timeOut : 9000,
                $extendedTimeOut : 1000
            }
            notification.info(
            'Inscription fini !', 
            'Votre formulaire est correct, appuyer sur le beau bouton bleu afin de finaliser votre inscription !', 
            options);
        }
    }
    
    var clean = function(item, iclass) {
        $.each(iclass, function(id) {
            item.next('span').remove();
            item.removeAttr('id');
            item.parent('div.control-group').removeClass(iclass[id]['class']);
        });
    }
    
})(jQuery);