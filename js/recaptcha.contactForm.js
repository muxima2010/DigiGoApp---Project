/* Template: DigiGo App - Ticket Support
   Author: André Gomes
   Created: June 2021
   Description: reCaptcha Validation Form JS file
*/

var verifyCallback = function(response) {
        var response = response.length;
        if(response>0){
          var submitBt = document.getElementById("sendForm");
          submitBt.type = "submit";
        }else{
          alert("Invalid Captcha. Please try again!");
        }
      };
      
var onloadCallback = function () {
    grecaptcha.render("reCaptcha", {
    sitekey: "6LegcUkbAAAAABP5xMXylYtfcmVCH4WlNPRF_ImO",
    'callback' : verifyCallback,
    theme: "light",
    });
};