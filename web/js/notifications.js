var notification = {
    
    "info": function(title, message, optionsOverride) {
        
        var options = 
            $fadeIn = optionsOverride.$fadeIn || 700,
            $fadeOut = optionsOverride.$fadeOut || 500,
            $timeOut = optionsOverride.$timeOut || 2000,
            $extendedTimeOut = optionsOverride.$extendedTimeOut || 0;

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

        toastr.info(message, title, optionsOverride)      
    },
    "success": function(title, message, optionsOverride, callback, data) {
        var options = 
            $fadeIn = optionsOverride.$fadeIn || 700,
            $fadeOut = optionsOverride.$fadeOut || 700,
            $timeOut = optionsOverride.$timeOut || 2000,
            $extendedTimeOut = optionsOverride.$extendedTimeOut || 0;

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
            $fadeIn = optionsOverride.$fadeIn || 700,
            $fadeOut = optionsOverride.$fadeOut || 700,
            $timeOut = optionsOverride.$timeOut || 2000,
            $extendedTimeOut = optionsOverride.$extendedTimeOut || 0;

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
            $fadeIn = optionsOverride.$fadeIn || 700,
            $fadeOut = optionsOverride.$fadeOut || 700,
            $timeOut = optionsOverride.$timeOut || 2000,
            $extendedTimeOut = optionsOverride.$extendedTimeOut || 0;

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