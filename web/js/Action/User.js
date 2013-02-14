(function($) {

    $(function() {
        /**
         *  Initialisation des différents éléments DOM par conditions.
         */
            /**
             * Page du compte Utilisateur
             */
            if($('#social-buttons').length) {
                var id_follower = $('#button-follow').attr('data-current-user');
                var id_followed = $('#button-follow').attr('data-user');
                
                if(user.isFollowedBy(id_followed, id_follower)) {
                    $('#button-follow').removeClass('follow').addClass('unfollow');
                    $('#button-follow').find('span').text('Ne plus suivre');
                }
            }
        
        /**
         *  Events
         */
        $('#button-follow').click(function() {
            var id_follower = $(this).attr('data-current-user');
            var id_followed = $(this).attr('data-user');
            if($(this).hasClass('follow')) {
                if(user.goFollow(id_followed, id_follower)) {
                    $(this).removeClass('follow').addClass('unfollow');
                    $(this).find('span').text('Ne plus suivre');
                }    
            } else if($(this).hasClass('unfollow')) {
                if(user.unFollow(id_followed, id_follower)) {
                    $(this).removeClass('unfollow').addClass('follow');
                    $(this).find('span').text('Suivre');
                }  
            }
        });
    })
})(jQuery);