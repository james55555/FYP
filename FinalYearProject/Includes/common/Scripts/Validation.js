/*
 * This form is to provide client-side form validation prior to submitting
 * to server-side.
 * The input will also be validated server-side to ensure it can be added to 
 * the database without failing.
 * @returns {Boolean}
 */
jQuery(function($) {

    var noSubmit;

    $("form#register input[name='submit']").click(function() {
        
        var noSubmit = 0;

        var fn = $.trim($("form#register input[name=fName]").val());
        var ln = $.trim($("form#register input[name=lName]").val());
        var em = $.trim($("form#register input[name=email]").val());
        /*Check email contains the right characters */
        var em_chars = /^[\w%_\-.\d]+@[\w.\-]+.[A-Za-z]{2,6}$/;
        var ui = $.trim($("form#register input[name=user_id]").val());
        var pw = $.trim($("form#register input[name=password]").val());
        var pw2 = $.trim($("form#register input[name=password2]").val());

        //Begin validation
        if (fn.indexOf(" ")  !== -1
                || fn === "") {
            $("span.val_fName").html("Invalid first name!").addClass('error');
            noSubmit = 1;
        }
        else {
            $("span.val_fName").html("");
        }
        //validate whether last name has a space or is empty.
        if (ln.indexOf(" ") !== -1
                || ln === "") {
            $("span.val_lName").html("Invalid last name!").addClass('error');
            noSubmit = 1;
        }
        else {
            $("span.val_lName").html("");
            noSubmit = 1;
        }
        //If email is invalid
        if (em_chars.test(em)) {
            $("span.val_email").html("Invalid email!").addClass('error');
            noSubmit = 1;
        }
        else {
            $("span.val_email").html("");
        }
        if (ui.indexOf(" ")
                || ui === "") {
            $("span.val_ui").html("Invalid User ID!").addClass('error');
            noSubmit = 1;
        }
        else {
            $("span.val_ui").html("");
        }
        if (pw.indexOf(" ") !== -1
                || pw === "") {
            $("span.val_pass").html("Invalid Password!").addClass('error');
            noSubmit = 1;
        }
        else {
            $("span.val_pass").html("");
        }
        if (pw2 === "") {
            $("span.val_pass2").html("Field Required").addClass('error');
            noSubmit = 1;
        }
        else {
            if (pw !== pw2) {
                $("span.val_pass2").html("Passwords don't match!").addClass('error');
                noSubmit = 1;
            } else {
                $("span.val_pass2").html("");
            }
        }

        if (noSubmit === 1) {
            return false;
        }
        noSubmit = 0;
    });
});



/*
 var fn = document.forms["register"]["fname"].value;
 var ln = document.forms["register"]["lname"].value;
 var em = document.forms["register"]["email"].value;
 var ui = document.forms["register"]["user_id"].value;
 var pw = document.forms["register"]["password"].value;
 var pw2 = document.forms["register"]["password2"].value;
 
 
 if (fieldEmpty(fn, ln, ui, pw)) {
 if (validEmail(em)) {
 if (validPwd(pw, pw2)) {
 if (validName(fn, ln, 30)) {
 if (usernameLength(ui, 25)) {
 //submit form for server-side validation
 document.getElementById("register").main();    
 }
 return false;
 }
 return false;
 }
 return false;
 }
 return false;
 }
 return false;
 }
 
 /*
 * Ensure all fields are filled in
 */
/*
function fieldEmpty(fn, ln, ui, pw) {
    if (fn === null || fn === "" || ln === null || ln === ""
            || ui === null || ui === "" || pw === null ||
            pw === "" || pw2 === null || pw2 === "") {
        alert("A field is missing");
        return false;
    }
    else {
        return 1;
    }

}
/*
 * Function to validate email address syntax
 * http://www.w3schools.com/js/js_form_validation.asp
 * @param {type} em
 * @returns {Boolean}
 */
/*
function validEmail(em) {

    var atpos = em.indexOf("@");
    var dotpos = em.lastIndexOf(".");
    if (!em === "") {
        if (atpos < 1 ||
                dotpos < atpos + 2 ||
                dotpos + 2 >= em.length)
        {
            alert("Not a valid e-mail address");
            return false;
        }
        else if (em.length > 50) {
            alert("Email address is too long!");
            return false;
        }
    }
    return 1;
}

/*
 * Function to validate field lengths
 *//*
function validPwd(pw, pw2) {
    /*
     * Validate the second password is the same as the first
     *//*
    if (pw !== pw2) {
        alert("Passwords don't match!");
        return false;
    }
    else if (pw > 25) {
        alert("Password too long! Must be less than 25 characters");
        return false;
    }
    else {
        return 1;
    }
}
/*
 * Function to check first and last name length name length
 *//*
function validName(fn, ln, mx) {
    if (fn.length > mx) {
        alert("First name must be less than 30 characters");
        return false;
        if (ln.legnth > mx) {
            alert(
                    "Last name too long must be less than 30 characters");
            return false;
        }
    }
    else {
        return 1;
    }
}
/*
 * Function to check username length
 */
/*
function usernameLength(ui, mx) {
    if (ui.length > mx) {
        alert("Username is too long. Must be less than 25 characters!");
        return false;
    }
    else {
        return 1;
    }
}
*/

