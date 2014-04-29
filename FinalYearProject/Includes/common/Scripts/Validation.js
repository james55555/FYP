/*
 * This form is to provide client-side form validation prior to submitting
 * to server-side.
 * The input will also be validated server-side to ensure it can be added to 
 * the database without failing.
 * 
 * Error messages will show as expected if this criteria is 
 * met in the HTML document:
 *      .error class exists in CSS
 *      A span class with and id of 'sp' followed by the input id
 *          is positioned to the right of each input
 *      Two divs or spans exist for form instructions and error message
 *          Their id's must be #msg and #errMessage respectively
 * 
 * @returns {Boolean}
 */
jQuery(function($) {
    var form = document.forms[0];

    $("#" + form.id + " input[name='submit']").click(function(e) {

        var errors = [];
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
                        else if (field.name === "password" &&
                                $("#password") !== $("#password2")) {
                            throw("Passwords don't match!");
                        }
                    }
                    //If the field type is an email then perform validation
                    else if (field.name === "email" && val !== "") {
                        //Validate email type
                        if (!em_chars.test(val)) {
                            throw("Invalid email");
                        }
                    }
                    /*else if(field.id === "#password" &&
                     $("#password") !== $("#password2")){
                     console.log("passmatch trigger");
                     throw("Passwords don't match!");
                     }*/
                } catch (ex1) {
                    addErrClass(field.name, field.id);
                    $("#errMessage").html(ex1);
                    if (field.name === "password") {
                        addErrClass(field.name + 2, field.id + 2);
                    }
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

/*
 * Function add error class to the HTML given the field name and id
 * @param (String) fieldName    This is the name of the input associated with the span class
 * @param (String) fieldId      This is the ID (#) of the input to add the error class to
 */
    function addErrClass(fieldName, fieldId) {
        $("#" + fieldId).addClass('error');
        $("span#sp" + fieldName).html("*");
        $("#msg").hide();
    }
    ;
});