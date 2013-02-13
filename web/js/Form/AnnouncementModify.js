(function($) {
    var formSelector = '#form-announcement-modify';
        id_announcement = $('#announcement-info').attr('data-id-announcement');
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
                data = {};
            /**
             *  Get change between data
             */
            $.each(inputs, function(key, value) {
                var value_old = initialData[value.name],
                    value_new = $.trim(value.value);
                if(value_new.length != value_old.length && value_new != '') {
                    data[value.name] =  $.trim(value_new); 
                }
            })
       
            if(data) {
                console.debug(data);
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
                        console.debug(data);
                        notification.success(
                        'Erreur lors de la modification !', 
                        'Veuillez contacter l\'adminstrateur afin de résoudre au plus vite ce problème.', {}, function(){});
                    }
                })
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
    })
})(jQuery)