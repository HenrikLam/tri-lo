var numCollections;
var collections;
var currentCollection;
var command;
var listingId;
var collectionId;

function doOnLoad(){
	getCollections();
	document.getElementById("collectionOptions").addEventListener("click",setActiveCollection);
	document.getElementById("searchButton").addEventListener("click",getCollections);
}

function getCollections() {
    var xhr = new XMLHttpRequest();
    //retrieve sessionId from cookie

    xhr.open('POST', 'php/collections/allCollections.php', true);
    xhr.onerror = function() {
        console.log('Request Error...');
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var send = document.getElementById("search").value;
    if (send != "") {
    	send = "&name=" + send;
    }

    if (command != null) {
    	send += "&command=" + command + "&listingId=" + 
    	        listingId + "&collectionId=" + collectionId;
    }
    //xhr.onprogress can be used to show loading screen
    //can also use xhr.onerror for error
    xhr.onload= function() {
        //200 ok, 403 forbidden, 404 not found
        if (this.status=200) {
        	// console.log(this.responseText);
            var data = JSON.parse(this.responseText);

            numCollections = data.numCollections;
            collections = data.collections;
            createOptions();
        }
        else {
            return "Error";
        }
    }

    xhr.send(send);
}

function setActiveCollection(e) {
	for (child of document.getElementById("collectionOptions").childNodes) {
		child.classList = "dropdown-item";
	}

 	if (e.target && e.target.nodeName == "A") {
		e.target.classList.add("active");
		currentCollection = parseInt(e.target.id.replace("collection", ""));
		e.stopPropagation();
		changeCollection();
	}
}

function createListing(listing) {
    var page = document.createElement("li");
	page.id = "listing" + listing.listingId;
	page.classList.add("list-group-item");
	page.classList.add("btn");

	var image = document.createElement("img");
	image.src = listing.imageLink;
	image.style.width = "320px"; 
	image.style.height = "180px"; 
	image.style.float = "left"

	var header = document.createElement("header");
	header.classList.add("lead");
	header.style.fontSize = "24pt"; 
	header.style.float = "left"
	header.style.marginLeft = "2%";
	header.style.textAlign = "left";
	header.style.whiteSpace = "pre";
	header.textContent = listing.address + "\r\n" + listing.city + ", " + 
						 listing.state + " " + listing.zip + "\r\n$" +
						 listing.rent + "/month";

	var button = document.createElement("button");
	button.type = "button";
	button.setAttribute('aria-label', 'Close');
	button.classList.add("close");
	button.addEventListener("click", deleteListing);

	var span = document.createElement("span");
	span.setAttribute('aria-hidden', 'true');
	span.id = "remove" + currentCollection + " " + listing.listingId
	span.textContent = "x";

	button.appendChild(span);
	page.appendChild(image);
	page.appendChild(header);
	page.appendChild(button);
	
	return page;
}

function changeCollection() {
	document.getElementById("bookmarkedGroup").innerHTML = "";
	
	var collection = collections[currentCollection];
	document.getElementById("collectionName").textContent = collection.name;

	for (var i = 0; i < collection.listings.length; i++) {
		var lis = createListing(collection.listings[i]);
		document.getElementById("bookmarkedGroup").appendChild(lis);
	}

	if (collection.listings.length == 0) {
		document.getElementById("bookmarkedGroup").innerHTML = "No listings to show";
	}
}

function createOptions() {
	document.getElementById("collectionOptions").innerHTML = "";

	var count = 0;
	for (var key in collections) {
		var option = document.createElement("a");
	    option.href = "#";
	    option.textContent = collections[key].name;
	    option.id = "collection" + collections[key].collectionId;
	    option.classList.add("dropdown-item");

	    if (count == 0) {
	    	option.classList.add("active");
	    	currentCollection = key;
	    }

	    count++;
	    document.getElementById("collectionOptions").appendChild(option);
	}
	changeCollection();
}

function deleteListing(e) {
	if (e.target) {
		var toDelete = e.target.id.replace("remove", "").split(" ");
		command = "remove";
		collectionId = toDelete[0];
		listingId = toDelete[1];
		e.stopPropagation();
		getCollections();
	}
}