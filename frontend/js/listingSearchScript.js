var address;
var sortamen = "sortnew";
var pagenum = 1;
var pageprev = false;
var pagenext = false;
var memeEvent = document.createEvent("MouseEvent");
var minPrice = null;
var maxPrice;
var minBed;
var minBath;
var sqFtMin;
var sqFtMax;
var bedToBath;
var listings;
var numpages;
var numlistings;

function setListingSearchEventListeners(){
  checkURL();
  document.getElementById("dmenuprice").addEventListener("click", setActivePrice);
  document.getElementById("dmenuprice").addEventListener("change", setActivePrice2);
  document.getElementById("dmenubath").addEventListener("click", setActiveBath);
  document.getElementById("dmenubed").addEventListener("click", setActiveBed);
  document.getElementById("dmenusort").addEventListener("click", setActiveSort);
  document.getElementById("listings").addEventListener("click", empac);
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
  var paramDict = getAmenities();

  if (address == "") {
    return;
  }

  var xhr = new XMLHttpRequest();
  houseNoods = new FormData();
  houseNoods.append("address", address);
  houseNoods.append("sortType", sortamen);
  houseNoods.append("pageNum", pagenum);

  houseNoods.append("amenities", JSON.stringify(paramDict));

  //still not sure how to use pagenum here as of yet
  // OPEN- type, url/file, async
  xhr.open('POST', 'php/listings/listingSearch.php', true);
  xhr.onerror = function() {
      console.log('Request Error...');
  }

  //xhr.onprogress can be used to show loading screen
  //can also use xhr.onerror for error
  xhr.onload= function() {
  //200 ok, 403 forbidden, 404 not found
      if (this.status=200) {
          console.log(this.responseText);

          var data = JSON.parse(this.responseText);

          // console.log(data);

          numpages = data['numPages'];
          numlistings = data['pageCount'];

          delete data['pageCount'];
          delete data['numPages'];

          listings = data; 

          makePages();
          updateListings();
      }
      else {
          console.log("error boi");
      }
  }
  xhr.send(houseNoods);
}

function checkURL() {
  const urlParams = new URLSearchParams(window.location.search);
  const myParam = urlParams.get("search");
  document.getElementById("search").value = myParam;

  searchFunc(memeEvent);
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

function remain(e) {
  e.stopPropagation();
  searchFunc(memeEvent);
}

function empac() {
  window.location.replace("exlistpage.html");
}

function getActivePrice(){
  if (document.getElementById("priceany").classList.contains("active")){
    return [null,null];
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
  console.log(priceArr);
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

  if (minPrice != null)
    paramDict["startingPrice"] = minPrice;
  if (maxPrice != null)
    paramDict["endingPrice"] = maxPrice;

  if (minBed != null)
    paramDict["bedrooms"] = minBed;
  if (minBath != null)
    paramDict["bathrooms"] = minBath;

  if (sqFtMin != null)
    paramDict["startingSquareFeet"] = sqFtMin;
  if (sqFtMax != null)
    paramDict["endingSquareFeet"] = sqFtMax;

  if (bedToBath)
    paramDict["bedToBath"] = bedToBath;

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

function createPageButton(title) {
  var page = document.createElement("li");
  page.classList.add("page-item");

  var link = document.createElement("a");
  link.id = "page" + title;
  link.classList.add("page-link");
  link.href = "#";
  link.textContent = "" + title;

  page.appendChild(link);

  return page;
}

function makePages() {
  document.getElementById("whichpage").innerHTML = '';

  var prev = createPageButton("Previous")
  document.getElementById("whichpage").appendChild(prev);

  for (var i = 1; i <= numpages; i++) {
    var page = createPageButton(i);

    if (i == pagenum) {
      page.classList.add("active");
    }

    document.getElementById("whichpage").appendChild(page);
  }

  var next = createPageButton("Next")
  document.getElementById("whichpage").appendChild(next);

  if (pagenum == 1) {
    pageprev = false;
    document.getElementById("pagePrevious").classList.add("isDisabled");
  }
  if (pagenum == numpages || numpages == 0) {
    pagenext = false;
    document.getElementById("pageNext").classList.add("isDisabled");
  }

}

function pageClick(e) {
  if (e.target && e.target.nodeName == "A") {
    if (e.target.id.match(/page[0-9]{1}$/)) {
      pagenum = parseInt(document.getElementById(e.target.id).textContent);  
    }
    else {
      if (e.target.id == "pagePrevious") {
        pagenum = pagenum - 1;
      }
      else {
        pagenum = pagenum + 1;
      }
    }
    searchFunc(memeEvent);
  }
}

function createListing(listing) {
  var page = document.createElement("button");
  page.id = "listing" + listing.listingId;
  page.classList.add("btn");
  page.classList.add("bg-light");
  page.classList.add("border");
  page.style.width = "100%";

  var image = document.createElement("img");
  image.src = listing.imageLink;
  image.classList.add("rounded");
  image.classList.add("img-fluid");

  var address = document.createElement("div");
  address.id = "address";
  address.style.float = "left";
  address.style.marginLeft = "10px";
  address.textContent = "" + listing.address;

  var rent = document.createElement("div");
  rent.id = "rent";
  rent.style.float = "right";
  rent.textContent = "$" + listing.rent;

  var bedrooms = document.createElement("div");
  bedrooms.id = "bedroomnum";
  bedrooms.style.float = "left";
  bedrooms.style.marginLeft = "10px";
  if (listing.bedrooms == null || listing.bedrooms == "")
    bedrooms.textContent = "Bedrooms: -- | ";
  else
    bedrooms.textContent = "Bedrooms: " + listing.bedrooms + " | ";

  var bathrooms = document.createElement("div");
  bathrooms.id = "bathroomnum";
  bathrooms.style.float = "left";
  bathrooms.style.marginLeft = "4px";
  if (listing.bathrooms == null || listing.bathrooms == "")
    bathrooms.textContent = "Bathrooms: -- | ";
  else
    bathrooms.textContent = "Bathrooms: " + listing.bathrooms + " | ";

  var squarefeet = document.createElement("div");
  squarefeet.id = "squarefeet";
  squarefeet.style.float = "left";
  squarefeet.style.marginLeft = "4px";
  if (listing.squareFeet == null || listing.squareFeet == "")
    squarefeet.textContent = "Square Feet: --";
  else
    squarefeet.textContent = "Square Feet: " + listing.squareFeet;

  var timeposted = document.createElement("div");
  timeposted.id = "lastposted";
  timeposted.style.float = "right";
  timeposted.textContent = "Posted " + listing.dateTimePosted;

  page.appendChild(address);
  page.appendChild(image);
  page.appendChild(rent);
  page.appendChild(document.createElement("br"));
  page.appendChild(document.createElement("br"));
  page.appendChild(document.createElement("br"));
  page.appendChild(bedrooms);
  page.appendChild(bathrooms);
  page.appendChild(squarefeet);
  page.appendChild(timeposted);

  return page;
}

function updateListings() {
  document.getElementById("listings").innerHTML = '';

  for (var i = 0; i < numlistings; i++) {
    var div = createListing(listings[i]);
    document.getElementById("listings").appendChild(div);
  }

  if (numlistings == 0) {
    var page = document.createElement("button");
    page.classList.add("btn");
    page.classList.add("bg-light");
    page.classList.add("border");
    page.style.width = "100%";
    page.textContent = "No listings matched";

    document.getElementById("listings").appendChild(page);
  }
}