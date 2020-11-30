var loggedIn = true;
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
            htmlString+= "<button class=\"dropdown-item\" type=\"button\" id=\"settingsBtn\">Settings</button>";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\" id=\"groupBtn\">Group</button>";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\" id=\"bookmarkedBtn\">Bookmarked Listings</button>";
            htmlString+= "</div>";
            htmlString+= "</div>";
            htmlString+= "</div>";
        document.getElementById("rightNavButton").innerHTML = htmlString;
        document.getElementById("settingsBtn").addEventListener("click", redirectToSettings);
        document.getElementById("groupBtn").addEventListener("click", redirectToGroup);
        document.getElementById("bookmarkedBtn").addEventListener("click", redirectToBookmarked);
        changeProfileButton();
    }
}
function redirectToSettings(){
    window.location.replace("profilePage.html");
}
function redirectToGroup(){
    window.location.replace("group.html");
}
function redirectToBookmarked(){
    window.location.replace("bookmarkedListings.html");
}