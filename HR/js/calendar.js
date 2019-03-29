var day = document.getElementsByClassName('calendar-day');

var dayArray = Array.from(day);
var vacationsPanel = $("#vacations-scroll");

var toolTip = document.createElement("div");
toolTip.className = "toolTip";
toolTip.style.position = "absolute";

toolTip.style.visibility = "hidden";
document.body.appendChild(toolTip);

assignDatePicker();

assignVacationDelete();

setVacationNumber();

setVacationsScroll();

dayArray.forEach(element => {
      if (element.innerText == "0") {
            element.style.visibility = "hidden";
      }

      if (element.dataset.vacation == "true") {
            element.className = "calendar-day-vacation";        
      }

      if (element.dataset.weekday == "6" || element.dataset.weekday == "7") {
            element.className = "calendar-day-weekend";
      }
   
      if (element.dataset.sickleave == "true"){
            element.className = "calendar-day-sick";
      }

      if (element.dataset.holiday != "false"){
            element.className = "calendar-day-weekend";
      }

      element.onmouseover = function (e) {
            showTooltip(this);
      }

      element.onmouseleave = function () {
            hideTooltip(this);
      }

      function showTooltip(element) {
            toolTip.innerText = element.dataset.today;
            toolTip.style.left = event.pageX - 100 + 'px';
            toolTip.style.top = event.pageY - 50 + 'px';
            if (element.dataset.vacation == "true") {
                  toolTip.innerText = element.dataset.today + "  Ferien";
                  toolTip.style.border = '2px solid yellow';
            }
            if (element.dataset.holiday != "false"){
                  var holidayName = element.dataset.holiday.replaceAll ("_", " ");
                  while (holidayName.includes("_")) {
                        holidayName = holidayName.replace ("_", " ");
                  }
                  toolTip.innerText = element.dataset.today  + " " + holidayName;
                  toolTip.style.border = '2px solid yellow';
            }

            setTimeout(function(){
                  toolTip.style.visibility = "visible";
                  toolTip.style.opacity = '1';
            },500);
            
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

function assignDatePicker(){
      $('body').on('focus','.bio-value-datepicker input', function(){
            $(this).datepicker({
                  format: 'dd-MM-yyyy',
                  todayHighlight: true,
                  autoclose: true,
                  assumeNearbyYear: true,
                  clearBtn: true,
                  weekStart: 1
            });
        });
}

function setVacationsScroll(){
      vacationsPanel.on('mousewheel', function (e) {
            var neededCard = $("#vacations-scroll > .create-personal-vacation").last();
            var offset = neededCard.outerHeight(true);
            var initPos = vacationsPanel.scrollTop();

            e.preventDefault();
      
            if ( e.originalEvent.deltaY > 0 ) {
                  scrollTo(initPos + offset);
            } else if ( e.originalEvent.deltaY <= 0 ) {
                  scrollTo(initPos - offset);
            }
      }); 
}

function scrollTo(pixels, speed = 400) {
            vacationsPanel.animate(
            { scrollTop: pixels },
            speed, 
            'swing'
      );
} 

function scrollToLastVacation(){
      var allCards = $("#vacations-scroll > .create-personal-vacation");
      var templateCard = allCards.last();
      var offset = templateCard.outerHeight(true);
      var initPos = vacationsPanel.scrollTop();
      var pixels = allCards.length * offset;
      scrollTo(pixels);
}

function createVacationForm() {
      vacationsPanel.append($('#vacation').html());
      assignVacationDelete();
      setVacationNumber();
      scrollToLastVacation();
}

function assignVacationDelete() {
      var buttonDeleteVacation = document.getElementsByClassName("btn-del-vacation");
      var arrayDelete = Array.from(buttonDeleteVacation);
      arrayDelete.forEach(function (element) {
            element.onclick = function () {
                  var panel = element.parentNode;
                  var card = panel.parentNode.parentNode;
                  var cardHolder = card.parentNode;
                  var div = cardHolder.parentNode;
                  div.parentNode.removeChild(div);
            }
      });
}

function setVacationNumber() {
      var number = document.getElementsByClassName("vacation-number");
      var numberArray = Array.from(number);
      var counter = 1;
      numberArray.forEach(function (element) {
            element.innerText = counter++;
      });
}