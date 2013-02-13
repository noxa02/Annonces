/**
 *  Get all users
 */
User.prototype.getAll = function (options) {
    var result;
    $.ajax({
        type: "GET",
        url: WS_PATH+'/users',
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

User.prototype.getSingle = function (options) {
    var result,
        me = this;
    
    if(!options && !this.isInitialized()) return false; 
    $.ajax({
        type: "GET",
        url: WS_PATH+'/users',
        dataType: 'json',
        async: false, 
        data: options || {
            id : me.id,
            login : me.login
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

User.prototype.isInitialized = function() {
    var requiered = [id, name, firstname, login, password, mail, address, city, zipcode, phone, portable
    , subscription_date, newsletter, role],
        valid = true;
        
    $.each(this, function(key, value) {
        if(!$.inArray(key, requiered)) {
            valid = false;
        }
    })
    return valid;
}