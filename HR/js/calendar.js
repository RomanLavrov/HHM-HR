var day = document.getElementsByClassName('calendar-day');

var dayArray = Array.from(day);
var vacationsPanel = $("#vacations-scroll");

var toolTip = document.createElement("div");
toolTip.className = "toolTip";
toolTip.style.position = "absolute";

toolTip.style.visibility = "hidden";
document.body.appendChild(toolTip);


$('document').ready(function(){
      var array = Array.from($('.bio-value-datepicker input'));
      array.forEach(element=>{
            element.onchange = onInputDateChanged;
      })
});

changeVacationDateFormat();

//assignDatePicker();

assignVacationDelete();

setVacationNumber();

setVacationsScroll();

//------------------------
cardInteraction();
dateSwap();
//------------------------

function dateSwap(){
    var input = document.getElementsByClassName("form-control");
    var inputArray = Array.from(input);
    inputArray.forEach(element=>{
          element.onchange = function(){
                alert(element.value);
          }
    })
}

function cardInteraction(){
      var card = document.getElementsByClassName("create-personal-vacation");
      var cardArray = Array.from(card);
      cardArray.forEach(element=>{
            console.log(element.childNodes);
      })
}

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
                  format: 'MM dd, yyyy',
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

function onInputDateChanged(input){
      input.value = '2019-01-01';
      // var vacationCard = $(this).closest('.create-personal-vacation');
      // var vacNum = vacationCard.get(0).dataset.vacationNumber;
      // var startInput = vacationCard.find(`input[name='Start${vacNum}']`);
      // var endInput = vacationCard.find(`input[name='End${vacNum}']`);
      // var startDate = startInput.datepicker('getDate');
      // var endDate = endInput.datepicker('getDate');
      // startInput.value = endDate.toLocaleString();
      // if(startDate > endDate)
      // {
      //       // startInput.value = getFormattedDateString(endDate);
      //       // endInput.value = getFormattedDateString(startDate);
            
      //       startInput.datepicker({
      //             setDate: endDate,
      //             altFormat: 'MM dd, yyyy'
      //       });
      //       endInput.datepicker({
      //             setDate: startDate,
      //             altFormat: 'MM dd, yyyy'
      //       });

      //       // startInput.datepicker('setDate', endDate);
      //       // endInput.datepicker('setDate', startDate);
      // }
}

function changeVacationDateFormat(){
      var array = Array.from($('.bio-value-datepicker input'));
      array.forEach(element=>{
            var dateStr = element.value;
            var date = new Date(dateStr);
            var dateValue = getFormattedDateString(date);
            element.value = dateValue;
            //element.value = `${date.getDay()}-${date.getMonth()}-${date.getFullYear()}`;
      })
}

function getFormattedDateString(date){
      return date.toLocaleString('en-us', {
            day: '2-digit',
            month: 'long' ,
            year: 'numeric'
      });
}