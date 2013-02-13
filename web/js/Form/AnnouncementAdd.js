(function($) {
    var formSelector = '#announcement-add',
        files;
    $(function() {
        
        /****
         * Validation on keyup for user form registration by
         * REGEX and check for login if no existent. 
         */
        $(formSelector+' input:not([type=checkbox],[type=button],[type=submit]), '+
          formSelector+' textarea').keyup(function() {
            var me    = $(this),
                input = me,
                type  = me.attr('data-type'),
                value = $.trim(me.val());
            
                       var me    = $(this);
            checkForm.checkInputRule(me);
        })
       
        $(formSelector+' #submit').click(function(e) {
            e.preventDefault();
            inputs = $(formSelector+' input:not([type=checkbox],[type=hidden],[type=file],[type=button],[type=submit]),'+
                       formSelector+' select,'+formSelector+' textarea');
            var id_user = $('#user-info').attr('data-user-id'),  
                data = {
            },
            
            isValid = true;
            $.each(inputs, function(key, value) {
                data[value.name] =  $.trim(value.value); 
            })
            data['id_user'] = id_user;
            $.each(data, function(i, val){
                if(val == '') {
                    isValid = false; 
                }
            });
            
            /**
             *  Prepare files to send by ajax request
             */
            if(isValid) { 
                /**
                 *  Send announcement data
                 */
                $.ajax({
                    url: WS_PATH+'/announcements',
                    type: 'POST',
                    data: data,
                    beforeSend: function (xhr){ 
                        xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                    },
                    success: function(data) {
                        /**
                         * Upload pictures
                         */
                        file.send(data);
                    }
                })
            /**
             *  Invalid form, show notification
             */
            } else {
                toastr.clear();
                var options = {
                    $position : 'toast-top-right'
                }
                notification.warning(
                'Formulaire incomplet !', 
                'Veuillez remplir tous les champs !', 
                options);
            }
        })
        
        /**
         *  Event on input File 
         */
        document.getElementById('files').addEventListener('change', file.read, false);
    });
    
    var file = { 
        read: function(evt) {
            $('#preview').html('');
            $('<ul></ul>').appendTo('#preview').addClass('pictures thumbnails');
            files = evt.target.files; 
            if(files.length <= 9) {
                for (var i = 0, f; f = files[i]; i++) {
                  if (!f.type.match('image.*')) {
                    continue;
                  }

                  var reader = new FileReader();
                  reader.onload = (function(f) {
                    return function(e) {
                      var img = $('<img>');
                      img
                          .attr('src', e.target.result)
                          .width(230)
                          .height(160);
                          $('<li></li>').appendTo('#preview ul').html(img).addClass('span3 thumbnail'); 
                    };
                  })(f);
                  reader.readAsDataURL(f);
                }
            } else {
                toastr.clear();
                var options = {
                    $position : 'toast-top-center'
                }
                notification.warning(
                'Attention !', 
                'Vous pouvez ajouter seulement 9 photos à votre annoncement !', 
                options);
            }
        }, 
        send: function(id_announcement) {
        var formdata = false;
            if (window.FormData) {  
                formdata = new FormData();
                if(files && files.length) {
                    for (var i = 0, file; file = files[i]; i++) {
                        if (!file.type.match('image.*')) {
                            continue;
                        }
                        if (formdata) {
                            formdata.append('files[]', file);
                        } 
                    }
                }
                formdata.append('id_announcement', id_announcement);
            }
       
            if(formdata) {
                $.ajax({
                    url: WS_PATH+'/pictures',
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    beforeSend: function (xhr){ 
                        xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                    },
                    success: function (data) {
                        var options = {
                            $position : 'toast-top-center'
                        }
                        notification.success(
                        'Ajout réussie !', 
                        'Vous allez être redirigé dans 3 secondes vers votre annonce', 
                        options, function(data) {
                            var url = BASE_URL+'/announcement/show/'+id_announcement;
                            $(this).delay(3000).queue(function() {
                                $(location).attr('href', url);
                            })
                        }, data);
                    }
                });
           }
        }
    }
})(jQuery);