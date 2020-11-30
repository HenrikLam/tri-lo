var ffn;
var lln;
var attype;
var usernameInput;
var emailInput;
var passwordInput;
var cpasswordInput;
var checkAll;

function setSignupEventListeners(){
    document.getElementById("login2").addEventListener("click", redirectToLogin);
    document.getElementById("signup").addEventListener("click", signupAccount);
    document.getElementById("username").addEventListener("change",checkUsername);
    document.getElementById("password").addEventListener("change", checkPassword);
    document.getElementById("cpassword").addEventListener("change", checkcPassword);
    document.getElementById("email").addEventListener("change", checkEmail);
    document.getElementById("fname").addEventListener("change", setFFN);
    document.getElementById("lname").addEventListener("change", setLLN);
    document.getElementById("clienta").addEventListener("click", kekC);
    document.getElementById("llda").addEventListener("click", kekL);
    document.getElementById("agenta").addEventListener("click", kekA);
}

function redirectToLogin(){
    window.location.replace("login.html");
}

// to be implemented later
function signupAccount(e){
    //has everything stored in the above variables so far.
    e.preventDefault();
    checkEverything();
    if (!checkAll) {
        console.log("sumting wong");
    }
    else {
        var xhr = new XMLHttpRequest();
        var params = "firstName=" + ffn + "&lastName=" + lln +
                     "&username=" + usernameInput + "&email=" + emailInput + 
                     "&password=" + passwordInput + "&accountType="+ attype;
        // OPEN- type, url/file, async
        xhr.open('POST', 'test_signup.php', true);
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
            }
            else {
                console.log("error boi");
            }
        }
        xhr.send(params);
    }
}

function setFFN() {
    ffn = document.getElementById("fname").value;
}

function setLLN() {
    lln = document.getElementById("lname").value;
}

function kekC() {
    changeBooton("clienta");
    attype = "Client";
}

function kekL() {
    changeBooton("llda");
    attype = "Landlord";
}
function kekA() {
    changeBooton("agenta");
    attype = "Agent";
}

function changeBooton(value) {
    switch(String(value)) {
        case "clienta": document.getElementById("atype").innerHTML = "Client "; break;
        case "llda" : document.getElementById("atype").innerHTML = "Landlord "; break;
        case "agenta" : document.getElementById("atype").innerHTML = "Agent "; break;
    }
}


function isValidUsername(usernameInput){
    var pattern = /^[a-z0-9]+$/i;
    if (usernameInput.length < 4 || usernameInput.length > 12 || usernameInput != usernameInput.match(pattern)){
        return false;
    }
    return true;
}
function isValidEmail(emailInput){
    var pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$/;
    if (pattern.test(emailInput)){
        return true;
    }
    return false;
}
function isValidPassword(passwordInput){
    var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/;
    if (passwordInput.length >= 8 && passwordInput.length < 24 && pattern.test(passwordInput)){
        return true;
    }
    return false;
}

function checkUsername(){
    usernameInput = document.getElementById("username").value;
    if (isValidUsername(usernameInput)){
        document.getElementById("usernameReq").style.color = "gray";
        return true;
    } else {
        document.getElementById("usernameReq").style.color = "red";
        return false;
    }
}
function checkEmail(){
    emailInput = document.getElementById("email").value;
    if (!isValidEmail(emailInput)){
        document.getElementById("emailReq").style.color = "red";
        return false;
    } else {
        document.getElementById("emailReq").style.color = "gray";
        return true;
    }
}
function checkPassword(){
    passwordInput = document.getElementById("password").value;
    if (!isValidPassword(passwordInput)){
        document.getElementById("passwordReq").style.color = "red";
        return false;
    } else {
        document.getElementById("passwordReq").style.color = "gray";
        return true;
    }
}

function checkcPassword() {
    cpasswordInput = document.getElementById("cpassword").value;
    if (cpasswordInput != passwordInput){
        document.getElementById("cpasswordReq").style.color = "red";
        return false;
    } else {
        document.getElementById("cpasswordReq").style.color = "gray";
        return true;
    }
}

function checkEverything() {
    checkAll = true;
    if (!checkUsername()) {
        checkAll = false;
    }
    if (!checkEmail()) {
        checkAll = false;
    }
    if (!checkPassword()) {
        checkAll = false;
    }
    if (!checkcPassword()) {
        checkAll = false;
    }
    if (document.getElementById("fname").value == "") {
        console.log("man u dont even have a first name");
        checkAll = false;
    }
    if (document.getElementById("lname").value == ""){
        console.log("no last name either");
        checkAll = false;
    }
}