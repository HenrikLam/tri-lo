var data;
function initMeme() {
	const urlParams = new URLSearchParams(window.location.search);
  	var listingid = urlParams.get("listingid");
  	var xhr = new XMLHttpRequest();
  	var params = "listingId=" + listingid;
  	xhr.open('POST', 'php/listings/individualListing.php', true);
  	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhr.onerror = function() {
      console.log('Request Error...');
  	}
  	xhr.onload= function() {
  	//200 ok, 403 forbidden, 404 not found
      	if (this.status=200) {
      		console.log(this.responseText);
      		data = JSON.parse(this.responseText);
      		display();
      	}
      	else {
          	console.log("error boi");
      	}
  	}
  	xhr.send(params);
}

function display() {
	// do something with data
	console.log(data);
}