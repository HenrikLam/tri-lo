// Test Account:
// Username: "SIS-man"
// Profile Picture: "sisman.png"


function setUsernameField(usr){
    console.log("setting username field");
    document.getElementById("usernameField").innerHTML = usr;
}

function getProfilePicture(){
    return "sisman.png";
}
function setNameField(name){
    console.log("name:" + name);
    document.getElementById("nameField").innerHTML = name;
}

function setFields(info){
    var infoSplit = info.split(";");
    var name = infoSplit[0];
    var username = infoSplit[1];
    var email = infoSplit[2];

    setNameField(name);
    setUsernameField(username);
    setEmailField(email);
}

function setEmailField(email){
    document.getElementById("emailField").innerHTML = email;
}
function getInfo(funct){
    var xhr = new XMLHttpRequest();
    //retrieve sessionId from cookie

    xhr.open('POST', 'echoUserInfo.php', true);
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

    xhr.send("&sessionID=" + sessionID);
}

function changePassword(){

}

function doOnLoad(){
    getInfo(setFields);
}