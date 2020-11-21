function setSignupEventListeners(){
    document.getElementById("login2").addEventListener("click", redirectToLogin);
    document.getElementById("signup").addEventListener("click", signupAccount);
    document.getElementById("username").addEventListener("input",checkUsername);
}

function redirectToLogin(){
    window.location.replace("login.html");
}

// to be implemented later
function signupAccount(){

}

function checkUsername(){

}