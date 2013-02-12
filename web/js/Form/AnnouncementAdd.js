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
            inputs = $(formSelector+' input:not([type=checkbox],[type=file],[type=button],[type=submit]),'+
                       formSelector+' select,'+formSelector+' textarea');
            var datas = {},
                isValid = true;
            $.each(inputs, function(key, value) {
                datas[value.name] =  $.trim(value.value); 
            })

            $.each(datas, function(i, val){
                if(val == '') {
                    isValid = false; 
                }
            });
            
            /**
             *  Prepare files to send by ajax request
             */
            if(isValid) {
                var formdata = false;  
                if (window.FormData) {  
                    formdata = new FormData();
                    if(files.length) {
                        for (var i = 0, file; file = files[i]; i++) {
                            if (!file.type.match('image.*')) {
                                continue;
                            }
                            if (formdata) { 
                                formdata.append('files[]', file);
                            } 
                        }
                    }  
                }  
                
                /**
                 *  Send pictures to the WebService
                 */
                if(formdata) {
                    return;
                    $.ajax({
                        url: WS_PATH+'/pictures',
                        type: 'POST',
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            console.debug(res);
                        }
                    });
                }
                
                /**
                 *  Send announcement data
                 */
                $.ajax({
                    url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/announcements',
                    type: 'POST',
                    data: datas,
                    beforeSend: function (xhr){ 
                        xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                    },
                    success: function(data) {
                        var options = {
                            $position : 'toast-top-center',
                            $fadeIn : 300,
                            $fadeOut : 4000,
                            $timeOut : 5000,
                            $extendedTimeOut : 1000
                        }
                        notification.success(
                        'Ajout réussie !', 
                        'Vous allez être redirigé dans 3 secondes vers votre annonce', 
                        options, function(data) {
                            var url = 'http://localhost:8888/projetcs/Annonces/web/';
                            $(this).delay(3000).queue(function() {
                                $(location).attr('href', url);
                            })
                        }, data);
                    }
                })
            /**
             *  Invalid form, show notification
             */
            } else {
                toastr.clear();
                var options = {
                    $position : 'toast-top-right', 
                    $fadeIn : 300,
                    $fadeOut : 4000,
                    $timeOut : 9000,
                    $extendedTimeOut : 1000
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
                    $position : 'toast-top-center', 
                    $fadeIn : 300,
                    $fadeOut : 4000,
                    $timeOut : 9000,
                    $extendedTimeOut : 1000
                }
                notification.warning(
                'Attention !', 
                'Vous pouvez ajouter seulement 9 photos à votre annoncement !', 
                options);
            }
        }
    }
})(jQuery);