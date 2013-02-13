if ($.browser.webkit) {
    $('input').attr('autocomplete', 'off');
}

var clean = function(item, iclass) {
    $.each(iclass, function(id) {
        item.next('span').remove();
        item.removeAttr('id');
        item.parent('div.control-group').removeClass(iclass[id]['class']);
    });
}

var form = {
    getValues: function(formSelector) {
        var inputs = $(formSelector),
            data = {};

        $.each(inputs, function(key, value) {
            data[value.name] =  value.value; 
        })
        return data;
    }
}
var checkForm = {
    valuesIsValid: function(data) {
        var isValid = true;
        $.each(data, function(i, val){
            if(val == '') {
                isValid = false; 
            }
        });
        return isValid;
    },
    checkFormId: function(formSelector) {
        var isValid = true,
            selector = formSelector;
            
        $(selector).each(function() {
            var me = $(this);
            if(me.attr('id') != 'inputSuccess') {
                isValid = false;
            }
        })
        return isValid;
    }, 
    findErrorField: function(selector) {
        var input;
        $(selector).each(function() {
            var me = $(this);
            if(me.attr('id') == 'inputError') {
                input = me;
                return false;
            }
        })
        return input;
    },
    checkInputRule: function(input) {
        var me    = input,
            type  = me.attr('data-type'),
            value = $.trim(me.val());
            
        clean(input, iclass);
        if(rules.hasOwnProperty(type)) {
            var regex = rules[type];
            if(input.val().match(regex)) {
                input.parent('div.control-group').addClass(iclass.success['class']);
                input.attr('id', iclass.success['id']);
            } else if(me.val() == '') {
                clean(me, iclass);
            } else{
                me.parent('div.control-group').addClass(iclass.error['class']);
                me.attr('id', iclass.error['id']);
                me.after('<span class="help-block">'+message.error[type]+'</span>');
            }
        }  
    },
    message: function() {
        var options = {
            $position : 'toast-top-center'
        }
        toastr.clear();
        notification.info(
        'Formulaire remplie !', 
        'Votre formulaire est correct, appuyer sur le beau bouton bleu afin de finaliser votre inscription !', 
        options);
    }
}

var valid = {
    "message": function() {
        var options = {
            $position : 'toast-top-center'
        }
        toastr.clear();
        notification.info(
        'Formulaire remplie !', 
        'Votre formulaire est correct, appuyer sur le beau bouton bleu afin de finaliser votre inscription !', 
        options);
    }
}

var rules = {
     'varchar' : /^[a-zA-Z0-9-_\s'éèàêâùïüë".!]+$/i,
     'text'    : /^[a-zA-Z0-9-_'":,éèàêâùïüë!.\s]+$/i,
     'email'   : /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
     'tel'     : /^([0-9]{10})+$/i,
     'number'  : /^[0-9]+$/i,
     'zipcode' : /^([0-9]{5})$/i,
     'address' : /^[a-zA-Z0-9-_éèàêâùïüë\s]+$/i
 }

 var iclass = {
     error :   {
                 'id' : 'inputError',
                 'class' : 'error'
               },
     warning : {
                 'id' : 'inputWarning',
                 'class' : 'warning'
               },
     success : {
                 'id' : 'inputSuccess',
                 'class' : 'success'
               },
     info : {
                 'id' : 'inputInfo',
                 'class' : 'info'
               }
 }

 var message = {
     error : {
                 'varchar' : 'Ce champ ne peut contenir que des caractères !',
                 'text'    : 'Ce champ ne peut contenir que des caractères ou des symbôles tel que [a-zA-Z0-9-_\'":,éèàêâùïüë] !',
                 'email'   : 'Votre e-mail doit être sous forme : exemple@fai.fr',
                 'zipcode' : 'Le code postal est composé de 5 chiffres !',
                 'tel'     : 'Ce champ doit être composé de 10 chiffres !'
             }
 }