function showPosterPreview() {
      const imageUrl = document.getElementById("poster").value;
      const imagePreview = document.querySelector("#image-preview img");
      if (imageUrl) {
        imagePreview.src = imageUrl;
        imagePreview.style.display = "block";
      } else {
        imagePreview.style.display = "none";
      }
    }
function showImagePreview() {
      const imageUrl = document.getElementById("image").value;
      const imagePreview = document.querySelector("#image-preview2 img");
      if (imageUrl) {
        imagePreview.src = imageUrl;
        imagePreview.style.display = "block";
      } else {
        imagePreview.style.display = "none";
      }
    }