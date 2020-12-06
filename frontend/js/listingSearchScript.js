var address;
var priceamen = "priceany";
var priceleft;
var priceright;
var bedamen = "bedany";
var bathamen = "bathany";
var sortamen = "sortnew";
var pagenum = "1";
var pageprev = false;
var pagenext = false;
var memeEvent = document.createEvent("MouseEvent");
var minPrice;
var maxPrice;
var minBed;
var minBath;
var sqFtMin;
var sqFtMax;
var bedToBath;

function setListingSearchEventListeners(){
  checkURL();
  document.getElementById("dmenuprice").addEventListener("click", setActivePrice);
  document.getElementById("dmenuprice").addEventListener("change", setActivePrice2);
  document.getElementById("dmenubath").addEventListener("click", setActiveBath);
  document.getElementById("dmenubed").addEventListener("click", setActiveBed);
  document.getElementById("dmenusort").addEventListener("click", setActiveSort);
  document.getElementById("house1").addEventListener("click", empac);
  document.getElementById("bedToBathC").addEventListener("click", remain);
  document.getElementById("sDogC").addEventListener("click",remain);
  document.getElementById("lDogC").addEventListener("click",remain);
  document.getElementById("catC").addEventListener("click",remain);
  document.getElementById("parkingG").addEventListener("click",remain);
  document.getElementById("parkingO").addEventListener("click",remain);
  document.getElementById("parkingC").addEventListener("click",remain);
  document.getElementById("washerC").addEventListener("click",remain);
  document.getElementById("dryerC").addEventListener("click",remain);
  document.getElementById("dishWasherC").addEventListener("click",remain);
  document.getElementById("centralHeatingC").addEventListener("click",remain);
  document.getElementById("forcedAirHeatingC").addEventListener("click",remain);
  document.getElementById("gasHeatingC").addEventListener("click",remain);
  document.getElementById("inUnitCoolingC").addEventListener("click",remain);
  document.getElementById("searchbar").addEventListener("submit", searchFunc, false);
  document.getElementById("whichpage").addEventListener("click", pageClick);
}

function searchFunc(e) {
  e.preventDefault();

  checkFilters();

  houseNoods = new FormData();
  houseNoods.append("address", address);
  houseNoods.append("startingPrice", minPrice);
  houseNoods.append("endingPrice", maxPrice);

  if (minBed != null)
    houseNoods.append("bedrooms", minBed);
  if (minBath != null)
    houseNoods.append("bathrooms", minBath);

  if (sqFtMin != null)
    houseNoods.append("startingSquareFeet", sqFtMin);
  if (sqFtMax != null)
    houseNoods.append("endingSquareFeet", sqFtMax);

  if (bedToBath){
    houseNoods.append("bedToBath", bedToBath);
  }

  var paramDict = getAmenities();

  var params = JSON.stringify(paramDict);
  console.log("paramDict: " + params);
  var xhr = new XMLHttpRequest();
  
  if (address == "") {
    return;
  }

  var xhr = new XMLHttpRequest();

  //still not sure how to use pagenum here as of yet
  // OPEN- type, url/file, async
  xhr.open('POST', 'php/listings/listingSearch.php', true);
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
  xhr.send("&params="+params);
}

function checkURL() {
  const urlParams = new URLSearchParams(window.location.search);
  const myParam = urlParams.get("search");
  document.getElementById("search").value = myParam;

  searchFunc(memeEvent);
}

function remain(e) {
  e.stopPropagation();
}

function empac() {
  window.location.replace("exlistpage.html");
}

function setActivePrice(e) {
  document.getElementById("priceany").classList = "dropdown-item";
  document.getElementById("price0500").classList = "dropdown-item";
  document.getElementById("price5001000").classList = "dropdown-item";
  document.getElementById("pricecustom").classList = "dropdown-item";
  if (e.target && e.target.nodeName == "A") {
    e.target.classList.add("active");
    priceamen = e.target.id;
    e.stopPropagation();
    searchFunc(memeEvent);
  }
}

function setActivePrice2(e) {
  document.getElementById("priceany").classList = "dropdown-item";
  document.getElementById("price0500").classList = "dropdown-item";
  document.getElementById("price5001000").classList = "dropdown-item";
  document.getElementById("pricecustom").classList = "dropdown-item";
  if (e.target && e.target.nodeName == "INPUT") {
    e.target.parentElement.classList.add("active");
    priceamen = "pricecustom";
    priceleft = document.getElementById("leftp").value;
    priceright = document.getElementById("rightp").value;
    e.stopPropagation();
    searchFunc(memeEvent);
  }
}

function getActivePrice(){
  if (document.getElementById("priceany").classList.contains("active")){
    return [0,99999999999];
  }
  if (document.getElementById("price0500").classList.contains("active")){
    return [0,500];
  }
  if (document.getElementById("price5001000").classList.contains("active")){
    return [500,1000];
  }
  return [document.getElementById("customMin").value, document.getElementById("customMax").value];
}

function setActiveBath(e) {
  document.getElementById("bathany").classList.remove("active");
  document.getElementById("bath1").classList.remove("active");
  document.getElementById("bath2").classList.remove("active");
  document.getElementById("bath3").classList.remove("active");
  document.getElementById("bath4").classList.remove("active");

  if(e.target && e.target.nodeName == "A") {
    e.target.classList.add("active");
    bathamen = e.target.id;
    e.stopPropagation();
    searchFunc(memeEvent);
  }
}

function getActiveBath(){
  if (document.getElementById("bathany").classList.contains("active")){
    return null;
  }
  if (document.getElementById("bath1").classList.contains("active")){
    return 1;
  }
  if (document.getElementById("bath2").classList.contains("active")){
    return 2;
  }
  if (document.getElementById("bath3").classList.contains("active")){
    return 3;
  }
  if (document.getElementById("bath4").classList.contains("active")){
    return 4;
  }
  return null;
}

function setActiveBed(e) {
  document.getElementById("bedany").classList.remove("active");
  document.getElementById("bed1").classList.remove("active");
  document.getElementById("bed2").classList.remove("active");
  document.getElementById("bed3").classList.remove("active");
  document.getElementById("bed4").classList.remove("active");

  if(e.target && e.target.nodeName == "A") {
    e.target.classList.add("active");
    bedamen = e.target.id;
    e.stopPropagation();
    searchFunc(memeEvent);
  }
}

function getActiveBed(){
  if (document.getElementById("bedany").classList.contains("active")){
    return null;
  }
  if (document.getElementById("bed1").classList.contains("active")){
    return 1;
  }
  if (document.getElementById("bed2").classList.contains("active")){
    return 2;
  }
  if (document.getElementById("bed3").classList.contains("active")){
    return 3;
  }
  if (document.getElementById("bed4").classList.contains("active")){
    return 4;
  }
  return null;
}

function checkFilters() {
  address = document.getElementById("search").value;

  var priceArr = getActivePrice();
  minPrice = priceArr[0];
  maxPrice = priceArr[1];

  minBath = getActiveBath();
  minBed = getActiveBed();
  
  sqFtMin = $("#sqFtMin").find("option:selected").text();
  sqFtMax = $("#sqFtMax").find("option:selected").text();
  if (sqFtMin == "Any" && sqFtMax == "Any"){
    sqFtMin = null;
    sqFtMax = null;
  }
  else if (sqFtMin == "Any" && sqFtMax != "Any"){
    sqFtMin = 0;
  }
  else if (sqFtMax == "Any" && sqFtMin != "Any"){
    sqFtMax = 99999999999;
  }

  bedToBath = false;
  if ($("#bedToBath").is(":checked")){
    bedToBath = true;
  }
}

function getAmenities() {
  var paramDict = {};
  
  if ($("#sDogs").is(":checked")){
    paramDict["pets"] = "small dogs";
  }
  
  if ($("#lDogs").is(":checked")){
    paramDict["Pets"] = "large dogs";
  }

  if ($("#cats").is(":checked")){
    paramDict["PETS"] = "cats";
  }

  if ($("#parkingGarage").is(":checked")){
    paramDict["parking"] = "garage";
  }

  if ($("#parkingOffStreet").is(":checked")){
    paramDict["Parking"] = "off-street";
  }

  if ($("#parkingCovered").is(":checked")){
    paramDict["ParkinG"] = "covered";
  }

  if ($("#washer").is(":checked")){
    paramDict["appliances"] = 'washer';
  }

  if ($("#dryer").is(":checked")){
    paramDict["Appliances"] = 'dryer';
  }

  if ($("#dishWasher").is(":checked")){
    paramDict["ApplianceS"] = 'dishwasher';
  }

  if ($("#centralHeating").is(":checked")){
    paramDict["heating"] = 'central';
  }

  if ($("#forcedAirHeating").is(":checked")){
    paramDict["Heating"] = 'forced air';
  }

  if ($("#gasHeating").is(":checked")){
    paramDict["HeatinG"] = 'gas';
  }

  if ($("#inUnitCooling").is(":checked")){
    paramDict["cooling"] = 'in unit';
  }

  return paramDict;
}

function setActiveSort(e) {
  document.getElementById("sortplh").classList.remove("active");
  document.getElementById("sortphl").classList.remove("active");
  document.getElementById("sortnew").classList.remove("active");
  document.getElementById("sortold").classList.remove("active");
  document.getElementById("sortsqft").classList.remove("active");

  if(e.target && e.target.nodeName == "A") {
    e.target.classList.add("active");
    sortamen = e.target.id;
    e.stopPropagation();
    searchFunc(memeEvent);
  }
}

function pageClick(e) {
  if (e.target && e.target.nodeName == "A") {
    if (e.target.id.match(/page[0-9]{1}$/)) {
      pagenum = document.getElementById(e.target.id).innerHTML;
      document.getElementById("page1").parentElement.classList.remove("active");
      document.getElementById("page2").parentElement.classList.remove("active");
      document.getElementById("page3").parentElement.classList.remove("active");
      e.target.parentElement.classList.add("active");
      searchFunc(memeEvent);
    }
    else {
      if (e.target.id.substring(4) == "prev") {
        console.log("prev");
        pageprev = true;
        //something here to use pagenum and -1 and calculate shit
      }
      else {
        console.log("next");
        pagenext = true;
        //smth here to use pagenum and +1 and calculate shit
      }
      searchFunc(memeEvent);
    }
  }
}