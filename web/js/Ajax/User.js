var user = {
    init: function(data) {
        var image = this.getPicture(data);
        var baseUrl = 'http://localhost:8888/projetcs/Annonces/web';
        var content = '';
        content += '<li class="thumbnail">';
        content += '    <div class="date">';
        content += '        Date de mise en ligne : '+$.format.date(data.post_date, "dd/MM/yyyy");;
        content += '    </div>';
        content += '    <h4>';
        content += '        <a href="'+baseUrl+'/announcement/'+data.id+'">'+data.title+'</a>';
        content += '    </h4>';
        content += '    <h6>'+data.subtitle+'</h6>'
        content += '    <a href="'+baseUrl+'/announcement/'+data.id+'">';
        content += '        '+image;
        content += '    </a>';
        content += '    <p class="description">'+data.content+'</p>';
        content += '    <div class="announcement-link">';
        content += '        <a href="'+baseUrl+'/announcement/'+data.id+'" class="btn btn-primary">Consulter</a>';
        content += '    </div>';
        content += '</li>';

        return content;
    },
    getAll: function() {
        var result; 
        $.ajax({
            type: "GET",
            url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/users',
            dataType : 'json',
            async: false, 
            beforeSend: function (xhr){ 
                xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
            },
            success: function(data) {
                result = data;
            }
        });
        return result;
    },
    goFollow: function(id_followed, id_follower) {
        var result = false;
        console.log($.ajax({
            type: "POST",
            url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/users/'+id_followed+'/followers/',
            data: {
                'id_user_follower' : id_follower
            },
            async: false,
            beforeSend: function (xhr){ 
                xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
            },           
            statusCode: {
                409: function () {
                    var options = {
                        $fadeIn : 300,
                        $fadeOut : 4000,
                        $timeOut : 5000,
                        $extendedTimeOut : 1000
                    }
                    notification.clear();
                    notification.error(
                    'Aïe un problème est survenu !', 
                    'Veuillez contacter l\'administrateur du site !', 
                    options);
                },
                201: function() {
                    result = true;
                }
            }
        }));
        return result;
    },
    unFollow: function(id_followed, id_follower) {
        result = false;
        $.ajax({
            type: "DELETE",
            url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/users/'+id_followed+'/followers/'+id_follower,
            async: false,
            beforeSend: function (xhr){ 
                xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
            },
            statusCode : {
                409: function () {
                    var options = {
                        $fadeIn : 300,
                        $fadeOut : 4000,
                        $timeOut : 5000,
                        $extendedTimeOut : 1000
                    }
                    notification.clear();
                    notification.error(
                    'Aïe un problème est survenu !', 
                    'Veuillez contacter l\'administrateur du site !', 
                    options);
                },
                200: function() {
                    result = true;
                }
            }
        });
        return result;
    },
    isFollowedBy: function(id_followed, id_follower) {
        result = false;
        $.ajax({
            type: "GET",
            url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/users/'+id_followed+'/followers/',
            dataType: 'json',
            async: false, 
            data: {
                'id_user_follower' : id_follower
            },
            beforeSend: function (xhr){ 
                xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
            },
            success: function(data) {
                if(data && data.length) {
                    result = true;
                }
            } 
        });
        return result;
    }
}

var loading = {
    "show": function() {
        $('#loading').html("<img src='http://localhost:8888/projetcs/Annonces/web/images/ajax-loader.gif'/>").fadeIn('fast');
    }, 
    "hide": function () {
        $('#loading').fadeOut();
    }    
}

