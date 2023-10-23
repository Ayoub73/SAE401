function triggerClick(id) {
    document.querySelector(id).click();
}

function displayImage(e, id) { 
    if (e.files[0]){
        var reader = new FileReader();

        reader.onload = function(e) {
            document.querySelector(id).setAttribute('src', e.target.result);    
        }
        reader.readAsDataURL(e.files[0]);
    }
}