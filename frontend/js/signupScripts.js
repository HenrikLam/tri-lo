function setSignupEventListeners(){
    document.getElementById("login2").addEventListener("click", redirectToLogin);
    document.getElementById("signup").addEventListener("click", signupAccount);
    document.getElementById("username").addEventListener("change",checkUsername);
    document.getElementById("password").addEventListener("change", checkPassword);
    document.getElementById("cpassword").addEventListener("change", checkPassword);
    document.getElementById("email").addEventListener("change", checkEmail);
}

function redirectToLogin(){
    window.location.replace("login.html");
}

// to be implemented later
function signupAccount(){

}

function isValidUsername(usernameInput){
    var pattern = /^[a-z0-9]+$/i;
    if (usernameInput.length < 4 || usernameInput.length > 12 || usernameInput != usernameInput.match(pattern)){
        return true;
    }
    return false;
}
function isValidEmail(emailInput){
    var pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$/;
    if (pattern.test(emailInput)){
        return true;
    }
    return false;
}
function isValidPassword(passwordInput){
    var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/;
    if (passwordInput.length > 8 && passwordInput.length < 24 && pattern.test(passwordInput)){
        return true;
    }
    return false;
}

function checkUsername(){
    var usernameInput = document.getElementById("username").value;
    if (isValidUsername(usernameInput)){
        document.getElementById("usernameReq").style.color = "red";
    } else {
        document.getElementById("usernameReq").style.color = "gray";
    }
}
function checkEmail(){
    var emailInput = document.getElementById("email").value;
    if (!isValidEmail(emailInput)){
        document.getElementById("emailReq").style.color = "red";
    } else {
        document.getElementById("emailReq").style.color = "gray";
    }
}
function checkPassword(){
    var passwordInput = document.getElementById("password").value;
    if (!isValidPassword(passwordInput)){
        document.getElementById("passwordReq").style.color = "red";
    } else {
        document.getElementById("passwordReq").style.color = "gray";
    }
    var cpasswordInput = document.getElementById("cpassword").value;
    if (cpasswordInput != passwordInput){
        document.getElementById("cpasswordReq").style.color = "red";
    } else {
        document.getElementById("cpasswordReq").style.color = "gray";
    }
}