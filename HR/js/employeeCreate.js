var upload = document.getElementById("imageUpload");

upload.onchange = function(){
    var fileName = this.value;
    var index = fileName.lastIndexOf("\\");
  
    document.getElementById("fileNameLabel").innerText = fileName.substring(index+1);
}

