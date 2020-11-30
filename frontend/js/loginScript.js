function tryLogIn(){
    console.log("trying to log in...\n");
    login();
}

function changeProfileButton(pfp, username){
    document.getElementById("profileNavButton").innerHTML = "<img src =\"" + pfp + "\" class = \"rounded-circle\" style = \"height:40px; width:40px\"> " + username;
}

function login(){
    // does nothing if the user is not logged in
    if (isLoggedIn()){
        // change the login button into the profile button with drop down menu
        var htmlString = "<div class=\"navbar-nav\">";
            htmlString+= "<div class=\"dropdown\">";
            htmlString+= "<button class=\"btn dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" style =\"background-color: #222222; color:white;\"id=\"profileNavButton\">";
            htmlString+= "user";
            htmlString+= "</button>";
            htmlString+= "<div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"profileNavButton\">";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\" id=\"settingsBtn\">Settings</button>";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\" id=\"groupBtn\">Group</button>";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\" id=\"bookmarkedBtn\">Bookmarked Listings</button>";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\" id=\"logoutButton\">Log Out</button>";
            htmlString+= "</div>";
            htmlString+= "</div>";
            htmlString+= "</div>";
        document.getElementById("rightNavButton").innerHTML = htmlString;
        document.getElementById("settingsBtn").addEventListener("click", redirectToSettings);
        document.getElementById("groupBtn").addEventListener("click", redirectToGroup);
        document.getElementById("bookmarkedBtn").addEventListener("click", redirectToBookmarked);
        document.getElementById("logoutButton").addEventListener("click", logout)
        changeProfileButton("sisman.png","SIS-Man");
    }
}

function isLoggedIn(){
    var name = "sessionID=";
    var decodedCookie = decodeURIComponent(document.cookie);
    if (decodedCookie.split(';').some((item) => item.trim().startsWith(name))) {
        console.log('The cookie "sessionID" exists!');
        return true;
    }
    return false;
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
function logout(){
    console.log("Logging out!!Logging out!!Logging out!!Logging out!!Logging out!!Logging out!!Logging out!!Logging out!!Logging out!!Logging out!!Logging out!!");

    document.cookie = "sessionID=-1; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=127.0.0.1; path=/";
    window.location.replace("homepage.html");
}