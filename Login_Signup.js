let Signupbtn= document.querySelector(".Signupbtn");
let Signupform=document.querySelector(".signup");
let Loginbtn= document.querySelector(".Loginbtn");
let MidContainer= document.querySelector(".midContainer");
let Loginform= document.querySelector(".login");
let forgotpassword=document.querySelector(".forgotPassword");
let showresetpassword=document.querySelector(".resetpass");
let askForToken=document.querySelector(".askForToken");
let validatebtn=document.querySelector(".validatebtn");
let tokenForm=document.querySelector(".container1");
var isshowpasswordactive =false;
var isfinishupformactive=false;
let finishUpRegistration=document.querySelector(".finishUpRegistration");
forgotpassword.addEventListener("click",showresetpasswordform);
Signupbtn.addEventListener("click",moveLeft);
Loginbtn.addEventListener("click",moveRight);
askForToken.addEventListener("click",moveToToken);
validatebtn.addEventListener("click",finishupregform);
function showresetpasswordform() {
   
    if(isshowpasswordactive){
        isshowpasswordactive=false;
        showresetpassword.classList.remove("showresetpass");
        forgotpassword.textContent="click here to reset";
    } 
    else{
        isshowpasswordactive=true;
        showresetpassword.classList.add("showresetpass");
        forgotpassword.textContent="Dismiss reset";
        
    }

}

function moveLeft(){
// alert("moving Left");
Loginform.classList.remove("signuptologin");
Signupform.classList.remove("signuptologin");

Loginform.classList.add("logintosignup");
Signupform.classList.add("logintosignup");
MidContainer.classList.add("addwidth");

}
function moveRight(){
    // alert("moving right");
    Loginform.classList.remove("logintosignup");
Signupform.classList.remove("logintosignup");
//     Loginform.classList.add("signuptologin");
// Signupform.classList.add("signuptologin");
MidContainer.classList.remove("addwidth");
Signupform.classList.remove("signuptotoken");

}
function finishupregform(){
    if(isfinishupformactive){
        finishUpRegistration.classList.remove("showfinishupform");
      
        isfinishupformactive=false;
    }else{
        finishUpRegistration.classList.add("showfinishupform");
        isfinishupformactive=true;
        tokenForm.classList.add("hidetokenform");
    }
}
function moveToToken(){
    Signupform.classList.add("signuptotoken");
}
const inputs = document.querySelectorAll('.token-input');      
                            inputs.forEach((input, index) => {
                                input.addEventListener('input', () => {
                                    if (input.value.length ===1 && index < inputs.length - 1) {
                                        inputs[index + 1].focus();
                                    }
                                });
                    
                                input.addEventListener('keydown', (event) => {
                                    if (event.key === 'Backspace' && input.value.length === 0 && index > 0) {
                                        inputs[index - 1].focus();
                                    }
                                });
                            });
                    
                            function validateToken() {
                                let token = '';
                                inputs.forEach(input => {
                                    token += input.value;
                                });
                    
                                if (token.length === 6 && /^\d{6}$/.test(token)) {
                                    // Token is valid
                                    return true;
                                } else {
                                    alert('Invalid token.');
                                    return false;
                                }
                            }

