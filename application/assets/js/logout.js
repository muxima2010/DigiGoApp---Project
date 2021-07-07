/* Template: DigiGo App - Ticket Support
   Author: André Gomes
   Created: June 2021
   Description: Logout JS file
*/

function logout(){
    if(!navigator.online){
        window.open('logout.php', '_self');
    } else{
        alert("Without Internet!!!");
    }
}

//Function to prevent go back after logou success
function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
