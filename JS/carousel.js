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

  if (index === images.length - 1) {
    iframe.style.display = "block";
  } else {
    iframe.style.display = "none";
  }
}

showImage(currentIndex);

function nextImage() {
  currentIndex = (currentIndex + 1) % (images.length + 1);
  showImage(currentIndex);
}

function prevImage() {
  currentIndex = (currentIndex - 1 + (images.length + 1)) % (images.length + 1);
  showImage(currentIndex);
}

// Event listeners for next and previous buttons
nextBtn.addEventListener("click", nextImage);
prevBtn.addEventListener("click", prevImage);
