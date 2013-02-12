(function($) {
    
    var formSelector = '#form-announcement-modify';
    
    $(function() {
        /**
         * On form submit
         */
        $(formSelector+' #submit').bind('click', function() {
            console.log('lol');
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
                        var options = {
                            $fadeIn : 300,
                            $fadeOut : 4000,
                            $timeOut : 5000,
                            $extendedTimeOut : 1000
                        }

                        notification.error(
                        'Erreur lors de la suppression !', 
                        'Veuillez contacter l\'adminstrateur afin de résoudre au plus vite ce problème.', 
                        options);
                    }
                },
                success: function() {
                    me.parent('li').remove();
                }
            })
        })
    })
})(jQuery)