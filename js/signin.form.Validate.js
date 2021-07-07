/* Template: DigiGo App - Ticket Support
   Author: André Gomes
   Created: June 2021
   Description: Signin Form Valitate PSW JS file
*/

// -- Show Passwords -- 
function showPsw() {
    var psw = document.getElementById("signinPsw");
    if (psw.type === "password") {
        psw.type = "text";
    } else {
        psw.type = "password";
    }
}

// -- Validate Password --
function pswCharsValidate(signPswChars){
  errors = [];
  if(signPswChars.length < 8){
    errors.push("Your password must be at least 8 characters.");
  }
  if (signPswChars.search(/[a-z]/) < 0) {
    errors.push("Your password must contain at least one lowercase letter.");
  }
  if (signPswChars.search(/[A-Z]/) < 0) {
    errors.push("Your password must contain at least one uppercase letter.");
  }
  if (signPswChars.search(/[0-9]/) < 0) {
    errors.push("Your password must contain at least one digit."); 
  }
  if (signPswChars.search(/[!@#$%^&*]/) < 0) {
    errors.push("Your password must contain at least one special character."); 
  }
  if (errors.length > 0) {
    return errors;
  }
  return true;
}

function validatePsw(){
  var signPsw = document.getElementById("signinPsw");
  var responsePswChars = pswCharsValidate(signPsw.value);
  
if(responsePswChars == true){
  return true;
}
else{
  alert(responsePswChars.join("\n"));
  return false;
}
}

//-- reCaptcha Validation --
function verifyCallback(response) {
  var response = response.length;
  var respValPsw = validatePsw();
  if(response>0 && respValPsw === true){
    const form = document.getElementById("signForm");
    form.setAttribute("method", "post");
    form.setAttribute("action", "php/signin.php");

    const button = document.getElementById("submitRegister");
    button.type="submit";
  }else if(response>0 && respValPsw === false){
    grecaptcha.reset();
  }else{
    alert("Invalid Captcha. Please try again!");
  }
}
      
function onloadCallback() {
  grecaptcha.render("reCaptcha", {
  sitekey: "6LegcUkbAAAAABP5xMXylYtfcmVCH4WlNPRF_ImO",
  'callback' : verifyCallback,
  theme: "light",
})
}