function doOnLoad(){
    loadGroupMembers();
    document.getElementById("leaveBtn").addEventListener("click",leaveGroup);
    doIfOwner();
}
function loadGroupMembers(){
    var groupMembers = getGroupMembers();
    var groupList = document.getElementById("groupList");
    var groupOwner = getGroupOwner();
    var htmlString = "<li class= \"list-group-item\"> <img src=\""+ groupOwner[0] +"\" style= \"float: left; height: 50px; width: 50px; margin-right: 10%;\">"+ groupOwner[1] + " (Owner)</li>";
    for (var i = 0; i < groupMembers.length; i++){
        htmlString += "<li class= \"list-group-item\"> <img src=\""+ groupMembers[i][0] +"\" style= \"float: left; height: 50px; width: 50px; margin-right: 10%;\">"+ groupMembers[i][1];
        if (isOwner()){
            htmlString += "<button type=\"button\" class=\"btn btn-danger\" style=\"position:absolute; right:0;margin-right:2%;\" onclick=\"kickMember("+i+")\"> Kick </button>";
        }
        htmlString += "</li>";
    }


    groupList.innerHTML = htmlString;
}
function kickMember(memberNumber){
    console.log(memberNumber + " got kicked! D:\n");
}
function getGroupMembers(){
    return [["sisman.png","JaneDoe"], ["sisman.png", "JohnDough"], ["sisman.png", "DoughDoughnut"]];
}
function getGroupOwner(){
    return ["sisman.png","SIS-Man"];
}
function getUsername(){
    return "SIS-Man";
}

function getProfilePicture(){
    return "sisman.png";
}
function getName(){
    return "Man, SIS";
}

function changeProfileButton(){
    document.getElementById("profileNavButton").innerHTML = "<img src =\"" + getProfilePicture() + "\" class = \"rounded-circle\" style = \"height:40px; width:40px\"> " + getUsername();
}

function isOwner(){
    return (getGroupOwner()[1] == getUsername());
}
function doIfOwner(){
    if (isOwner()){
        document.getElementById("addMemberDiv").innerHTML = "<button type=\"button\" class=\"btn btn-primary\" style=\"margin-bottom: 2%;\"> Add Member</button>";
    }
}

function leaveGroup(){
    console.log("You left the group! D:\n");
}