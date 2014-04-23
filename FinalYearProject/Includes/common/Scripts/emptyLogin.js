/* 
 * Query to check if 
 */

jQuery(function($){
   var form = document.forms[0];
   $("#submit").click(function(){
     
     // get user name
     var un = $("input[name='username']").val();
     var pw = $("input[name='password']").val();
     
     try {
       
       if (un === "" || un === null){
           throw "Username";
       }
       if (pw === "" || pw === null){
           throw "Password";
       }
     
     } catch(ex) {
       $('#emptyError').html('<p>' + ex + ' must be filled in!</p>');
       return false;
     }
     return true;
   });
});
