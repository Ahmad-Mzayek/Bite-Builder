// DOM.
const elements = {
  overlay: document.querySelector("#overlay"),
  themeIcon: document.querySelector("#theme-icon"),
  loginPopup: document.querySelector("#login-popup"),
  signupPopup: document.querySelector("#signup-popup"),
  showLoginButton: document.querySelector("#show-login-button"),
  closeLoginSvg: document.querySelector("#close-login-popup-svg"),
  showSignupButton: document.querySelector("#show-signup-button"),
  themeSwitchButton: document.querySelector("#theme-switch-button"),
  loginSignupButton: document.querySelector("#login-signup-button"),
  closeSignupSvg: document.querySelector("#close-signup-popup-svg"),
  resetPasswordButton: document.querySelector("#reset-password-button"),
  forgotPasswordPopup: document.querySelector("#forgot-password-popup"),
  closeForgotPasswordSvg: document.querySelector("#close-forgot-password-popup-svg")
};

// Utility Functions.
const toggleVisibility = (element, show) => {
  element.classList.toggle("hidden", !show);
  element.classList.toggle("flex", show);
};

const switchPopup = (popupToShow, popupToHide) => {
  toggleVisibility(popupToHide, false);
  toggleVisibility(popupToShow, true);
};

// Event Handlers.
elements.themeSwitchButton.addEventListener("click", () => {
  const isLight = document.body.classList.toggle("light");
  document.body.classList.toggle("dark", !isLight);
  elements.themeIcon.src = isLight ? "../../assets/dark-icon.png" : "../../assets/light-icon.png";
});

elements.loginSignupButton.addEventListener("click", () => {
  toggleVisibility(elements.overlay, true);
  toggleVisibility(elements.loginPopup, true);
});

elements.closeSignupSvg.addEventListener("click", () => {
  toggleVisibility(elements.overlay, false);
  toggleVisibility(elements.signupPopup, false);
});

elements.closeLoginSvg.addEventListener("click", () => {
  toggleVisibility(elements.overlay, false);
  toggleVisibility(elements.loginPopup, false);
});

elements.closeForgotPasswordSvg.addEventListener("click", () => {
  toggleVisibility(elements.forgotPasswordPopup, false);
  elements.loginPopup.classList.replace("z-9", "z-20");
  elements.closeLoginSvg.classList.remove("pointer-events-none");
});

elements.showLoginButton.addEventListener("click", () => {
  switchPopup(elements.loginPopup, elements.signupPopup);
});

elements.showSignupButton.addEventListener("click", () => {
  switchPopup(elements.signupPopup, elements.loginPopup);
});

elements.resetPasswordButton.addEventListener("click", () => {
  toggleVisibility(elements.forgotPasswordPopup, true);
  elements.loginPopup.classList.replace("z-20", "z-9");
  elements.closeLoginSvg.classList.add("pointer-events-none");
});