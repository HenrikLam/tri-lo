var sessionID;
var username;

function tryLogIn(){
    console.log("trying to log in...\n");
    login();
}

function changeProfileButton(pfp){
    document.getElementById("profileNavButton").innerHTML = "<img src =\"" + pfp + "\" class = \"rounded-circle\" style = \"height:40px; width:40px\"> " + username;
}

function setUsername(usr){
    console.log("setting username:" + usr);
    username = usr;
}

function getAccountType(func){
    var xhr = new XMLHttpRequest();
    //retrieve sessionId from cookie

    xhr.open('POST', 'php/users/getAccountType.php', true);
    xhr.onerror = function() {
        console.log('Request Error...');
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //xhr.onprogress can be used to show loading screen
    //can also use xhr.onerror for error
    xhr.onload= function() {
        //200 ok, 403 forbidden, 404 not found
        if (this.status=200) {
            return func(this.responseText);
        }
        else {
            return "Error";
        }
    }

    xhr.send("&sessionID=" + sessionID);
}

function getProfilePicture(func){
    var xhr = new XMLHttpRequest();
    //retrieve sessionId from cookie

    xhr.open('POST', 'php/images/getImages.php', true);
    xhr.onerror = function() {
        console.log('Request Error...');
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //xhr.onprogress can be used to show loading screen
    //can also use xhr.onerror for error
    xhr.onload= function() {
        //200 ok, 403 forbidden, 404 not found
        if (this.status=200) {
            return func(this.responseText);
        }
        else {
            return "Error";
        }
    }

    xhr.send("&type=user&id=" + username);
}

function checkAccountType(accType){
    if (accType == "Client"){
        document.getElementById("createListing").innerHTML = "";
    }
    return 1;
}

function getUsername(funct){

    var xhr = new XMLHttpRequest();
    //retrieve sessionId from cookie

    xhr.open('POST', 'php/users/getUsername.php', false);
    xhr.onerror = function() {
        console.log('Request Error...');
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //xhr.onprogress can be used to show loading screen
    //can also use xhr.onerror for error
    xhr.onload= function() {
        //200 ok, 403 forbidden, 404 not found
        if (this.status=200) {
            funct(this.responseText);
        }
        else {
            return "Error";
        }
    }
    console.log('SessionID:' + sessionID);
    xhr.send("&sessionID=" + sessionID);
}
function checkSessionID(string){
    return string.trim().startsWith("sessionID=");
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
            htmlString+= "<button class=\"dropdown-item\" type=\"button\" id=\"inviteBtn\">Invites</button>";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\" id=\"bookmarkedBtn\">Bookmarked Listings</button>";
            htmlString+= "<button class=\"dropdown-item\" type=\"button\" id=\"logoutButton\">Log Out</button>";
            htmlString+= "</div>";
            htmlString+= "</div>";
            htmlString+= "</div>";
        document.getElementById("rightNavButton").innerHTML = htmlString;
        document.getElementById("settingsBtn").addEventListener("click", redirectToSettings);
        document.getElementById("groupBtn").addEventListener("click", redirectToGroup);
        document.getElementById("inviteBtn").addEventListener("click", redirectToInvite);
        document.getElementById("bookmarkedBtn").addEventListener("click", redirectToBookmarked);
        document.getElementById("logoutButton").addEventListener("click", logout);
        getUsername(setUsername);
        getProfilePicture(changeProfileButton);
        getAccountType(checkAccountType);
    } else {
        document.getElementById("createListing").innerHTML = "";
    }
}

function isLoggedIn(){
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookieSplit = decodedCookie.split(';');
    if (cookieSplit[0] && (sessionID = cookieSplit.find(checkSessionID).substr("sessionID=".length))) {
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
function redirectToInvite(){
    window.location.replace("invites.html");
}
function redirectToBookmarked(){
    window.location.replace("bookmarkedListings.html");
}
function logout(){
    
    var xhr = new XMLHttpRequest();
    //retrieve sessionId from cookie

    xhr.open('POST', 'php/users/logOut.php', true);
    xhr.onerror = function() {
        console.log('Request Error...');
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //xhr.onprogress can be used to show loading screen
    //can also use xhr.onerror for error
    xhr.onload= function() {
        //200 ok, 403 forbidden, 404 not found
        if (this.status=200) {
            var response = this.responseText;

            if (response == "logged out"){
                document.cookie = "sessionID=-1; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=127.0.0.1; path=/";
                window.location.replace("homepage.html");
            } else {
                console.log(response);
            }
        }
        else {
            console.log("Error:" + this.status);
        }
    }
    xhr.send("&sessionID=" + sessionID);
}