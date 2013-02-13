(function($) {
    $(function() {
        var array = {
            data : {}, 
            url  : WS_PATH+'/announcements/'
        };
        
        ajaxRequest.setRequest(array);
        /**
         * Action when input text are binded
         */
        var searchTimer = 0;
        $('#search-form input:not([type=checkbox],[type=radio],[type=button],[type=submit])').bind('keyup', function() {
            if (searchTimer != 0) {
              clearTimeout(searchTimer);
            }
            searchTimer = setTimeout(ajaxRequest.init(), 1000);
        })
        $('#search-form input:not([type=checkbox],[type=radio],[type=button],[type=submit])').bind('change', function() {
            ajaxRequest.init();
        })  
        $('select[name="limit"],select[name="order-type"], select[name="order-column"]').bind('change', function() {
            if($.cookie('ajaxRequest')) {
                ajaxRequest.refresh();
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
        "init": function() {
            return function(){
                var array = {
                    data : {}, 
                    url  : WS_PATH+'/announcements/'
                }, 
                searchTimer = 0;
                /**
                 * Get input Text value(s)
                 */
                $.each($('input:not([type=radio],[type=date])'), function() {
                    var column = $(this).attr('data-column'),
                        value  = $(this).val();
                    if(column && value != '') {
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
                
                /**
                 * Get select filter value(s)
                 */
                $.each($('select[data-select="filter"]'), function() {
                    input = $(this);
                    var key = input.attr('name'),
                        value = input.val(),
                        column = $('select[name="order-column"]').val(),
                        type = $('select[name="order-type"]').val();
                        
                    if(input.attr('name') == 'order-type') {
                        key = 'order';
                        value = column+' '+input.val();
                    } else if(input.attr('name') == 'order-column') {
                        key = 'order';
                        value = value+' '+type;
                    } 
                    
                    if(key && value) {
                         array['data'][key] = value;
                    }
                })
                
                var cookieRequest = ajaxRequest.getRequest();
                if(!compare.object(array['data'], cookieRequest['data'])) {
                    ajaxRequest.setRequest(array);
                    ajaxRequest.refresh();
                    timeOut = setTimeout(function(){
                        ajaxRequest.send(ajaxRequest.getRequest());
                    }, 1500);
                }
            }

        }, 
        "send": function(array) {
            /**
             * If data args is equals to the last search, no need to re-send an ajax request.
             */
            $.ajax({
                url: array['url'],
                type: 'GET',
                dataType: 'json',
                data: array['data'],
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
                },
                statusCode: {
                    204: function() {
                        $('#search').html('Aucun résultats.. veuillez modifier votre recherche !');
                    }
                },
                success: function(data) {
                    var html;
                    if(data) {
                        html += '<ul>';
                        $.each(data, function() {
                            html += announcement.init(this);
                        })
                        html += '</ul>';
                        $('#search').html(html);   
                    } else {
                       $('#search').html('');
                    }

                }
            })

        },
        "setRequest": function(array) {
            if($.cookie('ajaxRequest')) $.removeCookie('ajaxRequest');
            $.cookie('ajaxRequest', $.toJSON(array), { path: '/' });
        }, 
        "getRequest": function() {
            return $.evalJSON($.cookie('ajaxRequest'));
        }, 
        "refresh": function() {
            var request = this.getRequest();
            
            $.each($('select[data-select="filter"]'), function() {
                request = checkFilter(request, $(this));
            })
            this.send(request);
        }
    }
    
    var checkFilter = function(data, input) {
        var key = input.attr('name'),
            value = input.val(),
            column = $('select[name="order-column"]').val(),
            type = $('select[name="order-type"]').val();
            
        if(input.attr('name') == 'order-type') {
            key = 'order';
            value = column+' '+input.val();
        } else if(input.attr('name') == 'order-column') {
            key = 'order';
            value = value+' '+type;
        }
        data['data'][key] = value;
        ajaxRequest.setRequest(data);
        return data;
    }