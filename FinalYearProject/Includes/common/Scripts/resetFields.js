jQuery(function($) {
    
    $('#reset').click(function() {
        $()
        var form = document.forms[0];
        if (confirmAction("reset", "all values")) {
          resetForm($(form));
          return false;
        }
    });
});

function resetForm(form) {
    $(form).find('input:text, input:password, input:file, select, textarea').val('');
    console.log($(form).find('input:text, input:password, input:file, select, textarea'));
    $(form).find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}