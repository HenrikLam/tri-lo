function setListingSearchEventListeners(){
  var elements = document.getElementsByClassName("dropdown-item bg-light border rounded");
  console.log(elements.length);

  Array.from(elements).forEach(function(element) {
    element.addEventListener('click', function() {element.style.backgroundColor = "#2196F3"});
  });

  var listings = document.getElementsByClassName("btn bg-light border");
  console.log(listings.length);

  Array.from(listings).forEach(function(listing) {
    element.addEventListener('click', function() {});
  });
}

function onClickListing(listing) {
  
  // document.getElementById("profileNavButton").innerHTML = "<img src =\"" + pfp + "\" class = \"rounded-circle\" style = \"height:40px; width:40px\"> " + username;
}