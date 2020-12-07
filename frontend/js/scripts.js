function setEventListeners(){
    //alert("Debug Message");
    document.getElementById("home").addEventListener("click", redirectToHome);
    document.getElementById("login").addEventListener("click", redirectToLogin);
    document.getElementById("createListing").addEventListener("click",redirectToCreate);
}
function redirectToHome(){
    window.location.replace("homepage.html");
}
function redirectToLogin(){
    window.location.replace("login.html");
}
function redirectToCreate(){
    console.log("hi");
    window.location.replace("listing_create.html");
}