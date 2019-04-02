// Global variables
var vacationsPanel = $("#vacations-scroll");

var toolTip = document.createElement("div");
toolTip.className = "toolTip";
toolTip.style.position = "absolute";
toolTip.style.visibility = "hidden";
document.body.appendChild(toolTip);

initializeVacations();
initializeCalendar();

//Initializing methods
function initializeCalendar(){
      var day = document.getElementsByClassName('calendar-day');
      var dayArray = Array.from(day);
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
                  showTooltip(this, 500);
            }
      
            element.onmouseleave = function () {
                  hideTooltip(this);
            }
      
            var btnAddVacation = document.getElementById("btn-add-vacation");
            btnAddVacation.onclick = function () {
                  createVacationForm();
            }
      });
      var months = Array.from(document.getElementsByClassName("calendar-month"));
      months.forEach(element => {
            element.onmouseleave = function(e){
                  hideTooltip(this, 501);
            };
      });
      $('.input-daterange').datepicker({
            format: "dd-MM-yyyy",
            language: "de",
            clearBtn: true
      });
}

function initializeVacations(){
      assignVacationDelete();
      setVacationNumber();
      setVacationsScroll();
      checkVacationsAmount();
}

function showTooltip(element, timeout = 0) {
      toolTip.innerText = element.dataset.today;
      toolTip.style.left = event.pageX - 100 + 'px';
      toolTip.style.top = event.pageY - 50 + 'px';
      if (element.dataset.vacation == "true") {
            toolTip.innerText = element.dataset.today + "  Ferien";
            toolTip.style.border = '2px solid yellow';
      }
      if (element.dataset.holiday != "false"){
            var holidayName = element.dataset.holiday.replace ("_", " ");
            while (holidayName.includes("_")) {
                  holidayName = holidayName.replace ("_", " ");
            }
            toolTip.innerText = element.dataset.today  + " " + holidayName;
            toolTip.style.border = '2px solid yellow';
      }
      toolTip.style.zIndex = 100;

      setTimeout(function(){
            toolTip.style.visibility = "visible";
            toolTip.style.opacity = '1';
      },timeout);

}

function hideTooltip(element, timeout = 0) {
      setTimeout(() => {
            toolTip.style.visibility = "hidden";
            toolTip.style.border = 'none';
      }, timeout);
}

// Vacation cards methods
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

function scrollTo(pixels, speed = 400, callback = null) {
            vacationsPanel.animate(
            { scrollTop: pixels },
            speed, 
            'swing',
            callback
      );
} 

function scrollToLastVacation(){
      var allCards = $("#vacations-scroll > .create-personal-vacation");
      var templateCard = allCards.last();
      var offset = templateCard.outerHeight(true);
      var initPos = vacationsPanel.scrollTop();
      var pixels = allCards.length * offset;
      scrollTo(pixels, 400, function(){
                  vacationsPanel.children()
                  .last()
                  .find('input.bio-value')
                  .first()
                  .focus();
      });
}

function createVacationForm() {
      vacationsPanel.append($('#vacation').html());
      assignVacationDelete();
      setVacationNumber();
      $('.input-daterange').datepicker({
            format: "dd-MM-yyyy",
            language: "de",
            clearBtn: true
      });
      var noVacDiv =  $('.no-vacations-label');
      if(noVacDiv.length > 0){
            noVacDiv.animate({
                  marginTop: -noVacDiv.outerHeight()
            },400,'linear', function(){
                  noVacDiv.remove();
                  vacationsPanel.children()
                  .last()
                  .find('input.bio-value')
                  .first()
                  .focus();
            });
      }
      else{
            scrollToLastVacation();
      }
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
                  checkVacationsAmount();
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

function checkVacationsAmount(){
      $(function(){
            if($('.create-personal-vacation').length == 1){
                        vacationsPanel.append(createNoVacationsLabel());
                  }
      });
}

function createNoVacationsLabel(){

      let cardHeaderText = vacationsPanel.siblings('.create-personal-header').text();
      let labelText = 'Kein';
      if(cardHeaderText.toLowerCase() == 'ferien') {
            labelText += 'e';
      }
      labelText += ` ${cardHeaderText}`;
      let labelDiv = $('<div/>',{
            class:'no-vacations-label',
            text:labelText
      });
      return labelDiv;
}

//Additional methods 
function getFormattedDateString(date){
      return date.toLocaleString('en-us', {
            day: '2-digit',
            month: 'long' ,
            year: 'numeric'
      });
}