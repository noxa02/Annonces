var notification = {
    
    "info": function(title, message, optionsOverride) {
        
        var options = 
            $fadeIn = optionsOverride.$fadeIn || 300,
            $fadeOut = optionsOverride.$fadeOut || 4000,
            $timeOut = optionsOverride.$timeOut || 5000,
            $extendedTimeOut = optionsOverride.$extendedTimeOut || 1000;

        toastr.options = {
            positionClass: optionsOverride.$position || 'toast-top-right',
            onclick: optionsOverride.$onclick || null
        };
        
        var title = title || '';
        var message = message || '';
        
        toastr.options.fadeIn = + $fadeIn;
        toastr.options.fadeOut = + $fadeOut;
        toastr.options.timeOut = + $timeOut;
        toastr.options.extendedTimeOut = + $extendedTimeOut;

        toastr.info(message, title, options)      
    },
    "success": function(title, message, optionsOverride, callback, data) {
        var options = 
            $fadeIn = optionsOverride.$fadeIn || 300,
            $fadeOut = optionsOverride.$fadeOut || 4000,
            $timeOut = optionsOverride.$timeOut || 5000,
            $extendedTimeOut = optionsOverride.$extendedTimeOut || 1000;

        toastr.options = {
            positionClass: optionsOverride.$position || 'toast-top-right',
            onclick: optionsOverride.$onclick || null
        };
        
        var title = title || '';
        var message = message || '';
        
        toastr.options.fadeIn = + $fadeIn;
        toastr.options.fadeOut = + $fadeOut;
        toastr.options.timeOut = + $timeOut;
        toastr.options.extendedTimeOut = + $extendedTimeOut;

        toastr.success(message, title, options) 
        callback(data);
    },
    "error": function(title, message, optionsOverride) {
        var options = 
            $fadeIn = optionsOverride.$fadeIn || 300,
            $fadeOut = optionsOverride.$fadeOut || 4000,
            $timeOut = optionsOverride.$timeOut || 5000,
            $extendedTimeOut = optionsOverride.$extendedTimeOut || 1000;

        toastr.options = {
            positionClass: optionsOverride.$position || 'toast-top-right',
            onclick: optionsOverride.$onclick || null
        };
        
        var title = title || '';
        var message = message || '';
        
        toastr.options.fadeIn = + $fadeIn;
        toastr.options.fadeOut = + $fadeOut;
        toastr.options.timeOut = + $timeOut;
        toastr.options.extendedTimeOut = + $extendedTimeOut;

        toastr.error(message, title, options)     
    },
    "warning": function(title, message, optionsOverride) {
        var options = 
            $fadeIn = optionsOverride.$fadeIn || 300,
            $fadeOut = optionsOverride.$fadeOut || 4000,
            $timeOut = optionsOverride.$timeOut || 5000,
            $extendedTimeOut = optionsOverride.$extendedTimeOut || 1000;

        toastr.options = {
            positionClass: optionsOverride.$position || 'toast-top-right',
            onclick: optionsOverride.$onclick || null
        };
        
        var title = title || '';
        var message = message || '';
        
        toastr.options.fadeIn = + $fadeIn;
        toastr.options.fadeOut = + $fadeOut;
        toastr.options.timeOut = + $timeOut;
        toastr.options.extendedTimeOut = + $extendedTimeOut;

        toastr.warning(message, title, options)     
    },
    "clear": function() {
        toastr.clear();
    }
}