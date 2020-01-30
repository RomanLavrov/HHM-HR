var month = document.getElementsByClassName("vacationMonth");

var monthArray = Array.from (month);

monthArray.forEach(function(element){
      if (element.innerText == "0"){           
            element.className = "vacationMonth-work";           
      }
      else (element.className = "vacationMonth-rest");
});

monthArray.forEach(function(element){
      if (element.innerText == "0"){
            element.innerText = "";
      }
})