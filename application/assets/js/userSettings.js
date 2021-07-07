/* Template: DigiGo App - Ticket Support
   Author: André Gomes
   Created: June 2021
   Description: User Settings JS file
*/

//Preview avatar img before update
function changeFunc() {
    var selectBox = document.getElementById("imgPreview");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    let file = "../application/assets/images/avatars/" + selectedValue;
    let avatarImg = document.querySelector("#img-avatar");
    avatarImg.setAttribute("src", file);
}