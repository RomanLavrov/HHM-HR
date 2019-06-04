$(".searchbar").keydown(function () {
            var employee = $(".employee-name");
            var employeeArray = Array.from(employee);

            employeeArray.forEach(element => {
                        if (this.value.length > 2) {
                              if (element.innerText.toLowerCase().includes(this.value.toLowerCase())) {
                                    //console.log(element.innerText);
                                    element.closest("tr").style.visibility = "visible";
                              } else {
                                    element.closest("tr").style.visibility = "collapse";
                              }
                        } else
                              element.closest("tr").style.visibility = "visible";
                  }
            );
});

$(document).ready(calculateExpirience);


function calculateExpirience(){
      var today = new Date().toJSON().slice(0,10).replace(/-/g,'/');
      var experienceDiv = Array.from($(".experience"));
      experienceDiv.forEach(element => {
            element.innerText;
            var table = element.closest("tbody");
            var startDate = new Date($(table).find(".workStartDate").text());
            var Years = (new Date().getFullYear() - startDate.getFullYear())
            if (Years>1){
                  element.innerText = Years + " Jahre";
            }
            if (Years < 1 ){
                  element.innerText = monthDiff(startDate, new Date())+1 + " Monate";
            }


          
      });      
}

function monthDiff(d1, d2) {
      var months;
      months = (d2.getFullYear() - d1.getFullYear()) * 12;
      months -= d1.getMonth() + 1;
      months += d2.getMonth();
      console.log(months <= 0 ? 0 : months);
          return months <= 0 ? 0 : months;
  }