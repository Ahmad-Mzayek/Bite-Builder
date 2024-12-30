const backgroundOverlay = document.querySelector("#overlay");

const themeSwitchButton = document.querySelector("#theme-switch-button");

const themeIcon = document.querySelector("#theme-icon");

const loginPopup = document.querySelector("#login-popup");
const signupPopup = document.querySelector("#signup-popup");
const resetPasswordPopup = document.querySelector("#reset-password-popup");

const loginSignupButton = document.querySelector("#login-signup-button");

const closeLoginPopupSVG = document.querySelector("#close-login-popup-svg");
const closeSignupPopupSVG = document.querySelector("#close-signup-popup-svg");
const closeResetPasswordPopupSVG = document.querySelector("#close-reset-password-popup-svg");

const showLoginButton = document.querySelector("#show-login-button");
const showSignupButton = document.querySelector("#show-signup-button");

const resetPasswordButton = document.querySelector("#reset-password-button");

themeSwitchButton.addEventListener("click", () => {
  if (document.body.classList.contains("light")) themeIcon.src = "../../assets/light-icon.png";
  else themeIcon.src = "../../assets/dark-icon.png";

  document.body.classList.toggle("light");
  document.body.classList.toggle("dark");
});

loginSignupButton.addEventListener("click", () => {
  backgroundOverlay.classList.toggle("hidden");

  loginPopup.classList.toggle("hidden");
  loginPopup.classList.toggle("flex");
});

closeSignupPopupSVG.addEventListener("click", () => {
  signupPopup.classList.remove("flex");
  signupPopup.classList.add("hidden");
  backgroundOverlay.classList.add("hidden");
});

closeLoginPopupSVG.addEventListener("click", () => {
  loginPopup.classList.remove("flex");
  loginPopup.classList.add("hidden");

  backgroundOverlay.classList.add("hidden");
});

closeResetPasswordPopupSVG.addEventListener("click", () => {
  resetPasswordPopup.classList.remove("flex");
  resetPasswordPopup.classList.add("hidden");

  loginPopup.classList.replace("z-9", "z-20");

  closeLoginPopupSVG.classList.remove("pointer-events-none");
});

showLoginButton.addEventListener("click", () => {
  signupPopup.classList.remove("flex");
  signupPopup.classList.add("hidden");

  loginPopup.classList.remove("hidden");
  loginPopup.classList.add("flex");
});

showSignupButton.addEventListener("click", () => {
  loginPopup.classList.remove("flex");
  loginPopup.classList.add("hidden");

  signupPopup.classList.add("flex");
  signupPopup.classList.remove("hidden");
});

resetPasswordButton.addEventListener("click", () => {
  resetPasswordPopup.classList.add("flex");
  resetPasswordPopup.classList.remove("hidden");

  loginPopup.classList.replace("z-20", "z-9");

  closeLoginPopupSVG.classList.add("pointer-events-none");
});
