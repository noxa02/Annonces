(function($) {
    /**
     * Global variables
     */
    var formSelector = '#form-announcement-modify';
        id_announcement = $('#announcement-info').attr('data-id-announcement'),
        pictures = {};
        
    $(function() {
        
        var initialInputs = $(formSelector+' input:not([type=checkbox],[type=hidden],[type=file],[type=button],[type=submit]),'+
                              formSelector+' select,'+formSelector+' textarea'),
            initialData = {};
            
        $.each(initialInputs, function(key, value) {
            if(value.type == 'text') {
                initialData[value.name] =  $.trim(value.placeholder); 
            } else {
                initialData[value.name] =  $.trim(value.value); 
            }
        })
        
        /**
         * On form submit
         */
        $(formSelector+' #submit').bind('click', function(e) {
            var inputs = $(formSelector+' input:not([type=checkbox],[type=hidden],[type=file],[type=button],[type=submit]),'+
                           formSelector+' select,'+formSelector+' textarea'),
                data = {},
                count = 0;
            /**
             *  Get change between data
             */
            $.each(inputs, function(key, value) {
                var value_old = initialData[value.name],
                    value_new = $.trim(value.value);
                if(value_new.length != value_old.length && value_new != '') {
                    data[value.name] =  $.trim(value_new); 
                    count++;
                }
            })
            
            if(count > 0 || count ==  0 && pictures && pictures.length > 0) {
                if(count > 0) {
                    var dataToChange = data;
                    $.ajax({
                        url: WS_PATH+'/announcements/'+id_announcement,
                        type: 'PUT',
                        data: data,
                        beforeSend: function (xhr){ 
                            xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                        },statusCode : {
                            409: function (statusCode) {
                                notification.error(
                                'Erreur lors de la modification !', 
                                'Veuillez contacter l\'adminstrateur afin de résoudre au plus vite ce problème.', 
                                options);
                            }
                        },
                        success: function(data) {
                            $.each(dataToChange, function(key, value) {
                                $('input[name="'+key+'"]').val('').attr('placeholder',value);
                                $('select[name="'+key+'"]').val(value);
                                $('textarea[name="'+key+'"]').text(value);
                            }); 
                        }
                    })
                }
                
                if(pictures && pictures.length > 0) {
                    file.send(id_announcement);
                }
            }
        });
        /**
         * Remove announcement picture by an Ajax request
         */
        $('.red-cross').bind('click', function() {
            var me = $(this),
                id = me.attr('data-original-id');
             
            $.ajax({
                url: WS_PATH+'/pictures/'+id,
                type: 'DELETE',
                beforeSend: function (xhr){ 
                    xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                },statusCode : {
                    409: function (statusCode) {
                        notification.error(
                        'Erreur lors de la suppression !', 
                        'Veuillez contacter l\'adminstrateur afin de résoudre au plus vite ce problème.', 
                        {});
                    }
                },
                success: function() {
                    me.parent('li').remove();
                }
            })
        })
        
        /**
         *  Event on input File 
         */
        document.getElementById('files').addEventListener('change', file.read, false);
    })
    
   var file = { 
        read: function(evt) {
            $('#preview').html('');
            $('<ul></ul>').appendTo('#preview').addClass('pictures thumbnails');
            files = evt.target.files;
            pictures = files;
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
                    success: function() {
                        notification.success(
                        'Modification réussie !', 
                        '',
                        {}, function(){});
                    }
                });
           }
        }
    }
})(jQuery)