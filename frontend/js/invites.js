var numInvited;
var invited;

function doOnLoad(){
    getInvites();
    // document.getElementById("leaveBtn").addEventListener("click",leaveGroup);
}

function getInvites() {
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
            loadInvited();
            // loadInvited();
        }
        else {
            return "Error";
        }
    }

    xhr.send("");
}

function loadInvited() {
    for (var i = 0; i < numInvited; i++) {
        loadInviteMembers(invited[i]);
    }
}

function loadInviteMembers(inviteObj){
    var full = document.createElement("div");
    full.classList.add("col-md-9");
    full.id = "group" + inviteObj.groupId;

    var group = document.createElement("div");
    group.style.paddingTop = "2%";
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
    container.style.minHeight = "200px";
    container.classList.add("container-fluid");

    var ul = document.createElement("ul");
    ul.id = "group" + inviteObj.groupId + "List";
    ul.classList.add("list-group");


    var groupMembers = getInvitedMembers(inviteObj);
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
    container.style.marginLeft = "2%";
    container.style.float = "bottom";
    leave.textContent = "Delete Invite";

    ul.innerHTML = htmlString;
    container.appendChild(ul);
    group.appendChild(title);
    group.appendChild(container);
    full.appendChild(group);
    group.appendChild(leave);

    document.getElementById("allGroups").appendChild(full);
    document.getElementById("allGroups").appendChild(document.createElement("br"));
}

function kickMember(memberNumber){
    console.log(memberNumber + " got kicked! D:\n");
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

function leaveGroup(){
    console.log("You left the group! D:\n");
}