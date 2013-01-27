(function($) {
    $(function() {
        window.maPagination = maPagination;
        window.announcement = announcement;
    })

    var maPagination = {
        
        "init": function(current_page, token) {
            loading.show();
            $.ajax({
                type: "GET",
                url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/announcements',
                dataType : 'json',
                current_page : current_page,
                AuthKey : 'bm94YTAyOm9nYW1lMTc=',
                data: {
                  current_page : current_page,
                  limit : 10
                }
                ,
                beforeSend: function (xhr){ 
                    xhr.setRequestHeader('Authorization', 'Basic bm94YTAyOm9nYW1lMTc='); 
                },
                success: function(data) {
                    
                    current_page = this.current_page;
                    var totalItems = announcement.getAll(this.AuthKey);
                    var nbPages = Math.ceil(totalItems/10);
                    var count = 0;
                    var html = '';
                    
                    if(data.length) {
                        for (var id in data) {
                            if (data.hasOwnProperty(id)) {
                                html += announcement.init(data[id], this.AuthKey);
                                count++;
                            }
                        }
        
                        $('#content-announcements').html(html);
                        var content = '';
                        content += '<li><a onClick="maPagination.refresh('+1+');">«</a></li>';
                        for(var i=0; i < 5; i++) {
                            if(this.current_page < count && this.current_page <= nbPages) {
                                if(this.current_page == current_page) {
                                    content += '<li class="active">';
                                    content += '    <a onClick="maPagination.refresh('+this.current_page+');">'+this.current_page+'</a>';
                                    content += '</li>';
                                } else {
                                    content += '<li>';
                                    content += '    <a onClick="maPagination.refresh('+this.current_page+');">'+this.current_page+'</a>';
                                    content += '</li>';
                                }
                                this.current_page++;
                            }
                        }
                        
                        if(this.current_page != count) {
                            content += '<li><a onClick="maPagination.refresh('+count+');">»</a></li>';    
                        }
                        
                        $('#pagination').html(content);
                        loading.hide(); 
                    }
                }
            });
        }, 
        "refresh": function(current_page) {
            var token = $('#AuthKey').text();
            maPagination.init(current_page, token);
        }
    }
    
    var announcement = {
        
        "init": function(data, AuthKey) {
            
            var image = this.getPicture(data,AuthKey);
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
        "getAll": function(token) {
            var result; 
            
            $.ajax({
                type: "GET",
                url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/announcements',
                dataType : 'json',
                async: false, 
                beforeSend: function (xhr){ 
                    xhr.setRequestHeader('Authorization', 'Basic '+token); 
                },
                success: function(data) {
                    result = data.length;
                }
            });
            return result;
        }, 
        "getPicture": function(data, AuthKey) {
            var content = '';
            $.ajax({
                type: "GET",
                url: 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/pictures/'
                      +'?id_announcement='+data.id+'&width=260&height=80&limit=1',
                dataType : 'json',
                async: false,
                beforeSend: function (xhr){ 
                    xhr.setRequestHeader('Authorization', 'Basic '+AuthKey); 
                },
                success: function(data) {
                    if(data != null) {
                        var data = data[0];
                        var src = 'http://localhost:8888/projetcs/REST_ANNONCE_V2';
                        src += '/upload/announcement/'+data.width+'x'+data.height;
                        src += '/'+data.title+'.'+data.extension;
                        content += '<img src="'+src+'" alt="'+data.alternative+'">';
                        
                    }
                }
            });     
            
            return content;
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
})(jQuery);

