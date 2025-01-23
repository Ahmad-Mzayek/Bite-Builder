// DOM.
const elements = {
  overlay: document.querySelector("#overlay"),
  loginForm: document.querySelector("#login-form"),
  signupForm: document.querySelector("#signup-form"),
  loginPopup: document.querySelector("#login-popup"),
  signupPopup: document.querySelector("#signup-popup"),
  showLoginButton: document.querySelector("#show-login-button"),
  closeLoginSvg: document.querySelector("#close-login-popup-svg"),
  showSignupButton: document.querySelector("#show-signup-button"),
  themeSwitchButton: document.querySelector("#theme-switch-button"),
  loginSignupButton: document.querySelector("#login-signup-button"),
  closeSignupSvg: document.querySelector("#close-signup-popup-svg"),
  showPasswordIcon: document.querySelectorAll(".show-password-icon"),
  passwordInput: document.querySelectorAll(".password-input"),
  resetPasswordButton: document.querySelector("#reset-password-button"),
  forgotPasswordPopup: document.querySelector("#forgot-password-popup"),
  loginErrorContainer: document.querySelector("#login-error-container"),
  signupErrorContainer: document.querySelector("#signup-error-container"),
  confirmPasswordInput: document.querySelectorAll(".confirm-password-input"),
  showPasswordIconTrue: document.querySelectorAll(".show-password-icon-true"),
  signupSuccessContainer: document.querySelector("#signup-success-container"),
  showPasswordIconFalse: document.querySelectorAll(".show-password-icon-false"),
  showConfirmPasswordIcon: document.querySelectorAll(".show-confirm-password-icon"),
  closeForgotPasswordSvg: document.querySelector("#close-forgot-password-popup-svg"),
  showConfirmPasswordIconTrue: document.querySelectorAll(".show-confirm-password-icon-true"),
  showConfirmPasswordIconFalse: document.querySelectorAll(".show-confirm-password-icon-false"),
};

// UI Theme Switcher Variable.
let themeSwitch = true;

// Utility Functions.
const toggleVisibility = (element, show) => {
  element.classList.toggle("hidden", !show);
  element.classList.toggle("flex", show);
};

const switchElements = (popupToShow, popupToHide) => {
  toggleVisibility(popupToHide, false);
  toggleVisibility(popupToShow, true);
};

// Event Handlers.
elements.themeSwitchButton.addEventListener("click", () => {
  themeSwitch = !themeSwitch;
  if (themeSwitch) {
    const isDark = document.body.classList.toggle("dark");
    document.body.classList.toggle("light", !isDark);
  }
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
  switchElements(elements.loginPopup, elements.signupPopup);
});

elements.showSignupButton.addEventListener("click", () => {
  switchElements(elements.signupPopup, elements.loginPopup);
});

elements.resetPasswordButton.addEventListener("click", () => {
  toggleVisibility(elements.forgotPasswordPopup, true);
  elements.loginPopup.classList.replace("z-20", "z-9");
  elements.closeLoginSvg.classList.add("pointer-events-none");
});

elements.loginForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const loginFormData = new FormData(event.target);
  try {
    const response = await fetch("../../controllers/login_controller/login_controller_main.php", {
      method: "POST",
      body: loginFormData,
    });
    const result = await response.json();
    window.location;
    if (result.status === "success") {
      toggleVisibility(elements.loginErrorContainer, false);
      alert(result.message);
      window.location.href = "../meal_page/meal_page.php";
    } else {
      elements.loginErrorContainer.innerHTML = result.message;
      toggleVisibility(elements.loginErrorContainer, true);
    }
  } catch (error) {
    console.error("Internal server error: " + error.message);
  }
});

elements.signupForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const signupFormData = new FormData(event.target);

  try {
    const response = await fetch("../../controllers/signup_controller/signup_controller_main.php", {
      method: "POST",
      body: signupFormData,
    });
    const result = await response.json();
    if (result.status === "success") {
      toggleVisibility(elements.signupErrorContainer, false);
      switchElements(elements.loginPopup, elements.signupPopup);
      toggleVisibility(elements.signupSuccessContainer, true);
    } else {
      elements.signupErrorContainer.innerHTML = result.message;
      toggleVisibility(elements.signupErrorContainer, true);
    }
  } catch (error) {
    console.error("Internal server error: " + error.message);
  }
});

elements.showPasswordIcon.forEach((icon) => {
  icon.addEventListener("click", () => {
    event.stopPropagation();

    if (elements.showPasswordIconTrue[0].classList.contains("flex")) {
      switchElements(elements.showPasswordIconFalse[0], elements.showPasswordIconTrue[0]);
      switchElements(elements.showPasswordIconFalse[1], elements.showPasswordIconTrue[1]);
    } else {
      switchElements(elements.showPasswordIconTrue[0], elements.showPasswordIconFalse[0]);
      switchElements(elements.showPasswordIconTrue[1], elements.showPasswordIconFalse[1]);
    }
    elements.passwordInput.forEach((input) => {
      input.getAttribute("type") === "password"
        ? input.setAttribute("type", "text")
        : input.setAttribute("type", "password");
    });
  });
});

elements.showConfirmPasswordIcon.forEach((icon) => {
  icon.addEventListener("click", () => {
    event.stopPropagation();

    if (elements.showConfirmPasswordIconTrue[0].classList.contains("flex")) {
      switchElements(
        elements.showConfirmPasswordIconFalse[0],
        elements.showConfirmPasswordIconTrue[0]
      );
    } else {
      switchElements(
        elements.showConfirmPasswordIconTrue[0],
        elements.showConfirmPasswordIconFalse[0]
      );
    }
    elements.confirmPasswordInput.forEach((input) => {
      input.getAttribute("type") === "password"
        ? input.setAttribute("type", "text")
        : input.setAttribute("type", "password");
    });
  });
});
