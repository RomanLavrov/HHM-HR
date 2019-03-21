
var deleteButton = document.getElementsByClassName("deleteButton");
deleteButton.onclick=function(){
   Confirm();
}

function Confirm(){
    if(confirm("Do you want to delete employee?")){
        alert('Confirm');
    }
    else{
        alert('Not Confirm');
    }
    
}
