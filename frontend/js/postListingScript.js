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

function setCreateListingEventListeners(){
  document.getElementById("clbutt").addEventListener("click", saveListing);
  document.getElementById("lname").addEventListener("change",setListingName);
  document.getElementById("addr").addEventListener("change", checkAddress);
  document.getElementById("city").addEventListener("change", checkCity);
  document.getElementById("state").addEventListener("change", checkState);
  document.getElementById("zipc").addEventListener("change", checkZipcode);
  document.getElementById("lldname").addEventListener("change", checkLandlordName);
  document.getElementById("hotline").addEventListener("change", checkPhoneNumber);
  document.getElementById("email").addEventListener("change", checkEmail);
  document.getElementById("descr").addEventListener("change", setDescription);
  document.getElementById("rent").addEventListener("change", checkRent);
  document.getElementById("sfeet").addEventListener("change", checkSquareFeet);
  document.getElementById("bed").addEventListener("change", checkBedrooms);
  document.getElementById("bath").addEventListener("change", checkBathrooms);
  document.getElementById("leaset").addEventListener("change", checkLeaseType);
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
                     "&bathrooms=" + bathrooms + "&bedrooms=" + bedrooms + "&leaseType=" + leaseType;
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

function setListingName() {
  listingName = document.getElementById("lname").value;
}
function setDescription() {
  description = document.getElementById("descr").value;
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

function checkLandlordName(){
  landlordName = document.getElementById("lldname").value;
  if (!isAlpha(landlordName) || landlordName == ""){
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
function checkCity(){
  city = document.getElementById("city").value;
  if (!isValidCityState(city) || city == ""){
      return false;
  } else {
      return true;
  }
}
function checkState(){
  state = document.getElementById("state").value;
  if (!isValidCityState(state) || state == ""){
      return false;
  } else {
      return true;
  }
}
function checkZipcode(){
  zipcode = document.getElementById("zipc").value;
  if (!isNumeric(zipcode) || zipcode == ""){
      return false;
  } else {
      return true;
  }
}
function checkBedrooms(){
  bedrooms = document.getElementById("bed").value;
  if (!isNumeric(bedrooms) || bedrooms == ""){
      return false;
  } else {
      return true;
  }
}
function checkBathrooms(){
  bathrooms = document.getElementById("bath").value;
  if (!isPrecisionOne(bathrooms) || bathrooms == ""){
      return false;
  } else {
      return true;
  }
}
function checkSquareFeet(){
  squareFeet = document.getElementById("sfeet").value;
  if (!isNumeric(squareFeet) || squareFeet == ""){
      return false;
  } else {
      return true;
  }
}
function checkLeaseType(){
  leaseType = document.getElementById("leaset").value;
  if (!isNumeric(leaseType) || leaseType == ""){
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
  if (!checkCity()) {
    checkAll = false;
  }
  if (!checkState()) {
    checkAll = false;
  }
  if (!checkZipcode()) {
    checkAll = false;
  }
  if (!checkLandlordName()) {
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
  if (!checkLeaseType()) {
    checkAll = false;
  }
}