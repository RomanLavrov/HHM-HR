// Global variables
var vacationsPanel = $("#vacations-scroll");
var toolTip = document.createElement("div");

main();

function main(){
      toolTip.className = "toolTip";
      toolTip.style.position = "absolute";
      toolTip.style.visibility = "hidden";
      document.body.appendChild(toolTip);
      
      initializeVacations();
      initializeCalendar();
}

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
                  //element.className = "calendar-day-weekend-vacation";
            }
         
            if (element.dataset.sickleave == "true"){
                  element.className = "calendar-day-sick";
            }
      
            if (element.dataset.holiday != "false"){
                  element.className = "calendar-day-weekend";
            }

            if (element.dataset.vacation == "true" && (element.dataset.weekday == "6" || element.dataset.weekday == "7")){
                  element.className = "calendar-day-weekend-vacation";
            }

            if(element.dataset.vacation == "true" && element.dataset.holiday !== 'false'){
                  element.className = "calendar-day-holiday-vacation";
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
      assignDurationChange();
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
      var counterPeriod = $(".input-daterange.input-group").length;

      counterPeriod = counterPeriod + 1;
      console.log(counterPeriod);
      var newVacation = $('#vacation');
      
      newVacation.find("#StartDate").attr('name', 'Start' + counterPeriod);
      newVacation.find("#EndDate").attr('name', 'End' + counterPeriod);
      console.log(newVacation.html());
      var newPanel = vacationsPanel.append($('#vacation').html());
      //console.log(newPanel.html());
      

      //console.log(newPanel.find("#StartDate").attr('name'));
      //console.log(newPanel.find("#EndDate").attr('name'));


      assignVacationDelete();
      setVacationNumber();
      assignDurationChange();

      $('.input-daterange').datepicker({
            format: "dd-MM-yyyy",
            language: "de",
            clearBtn: true,
            weekStart: 1
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

function getDates(startDate, stopDate) {
      var dateArray = new Array();
      var currentDate = startDate;
      while (currentDate <= stopDate) {
          dateArray.push(new Date (currentDate));
          currentDate = currentDate.addDays(1);
      }
      return dateArray;
  }

function assignDurationChange() {
      $('.input-daterange').change(function () {
            let duration = $(this.parentNode).find('.bio-value-duration')[0];
            let startInput = $(this.parentNode).find('.bio-value')[0];
            let endInput = $(this.parentNode).find('.bio-value')[1];

            let startDate = new Date(startInput.value);
            let endDate = new Date(endInput.value);

            let diffTime = Math.abs(endDate.getTime() - startDate.getTime());
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            if(isNaN(diffDays))
                  diffDays = -1;
            //duration.innerText = diffDays + 1 + " Tage";
            //console.log("Diff days" + diffDays);
            //console.log("Start" + startDate);
            //console.log("End" + endDate);

            var holidays = $(".calendar-day-weekend").toArray();
            var holidaysVacation = $(".calendar-day-holiday-vacation").toArray();
            holidays = holidays.concat(holidaysVacation);

            //console.log(holidaysVacation);

            var holidaysDates = [];
            holidays.forEach(element => {
                  if(element.dataset.holiday!== 'false' && element.dataset.holiday!== undefined  && element.dataset.holiday!== "" && element.dataset.today!== undefined ){
                   //console.log(element);
                   holidaysDates.push(new Date(element.dataset.today));
                  }
            });

            //console.log(startDate);
            //console.log(endDate);

            var workDayDuration = 0;
            var numberHolidays = 0;
            var vacDay = new Date();
            vacDay = startDate;
            for (let i = 0; i <= diffDays; i++) {                  
                 
                  //console.log(i + " " + vacDay);
                  
                  if (vacDay.getDay()!=6 && vacDay.getDay()!=0){                                            
                        workDayDuration++;
                  }

                  holidaysDates.forEach(element => {
                        //console.log(element);
                        //console.log(vacDay);
                        //console.log(element);
                        //console.log(vacDay.getDate() + ":" + vacDay.getMonth());
                        //console.log(element.getDate() + ":" + element.getMonth());
                        //console.log(" ");

                        
                        if ((vacDay.getMonth() === element.getMonth()) && (vacDay.getDate() === element.getDate())){
                            
                              //console.log("Vacation" + vacDay);
                              //console.log("Holiday" + element);
                              numberHolidays++;
                        }
                  });
                 
                  vacDay.setDate(vacDay.getDate() + 1);
            }
            console.log('Start: '+ startDate + " EndDate:" + endDate);
            console.log("WorkDays:" + workDayDuration);
            console.log("Holidays: " + numberHolidays);
            //console.log(numberHolidays);
            duration.innerText = workDayDuration-numberHolidays + " Tage";
      });
}
//Additional methods 
function getFormattedDateString(date){
      return date.toLocaleString('en-us', {
            day: '2-digit',
            month: 'long' ,
            year: 'numeric'
      });
}