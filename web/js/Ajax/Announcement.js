var customPagination = {
    "init": function(current_page) {
        loading.show();
        $.ajax({
            type: "GET",
            url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/announcements',
            //url: 'http://rest.asimpletrade.fr:8086/announcements/',
            dataType : 'json',
            current_page : current_page,
            data: {
              current_page : current_page,
              limit : 10
            }
            ,
            beforeSend: function (xhr){ 
                xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
            },
            success: function(data) {
                var me = this,
                    totalItems = announcement.getAll().length,
                    current_page = me.current_page,
                    nbPages = Math.ceil(totalItems/10),
                    count = 0,
                    html = '';

                if(data.length) {
                    for (var id in data) {
                        if (data.hasOwnProperty(id)) {
                            html += announcement.init(data[id]);
                            count++;
                        }
                    }
                    $('#content-announcements').html(html);
                    var content = '';
                    content += '<li><a onClick="customPagination.refresh('+1+');">«</a></li>';
                    for(var i=0; i < 5; i++) {
                        if(me.current_page < count && me.current_page <= nbPages) {
                            if(me.current_page == current_page) {
                                content += '<li class="active">';
                                content += '    <a onClick="customPagination.refresh('+me.current_page+');">'+me.current_page+'</a>';
                                content += '</li>';
                            } else {
                                content += '<li>';
                                content += '    <a onClick="customPagination.refresh('+me.current_page+');">'+me.current_page+'</a>';
                                content += '</li>';
                            }
                            me.current_page++;
                        }
                    }

                    if(me.current_page != count) {
                        content += '<li><a onClick="customPagination.refresh('+count+');">»</a></li>';    
                    }

                    $('#pagination').html(content);
                    loading.hide(); 
                }
            }
        });
    }, 
    "refresh": function(current_page) {
        customPagination.init(current_page);
    }
}

var announcement = {
    init: function(data) {
            //image = this.getPicture(data);
        var baseUrl = 'http://localhost:8888/projetcs/Annonces/web',
            //baseUrl =  'http://rest.asimpletrade.fr:8086/';
            content = '';
        content += '<li class="thumbnail">';
        content += '    <div class="date">';
        content += '        Date de mise en ligne : '+$.format.date(data.post_date, "dd/MM/yyyy");;
        content += '    </div>';
        content += '    <h4>';
        content += '        <a href="'+baseUrl+'/announcement/show/'+data.id+'">'+data.title+'</a>';
        content += '    </h4>';
        content += '    <h6>'+data.subtitle+'</h6>'
//        content += '    <a href="'+baseUrl+'/announcement/'+data.id+'">';
//        content += '        '+image;
//        content += '    </a>';
        content += '    <p class="description">'+data.content+'</p>';
        content += '    <div class="announcement-link">';
        content += '        <a href="'+baseUrl+'/announcement/show/'+data.id+'" class="btn btn-primary">Consulter</a>';
        content += '    </div>';
        content += '</li>';

        return content;
    },
    getAll: function() {
        var result; 
        $.ajax({
            type: "GET",
            url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/announcements',
            //url: 'http://rest.asimpletrade.fr:8086/announcements/',
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
    getPicture: function(data) {
        var content = '';
        $.ajax({
            type: "GET",
            url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/pictures/'
                  +'?id_announcement='+data.id+'&width=260&height=80&limit=1',
            //url: 'http://rest.asimpletrade.fr:8086/pictures/'
            //      +'?id_announcement='+data.id+'&width=260&height=80&limit=1',
            dataType : 'json',
            async: false,
            beforeSend: function (xhr){ 
                xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
            },
            success: function(data) {
                if(data != null) {
                    var data = data[0],
                        src = 'http://localhost:8888/projetcs/REST_ANNONCE_V2';
                    //var src = 'http://rest.asimpletrade.fr:8086';
                    src += '/upload/announcement/'+data.width+'x'+data.height;
                    src += '/'+data.title+'.'+data.extension;
                    content += '<img src="'+src+'" alt="'+data.alternative+'">';

                }
            }
        });     

        return content;
    },
    getWithAuthor: function() {
        
    },
    "search-page": function(data) {
        var image = this.getPicture(data),
            baseUrl = 'http://localhost:8888/projetcs/Annonces/web',
            //baseUrl = 'http://rest.asimpletrade.fr:8086/';
            content = '';
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
    }
}

var loading = {
    show: function() {
        $('#loading').html("<img src='http://localhost:8888/projetcs/Annonces/web/images/ajax-loader.gif'/>").fadeIn('fast');
        //$('#loading').html("<img src='http://rest.asimpletrade.fr:8086/images/ajax-loader.gif'/>").fadeIn('fast');
    }, 
    hide: function () {
        $('#loading').fadeOut();
    }    
}