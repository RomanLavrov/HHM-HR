var day = document.getElementsByClassName('calendar-day');

var dayArray = Array.from(day);

var toolTip = document.createElement("div");
toolTip.className = "toolTip";
toolTip.style.position = "absolute";

toolTip.style.visibility = "hidden";
document.body.appendChild(toolTip);

assignVacationDelete();


dayArray.forEach(element => {
      if (element.innerText == "0") {
            element.style.visibility = "hidden";
      }
      if (element.dataset.weekday == "6" || element.dataset.weekday == "7") {
            element.className = "calendar-day-weekend";
      }
      if (element.dataset.vacation == "true") {
            element.className = "calendar-day-vacation";
      }

      element.onmouseover = function () {
            showTooltip(this);
      }

      element.onmouseleave = function () {
            hideTooltip(this);
      }

      function showTooltip(element) {
            toolTip.innerText = element.dataset.today;
            if (element.dataset.vacation == "true") {
                  toolTip.innerText = element.dataset.today + "  Ferien";
                  toolTip.style.border = '2px solid yellow';
            }
            toolTip.style.visibility = "visible";
            toolTip.style.left = event.pageX - 100 + 'px';
            toolTip.style.top = event.pageY - 50 + 'px';
            toolTip.style.zIndex = 100;
      }

      function hideTooltip(element) {
            toolTip.style.visibility = "hidden";
            toolTip.style.border = 'none';
      }

      var btnAddVacation = document.getElementById("btn-add-vacation");
      btnAddVacation.onclick = function () {
            createVacationForm();
      }     
});

function createVacationForm() {
      var vacationDiv = document.createElement("div");
      vacationDiv.innerHTML = document.getElementById("vacation").innerHTML;
      document.getElementById("vacation-parent").appendChild(vacationDiv);
      assignVacationDelete();      
      createDeleteBucket();      
}     

function assignVacationDelete(){
      var buttonDeleteVacation = document.getElementsByClassName("btn-del-vacation");
      var arrayDelete = Array.from(buttonDeleteVacation);
      arrayDelete.forEach(function (element) {
            element.onclick = function () {
                  var div = element.parentNode
                  div.parentNode.removeChild(div);
            }
      });
}


