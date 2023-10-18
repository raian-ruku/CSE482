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
    // Show the trailer on the second page
    showImage(images.length);
  } else if (currentIndex === 2) {
    // Show the poster on the third page
    showImage(0);
  } else {
    // Show the image on the first page
    showImage(0);
    currentIndex = 0;
  }
}

function prevImage() {
  currentIndex--;
  if (currentIndex === -1) {
    // Show the poster on the third page
    showImage(0);
    currentIndex = 2;
  } else if (currentIndex === 0) {
    // Show the image on the first page
    showImage(0);
  } else {
    // Show the trailer on the second page
    showImage(images.length);
  }
}

// Event listeners for next and previous buttons
nextBtn.addEventListener("click", nextImage);
prevBtn.addEventListener("click", prevImage);