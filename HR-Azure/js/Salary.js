// SheetJS https://github.com/SheetJS
$.getScript("https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.6/xlsx.core.min.js")
$.getScript("https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.js")

document.getElementById('salaryFile').addEventListener('change', processFile, false);

function processFile(evt) {
      var file = evt.target.files[0];
      console.log(file);

      var reader = new FileReader();
      reader.readAsBinaryString(file);
      

      reader.onload = function (e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
              type: 'binary'
            });
            var json_object;
            console.log(workbook);
            workbook.SheetNames.forEach(element => {
                  console.log(element);
                  var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[element]);
                  console.log(XL_row_object);
                   json_object = JSON.stringify(XL_row_object);
                  
                  console.log(json_object);
            });  
            
            var salary = JSON.parse(json_object);

            salary.forEach(element => {
                  console.log(element.Id);
                  console.log(element.Name);
                  console.log(element.LastName);
                  console.log(element.Salary);

                  console.log($('#'+element.LastName+element.Name).html(element.Salary + " " + element.Currency));
            });           
      }  

}


