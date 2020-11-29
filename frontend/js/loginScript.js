var loggedIn = false;
function tryLogIn(){
    login();
}

function getUsername(){
    return "SIS-Man";
}

function getProfilePicture(){
    return "sisman.png";
}

function changeProfileButton(){
    document.getElementById("profileNavButton").innerHTML = "<img src =\"" + getProfilePicture() + "\" class = \"rounded-circle\" style = \"height:40px; width:40px\"> " + getUsername();
}

function login(){
    // does nothing if the user is not logged in
    if (loggedIn){
        // change the login button into the profile button with drop down menu
        var htmlString = "<div class=\"navbar-nav\">";
            htmlString+= "<div class=\"dropdown\">";
            htmlString+= "<button class=\"btn dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" style =\"background-color: #222222; color:white;\"id=\"profileNavButton\">";
            htmlString+= "You're a donkey";
            htmlString+= "</button>";
            htmlString+= "<div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"profileNavButton\">";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\">Settings</button>";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\">Group</button>";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\">Bookmarked Listings</button>";
            htmlString+= "</div>";
            htmlString+= "</div>";
            htmlString+= "</div>";
        document.getElementById("rightNavButton").innerHTML = htmlString;

        changeProfileButton();
    }
}