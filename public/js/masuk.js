const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

let currentIndex = 0;
let interval;
const intervalTime = 5000; // Ubah angka ini sesuai dengan interval waktu yang diinginkan (dalam milidetik).

function moveSlider() {
  clearInterval(interval);

  let index = this.dataset.value;
  currentIndex = index - 1;

  let currentImage = document.querySelector(`.img-${index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

  bullets.forEach((bull) => bull.classList.remove("active"));
  this.classList.add("active");

  startCarousel();
}

function moveNext() {
  currentIndex = (currentIndex + 1) % bullets.length;
  moveSlider.call(bullets[currentIndex]);
}

function startCarousel() {
  interval = setInterval(moveNext, intervalTime);
}

bullets.forEach((bullet) => {
  bullet.addEventListener("click", moveSlider);
});

startCarousel();

inputs.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
});

function lihatPassword(inputId, eyeIconClass) {
  const passwordInput = document.getElementById(inputId);
  const eyeIcon = document.querySelector(`.${eyeIconClass}`);

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");
  } else {
    passwordInput.type = "password";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash");
  }
}
