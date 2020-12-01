var listingName;
var ownerUsername;
var price;
var address;
var city;
var state;
var zipcode;
var longitude;
var latitude;
var isRenting;
var paymentFrequency;
var bedrooms;
var bathrooms;
var squareFeet;
var datePosted;
var status;

function setSignupEventListeners(){
    
}


function saveListing(e){
    e.preventDefault();
    checkEverything();
    if (!checkAll) {
        console.log("missing or incorrect information in fields");
    }
    else {
        var xhr = new XMLHttpRequest();
        var params = "listingName=" + listingName + "&ownerUsername=" + ownerUsername + 
                     "&price=" + price + "&address=" + address + "&city=" + city + 
                     "&state=" + state + "&zipcode=" + zipcode + "&longitude=" + longitude +
                     "&latitude=" + latitude + "&isRenting=" + isRenting + 
                     "&paymentFrequency=" + paymentFrequency + "&bedrooms=" + bedrooms +
                     "&bathrooms=" + bathrooms + "&squareFeet=" + squareFeet + 
                     "&datePosted=" + datePosted + "&status=" + status;
        // OPEN- type, url/file, async
        xhr.open('POST', 'post_listing.php', true);
        xhr.onerror = function() {
            console.log('Request Error...');
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        //xhr.onprogress can be used to show loading screen
        //can also use xhr.onerror for error
        xhr.onload= function() {
        // 200 ok, 403 forbidden, 404 not found
            if (this.status=200) {
                console.log(this.responseText);
            }
            else {
                console.log("error");
            }
        }
        xhr.send(params);
    }
}

// TO DO: set variables
function setListingName() {
    listingName = document.getElementById("listingName").value;
}
function setOwnerUsername() {
    // get owner username from POST?
}

function isNumeric(input) {
  var pattern = /^[0-9\s]+$/i;
  if (input != pattern.match(input)){
    return false;
  }
  return true;
}
function isAlphaNumeric(input){
  var pattern = /^[a-zA-Z0-9\s]+$/i;
  if (input != pattern.match(input)){
    return false;
  }
  return true;
}
function isValidPrice(priceInput){
    var pattern = /^[0-9$.]+$/;
    if (pattern.test(priceInput)){
        return true;
    }
    return false;
}
function isValidAddress(addressInput){
    var pattern = /^[a-zA-Z0-9.#',-/\s]+$/;
    if (pattern.test(addressInput)){
        return true;
    }
    return false;
}
function isValidCityState(cityStateInput){
    var pattern = /^[a-zA-Z-\s]+$/;
    if (pattern.test(cityStateInput)){
        return true;
    }
    return false;
}
function isValidLongLat(longLatInput){
  var pattern = /^[a-zA-Z0-9.\s]+$/;
  if (pattern.test(longLatInput)){
      return true;
  }
  return false;
}
function isPrecisionOne(input){
  var pattern = /^[0-9]+(\.[0-9]?)?+$/;
  if (pattern.test(input)){
      return true;
  }
  return false;
}
function isPrecisionTwo(input){
  var pattern = /^[0-9]+(\.[0-9][0-9]?)?+$/;
  if (pattern.test(input)){
      return true;
  }
  return false;
}

function checkListingName(){
    listingNameInput = document.getElementById("listingName").value;
    if (!isAlphaNumeric(listingNameInput) || listingNameInput == ""){
        document.getElementById("listingNameReq").style.color = "red";
        return false;
    } else {
        document.getElementById("listingNameReq").style.color = "gray";
        return true;
    }
}
function checkPrice(){
    priceInput = document.getElementById("price").value;
    if (!isValidPrice(priceInput) || priceInput == ""){
        document.getElementById("priceReq").style.color = "red";
        return false;
    } else {
        document.getElementById("priceReq").style.color = "gray";
        return true;
    }
}
function checkAddress(){
  addressInput = document.getElementById("address").value;
  if (!isValidAddress(addressInput) || addressInput == ""){
      document.getElementById("addressReq").style.color = "red";
      return false;
  } else {
      document.getElementById("addressReq").style.color = "gray";
      return true;
  }
}
function checkCityState(type){
  cityStateInput = document.getElementById(type).value;
  if (!isValidAddress(cityStateInput) || cityStateInput == ""){
      document.getElementById(type).style.color = "red";
      return false;
  } else {
      document.getElementById(type).style.color = "gray";
      return true;
  }
}
function checkZipCode(){
  zipCodeInput = document.getElementById("zipCode").value;
  if (!isNumeric(zipCodeInput) || zipCodeInput == ""){
      document.getElementById("zipCode").style.color = "red";
      return false;
  } else {
      document.getElementById("zipCode").style.color = "gray";
      return true;
  }
}
function checkLongLat(type){
  longLatInput = document.getElementById(type).value;
  if (!isValidLongLat(longLatInput) || longLatInput == ""){
      document.getElementById(type).style.color = "red";
      return false;
  } else {
      document.getElementById(type).style.color = "gray";
      return true;
  }
}
function checkPaymentFrequency(type){
  paymentFrequencyInput = document.getElementById("paymentFrequency").value;
  if (!isAlphaNumeric(paymentFrequencyInput) || paymentFrequencyInput == ""){
      document.getElementById("paymentFrequency").style.color = "red";
      return false;
  } else {
      document.getElementById("paymentFrequency").style.color = "gray";
      return true;
  }
}
function checkBedrooms(){
  bedroomsInput = document.getElementById("bedrooms").value;
  if (!isNumeric(bedroomsInput) || bedroomsInput == ""){
      document.getElementById("bedrooms").style.color = "red";
      return false;
  } else {
      document.getElementById("bedrooms").style.color = "gray";
      return true;
  }
}
function checkBathrooms(){
  bedroomsInput = document.getElementById("bathrooms").value;
  if (!isPrecisionOne(bedroomsInput) || bedroomsInput == ""){
      document.getElementById("bathrooms").style.color = "red";
      return false;
  } else {
      document.getElementById("bathrooms").style.color = "gray";
      return true;
  }
}
function checkSquareFeet(){
  squareFeetInput = document.getElementById("squareFeet").value;
  if (!isPrecisionTwo(squareFeetInput) || squareFeetInput == ""){
      document.getElementById("squareFeet").style.color = "red";
      return false;
  } else {
      document.getElementById("squareFeet").style.color = "gray";
      return true;
  }
}

function checkEverything() {
  checkAll = true;
  if (!checkListingName()) {
      checkAll = false;
  }
  if (!checkPrice()) {
      checkAll = false;
  }
  if (!checkAddress()) {
      checkAll = false;
  }
  if (!checkCityState("city")) {
      checkAll = false;
  }
  if (!checkCityState("state")) {
    checkAll = false;
  }
  if (!checkZipCode()) {
    checkAll = false;
  }
  if (!checkLongLat("longitude")) {
    checkAll = false;
  }
  if (!checkLongLat("latitude")) {
    checkAll = false;
  }
  if (!checkPaymentFrequency()) {
    checkAll = false;
  }
  if (!checkBedrooms()) {
    checkAll = false;
  }
  if (!checkBathrooms()) {
    checkAll = false;
  }
  if (!checkSquareFeet()) {
    checkAll = false;
  }
}