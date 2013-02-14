(function($) {
    $(function() {
        var user = new User().getSingle({id : $('input[name="id_user"]').val()}),
            announcement = new Announcement().getSingle({id : $('input[name="id_announcement"]').val()}),
            html = '';
            
        $('#apply').click(function() {
                $.ajax({
                    url: WS_PATH+'/announcements/'+id_announcement,
                    type: 'PUT',
                    data: {
                        id_user : user.id
                    },
                    beforeSend: function (xhr){ 
                        xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                    },statusCode : {
                        409: function (statusCode) {
                            notification.error(
                            'Erreur sur l\'action "Postuler" !', 
                            'Veuillez contacter l\'adminstrateur afin de résoudre au plus vite ce problème.', 
                            options);
                        }
                    },
                    success: function(data) {
                       
                       html += '<i class="icon-time"></i>';
                        if(pictures.length > 0) {
                            file.send(id_announcement);
                        }
                    }
                })
        });
    })
})(jQuery);