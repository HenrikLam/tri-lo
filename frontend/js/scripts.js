function setEventListeners(){
    //alert("Debug Message");
    document.getElementById("home").addEventListener("click", redirectToHome);
    document.getElementById("login").addEventListener("click", redirectToLogin);
}
function redirectToHome(){
    window.location.replace("homepage.html");
}
function redirectToLogin(){
    window.location.replace("login.html");
}