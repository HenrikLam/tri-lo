var address;

function setListingSearchEventListeners(){
  document.getElementById("dmenuprice").addEventListener("click", setActivePrice);
  document.getElementById("dmenuprice").addEventListener("change", setActivePrice2);
  document.getElementById("dmenubath").addEventListener("click", setActiveBath);
  document.getElementById("dmenubed").addEventListener("click", setActiveBed);
  document.getElementById("dmenusort").addEventListener("click", setActiveSort);
  document.getElementById("house1").addEventListener("click", empac);
  document.getElementById("customC").addEventListener("click", remain);
  document.getElementById("trySearch").addEventListener("click", searchFunc);
}

function searchFunc(e) {
  e.preventDefault();
  address = document.getElementById("search").value;

  console.log(address);
  
  var xhr = new XMLHttpRequest();
  var params = "address=" + address;
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