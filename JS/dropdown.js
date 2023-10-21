function toggleMenu() {
  const menu = document.getElementById("menu");
  menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

// Close the menu if the user clicks outside of it
window.onclick = function(event) {
  const menu = document.getElementById("menu");
  if (event.target === menu) {
    menu.style.display = "none";
  }
};
