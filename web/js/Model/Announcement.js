/**
 *  Get all Announcements
 */
Announcement.prototype.getAll = function (options) {
    var result;
    $.ajax({
        type: "GET",
        url: WS_PATH+'/announcements',
        dataType: 'json',
        async: false, 
        data: options || {},
        beforeSend: function (xhr){ 
            xhr.setRequestHeader('Authorization', 'Basic '+authKey.getAuthKey()); 
        },
        success: function(data) {
            
            if(data.length) {
                $.each(data, function(key, value) {
                    this.announcements.push(value);
                })
            }
        }
     });
     return result;
};

Announcement.prototype.getSingle = function (options) {
    var result,
        me = this;
    
    if(!options && !this.isInitialized()) return false; 
    $.ajax({
        type: "GET",
        url: WS_PATH+'/announcements',
        dataType: 'json',
        async: false, 
        data: options || {
            id : me.id
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

Announcement.prototype.isInitialized = function() {
    var requiered = [id, title, subtitle, post_date, conclued, type, id_user],
        valid = true;
        
    $.each(this, function(key, value) {
        if(!$.inArray(key, requiered)) {
            valid = false;
        }
    })
    return valid;
}