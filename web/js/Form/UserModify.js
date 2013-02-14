(function($) {
    /**
     * Global variables
     */
    var formSelector = '#form-user-modify';
        id_user = $('#user-info').attr('data-id-user'),
        pictures = {};
        
    $(function() {
        
        var initialInputs = $(formSelector+' input:not([type=checkbox],[type=hidden],[type=file],[type=button],[type=submit]),'+
                              formSelector+' select,'+formSelector+' textarea'),
            initialData = {}, 
            user = new User();
            
            initialData = user.getSingle({id:id_user})[0];
          
        if ($.browser.webkit) {
            $('input').attr('autocomplete', 'off');
        }
        /****
         * Validation on keyup for user form registration by
         * REGEX and check for login if no existent. 
         */
        $('#form-user-modify input:not([type=checkbox],[type=button],[type=submit])').keyup(function() {
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
                        if(cpassword.val() != '' || input.val() != cpassword.val()
                            || cpassword.val() == '') {
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
                        if(password.val() != '' && input.val() != password.val() 
                            || password.val() == '') {
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
        })
        /**
         * On form submit
         */
        $(formSelector+' #submit').bind('click', function(e) {
            if(!valid.check()) {
                notification.warning(
                'Attention !', 
                'Votre formulaire n\'est pas valide, veuillez corriger les erreurs avant de valider !', 
                {});
                return;
            }
            var inputs = $(formSelector+' input:not([type=checkbox],[type=hidden],[type=file],[type=button],[type=submit]),'+
                           formSelector+' select,'+formSelector+' textarea'),
                data = {};
            /**
             *  Get change between data
             */
     
            $.each(inputs, function(key, value) {
                var value_old = initialData[value.name],
                    value_new = $.trim(value.value);
                if(value_new != value_old && value_new != '') {
                    data[value.name] =  $.trim(value_new); 
                }
            })
            
            var count = 0;
            for (i in data) {
                if (data.hasOwnProperty(i)) {
                    count++;
                }
            }
            if(count > 0) {
                var dataToChange = data;
                $.ajax({
                    url: WS_PATH+'/users/'+id_user,
                    type: 'PUT',
                    data: data,
                    beforeSend: function (xhr){ 
                        xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                    },statusCode : {
                        409: function (statusCode) {
                            notification.error(
                            'Erreur lors de la modification !', 
                            'Veuillez contacter l\'adminstrateur afin de résoudre au plus vite ce problème.', 
                            {});
                        }
                    },
                    success: function(data) {
                        $.each(dataToChange, function(key, value) {
                            $('input[name="'+key+'"]').attr('inputSuccess','').val('').attr('placeholder',value);
                        });
                    }
                })
            }
        });
    })
    
    var valid = {
        "check": function() {
            var valid = true;
            $('#form-user-modify input').each(function() {
                if($(this).attr('id') == 'inputError') {
                    valid = false;
                }
            })
            return valid;
        }
    }
})(jQuery)