(function($) {
    $(function() {
        customPagination.init(1, authKey.getAuthKey());
    })
})(jQuery);

var customPagination = {
    "init": function(current_page) {
        var config = {
              current_page : current_page,
              limit : 4
        };

        loading.show();
        $.ajax({
            type: "GET",
            url: WS_PATH+'/announcements',
            dataType : 'json',
            data: config,
            beforeSend: function (xhr){ 
                xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
            },
            success: function(data) {
                var me = this,
                    totalItems = announcement.getAll().length,
                    nbPages = Math.ceil(totalItems/config.limit),
                    count = 0,
                    page = config.current_page,
                    content = '',
                    html = '';

                if(data && data.length) {
                    for (var id in data) {
                        if (data.hasOwnProperty(id)) {
                            html += announcement.init(data[id]);
                            count++;
                        }
                    }
                    $('#content-announcements').html(html);
                    if(config.current_page > 1) {
                        content += '<li><a onClick="customPagination.refresh('+1+');">«</a></li>';
                    }
                    for(var i=0; i < 5; i++) {
                        if(page <= nbPages) {
                            if(page == config.current_page) {
                                content += '<li class="active">';
                                content += '    <a onClick="customPagination.refresh('+page+');">'+page+'</a>';
                                content += '</li>';
                            } else {
                                content += '<li>';
                                content += '    <a onClick="customPagination.refresh('+page+');">'+page+'</a>';
                                content += '</li>';
                            }
                            page++;
                        }
                    }

                    if(config.current_page != nbPages) {
                        content += '<li><a onClick="customPagination.refresh('+nbPages+');">»</a></li>';    
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

var loading = {
    show: function() {
        $('#loading').html("<img src='"+BASE_URL+"/images/ajax-loader.gif'/>").fadeIn('fast');
    }, 
    hide: function () {
        $('#loading').fadeOut();
    }    
}
var announcement = {
    init: function(data) {
        var content = '',
            user = new User().getSingle({id : data.id_user})[0],
            announcement = data,
            comment = new Comment().getAll({id_announcement : announcement.id}),
            countComments = (comment && comment.length) ? comment.length : 0;
        
        content += '<div class="span12">';
        content += '<h4><strong><a href="'+BASE_URL+'/announcement/show/'+data.id+'">'+data.title+'</a></strong></h4>';
        content += '<div class="row-fluid">';
        content += '    <div class="post-summary">';
        content += '        <p>'+data.content+'</p>';
        content += '        <p><a class="btn btn-mini" href="'+BASE_URL+'/announcement/show/'+data.id+'">Consulter</a></p>';
        content += '    </div>';
        content += '</div>';
        content += '<div class="row-fluid details">';
        content += '    <i class="icon-user"></i> by <a href="'+BASE_URL+'/user/account/'+user.id+'">'+user.login+'</a> ';
        content += '    | <i class="icon-calendar"></i> '+$.format.date(data.post_date, "dd/MM/yyyy");
        content += '    | <i class="icon-comment"></i> <a href="javascript:void(0)"> '+countComments+' commentaires</a>';
        content += '</div>';
        content += '</div>';

//        
//        content += '<li class="thumbnail">';
//        content += '    <div class="date">';
//        content += '        Date de mise en ligne : '+$.format.date(data.post_date, "dd/MM/yyyy");;
//        content += '    </div>';
//        content += '    <h4>';
//        content += '        <a href="'+BASE_URL+'/announcement/show/'+data.id+'">'+data.title+'</a>';
//        content += '    </h4>';
//        content += '    <h6>'+data.subtitle+'</h6>'
//        content += '    <p class="description">'+data.content+'</p>';
//        content += '    <div class="announcement-link">';
//        content += '        <a href="'+BASE_URL+'/announcement/show/'+data.id+'" class="btn btn-primary">Consulter</a>';
//        content += '    </div>';
//        content += '</li>';

        return content;
    },
    getAll: function() {
        var result; 
        $.ajax({
            type: "GET",
            url: WS_PATH+'/announcements',
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
            url: WS_PATH+'/pictures/?id_announcement='+data.id+'&width=260&height=80&limit=1',
            dataType : 'json',
            async: false,
            beforeSend: function (xhr){ 
                xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
            },
            success: function(data) {
                if(data != null) {
                    var data = data[0],
                        src = WS_PATH;
                    src += '/upload/announcement/'+data.width+'x'+data.height;
                    src += '/'+data.title+'.'+data.extension;
                    content += '<img src="'+src+'" alt="'+data.alternative+'">';

                }
            }
        });     

        return content;
    },
    "search-page": function(data) {
        var content = '';
        content += '<li class="thumbnail">';
        content += '    <div class="date">';
        content += '        Date de mise en ligne : '+$.format.date(data.post_date, "dd/MM/yyyy");;
        content += '    </div>';
        content += '    <h4>';
        content += '        <a href="'+BASE_URL+'/announcement/'+data.id+'">'+data.title+'</a>';
        content += '    </h4>';
        content += '    <h6>'+data.subtitle+'</h6>'
        content += '    <p class="description">'+data.content+'</p>';
        content += '    <div class="announcement-link">';
        content += '        <a href="'+BASE_URL+'/announcement/'+data.id+'" class="btn btn-primary">Consulter</a>';
        content += '    </div>';
        content += '</li>';

        return content;
    }
}