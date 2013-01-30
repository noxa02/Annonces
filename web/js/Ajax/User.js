var user = {
    "init": function(data) {
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
    "getAll": function() {
        var result; 
        $.ajax({
            type: "GET",
            url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/users',
            dataType : 'json',
            async: false, 
            beforeSend: function (xhr){ 
                xhr.setRequestHeader('Authorization', 'Basic '+authKey.get()); 
            },
            success: function(data) {
                result = data;
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

