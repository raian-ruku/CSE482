const dropArea = document.getElementById("drop");
const inputFile = document.getElementById("image");
const imageViewer = document.getElementById("image-viewer");

inputFile.addEventListener("change", uploadImage);

function uploadImage(){
let imgLink = URL.createObjectURL(inputFile.files[0]);
imageViewer.style.backgroundImage = `url(${imgLink})`;
imageViewer.textContent = "";

}

dropArea.addEventListener("dragover", function(event){
event.preventDefault();
});

dropArea.addEventListener("drop", function(event){
event.preventDefault();
inputFile.files = event.dataTransfer.files;
uploadImage();
});