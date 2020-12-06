function setHomepageEventListeners(){
    document.getElementById("search").addEventListener("click", searchListener);
}

function searchListener(e){
    var searchInput = document.getElementById("searchInput").value;

    if (searchInput == "") 
        return;

    // // OPEN- type, url/file, async
    // xhr.open('POST', 'listing_search.html', true);
    // xhr.onerror = function() {
    //     console.log('Request Error...');
    // }
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // //xhr.onprogress can be used to show loading screen
    // //can also use xhr.onerror for error
    // xhr.onload= function() {
    // //200 ok, 403 forbidden, 404 not found
    //     if (this.status=200) {
    location.replace(encodeURI("listing_search.html?search=" + searchInput));
    //         document.body = this.responseText;
    //     }
    //     else {
    //         console.log("error boi");
    //     }
    // }
    // xhr.send(params);
}