/* Template: DigiGo App - Ticket Support
   Author: André Gomes
   Created: June 2021
   Description: Login Form JS file
*/

// -- Show Password --
function showPsw() {
    var psw = document.getElementById("input-psw");
    if (psw.type === "password") {
        psw.type = "text";
    } else {
        psw.type = "password";
    }
}