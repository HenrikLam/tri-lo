var address;

function setListingSearchEventListeners(){
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
  document.getElementById("parkingC").addEventListener("click",remain);
  document.getElementById("washerC").addEventListener("click",remain);
  document.getElementById("dryerC").addEventListener("click",remain);
  document.getElementById("dishWasherC").addEventListener("click",remain);
  document.getElementById("centralHeatingC").addEventListener("click",remain);
  document.getElementById("forcedAirHeatingC").addEventListener("click",remain);
  document.getElementById("gasHeatingC").addEventListener("click",remain);
  document.getElementById("inUnitCoolingC").addEventListener("click",remain);
  document.getElementById("searchbar").addEventListener("submit", searchFunc);
}

function searchFunc(e) {
  e.preventDefault();
  var paramDict = {};

  address = document.getElementById("search").value;
  var params = "&address=" + address;
  var minPrice;
  var maxPrice;
  console.log(address);
  var priceArr = getActivePrice();
  minPrice = priceArr[0];
  maxPrice = priceArr[1];
  paramDict["minPrice"] = minPrice;
  paramDict["maxPrice"] = maxPrice;

  console.log("minPrice: " + minPrice);
  console.log("maxPrice: " + maxPrice);
  var minBath = getActiveBath();
  var minBed = getActiveBed();
  console.log("minBath: " + minBath);
  console.log("minBed: " + minBed);
  paramDict["minBath"] = minBath;
  paramDict["maxBed"] = minBed;
  var sqFtMin = $("#sqFtMin").find("option:selected").text();
  if (sqFtMin == "Any"){
    sqFtMin = 0;
  }
  var sqFtMax = $("#sqFtMax").find("option:selected").text();
  if (sqFtMax == "Any"){
    sqFtMax = 99999999999;
  }
  params += "&sqFtMin="+sqFtMin + "&sqFtMax="+sqFtMax;
  console.log("sqFtMin: "+sqFtMin);
  console.log("sqFtMax: "+sqFtMax);
  var bedToBath = false;
  if ($("#bedToBath").is(":checked")){
    bedToBath = true;
    params += "&bedToBath="+true;
  }
  console.log("bedToBath: "+ bedToBath);
  var sDogs = false;
  if ($("#sDogs".is(":checked"))){
    sDogs = true;
    params += "&sDogs="+true;
  }
  console.log("sDogs: "+ sDogs);
  var lDogs = false;
  if ($("#lDogs".is(":checked"))){
    lDogs = true;
    params += "&lDogs="+true;
  }
  var cats = false;
  if ($("#cats".is(":checked"))){
    cats = true;
    params += "&cats="+true;
  }
  var parking = false;
  if ($("#parking".is(":checked"))){
    parking = true;
    params += "&parking="+true;
  }
  var washer = false;
  if ($("#washer".is(":checked"))){
    washer = true;
    params += "&washer="+true;
  }
  var dryer = false;
  if ($("#dryer".is(":checked"))){
    dryer = true;
    params += "&dryer="+true;
  }
  var dishWasher = false;
  if ($("#dishWasher".is(":checked"))){
    dishWasher = true;
    params += "&dishWasher="+true;
  }
  var centralHeating = false;
  if ($("#centralHeating".is(":checked"))){
    centralHeating = true;
    params += "&centralHeating="+true;
  }
  var forcedAirHeating = false;
  if ($("#forcedAirHeating".is(":checked"))){
    forcedAirHeating = true;
    params += "&forcedAirHeating="+true;
  }
  var gasHeating = false;
  if ($("#gasHeating".is(":checked"))){
    gasHeating = true;
    params += "&gasHeating="+true;
  }
  var inUnitCooling = false;
  if ($("#inUnitCooling".is(":checked"))){
    inUnitCooling = true;
    params += "&inUnitCooling="+true;
  }

  var xhr = new XMLHttpRequest();
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
  xhr.send(params);
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
  }
  e.stopPropagation();
}

function setActivePrice2(e) {
  document.getElementById("priceany").classList = "dropdown-item";
  document.getElementById("price0500").classList = "dropdown-item";
  document.getElementById("price5001000").classList = "dropdown-item";
  document.getElementById("pricecustom").classList = "dropdown-item";
  if (e.target && e.target.nodeName == "INPUT") {
    e.target.parentElement.classList.add("active");
  }
  e.stopPropagation();
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
  }
  e.stopPropagation();
}

function getActiveBath(){
  if (document.getElementById("bathany").classList.contains("active")){
    return 0;
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
  return 0;
}

function setActiveBed(e) {
  document.getElementById("bedany").classList.remove("active");
  document.getElementById("bed1").classList.remove("active");
  document.getElementById("bed2").classList.remove("active");
  document.getElementById("bed3").classList.remove("active");
  document.getElementById("bed4").classList.remove("active");

  if(e.target && e.target.nodeName == "A") {
    e.target.classList.add("active");
  }
  e.stopPropagation();
}

function getActiveBed(){
  if (document.getElementById("bedany").classList.contains("active")){
    return 0;
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
  return 0;
}

function setActiveSort(e) {
  document.getElementById("sortplh").classList.remove("active");
  document.getElementById("sortphl").classList.remove("active");
  document.getElementById("sortnew").classList.remove("active");
  document.getElementById("sortold").classList.remove("active");
  document.getElementById("sortsqft").classList.remove("active");

  if(e.target && e.target.nodeName == "A") {
    e.target.classList.add("active");
  }
  e.stopPropagation();
}

function onClickListing(listing) {
  
  // document.getElementById("profileNavButton").innerHTML = "<img src =\"" + pfp + "\" class = \"rounded-circle\" style = \"height:40px; width:40px\"> " + username;
}