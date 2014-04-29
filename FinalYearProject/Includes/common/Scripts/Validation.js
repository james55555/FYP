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
        var pwCheck = [];
        //Check email contains the right characters
        var em_chars = /([\w\-]+\@[\w\-]+\.[\w\-]+)/;

        //Get all input elements that are to be validated
        var fieldStack = document.querySelectorAll("#" + form.id + " input[data-validate='true']");

        try {
            //Check for empty inputs
            for (i = 0; i < fieldStack.length; i++) {
                try {
                    //Similar to associative key => value assignment
                    //Key - Field name
                    var field = fieldStack[i];
                    //Value - Value name
                    var val = form[field.name].value.trim();
                    //Allow empty optional fields
                    if (!$(field).data('optional')) {
                        if (!val) {
                            throw("Fields Required!");
                        }
                    }
                    //If the field type is an email then perform validation
                    else if (field.name === "email" && val !== "") {
                        //Validate email type
                        if (!em_chars.test(val)) {
                            throw("Invalid email");
                        }
                    }
                } catch (ex1) {
                    errors.push(field.name);
                    /*
                     * Error messages will show as expected if this criteria is 
                     * met in the HTML document:
                     *      .error class exists in CSS
                     *      A span class with and id of 'sp' followed by the input id
                     *          is positioned to the right of each input
                     *      Two divs or spans exist for form instructions and error message
                     *          Their id's must be #msg and #errMessage respectively
                     */
                    $("#" + field.name).addClass('error');
                    $("span#sp" + field.id).html("*");
                    $("#msg").hide();
                    $("#errMessage").html(ex1);
                }
            }//End of for loop
            if (errors.length !== 0) {
                throw (false);
            }
        } catch (ex2) {
            //Only caught when the loop has iterated through all nodeList variables
            //and errors have been caught
            return ex2;
        }
        return true;
    });
});