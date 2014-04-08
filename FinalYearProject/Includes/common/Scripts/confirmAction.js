/*
 * Function to prompt the user to confirm their action choice
 * @param action (String) This is used to define what has been called
 * @param item   (String) This is used to define the item being actioned
 * 
 * @return confirm() Return the popup box displaying the full String
 */
function confirmAction(action, item){
    return confirm("Are you sure you want to " + action + " " + item + "?");
}