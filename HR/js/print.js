var checkboxes = $("input:checkbox").toArray();

$("#btn-select-employee").click(function () {

      checkboxes.forEach(element => {
            if (element.name.includes("Id")) {
                  if (element.checked == false) {
                        //element.checked = true;
                        element.click();
                  }
            }
      })
})

$("#btn-unselect-employee").click(function () {
      checkboxes.forEach(element => {
            if (element.name.includes("Id")) {
                  if (element.checked == true) {
                        element.click();
                        //element.checked = false;
                  }
            }
      })
})

$("#btn-select-categories").click(function(){
      
      checkboxes.forEach(element=>{
            if (!element.name.includes("Id")){
                  if (element.checked == false){
                        element.click();
                  }
            }
      })
});

$("#btn-unselect-categories").click(function(){
      
      checkboxes.forEach(element=>{
            if (!element.name.includes("Id")){
                  if (element.checked == true){
                        element.click();
                  }
            }
      })
});


checkboxes.forEach(element => {
      console.log(element);
      if (element.name.includes("Id")) {
            element.addEventListener("change", updateList);
      }

      if (element.name.includes("PersonalData")) {
            element.addEventListener("change", updatePersonalData);
      }

      switch (element.name) {
            case "PersonalData":
                  element.addEventListener("change", updatePersonalData);
                  break;

            case "Career":
                  element.addEventListener("change", updateCareer);
                  break;

            case "ForeignPassport":
                  element.addEventListener("change", updatePassportData);
                  break;
            case "Children":
                  element.addEventListener("change", updateChildrenData);
                  break;

            case "SwissVisit":
                  element.addEventListener("change", updateVisitData);
                  break;

            default:
                  break;
      }
});

function updatePersonalData() {
      if (this.checked) {
            ($(".col-md.print-personal")).removeClass("collapse");
      } else {
            $(".col-md.print-personal").addClass("collapse");
      }
}

function updateCareer() {
      if (this.checked) {
            ($(".print-career")).removeClass("collapse");
      } else {
            $(".print-career").addClass("collapse");
      }
}

function updatePassportData() {
      if (this.checked) {
            ($(".print-pass")).removeClass("collapse");
      } else {
            $(".print-pass").addClass("collapse");
      }
}

function updateChildrenData() {
      if (this.checked) {
            ($(".print-children")).removeClass("collapse");
      } else {
            $(".print-children").addClass("collapse");
      }
}

function updateVisitData() {
      if (this.checked) {
            ($(".print-visit")).removeClass("collapse");
      } else {
            $(".print-visit").addClass("collapse");
      }
}



function updateList() {
      if (this.name.includes("Id") && !this.checked) {
            console.log($("#" + this.value + ".print-employee").addClass("collapse"));
      } else {
            $("#" + this.value + ".print-employee").removeClass("collapse");
      }

      /*
      if (this.name.includes("PersonalData") && !this.checked){
            console.log($(".print-personal")).addClass("collapse");
      }
      else{
            $(".print-personal").removeClass("collapse");
      }

      if (this.name.includes("Career") && this.checked){
            console.log($(".print-career")).addClass("collapse");
      }
      else{
            $(".print-career").removeClass("collapse");
      }*/
}