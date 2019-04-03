$(".searchbar").keydown(function () {
      var employee = $(".employee-name");
      var employeeArray = Array.from(employee);
     

      employeeArray.forEach(element => {
            console.log(getAcronym(element.innerText));
            if (this.value.length > 1) {
                  if (element.innerText.toLowerCase().includes(this.value.toLowerCase())) {
                        console.log(element.innerText);
                        element.closest("tr").style.visibility = "visible";
                  } else {
                        element.closest("tr").style.visibility = "collapse";
                  }
            }
            else {
                  element.closest("tr").style.visibility = "visible";
            }
      });
})

function getAcronym(){

  
      return acronym;
}


