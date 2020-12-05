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

function setListingSearchEventListeners(){
  checkURL();
  document.getElementById("dmenuprice").addEventListener("click", setActivePrice);
  document.getElementById("dmenuprice").addEventListener("change", setActivePrice2);
  document.getElementById("dmenubath").addEventListener("click", setActiveBath);
  document.getElementById("dmenubed").addEventListener("click", setActiveBed);
  document.getElementById("dmenusort").addEventListener("click", setActiveSort);
  document.getElementById("house1").addEventListener("click", empac);
  document.getElementById("customC").addEventListener("click", remain);
  document.getElementById("searchbar").addEventListener("submit", searchFunc, false);
  document.getElementById("whichpage").addEventListener("click", pageClick);
}

function searchFunc(e) {
  e.preventDefault();
  address = document.getElementById("search").value;

  console.log(address);
  
  if (address == "") {
    return;
  }

  var xhr = new XMLHttpRequest();
  var params = "address=" + address + "&pricetype=" + priceamen + "&bedtype=" + bedamen
             + "&bathtype=" + bathamen + "&sorttype=" + sortamen + "&pagenum=" + pagenum
             + "&pageprev=" + pageprev + "&pagenext=" + pagenext;

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
  xhr.send(params);
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