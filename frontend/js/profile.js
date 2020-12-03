// Test Account:
// Username: "SIS-man"
// Profile Picture: "sisman.png"
var username;

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
    username = infoSplit[1];
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

    xhr.open('POST', 'php/users/echoUserInfo.php', true);
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

function isValidPassword(passwordInput){
    var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/;
    if (passwordInput.length >= 8 && passwordInput.length < 24 && pattern.test(passwordInput)){
        return true;
    }
    return false;
}

function changePassword(){
    console.log("Trying to change password...");
    var currentPassword = document.getElementById("oldPassword").value;
    var newPassword = document.getElementById("newPassword").value;
    var repeatNewPassword = document.getElementById("repeatNewPassword").value;

    if (currentPassword == ""){
        document.getElementById("oldPasswordAlert").innerHTML = "Cannot be empty!";
    }
    if (isValidPassword(newPassword)){
        if (newPassword == repeatNewPassword){
            var xhr = new XMLHttpRequest();
            //retrieve sessionId from cookie

            xhr.open('POST', 'php/users/changePassword.php', true);
            xhr.onerror = function() {
                console.log('Request Error...');
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            //xhr.onprogress can be used to show loading screen
            //can also use xhr.onerror for error
            xhr.onload= function() {
                //200 ok, 403 forbidden, 404 not found
                if (this.status=200) {
                    console.log(this.responseText);
                    if (this.responseText == "Password Changed"){
                        $('#pwChangeModal').modal('hide');
                        $('#alert').toast({
                            delay: 5000,
                        });
                        $('#alert').toast('show');
                    } else {
                        document.getElementById("oldPasswordAlert").innerHTML = "Incorrect Password";
                    }
                }
                else {
                    return "Error";
                }
            }
            var param = "&username=" + username + "&password=" + currentPassword + "&newPassword=" + newPassword;
            xhr.send(param);
        } else {
            document.getElementById("repeatPwChangeAlert").style.color ="red";
        }
    } else {
        document.getElementById("pwChangeAlert").style.color ="red";
    }
    

}

function doOnLoad(){
    getInfo(setFields);
    document.getElementById("changePwBtn").addEventListener("click", changePassword);
}