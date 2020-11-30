function setLoginEventListeners(){
    document.getElementById("signup").addEventListener("click", redirectToSignup);
    document.getElementById("accLogIn").addEventListener("click", accLogIn);
}

function redirectToSignup(){
    window.location.replace("signup.php");
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
}
