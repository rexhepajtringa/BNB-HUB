function upload_file(e) {
    e.preventDefault();
    ajax_file_upload(e.dataTransfer.files);
}
  
function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        files = document.getElementById('selectfile').files;
        ajax_file_upload(files);
    };  
}
  

function ajax_file_upload(files_obj) {
    if(files_obj != undefined) {
        var form_data = new FormData();
        for(i=0; i<files_obj.length; i++) {
            form_data.append('file[]', files_obj[i]);
        }
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "ajax.php", true);
        xhttp.onload = function(event) {
            if (xhttp.status == 200) {
                const imageContainer = document.getElementById("picturesAdded");

                for (let i = 0; i < files_obj.length; i++) {
                    const file = files_obj[i];

                    if (file.type.startsWith("image/")) {
                        let reader = new FileReader();

                        reader.onload = function(event) {
                            let img = document.createElement("img");

                            img.src = event.target.result;
                            img.width = 100;
                            img.classList.add("grid-item");
                            
                            
                            imageContainer.appendChild(img);
                            img.addEventListener("click", deleteImage);

                        };

                        reader.readAsDataURL(file);
                    }
                }
            } else {
                alert("Error " + xhttp.status + " occurred when trying to upload your file.");
            }
        }
        xhttp.send(form_data);
    }
}

function deleteImage(event) {
   
    let img = event.target;
    const imageContainer = document.getElementById("picturesAdded");
    
    imageContainer.removeChild(img);

    //  AJAX call to delete the image from the database
    let fileName = img.dataset.fileName;
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "delete_image.php", true);
    xhttp.onload = function() {
        if (xhttp.status == 200) {
            console.log("Image deleted successfully");
        } else {
            console.log("Error deleting image");
        }
    };
    xhttp.send("fileName=" + fileName);
}
