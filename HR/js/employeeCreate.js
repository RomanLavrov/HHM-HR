var upload = document.getElementById("imageUpload");
//var visitTemplate = document.getElementById("visitTemplate");


upload.onchange = function () {
    var fileName = this.value;
    var index = fileName.lastIndexOf("\\");

    document.getElementById("fileNameLabel").innerText = fileName.substring(index + 1);
}

$("#btnAddVisit").click(function () {
    var listVisit = document.getElementsByClassName("btn btn-danger");
    var visitCounter = listVisit.length-1;
    visitCounter++;
    console.log(visitCounter);

    var template = $("#visitTemplate").clone();
    template.css('visibility', 'visible');
    var inputList = template.find("input");
    
    for (let index = 0; index < inputList.length; index++) {

        console.log();

        inputList[index].setAttribute("name", inputList[index].name.substring(0, inputList[index].name.lastIndexOf('_')+1) + visitCounter+"]");
        //inputList[index].name = inputList[index].name + visitCounter;
        console.log(inputList[index]);
    }

    $("#visitPlaceholder").append(template);
});


function DeleteVisit(btn) {
    console.log($(btn).closest(".create-personal-short").remove());

}