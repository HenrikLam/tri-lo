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
function changeProfileButton(){
    document.getElementById("profileNavButton").innerHTML = "<img src =\"" + getProfilePicture() + "\" class = \"rounded-circle\" style = \"height:40px; width:40px\"> " + getUsername();
}

function changeNameField(){
    document.getElementById("nameField").innerHTML = getName();
}
function doOnLoad(){
    changeProfileButton();
    changeNameField();
    document.getElementById("usernameField").innerHTML = getUsername();
    document.getElementById("emailField").innerHTML = getEmail();

}