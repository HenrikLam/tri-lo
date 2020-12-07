var numGroups;
var numInvited;
var groups;
var invited;
var userId;

function doOnLoad(){
    getGroups();
    // document.getElementById("leaveBtn").addEventListener("click",leaveGroup);
}

function getGroups(send="") {
    var xhr = new XMLHttpRequest();
    //retrieve sessionId from cookie

    xhr.open('POST', 'php/groups/allGroups.php', true);
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

            numGroups = data.numGroups;
            numInvited = data.numInvited;
            groups = data.groups;
            invited = data.invited;
            userId = data.userId;
            loadGroups();
            // loadInvited();
        }
        else {
            return "Error";
        }
    }

    xhr.send(send);
}

function loadGroups() {
    document.getElementById("allGroups").innerHTML = "";

    for (var i = 0; i < numGroups; i++) {
        loadGroupMembers(groups[i]);
    }

    if (numGroups == 0) {
        document.getElementById("allGroups").innerHTML = "No groups to show";
    }
}

function loadGroupMembers(groupObj){
    var full = document.createElement("div");
    full.id = "group" + groupObj.groupId;

    var group = document.createElement("div");
    group.style.paddingTop = "2%";
    group.classList.add("jumbotron");
    group.classList.add("jumbotron-fluid");
    group.style.paddingRight = "2%";
    group.style.paddingLeft = "2%";
    
    var title = document.createElement("div");
    title.textContent = groupObj.name;
    title.classList.add("lead");
    title.style.marginLeft = "2%";
    title.style.marginBottom = "2%";
    title.style.fontSize = "32pt";

    var container = document.createElement("div");
    container.id = "group" + groupObj.groupId + "Container";
    container.classList.add("container-fluid");

    var ul = document.createElement("ul");
    ul.id = "group" + groupObj.groupId + "List";
    ul.classList.add("list-group");
    ul.paddignLeft="0%";


    var groupMembers = getGroupMembers(groupObj);
    var htmlString = "";
    for (var i = 0; i < groupMembers.length; i++){
        htmlString += "<li class= \"list-group-item\"> <img src=\""+ groupMembers[i][0] +"\" style= \"float: left; height: 50px; width: 50px; margin-right: 10%;\">"+ groupMembers[i][1];
        if (userId == groupObj.owner.userId && userId != groupObj.members[i].userId){
            htmlString += "<button type=\"button\" class=\"btn btn-danger\" style=\"position:absolute; right:0;margin-right:2%;\" onclick=\"kickMember("+groupObj.groupId+", "+groupObj.members[i].userId+")\"> Kick </button>";
        }
        htmlString += "</li>";
    }

    var leave = document.createElement("button");
    leave.type = "button";
    leave.classList.add("btn");
    leave.classList.add("btn-danger");
    leave.id = "leave" + groupObj.groupId;
    leave.style.marginTop="2%";
    container.style.float = "bottom";
    leave.textContent = "Leave Group";
    leave.setAttribute("onclick", "leaveGroup("+groupObj.groupId +", " + userId+")");

    if (userId == groupObj.owner.userId) {
        leave.textContent = "Delete Group";
        leave.setAttribute("onclick", "deleteGroup("+groupObj.groupId+")");
    }

    ul.innerHTML = htmlString;
    container.appendChild(ul);
    group.appendChild(title);
    group.appendChild(container);
    container.appendChild(leave);
    full.appendChild(group);

    document.getElementById("allGroups").appendChild(full);
    document.getElementById("allGroups").appendChild(document.createElement("br"));
}

function leaveGroup(groupId, userId) {
    getGroups("&command=leaveGroup&groupId=" + groupId + "&userId=" + userId);
}

function kickMember(groupId, userId) {
    getGroups("&command=deleteMember&groupId=" + groupId + "&userId=" + userId);
}

function deleteGroup(groupId) {
    getGroups("&command=deleteGroup&groupId=" + groupId + "&userId=" + userId);
}

function createGroup() {
    var name = document.getElementById("groupName").value;
    var description = document.getElementById("groupDescription").value;

    if (name == ""){
        document.getElementById("createReq").innerHTML = "Name field cannot be empty!";
        return;
    }

    $("#myModal").modal("hide");
    getGroups("&command=createGroup&groupId=0&userId=" + userId +
              "&name=" + name + "&description=" + description);
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