var listingName = "My Listing";
var address;
var city;
var state;
var zipcode;
var landlordName;
var phoneNo;
var email;
var description = "";
var rent;
var squareFeet;
var bedrooms;
var bathrooms;
var leaseType;

var houseNoods;
var numNoods;

var checkAll = true;

var amenityTs = [];
var amenityDs = [];
var newAmen = 3;
for (var i = 0; i < newAmen; i++) {
  amenityTs.push("");
}
for (var i = 0; i < newAmen; i++) {
  amenityDs.push("");
}
var amenities;

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
  document.getElementById("aamen").addEventListener("click", addButton);
  document.getElementById("addBootonBox").addEventListener("change", setAmenity);
}

function saveListing(e){
    e.preventDefault();
    checkEverything();

    houseNoods = new FormData();

    numNoods = document.getElementById("housenoods").files.length;
    for (var index = 0; index < numNoods; index++) {
      houseNoods.append("files[]", document.getElementById("housenoods").files[index]);
    }
    if (!checkAll) {
        console.log("missing or incorrect information in fields");
    }
    else {
        var xhr = new XMLHttpRequest();
        houseNoods.append("listingName", listingName);
        houseNoods.append("address", address);
        houseNoods.append("city", city);
        houseNoods.append("state", state);
        houseNoods.append("zipcode", zipcode);
        houseNoods.append("landlordName", landlordName);
        houseNoods.append("phoneNo", phoneNo);
        houseNoods.append("email", email);
        houseNoods.append("description", description);
        houseNoods.append("rent", rent);
        houseNoods.append("squareFeet", squareFeet);
        houseNoods.append("bathrooms", bathrooms);
        houseNoods.append("bedrooms", bedrooms);
        houseNoods.append("leaseType", leaseType);
        houseNoods.append("status", "ACTIVE");
        houseNoods.append("amenities", JSON.stringify(amenities));
        // OPEN- type, url/file, async
        xhr.open('POST', 'php/listings/postListing.php', true);
        xhr.onerror = function() {
            console.log('Request Error...');
        }

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
        xhr.send(houseNoods);
    }
}

// .createElement can create a html object
// .classList.add adds to class at the end, overlaying any previous classes
// .style.property = changes the styles property
// .createTextNode() allows you to add text
// .appendChild() is insertion of text/class/object
function addButton() {
  //need to set ids by doing .id on the input elements.
  // ie; srinput1.id = "id";
  if (newAmen == 100) {
    document.getElementById("buttonWarning").innerHTML = "Cannot add more than 100 listings on this page."
    document.getElementById("buttonWarning").style.color = "red";
    document.getElementById("buttonWarning").style.marginBottom = "15px";
    return;
  }

  const first_row = document.createElement("div");
  first_row.classList.add("row");
  first_row.style.marginLeft = "0px";
  const frlabel1 = document.createElement("label");
  frlabel1.style.width = "15%";
  const label1text = document.createTextNode("Type:");
  frlabel1.appendChild(label1text);

  const frlabel2 = document.createElement("label");
  frlabel2.style.width = "15%";
  frlabel2.style.marginLeft = "15px";
  const label2text = document.createTextNode("Description:");
  frlabel2.appendChild(label2text);

  first_row.appendChild(frlabel1);
  first_row.appendChild(frlabel2);

  document.getElementById("addBootonBox").appendChild(first_row);

  const second_row = document.createElement("div");
  second_row.classList.add("row");
  second_row.style.marginLeft = "0px";

  const srinput1 = document.createElement("input");
  srinput1.type = "text";
  srinput1.classList.add("form-control");
  srinput1.classList.add("mb-2");
  srinput1.style.width = "15%";
  srinput1.style.float = "left";
  srinput1.id = "amen" + newAmen + "t";

  const srinput2 = document.createElement("input");
  srinput2.type = "text";
  srinput2.classList.add("form-control");
  srinput2.classList.add("mb-2");
  srinput2.style.width = "30%";
  srinput2.style.float = "left";
  srinput2.style.marginLeft = "15px";
  srinput2.id = "amen" + newAmen + "d";
  newAmen++;

  second_row.appendChild(srinput1);
  second_row.appendChild(srinput2);


  amenityTs.push("");
  amenityDs.push("");

  document.getElementById("addBootonBox").appendChild(second_row);

}

function setAmenity(e) {
  if (e.target && e.target.nodeName == "INPUT") {
    if (e.target.id.match(/amen[0-9]{2}t/)) {
      var meme = e.target.id.replace("amen", "").replace("t", "");
      amenityTs[parseInt(meme)] = e.target.value;
    }
    if (e.target.id.match(/amen[0-9]{2}d/)) {
      var meme = e.target.id.replace("amen", "").replace("d", "");
      amenityDs[parseInt(meme)] = e.target.value;
    }
  }
}

function checkAmen() {
  amenities = {};
  for (var i = 0; i < newAmen; i++) {
    if (amenityDs[i] == "" && !(amenityTs[i] == "")) {
      document.getElementById("amen" + i + "d").placeholder = "(required)";
      document.getElementById("amen" + i + "d").style.borderColor = "red";
      return false;
    }
    else if (amenityTs[i] == "" && !(amenityDs[i] == "")) {
      document.getElementById("amen" + i + "t").placeholder = "(required)";
      document.getElementById("amen" + i + "t").style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById("amen" + i + "t").placeholder = "";
      document.getElementById("amen" + i + "t").style.borderColor = "";
      document.getElementById("amen" + i + "d").placeholder = "";
      document.getElementById("amen" + i + "d").style.borderColor = "";
    }
  }
  for (var i = 0; i < newAmen; i++) {
    if (!(amenityTs[i] == "")) {
      amenities[amenityTs[i]] = amenityDs[i];
    }
  }
  return true;
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
  var pattern = /^\d{5}$/;
  if (pattern.test(zipcodeInput)){
    return true;
  }
  return false;
}
function isValidBathroom(input){
  var pattern = /^[0-9]+(\.[5])?$/;
  if (pattern.test(input)){
    return true;
  }
  return false;
}

function checkLandlordName(){
  landlordName = document.getElementById("lldname").value;
  if (!isValidName(landlordName) || landlordName == ""){
    document.getElementById("checklldname").innerHTML="Please enter a name.";
    return false;
  } else {
    document.getElementById("checklldname").innerHTML="";
    return true;
  }
}
function checkPhoneNumber(){
  phoneNoInput = document.getElementById("phoneno").value;
  if (!isValidPhoneNumber(phoneNoInput) || phoneNoInput == ""){
    document.getElementById("checkphoneno").innerHTML="Please enter a valid phone number.";
    return false;
  } else {
    document.getElementById("checkphoneno").innerHTML="";
    return true;
  }
}
function checkEmail(){
  emailInput = document.getElementById("lemail").value;
  if (!isValidEmail(emailInput)){
    document.getElementById("checklemail").innerHTML="Please enter a valid email.";
    return false;
  } else {
    document.getElementById("checklemail").innerHTML="";
    return true;
  }
}
function checkRent(){
  rentInput = document.getElementById("rent").value;
  if (!isValidRent(rentInput) || rentInput == ""){
      document.getElementById("checkrent").innerHTML="Please enter a number.";
      return false;
  } else {
      document.getElementById("checkrent").innerHTML="";
      return true;
  }
}
function checkAddress(){
  address = document.getElementById("addr").value;
  if (!isValidAddress(address) || address == ""){
    document.getElementById("checkaddr").innerHTML="Please enter a valid address.";
    return false;
  } else {
    document.getElementById("checkaddr").innerHTML="";
    return true;
  }
}
function checkCity(){
  city = document.getElementById("city").value;
  if (!isValidCityState(city) || city == ""){
    document.getElementById("checkcity").innerHTML="Please enter a valid city.";
    return false;
  } else {
    document.getElementById("checkcity").innerHTML="";
    return true;
  }
}
function checkState(){
  state = document.getElementById("state").value;
  if (!isValidCityState(state) || state == ""){
    document.getElementById("checkstate").innerHTML="Please enter a valid state.";
    return false;
  } else {
    document.getElementById("checkstate").innerHTML="";
    return true;
  }
}
function checkZipcode(){
  zipcode = document.getElementById("zipc").value;
  if (!isNumeric(zipcode) || zipcode == ""){
    document.getElementById("checkzipc").innerHTML="Please enter a valid zip code.";
    return false;
  } else {
    document.getElementById("checkzipc").innerHTML="";
    return true;
  }
}
function checkBedrooms(){
  bedrooms = document.getElementById("bed").value;
  if (!isNumeric(bedrooms) || bedrooms == ""){
    document.getElementById("checkbed").innerHTML="Please enter an integer.";
    return false;
  } else {
    document.getElementById("checkbed").innerHTML="";
    return true;
  }
}
function checkBathrooms(){
  bathrooms = document.getElementById("bath").value;
  if (!isValidBathroom(bathrooms) || bathrooms == ""){
    document.getElementById("checkbath").innerHTML="Please enter an number.";
    return false;
  } else {
    document.getElementById("checkbath").innerHTML="";
    return true;
  }
}
function checkSquareFeet(){
  squareFeet = document.getElementById("sfeet").value;
  if (!isNumeric(squareFeet) || squareFeet == ""){
    document.getElementById("checksfeet").innerHTML="Please enter a number.";
    return false;
  } else {
    document.getElementById("checksfeet").innerHTML="";
    return true;
  }
}
function checkLeaseType(){
  leaseType = document.getElementById("leaset").value;
  if (!isNumeric(leaseType) || leaseType == ""){
    document.getElementById("checkleaset").innerHTML="Please enter an integer.";
    return false;
  } else {
    document.getElementById("checkleaset").innerHTML="";
    return true;
  }
}

function checkEverything() {
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
  if (!checkAmen()) {
    checkAll = false;
  }
}