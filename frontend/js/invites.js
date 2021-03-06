var numInvited;
var invited;
var userId;

function doOnLoad(){
    getInvites();
    // document.getElementById("leaveBtn").addEventListener("click",leaveGroup);
}

function getInvites(send="") {
    var xhr = new XMLHttpRequest();
    //retrieve sessionId from cookie

    xhr.open('POST', 'php/groups/allInvites.php', true);
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

            var data = JSON.parse(this.responseText);

            numInvited = data.numInvited;
            invited = data.invited;
            userId = data.userId;
            loadInvited();
            // loadInvited();
        }
        else {
            return "Error";
        }
    }

    xhr.send(send);
}

function loadInvited() {
    document.getElementById("allGroups").innerHTML = "";
    
    for (var i = 0; i < numInvited; i++) {
        loadInviteMembers(invited[i]);
    }

    if (numInvited == 0) {
        document.getElementById("allGroups").innerHTML = "No Invites to show";
    }
}

function loadInviteMembers(inviteObj){
    var full = document.createElement("div");
    full.id = "group" + inviteObj.groupId;

    var group = document.createElement("div");
    group.style.paddingTop = "2%";
    group.style.paddingRight = "2%";
    group.style.paddingLeft = "2%";
    group.classList.add("jumbotron");
    group.classList.add("jumbotron-fluid");

    var title = document.createElement("div");
    title.textContent = inviteObj.name;
    title.classList.add("lead");
    title.style.marginLeft = "2%";
    title.style.marginBottom = "2%";
    title.style.fontSize = "32pt";

    var container = document.createElement("div");
    container.id = "group" + inviteObj.groupId + "Container";
    container.style.marginBottom = "2%";
    container.classList.add("container-fluid");

    var ul = document.createElement("ul");
    ul.id = "group" + inviteObj.groupId + "List";
    ul.classList.add("list-group");
    ul.style.marginBottom = "2%";


    var groupMembers = getGroupMembers(inviteObj);
    var htmlString = "";
    for (var i = 0; i < groupMembers.length; i++){
        htmlString += "<li class= \"list-group-item\"> <img src=\""+ groupMembers[i][0] +"\" style= \"float: left; height: 50px; width: 50px; margin-right: 10%;\">"+ groupMembers[i][1];
        htmlString += "</li>";
    }

    var leave = document.createElement("button");
    leave.type = "button";
    leave.classList.add("btn");
    leave.classList.add("btn-danger");
    leave.id = "leave" + inviteObj.groupId;
    container.style.float = "bottom";
    leave.textContent = "Delete Invite";
    leave.setAttribute("onclick", "deleteInvite("+inviteObj.groupId +", " + userId+")");

    var accept = document.createElement("button");
    accept.type = "button";
    accept.classList.add("btn");
    accept.classList.add("btn-primary");
    accept.id = "accept" + inviteObj.groupId;
    accept.textContent = "Accept Invite";
    accept.style.marginRight = "1%";
    accept.setAttribute("onclick", "acceptInvite("+inviteObj.groupId +", " + userId+")");

    ul.innerHTML = htmlString;
    container.appendChild(ul);
    group.appendChild(title);
    group.appendChild(container);
    full.appendChild(group);
    container.appendChild(accept);
    container.appendChild(leave);

    document.getElementById("allGroups").appendChild(full);
    document.getElementById("allGroups").appendChild(document.createElement("br"));
}

function acceptInvite(groupId, userId) {
    getInvites("&command=acceptInvite&groupId=" + groupId + "&userId=" + userId);
}

function deleteInvite(groupId, userId) {
    getInvites("&command=deleteInvite&groupId=" + groupId + "&userId=" + userId);
}

function getInvitedMembers(invite){
    var invited = [];

    for (var i = 0; i < invite.invited.length; i++) {
        var pfp = invite.invited[i].profilePicture;
        if (pfp == null)
            pfp = "sisman.png"

        var name = invite.invited[i].firstName + " " + invite.invited[i].lastName;

        if (invite.invited[i].userId == invite.owner.userId)
            name += " (Owner)"

        invited.push([pfp, name]);
    }

    return invited;
}

function getGroupMembers(group){
    var members = [];

    for (var i = 0; i < group.members.length; i++) {
        var pfp = group.members[i].profilePicture;
        if (pfp == null)
            pfp = "sisman.png"

        var name = group.members[i].firstName + " " + group.members[i].lastName;

        if (userId == group.members[i].userId) {
            name = "You";
        }

        if (group.members[i].userId == group.owner.userId)
            name += " (Owner)"

        members.push([pfp, name]);
    }

    return members;
}

function leaveGroup(){
    console.log("You left the group! D:\n");
}