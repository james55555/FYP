/*
 * This form is to provide client-side form validation prior to submitting
 * to server-side.
 * The input will also be validated server-side to ensure it can be added to 
 * the database without failing.
 * @returns {Boolean}
 */
jQuery(function($) {
    var form = document.forms[0];

    $("#" + form.id + " input[name='submit']").click(function(e) {
        var errors = [];
        var empty = [];

        //Check email contains the right characters
        var em_chars = /([\w\-]+\@[\w\-]+\.[\w\-]+)/;
        //Get all input elements that are valid
        var fieldStack = document.querySelectorAll('.valid');
        //Check for empty inputs
        for (i = 0; i < fieldStack.length; i++) {
            //Similar to associative key => value assignment
            //Key - Field name
            var field = fieldStack[i];
            //Value - Value name
            var val = form[field.name].value.trim();
            //Allow empty optional fields
            if (!$(field).data('optional')) {
                if (!val) {
                    $("#" + field.name).removeClass("valid").addClass('error');
                    $("span#sp" + field.id).html("*");
                    empty.push(field.name);
                }
            }
            //If the field type is an email then perform validation
            else if (field.name === "email" && val !== "") {
                //Validate email type
                if (!em_chars.test(val)) {
                    $("#" + field.name).addClass('error');
                    $("span#sp" + field.id).html("*");
                    errors.push(field.name);
                }
            }
        }//End of for loop
        //Message to explain error
        var msg;
        if (empty.length !== 0) {
            msg = "Fields Required!";
        }
        else if (errors.length !== 0)
        {
            //Capitalize first letter of error field and concatenate
            msg = errors[0].charAt(0).toUpperCase()
                    + errors[0].substring(1)
                    + " isn't valid!";
        }
        else {
            return true;
        }
        $("#msg").hide();
        $("#errMessage").html(msg);
        return false;
    });
});