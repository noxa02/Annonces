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
                
                $date = $.each($('#comments-list > li'), function() {
                    var me = $(this),
                        current_date = $.format.date(new Date(), 'yyyy/MM/dd HH:mm:ss'),
                        date = null;
                    if(me.find('span.author').text() == authKey.getOwner()) {
                        date = $.format.date(new Date(me.find('span.date').text()), 'yyyy/MM/dd HH:mm:ss');
                        if(date < current_date) {
                            last_comment = datediff(date, current_date, 'minutes');
                        }
                    }
                });
                /**
                 *  If last comment was posted less of 5 minutes
                 */
                if(last_comment < 5) {
                    var options = {
                        $fadeIn : 300,
                        $fadeOut : 4000,
                        $timeOut : 5000,
                        $extendedTimeOut : 1000
                    }

                    notification.warning(
                    'Impossible de poster le commentaire !', 
                    'Le temps minimum avant de pouvoir re-poster un commentaire est d\'au moins 5 minutes, soyez patient !', 
                    options, function(){}, {});
                    return;
                } 
                if(checkForm.valuesIsValid(data)) {
                    $.ajax({
                        type: "POST",
                        url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/comments',
                        //url: 'http://rest.asimpletrade.fr:8086/announcements/',
                        data: data,
                        beforeSend: function (xhr){ 
                            xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                        },
                        success: function(data) {
                           var options = {
                               $fadeIn : 300,
                               $fadeOut : 4000,
                               $timeOut : 5000,
                               $extendedTimeOut : 1000
                           }

                           notification.success(
                           'Commentaire ajouté !', 
                           'Merci pour votre commentaire !', 
                           options, function(){}, {});
                        }
                     });
                     
                    /**
                     *  Refresh comments
                     */
                    var comments = {};
                        html = '',
                        comment  = new Comment(),
                        comments = comment.getAll({id_announcement:announcement.val()});
                    
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
                    $(formSelector+' textarea').val('');
                    $('#comments-list').html(html);
                }
            } else {
                var input = checkForm.findErrorField($(formSelector+' textarea'));
            }

        })
    });
})(jQuery);