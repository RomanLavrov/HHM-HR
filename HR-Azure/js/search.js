$(".searchbar").on("change paste keyup", function () {
      var employee = $(".employee-name");
      var employeeArray = Array.from(employee);

      employeeArray.forEach(element => {
     
            if (element.innerText.toLowerCase().includes(this.value.toLowerCase())){
                  //console.log(element.innerText);

                  
                  element.closest("#container").className = "";
            }
            else{
                  element.closest("#container").className = "collapse";
            }           
      });
});

$(document).ready(calculateExpirience);

$(".employee-name").click(function(){
     /* console.log (this.parentNode.submit());*/
});

function calculateExpirience() {
      var today = new Date().toJSON().slice(0, 10).replace(/-/g, '/');
      var experienceDiv = Array.from($(".experience"));
      //console.log(experienceDiv);
      experienceDiv.forEach(element => {
            //console.log(element.innerText);
            var table = element.closest(".col-md.main-personal-data");
            //console.log(table);
            var stringDate = (($(table).find(".col-md.bio-data.workStartDate").text()).replace(/\s/g, ''));
            //console.log(stringDate);
            var splitDate = stringDate.split("-");
            var startDate = new Date(splitDate[2] + "-" + splitDate[1] + "-" + splitDate[0]);
            //console.log(startDate);
            var Years = (new Date().getFullYear() - startDate.getFullYear())
            
            if (Years <= 1) {
                  var months = monthDiff(startDate, new Date());
                  if (months< 12){
                        element.innerText = monthDiff(startDate, new Date()) + 1 + " Monate";
                  }
                  else{
                        element.innerText = "1 Jahre";
                  }
            }

            if (Years > 1) {
                  element.innerText = Years + " Jahre";
            }

            //console.log(stringDate, Years )
      });
}

function monthDiff(d1, d2) {
      var months;
      months = (d2.getFullYear() - d1.getFullYear()) * 12;
      months -= d1.getMonth() + 1;
      months += d2.getMonth();
      //console.log(months <= 0 ? 1 : months);
      return months <= 0 ? 0 : months;
}

for (let index = 0; index < $(".employee-name").length; index++) {
     switch ($(".employee-name")[index].dataset.status) {
           case "Arbeitet":
                  ($(".employee-name")[index].style.background = "#23588c");
                 break;
                 case "Ausgetreten":
                 ($(".employee-name")[index].style.background = "#da3931");
                 break;
                 case "Mutterschlafsurlaub":
                 ($(".employee-name")[index].style.background = "#e6530b");
                 break;
           default:
                 break;
     }
      
}

for (let index = 0; index < $(".status").length; index++) {
      switch ($(".status")[index].dataset.status) {
            case "Arbeitet":
                  $(".status")[index].classList.add('employee-status-work');
                  break;

                  case "Ausgetreten":
                  $(".status")[index].classList.add('employee-status-retired');
                  break;

                  case "Mutterschlafsurlaub":
                  $(".status")[index].classList.add('employee-status-maternity');
                  break;

            default:
                  
                  break;
      }     
}