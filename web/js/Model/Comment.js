/**
 *  Get all comments
 */
Comment.prototype.getAll = function (options) {
    var result;
    $.ajax({
        type: "GET",
        url: WS_PATH+'/comments',
        dataType: 'json',
        async: false, 
        data: options || {},
        beforeSend: function (xhr){ 
            xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
        },
        success: function(data) {
            result = data;
        }
     });
     return result;
};

Comment.prototype.getSingle = function (options) {
    var result,
        me = this;
    
    if(!options && !this.isInitialized()) return false; 
    $.ajax({
        type: "GET",
        url: WS_PATH+'/comments',
        dataType: 'json',
        async: false, 
        data: options || {
            id : me.id,
        },
        beforeSend: function (xhr){ 
            xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
        },
        success: function(data) {
            result = data;
        }
     });
     return result;
};

Comment.prototype.isInitialized = function() {
    var requiered = [id, content, post_date, id_user, id_announcement],
        valid = true;
        
    $.each(this, function(key, value) {
        if(!$.inArray(key, requiered)) {
            valid = false;
        }
    })
    return valid;
}