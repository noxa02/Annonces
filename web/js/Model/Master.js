var Master = function() {
    var me = this,
        value;
    me.init = function(data) {
        $.each(data, function(key, value) {
            me[key] = value;
        })
    }
   
    me.__defineSetter__("value", function(val){
        value = val;
    });
    
    me.__defineGetter__("value", function(){
        return value;
    });
}

var User = function() {
    var me = this;
    
    me.init = function(data) {
        $.each(data, function(key, value) {
            me[key] = value;
        })
    }
}

var Announcement = function() {
    var me = this;
    
    me.init = function(data) {
        $.each(data, function(key, value) {
            me[key] = value;
        })
    }
}

var Comment = function() {
    var me = this;
    
    me.init = function(data) {
        $.each(data, function(key, value) {
            me[key] = value;
        })
    }
}

User.prototype = $.extend(
    {},
    new Master(),
    User.prototype,
    Announcement.prototype,
    Comment.prototype
);

Announcement.prototype = $.extend(
    {},
    new Master(),
    User.prototype,
    Comment.prototype,
    Announcement.prototype
);

Comment.prototype = $.extend(
    {},
    new Master(),
    User.prototype,
    Announcement.prototype,
    Comment.prototype
);