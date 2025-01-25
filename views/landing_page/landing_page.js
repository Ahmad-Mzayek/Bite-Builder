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
  showPasswordIcons: document.querySelectorAll(".show-password-icon"),
  passwordInputs: document.querySelectorAll(".password-input"),
  resetPasswordButton: document.querySelector("#reset-password-button"),
  forgotPasswordPopup: document.querySelector("#forgot-password-popup"),
  loginErrorContainer: document.querySelector("#login-error-container"),
  signupErrorContainer: document.querySelector("#signup-error-container"),
  confirmPasswordInputs: document.querySelectorAll(".confirm-password-input"),
  showPasswordIconsTrue: document.querySelectorAll(".show-password-icon-true"),
  signupSuccessContainer: document.querySelector("#signup-success-container"),
  showPasswordIconsFalse: document.querySelectorAll(".show-password-icon-false"),
  showConfirmPasswordIcons: document.querySelectorAll(".show-confirm-password-icon"),
  closeForgotPasswordSvg: document.querySelector("#close-forgot-password-popup-svg"),
  showConfirmPasswordIconsTrue: document.querySelectorAll(".show-confirm-password-icon-true"),
  showConfirmPasswordIconsFalse: document.querySelectorAll(".show-confirm-password-icon-false"),
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
      switchElements(elements.signupSuccessContainer, elements.signupErrorContainer);
      switchElements(elements.loginPopup, elements.signupPopup);
    } else {
      elements.signupErrorContainer.innerHTML = result.message;
      toggleVisibility(elements.signupErrorContainer, true);
    }
  } catch (error) {
    console.error("Internal server error: " + error.message);
  }
});

elements.showPasswordIcons.forEach((icon) => {
  icon.addEventListener("pointerdown", (event) => {
    event.preventDefault()
    event.stopPropagation();
    
    if (elements.showPasswordIconsTrue[0].classList.contains("flex")) {
      switchElements(elements.showPasswordIconsFalse[0], elements.showPasswordIconsTrue[0]);
      switchElements(elements.showPasswordIconsFalse[1], elements.showPasswordIconsTrue[1]);
    } else {
      switchElements(elements.showPasswordIconsTrue[0], elements.showPasswordIconsFalse[0]);
      switchElements(elements.showPasswordIconsTrue[1], elements.showPasswordIconsFalse[1]);
    }

    elements.passwordInputs.forEach((input) => {
      input.getAttribute("type") === "password"
        ? input.setAttribute("type", "text")
        : input.setAttribute("type", "password");
    });
  });
});

elements.showConfirmPasswordIcons.forEach((icon) => {
  icon.addEventListener("pointerdown", (event) => {
    event.preventDefault()
    event.stopPropagation();
    
    if (elements.showConfirmPasswordIconsTrue[0].classList.contains("flex")) {
      switchElements(
        elements.showConfirmPasswordIconsFalse[0],
        elements.showConfirmPasswordIconsTrue[0]
      );
    } else {
      switchElements(
        elements.showConfirmPasswordIconsTrue[0],
        elements.showConfirmPasswordIconsFalse[0]
      );
    }
    elements.confirmPasswordInputs.forEach((input) => {
      input.getAttribute("type") === "password"
        ? input.setAttribute("type", "text")
        : input.setAttribute("type", "password");
    });
  });
});

elements.passwordInputs.forEach((input) => {
  input.addEventListener("focusin", () => {
    input.getAttribute("type") == "password"
      ? elements.showPasswordIconsTrue.forEach((icon) => {
          toggleVisibility(icon, true);
        })
      : elements.showPasswordIconsFalse.forEach((icon) => {
          toggleVisibility(icon, true);
        });
  });

  input.addEventListener("blur", (event) => {
      input.getAttribute("type") == "password"
        ? elements.showPasswordIconsTrue.forEach((icon) => {
            toggleVisibility(icon, false);
          })
        : elements.showPasswordIconsFalse.forEach((icon) => {
            toggleVisibility(icon, false);
          });
  });
});

elements.confirmPasswordInputs.forEach((input) => {
  input.addEventListener("focusin", () => {
    input.getAttribute("type") == "password"
      ? elements.showConfirmPasswordIconsTrue.forEach((icon) => {
          toggleVisibility(icon, true);
        })
      : elements.showConfirmPasswordIconsFalse.forEach((icon) => {
          toggleVisibility(icon, true);
        });
  });

  input.addEventListener("blur", (event) => {
      input.getAttribute("type") == "password"
        ? elements.showConfirmPasswordIconsTrue.forEach((icon) => {
            toggleVisibility(icon, false);
          })
        : elements.showConfirmPasswordIconsFalse.forEach((icon) => {
            toggleVisibility(icon, false);
          });
  });
});
