// mobile menu
const btn = document.querySelector("button.mobile-menu-button");
const menu = document.querySelector(".mobile-menu");
const toggleMenu = document.querySelector(".toggleMenu");
const form = document.getElementById("form");
const nin = document.getElementById("nin");
const nimc = document.querySelector(".nimc");
const emailPhone = document.querySelector(".email-phone");

// mobile menu event listeners
btn.addEventListener("click", () => {
  menu.classList.toggle("hidden");
});

function toggle() {
  toggleMenu.classList.toggle("hidden");
}

function nimcc() {
  form.classList.add("hidden");
  nin.classList.remove("hidden");
  emailPhone.classList.remove("hidden");
  nimc.classList.add("hidden");
}

function phoneEmail() {
  form.classList.remove("hidden");
  nin.classList.add("hidden");
  emailPhone.classList.add("hidden");
  nimc.classList.remove("hidden");
}
