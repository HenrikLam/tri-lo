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
	document.getElementById("maddr").innerHTML = data['address'] + ", " + data['city'] + ", " + data['state'] + ", " + data['zip'];
	document.getElementById("numbath").innerHTML = data['bathrooms'];
	document.getElementById("numbed").innerHTML = data['bedrooms'];
	document.getElementById("longtime").innerHTML = data['leaseType'];
	document.getElementById("howmuchbigboi").innerHTML = data['rent'];
	document.getElementById("lname").innerHTML = data['owner']['firstName'] + " " + data['owner']['lastName'];
	document.getElementById("lnumber").innerHTML = data['owner']['phoneNumber'];
	
	document.getElementById("lorem").innerHTML = data['description'];
	if (document.getElementById("lorem").innerHTML == "") {
		document.getElementById("lorem").innerHTML = "No description."
	}
	document.getElementById("amen").innerHTML = "";
	var meme = Object.keys(data['amenities']);
	meme.forEach(element => document.getElementById("amen").innerHTML += (element + ": " + data['amenities'][element] + "<br>"));

	document.getElementById("im1").src = data['imageLink'];
	document.getElementById("im2").src = data['imageLink'];
	document.getElementById("img1").src = data['imageLink'];
	document.getElementById("img2").src = data['imageLink'];
}