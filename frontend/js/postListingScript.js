var listingName;
var address;
var city;
var state;
var zipcode;
var landlordName;
var phoneNo;
var email;
var description;
var rent;
var squareFeet;
var bedrooms;
var bathrooms;
var leaseType;
var datePosted;
var status;

function setCreateListingEventListeners(){
  // add event listeners
}

function saveListing(e){
    e.preventDefault();
    checkEverything();
    if (!checkAll) {
        console.log("missing or incorrect information in fields");
    }
    else {
        var xhr = new XMLHttpRequest();
        var params = "listingName=" + listingName + "&address=" + address + "&city=" + city + 
                     "&state=" + state + "&zipcode=" + zipcode + "&landlordName=" + landlordName + 
                     "&phoneNo=" + phoneNo + "&email=" + email + "&rent=" + rent + "&squareFeet=" + squareFeet + 
                     "&bathrooms=" + bathrooms + "&bedrooms=" + bedrooms + "&leaseType=" + leaseType
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
function setLandlordName() {
  landlordName = document.getElementById("lldname").value;
}

function isNumeric(input) {
  var pattern = /^[0-9\s]+$/i;
  if (input != pattern.match(input)){
    return false;
  }
  return true;
}
function isAlpha(input){
  var pattern = /^[a-zA-Z\s]+$/i;
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
function isValidPhoneNumber(phoneNoInput){
  // make sure phone number is in XXX-XXX-XXXX format
  var pattern = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(phoneNoInput != pattern.match(phoneNoInput)){
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
function isValidRent(priceInput){
    var pattern = /^$[0-9]+(\.[0-9][0-9]?)?+$/;
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

function checkListingName(){
    listingNameInput = document.getElementById("lname").value;
    if (!isAlphaNumeric(listingNameInput) || listingNameInput == ""){
        return false;
    } else {
        return true;
    }
}
function checkLandlordName(){
  landlordNameInput = document.getElementById("lldname").value;
  if (!isAlpha(landlordNameInput) || landlordNameInput == ""){
      return false;
  } else {
      return true;
  }
}
function checkPhoneNumber(){
  phoneNoInput = document.getElementById("hotline").value;
  if (!isValidPhoneNumber(phoneNoInput) || phoneNoInput == ""){
      return false;
  } else {
      return true;
  }
}
function checkEmail(){
  emailInput = document.getElementById("lemail").value;
  if (!isValidEmail(emailInput)){
      return false;
  } else {
      return true;
  }
}
function checkRent(){
    rentInput = document.getElementById("rent").value;
    if (!isValidRent(rentInput) || rentInput == ""){
        return false;
    } else {
        return true;
    }
}
function checkAddress(){
  addressInput = document.getElementById("addr").value;
  if (!isValidAddress(addressInput) || addressInput == ""){
      return false;
  } else {
      return true;
  }
}
function checkCityState(type){
  cityStateInput = document.getElementById(type).value;
  if (!isValidAddress(cityStateInput) || cityStateInput == ""){
      return false;
  } else {
      return true;
  }
}
function checkZipcode(){
  zipcodeInput = document.getElementById("zip").value;
  if (!isNumeric(zipcodeInput) || zipcodeInput == ""){
      return false;
  } else {
      return true;
  }
}
function checkLongLat(type){
  longLatInput = document.getElementById(type).value;
  if (!isValidLongLat(longLatInput) || longLatInput == ""){
      return false;
  } else {
      return true;
  }
}
function checkBedrooms(){
  bedroomsInput = document.getElementById("bed").value;
  if (!isNumeric(bedroomsInput) || bedroomsInput == ""){
      return false;
  } else {
      return true;
  }
}
function checkBathrooms(){
  bedroomsInput = document.getElementById("bath").value;
  if (!isPrecisionOne(bedroomsInput) || bedroomsInput == ""){
      return false;
  } else {
      return true;
  }
}
function checkSquareFeet(){
  squareFeetInput = document.getElementById("sfeet").value;
  if (!isNumeric(squareFeetInput) || squareFeetInput == ""){
      return false;
  } else {
      return true;
  }
}
function checkLeaseType(){
  squareFeetInput = document.getElementById("leaset").value;
  if (!isNumeric(squareFeetInput) || squareFeetInput == ""){
      return false;
  } else {
      return true;
  }
}

function checkEverything() {
  checkAll = true;
  if (lname == "") {
    console.log("Listing name cannot be empty");
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
  if (lldname == "") {
    console.log("Landlord name cannot be empty");
    checkAll = false;
  }
  if (!checkPhoneNumber()) {
    checkAll = false;
  }
  if (!checkEmail()) {
    checkAll = false;
  }
  if (!checkRent()) {
    checkAll = false;
  }
  if (!checkSquareFeet()) {
    checkAll = false;
  }
  if (!checkBedrooms()) {
    checkAll = false;
  }
  if (!checkBathrooms()) {
    checkAll = false;
  }
  if (!isNumeric(leaseType)) {
    checkAll = false;
  }
}