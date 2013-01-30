(function($) {
    $(function() {
        var searchTimer = 0;
        $('#search-form input:not([type=checkbox],[type=radio],[type=button],[type=submit])').bind('keyup', function() {
            if (searchTimer != 0) {
              clearTimeout(searchTimer);
            }
            searchTimer = setTimeout(ajaxRequest.init($(this)), 1000);
           
        })
        $('#search-form input:not([type=checkbox],[type=radio],[type=button],[type=submit])').bind('change', function() {
            ajaxRequest.init($(this));
        })  
        $('select[name="limit"]').bind('change', function() {
            if($.cookie('ajaxRequest')) {
                ajaxRequest.refreshLimit($(this).val());
            }
        })
        $('#search-form input[type=radio]').bind('change',function() {
            if($(this).attr('checked')) {
                if($(this).val() == 'date-unique') {
                    $('#date-2').attr('disabled', true);
                } else if($(this).val() == 'date-between') {
                    $('#date-2').attr('disabled', false);
                }
            }
        }).trigger('change');
    })
})(jQuery);

    var ajaxRequest = {
        "init": function(input) {
            return function(){
                searchTimer = 0;
                var length = input.val().length
                var array = {'data':{}, 'url':'http://localhost:8888/projetcs/REST_ANNONCE_V2/web/announcements/'};
                array['data']['limit'] = $('select[name="limit"]').val();
                $.each($('input:not([type=radio],[type=date])'), function() {
                    column = $(this).attr('data-column');
                    value = $(this).val();
                    if(column && value) {
                        array['data'][column] = value;   
                    }
                })
                /**
                 * Get input date value(s)
                 */
                $.each($('input[type=date]'), function() {
                    id = $(this).attr('id');
                    column = $(this).attr('data-column');
                    value = $(this).val();
                    if(!$(this).is(':disabled') && column && value) {
                        if($('#date-2').is(':disabled')) {
                            array['data'][column] = value;
                        } else {
                            if(id == 'date-1') {
                                array['data'][column+'_begin'] = value;
                            } else if(id == 'date-2') {
                                array['data'][column+'_end'] = value;
                            }     
                        }   
                    }
                })
                
                timeOut = setTimeout(function(){
                    ajaxRequest.send(array);
                }, 1500);
            }

        }, 
        "send": function(array) {
            this.setRequest(array);
            
            $.ajax({
                url: array['url'],
                type: 'GET',
                dataType: 'json',
                data: array['data'],
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Basic '+authKey.get()); 
                },
                statusCode: {
                    204: function() {
                        $('#search').html('Aucun résultats.. veuillez modifier votre recherche !');
                    }
                },
                success: function(data) {
                    var html;
                    if(data) {
                        $.each(data, function() {
                            html += announcement.init(this);
                        })
                        $('#search').html(html);   
                    } else {
                       $('#search').html('');
                    }

                }
            })
        },
        "setRequest": function(array) {
            $.cookie('ajaxRequest', array);
        }, 
        "getRequest": function() {
            return $.cookie('ajaxRequest');
        }, 
        "refreshLimit": function(limit) {
            var request = this.getRequest();
        }
    }