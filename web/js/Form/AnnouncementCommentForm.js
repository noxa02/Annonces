(function($) {
    $(function() {
       var formSelector = '#form-announcement-comment';
           
        if ($.browser.webkit) {
            $('input').attr('autocomplete', 'off');
        }
        /****
         * Validation on keyup for user form registration by
         * REGEX and check for login if no existent. 
         */
        $(formSelector+' input:not([type=checkbox],[type=button],[type=submit]), '+
          formSelector+' textarea').keyup(function() {
            var me    = $(this);
            checkForm.checkInputRule(me);

        })
       
        $(formSelector+' #submit').click(function(e) {
            toastr.clear();
            e.preventDefault();
            var data = form.getValues($(formSelector+' textarea'));
            /**
             * Check if form had empty field
             */
            if(checkForm.checkFormId($(formSelector+' textarea'))) {
               var user = $(formSelector+' input[type=hidden][name=id_user]');
                   announcement =  $(formSelector+' input[type=hidden][name=id_announcement]'),
                   last_comment = null;
                   
                data['id_user'] = user.val();
                data['id_announcement'] = announcement.val();
                
//                $date = $.each($('#comments-list > li'), function() {
//                    var me = $(this),
//                        current_date = $.format.date(new Date(), 'yyyy/MM/dd HH:mm:ss'),
//                        date = null;
//                    if(me.find('span.author').text() == authKey.getOwner()) {
//                        date = $.format.date(new Date(me.find('span.date').text()), 'yyyy/MM/dd HH:mm:ss');
//                        if(date < current_date) {
//                            last_comment = datediff(current_date, date, 'minutes');
//                        }
//                    }
//                });
                /**
                 *  If last comment was posted less of 5 minutes
                 */
                if($.cookie('comment')) {
                    notification.warning(
                    'Impossible de poster le commentaire !', 
                    'Le temps minimum avant de pouvoir re-poster un commentaire est d\'au moins 5 minutes, soyez patient !', 
                    {}, function(){}, {});
                    return;
                } 
                
                if(checkForm.valuesIsValid(data)) {
                    $.ajax({
                        type: "POST",
                        url: WS_PATH+'/comments',
                        data: data,
                        beforeSend: function (xhr){ 
                            xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                        },
                        success: function(data) {
                           notification.success(
                           'Commentaire ajouté !', 
                           'Merci pour votre commentaire !', 
                           {}, function(){}, {});
                           setCookie('comment', 1, 5);
                        }
                     });
                     
                    /**
                     *  Refresh comments
                     */
                    var comments = {};
                        html = '',
                        comment  = new Comment(),
                        comments = comment.getAll({id_announcement:announcement.val()});
                    
                    if(comments && comments.length) {
                        $.each(comments, function() {
                            var comment = this,
                                user = new User().getSingle({id:comment.id_user}),
                                content;
                                user = (user.length) ? user[0] : null;
                            if(user) {
                                content  = '<li>'
                                content += '    <h6>';
                                content += '        <i class="icon-time"></i> ';
                                content += '        Par <a href="'+BASE_URL+'/user/account/'+user.id+'">';
                                content += '                <span class="author">'+user.login+'</span>';
                                content += '            </a>';
                                content += '        le <span class="date">'+comment.post_date+'</span>';
                                content += '    </h6>';
                                content += '    <p>'+comment.content+'</p><hr/>';
                                content += '</li>';

                                html += content;
                            }
                        });
                    }
                    
                    $(formSelector+' textarea').val('');
                    if($('#comments-list').hasClass('hide')) $('#comments-list').removeClass('hide');
                    $('#comments-list').html(html);
                }
            } else {
                var input = checkForm.findErrorField($(formSelector+' textarea'));
            }

        })
    });
})(jQuery);