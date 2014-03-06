/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * This form is to provide client-side form validation prior to submitting
 * to server-side.
 * The input will also be validated server-side to ensure it can be added to 
 * the database without failing.
 * @returns {Boolean}
 */

function Validation() {

    /*
     * 
     * @type @exp;documentformsregister
     * @pro;fName
     * @pro;value
     */

    var fn = document.forms["register"]["fName"].value;
    var ln = document.forms["register"]["lName"].value;
    var em = document.forms["register"]["email"].value;
    var ui = document.forms["register"]["user_id"].value;
    var pw = document.forms["register"]["password"].value;
    var pw2 = document.forms["register"]["password2"].value;


    if (fieldEmpty(fn, ln, ui, pw)) {
        if (validEmail(em)) {
            if (validPwd(pw, pw2)) {
                if (validName(fn, ln, 30)) {
                    if (usernameLength(ui, 25)) {

                    }
                    /*
                     * Submit the form
                     */
                    document.getElementById("register").main();
                }
            }
        }
    }
    return false;


    /*
     * Ensure all fields are filled in
     */
    function fieldEmpty(fn, ln, ui, pw) {
        if (fn === null || fn === "" || ln === null || ln === ""
                || ui === null || ui === "" || pw === null || pw === ""
                || pw2 === null || pw2 === "") {
            alert("A field is missing");
            return false;
        }
        else {
            return true;
        }

    }
    /*
     * Function to validate email address syntax
     * http://www.w3schools.com/js/js_form_validation.asp
     * @param {type} em
     * @returns {Boolean}
     */
    function validEmail(em) {

        var atpos = em.indexOf("@");
        var dotpos = em.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= em.length)
        {
            alert("Not a valid e-mail address");
            return false;
        }
        else if (em.length > 50) {
            alert("Email address is too long!");
            return false;
        }
        else {

            return true;

        }

        /*
         * Function to validate field lengths
         */
        function validPwd(pw, pw2) {
            /*
             * Validate the second password is the same as the first
             */
            if (!pw !== pw2) {
                alert("Passwords don't match!");
                return false;
            }
            else if (pw > 25) {
                alert("Password too long! Must be less than 25 characters");
                return false;
            }
            else {

                return true;

            }

        }
        /*
         * Function to check first and last name length name length
         */
        function validName(fn, ln, mx) {
            var valid = true;
            if (fn.length > mx) {
                alert("First name must be less than 30 characters");
                valid = false;
                if (ln.legnth > mx) {
                    alert(
                            "Last name too long must be less than 30 characters");
                    valid = false;
                }
            }
            return valid;
        }
        /*
         * Function to check username length
         */
        function usernameLength(ui, mx) {
            if (ui.length > mx) {
                alert("Username is too long. Must be less than 25 characters!");
                return false;
            }
            return true;
        }
    }
}


