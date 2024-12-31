// ---- DOM Elements --------------------------------------------------------------------------------------------------------------------------------
const elements = {
  themeIcon: document.querySelector("#theme-icon"),
  loginPopup: document.querySelector("#login-popup"),
  signupPopup: document.querySelector("#signup-popup"),
  backgroundOverlay: document.querySelector("#overlay"),
  showLoginButton: document.querySelector("#show-login-button"),
  showSignupButton: document.querySelector("#show-signup-button"),
  themeSwitchButton: document.querySelector("#theme-switch-button"),
  loginSignupButton: document.querySelector("#login-signup-button"),
  forgotPasswordPopup: document.querySelector("#reset-password-popup"),
  closeLoginPopupSVG: document.querySelector("#close-login-popup-svg"),
  resetPasswordButton: document.querySelector("#reset-password-button"),
  closeSignupPopupSVG: document.querySelector("#close-signup-popup-svg"),
  closeForgotPasswordPopupSVG: document.querySelector("#close-reset-password-popup-svg")
};

// ---- Utility Functions ---------------------------------------------------------------------------------------------------------------------------
const addClass = (element, ...classes) => element.classList.add(...classes);
const removeClass = (element, ...classes) => element.classList.remove(...classes);
const toggleClass = (element, ...classes) => element.classList.toggle(...classes);
const replaceClass = (element, oldClass, newClass) => element.classList.replace(oldClass, newClass);

// ---- Switch Theme --------------------------------------------------------------------------------------------------------------------------------
elements.themeSwitchButton.addEventListener("click", () => {
  elements.themeIcon.src = document.body.classList.contains("light") ? "../../assets/light-icon.png" : "../../assets/dark-icon.png";
  toggleClass(document.body, "light", "dark");
});

// ---- Show Login/Signup Popup ---------------------------------------------------------------------------------------------------------------------
elements.loginSignupButton.addEventListener("click", () => {
  toggleClass(elements.backgroundOverlay, "hidden");
  toggleClass(elements.loginPopup, "hidden", "flex");
});

// ---- Close Popups --------------------------------------------------------------------------------------------------------------------------------
elements.closeSignupPopupSVG.addEventListener("click", () => {
  addClass(elements.signupPopup, "hidden");
  removeClass(elements.signupPopup, "flex");
  addClass(elements.backgroundOverlay, "hidden");
});

elements.closeLoginPopupSVG.addEventListener("click", () => {
  addClass(elements.loginPopup, "hidden");
  removeClass(elements.loginPopup, "flex");
  addClass(elements.backgroundOverlay, "hidden");
});

elements.closeForgotPasswordPopupSVG.addEventListener("click", () => {
  addClass(elements.forgotPasswordPopup, "hidden");
  removeClass(elements.forgotPasswordPopup, "flex");
  replaceClass(elements.loginPopup, "z-9", "z-20");
  removeClass(elements.closeLoginPopupSVG, "pointer-events-none");
});

// ---- Toggle Between Login and Signup Popups ------------------------------------------------------------------------------------------------------
elements.showLoginButton.addEventListener("click", () => {
  addClass(elements.signupPopup, "hidden");
  removeClass(elements.signupPopup, "flex");
  removeClass(elements.loginPopup, "hidden");
  addClass(elements.loginPopup, "flex");
});

elements.showSignupButton.addEventListener("click", () => {
  addClass(elements.loginPopup, "hidden");
  removeClass(elements.loginPopup, "flex");
  addClass(elements.signupPopup, "flex");
  removeClass(elements.signupPopup, "hidden");
});

// ---- Reset Password Popup ------------------------------------------------------------------------------------------------------------------------
elements.resetPasswordButton.addEventListener("click", () => {
  addClass(elements.forgotPasswordPopup, "flex");
  removeClass(elements.forgotPasswordPopup, "hidden");
  replaceClass(elements.loginPopup, "z-20", "z-9");
  addClass(elements.closeLoginPopupSVG, "pointer-events-none");
});

// --------------------------------------------------------------------------------------------------------------------------------------------------