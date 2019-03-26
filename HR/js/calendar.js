var day = document.getElementsByClassName('calendar-day');

var dayArray = Array.from(day);

var toolTip = document.createElement("div");
toolTip.className = "toolTip";
toolTip.style.position = "absolute";

toolTip.style.visibility = "hidden";
document.body.appendChild(toolTip);

assignVacationDelete();

setVacationNumber();

setVacationsScroll();

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

      if (element.dataset.sickleave == "true"){
            element.className = "calendar-day-sick";
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

function setVacationsScroll(){
      $('.vacations-scroll').on('mousewheel', function (e) {
            var neededCard = $(".create-personal-vacation").first();
            var offset = neededCard.outerHeight(true);
            var initPos = $('.vacations-scroll').scrollTop();
      
            e.preventDefault();
      
            if ( e.originalEvent.deltaY > 0 ) {
                  scrollThere(initPos + offset, 250);
            } else if ( e.originalEvent.deltaY <= 0 ) {
                  scrollThere(initPos - offset, 250);
            }
          
      }); 
}

function scrollThere(pixels, speed) {
      $('.vacations-scroll').stop().animate(
            { scrollTop: pixels },
            speed, 
            'swing' 
      );
} 

function createVacationForm() {
      $("#vacation-parent").append($('#vacation').html());
      assignVacationDelete();
      setVacationNumber();
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