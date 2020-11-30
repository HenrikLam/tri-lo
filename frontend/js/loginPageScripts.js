function setLoginEventListeners(){
    document.getElementById("signup").addEventListener("click", redirectToSignup);
    document.getElementById("accLogIn").addEventListener("click", accLogIn);
}

function redirectToSignup(){
    window.location.replace("signup.html");
}

function accLogIn(){
    document.getElementById("alertBox").innerHTML = "";
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    if (username == ""){
        document.getElementById("alertBox").innerHTML += "Username field cannot be empty!";
    }
    if (password == ""){
        document.getElementById("alertBox").innerHTML += "<br>Password field cannot be empty!";
    }
    //send AJAX message to php code to log in

    var xhr = new XMLHttpRequest();
    var params = "&username=" + username + "&password=" + password;
    xhr.open('POST', 'login.php', true);
    xhr.onerror = function() {
        console.log('Request Error...');
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //xhr.onprogress can be used to show loading screen
    //can also use xhr.onerror for error
    xhr.onload= function() {
        //200 ok, 403 forbidden, 404 not found
        if (this.status=200) {
            var d = new Date();
            d.setTime(d.getTime() + (60*60*1000));
            var expires = "expires="+ d.toUTCString();
            var response = this.responseText;
            if (!isNaN(response)){
                document.cookie = "sessionID="+this.responseText+"; "+ expires+"; domain=127.0.0.1; path=/";
                window.location.replace("homepage.html");
            } else {
                console.log(response);
            }
        }
        else {
            console.log("Error:" + this.status);
        }
    }
    xhr.send(params);
}
