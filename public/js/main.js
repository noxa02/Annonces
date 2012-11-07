(function($) {
    $(function () {
        $('#submit-connexion').click(function() {
          var login = $('#login-connexion').val();
          var password = $('#password-connexion').val();
          var remember_me = $('#remember-me').val();
          var url = "/projetcs/Annonces/application/controllers/Member/login.controller.php";
          $.ajax({
            type: "POST",
            url: url,
            data: { login_c : login,
                    password_c : password,
                    remember_me_c : remember_me},
            dataType: "json",
            success: function(data){
                console.log(data);
            },
            complete: function()
            {
                console.log('lol');
            }
          });
        });
    });
})(jQuery)