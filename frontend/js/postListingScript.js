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
  document.getElementById("phoneno").addEventListener("change", checkPhoneNumber);
  document.getElementById("lemail").addEventListener("change", checkEmail);
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
              console.log('success'); // temp
                // console.log(this.responseText);
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
  var pattern = /^[0-9\s]+$/;
  if (pattern.test(input)){
    return true;
  }
  return false;
}
function isValidName(input){
  var pattern = /^[a-zA-Z-\s]+$/;
  if (pattern.test(input)){
    return true;
  }
  return false;
}
function isAlphaNumeric(input){
  var pattern = /^[a-zA-Z0-9\s]+$/i;
  if (pattern.test(input)){
    return true;
  }
  return false;
}
function isValidPhoneNumber(phoneNoInput){
  // make sure phone number is in XXX-XXX-XXXX format
  var pattern = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(pattern.test(phoneNoInput)){
    return true;
  }
  return false;
}
function isValidEmail(emailInput){
  var pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$/;
  if (pattern.test(emailInput)){
      return true;
  }
  return false;
}
function isValidRent(priceInput){
    var pattern = /^[$]?[0-9]{1,3}(?:,?[0-9]{3})*(?:\.[0-9]{2})?$/;
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
function isValidZipcode(zipcodeInput){
  var pattern = /^\d{5}(?:[-\s]\d{4})?$/;
  if (pattern.test(zipcodeInput)){
    return true;
  }
  return false;
}
function isPrecisionOne(input){
  var pattern = /^[0-9]+(\.[5])?$/;
  if (pattern.test(input)){
    return true;
  }
  return false;
}

function checkLandlordName(){
  landlordName = document.getElementById("lldname").value;
  if (!isValidName(landlordName) || landlordName == ""){
    console.log("landlord name");
    return false;
  } else {
    return true;
  }
}
function checkPhoneNumber(){
  phoneNo = document.getElementById("phoneno").value;
  if (!isValidPhoneNumber(phoneNo) || phoneNo == ""){
    console.log("phone no");
      return false;
  } else {
      return true;
  }
}
function checkEmail(){
  email = document.getElementById("lemail").value;
  if (!isValidEmail(email)){
    console.log("email");
      return false;
  } else {
      return true;
  }
}
function checkRent(){
    rent = document.getElementById("rent").value;
    if (!isValidRent(rent) || rent == ""){
      console.log("rent");
        return false;
    } else {
        return true;
    }
}
function checkAddress(){
  address = document.getElementById("addr").value;
  if (!isValidAddress(address) || address == ""){
    console.log("address");
      return false;
  } else {
      return true;
  }
}
function checkCity(){
  city = document.getElementById("city").value;
  if (!isValidCityState(city) || city == ""){
    console.log("city");
      return false;
  } else {
      return true;
  }
}
function checkState(){
  state = document.getElementById("state").value;
  if (!isValidCityState(state) || state == ""){
    console.log("state");
      return false;
  } else {
      return true;
  }
}
function checkZipcode(){
  zipcode = document.getElementById("zipc").value;
  if (!isValidZipcode(zipcode) || zipcode == ""){
    console.log("zipcode");
      return false;
  } else {
      return true;
  }
}
function checkBedrooms(){
  bedrooms = document.getElementById("bed").value;
  if (!isNumeric(bedrooms) || bedrooms == ""){
    console.log("bedrooms");
      return false;
  } else {
      return true;
  }
}
function checkBathrooms(){
  bathrooms = document.getElementById("bath").value;
  if (!isPrecisionOne(bathrooms) || bathrooms == ""){
    console.log("bathrooms");
      return false;
  } else {
      return true;
  }
}
function checkSquareFeet(){
  squareFeet = document.getElementById("sfeet").value;
  if (!isNumeric(squareFeet) || squareFeet == ""){
    console.log("sq ft");
      return false;
  } else {
      return true;
  }
}
function checkLeaseType(){
  leaseType = document.getElementById("leaset").value;
  if (!isNumeric(leaseType) || leaseType == ""){
    console.log("lease type");
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