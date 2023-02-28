const barBtn = document.querySelector(".bar-btn");
const closeBtn = document.querySelector(".close-btn");
const menus = document.querySelector(".menu");

barBtn.addEventListener("click", () => {
    menus.style.display = "block";
  closeBtn.style.display = "block";
  barBtn.style.display = "none";
});

closeBtn.addEventListener("click", () => {
    menus.style.display = "none";
  closeBtn.style.display = "none";
  barBtn.style.display = "block";
});