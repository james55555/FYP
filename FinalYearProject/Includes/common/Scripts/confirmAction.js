/*
 * Function to prompt the user to confirm their action choice
 */
function confirmAction(action, item){
    return confirm("Are you sure you want to " + action + " " + item + "?");
}