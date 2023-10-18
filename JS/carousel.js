const carousel = document.querySelector(".carousel-container");
const images = document.querySelectorAll(".carousel-image");
const iframe = document.querySelector(".carousel-iframe");
const prevBtn = document.querySelector(".prev-btn");
const nextBtn = document.querySelector(".next-btn");

let currentIndex = 0;

function showImage(index) {
  images.forEach((image, i) => {
    if (i === index) {
      image.style.display = "block";
    } else {
      image.style.display = "none";
    }
  });

  if (index === images.length) {
    iframe.style.display = "block";
  } else {
    iframe.style.display = "none";
  }
}

showImage(currentIndex);

function nextImage() {
  currentIndex++;
  if (currentIndex === 1) {
    
    showImage(images.length);
  } else if (currentIndex === 2) {
    
    showImage(0);
  } else {
    
    showImage(0);
    currentIndex = 0;
  }
}

function prevImage() {
  currentIndex--;
  if (currentIndex === -1) {
    
    showImage(0);
    currentIndex = 2;
  } else if (currentIndex === 0) {
    
    showImage(0);
  } else {
    
    showImage(images.length);
  }
}


nextBtn.addEventListener("click", nextImage);
prevBtn.addEventListener("click", prevImage);x