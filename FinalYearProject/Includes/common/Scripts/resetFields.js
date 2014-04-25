/*
 * Generic function to reset all form values used throughout the system
 */

$(document).ready(function() {
    
    $('#reset').on('click', function() {

        var form = document.forms[0];
        if (confirmAction("reset", "all values \n\
                    (to restore values press F5)")) {
          resetForm($(form));
          return false;
        }

    });
});

function resetForm(form) {
    $(form).find('input:text, input:password, input:file, input[type="date"], select, textarea').val('');
    $(form).find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}
