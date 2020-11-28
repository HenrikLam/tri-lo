// Test Account:
// Username: "SIS-man"
// Profile Picture: "sisman.png"

function getUsername(){
    return "SIS-Man";
}

function getProfilePicture(){
    return "sisman.png";
}

function getEmail(){
    return "sisman@rpi.edu";
}
function changeProfileButton(){
    document.getElementById("profileNavButton").innerHTML = "<img src =\"" + getProfilePicture() + "\" class = \"rounded-circle\" style = \"height:40px; width:40px\"> " + getUsername();
}

function doOnLoad(){
    changeProfileButton();
    document.getElementById("usernameField").innerHTML = getUsername();
    document.getElementById("emailField").innerHTML = getEmail();

}