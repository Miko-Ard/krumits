document.addEventListener("DOMContentLoaded", function () {
  const profileDropdownContainer = document.getElementById("profileDropdownContainer");
  const dropdownMenu = document.getElementById("dropdownMenu");
  const menuButton = document.getElementById("menuButton");
  const sidebar = document.getElementById("sidebar");
  const backButton = document.getElementById("backButton");

  profileDropdownContainer.addEventListener("click", function (event) {
    event.stopPropagation();
    dropdownMenu.classList.toggle("show");
  });

  window.addEventListener("click", function (event) {
    if (!profileDropdownContainer.contains(event.target) && !dropdownMenu.contains(event.target)) {
      dropdownMenu.classList.remove("show");
    }
  });

  menuButton.addEventListener("click", function (e) {
    e.preventDefault();
    sidebar.classList.add("show");
    dropdownMenu.classList.remove("show");
  });

  backButton.addEventListener("click", function (e) {
    e.preventDefault();
    sidebar.classList.remove("show");
  });
});
