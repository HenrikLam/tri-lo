// Test Account:
// Username: "SIS-man"
// Profile Picture: "sisman.png"

function getUsername(){
    return "SIS-Man";
}

function getProfilePicture(){
    return "sisman.png";
}
function getName(){
    return "Man, SIS";
}

function getEmail(){
    return "sisman@rpi.edu";
}

function doOnLoad(){
    document.getElementById("nameField").innerHTML = getName();
    document.getElementById("usernameField").innerHTML = getUsername();
    document.getElementById("emailField").innerHTML = getEmail();

}