import {idElements, classElements} from "./landing_page_elements.js";
import * as LandingPageUtils from "./landing_page_utils.js";
import * as Utils from "../../global_views/javascript/global_utils.js";

let themeSwitch = true;

idElements.themeSwitchButton.addEventListener("click", () => {
  themeSwitch = !themeSwitch;
  if (themeSwitch) {
    const isDark = document.body.classList.toggle("dark");
    document.body.classList.toggle("light", !isDark);
  }
});

idElements.loginSignupButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.overlay, true);
  Utils.toggleVisibility(idElements.loginPopup, true);
});

idElements.closeSignupSvg.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.overlay, false);
  Utils.toggleVisibility(idElements.signupPopup, false);
  idElements.signupUsernameInput.value = "";
  idElements.signupEmailInput.value = "";
  idElements.signupPasswordInput.value = "";
  idElements.signupConfirmPasswordInput.value = "";
});

idElements.closeLoginSvg.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.overlay, false);
  Utils.toggleVisibility(idElements.loginPopup, false);
  idElements.loginInput.value = "";
  idElements.loginPasswordInput.value = "";
});

idElements.closeForgotPasswordSvg.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.forgotPasswordPopup, false);
  idElements.loginPopup.classList.replace("z-9", "z-20");
  idElements.closeLoginSvg.classList.remove("pointer-events-none");
});

idElements.showLoginButton.addEventListener("click", () => {
  Utils.switchElements(idElements.loginPopup, idElements.signupPopup);
  Utils.toggleVisibility(idElements.signupSuccessContainer, false);
  Utils.toggleVisibility(idElements.signupErrorContainer, false);
  idElements.signupUsernameInput.value = "";
  idElements.signupEmailInput.value = "";
  idElements.signupPasswordInput.value = "";
  idElements.signupConfirmPasswordInput.value = "";
});

idElements.showSignupButton.addEventListener("click", () => {
  Utils.switchElements(idElements.signupPopup, idElements.loginPopup);
  Utils.toggleVisibility(idElements.loginErrorContainer, false);
  idElements.loginInput.value = "";
  idElements.loginPasswordInput.value = "";
});

idElements.resetPasswordButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.forgotPasswordPopup, true);
  idElements.loginPopup.classList.replace("z-20", "z-9");
  idElements.closeLoginSvg.classList.add("pointer-events-none");
});

idElements.loginForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const loginFormData = new FormData(event.target);
  try {
    const response = await fetch("../../../controllers/landing_page_controllers/login_controller/login_controller_main.php", {
      method: "POST",
      body: loginFormData,
    });
    const result = await response.json();
    window.location;
    if (result.status === "success") {
      Utils.toggleVisibility(idElements.loginErrorContainer, false);
      alert(result.message);
      window.location.href = "../../meal_page_views/php/meal_page.php";
    } else {
      idElements.loginErrorContainer.innerHTML = result.message;
      Utils.toggleVisibility(idElements.loginErrorContainer, true);
    }
  } catch (error) {
    console.error("Internal server error: " + error.message);
  }
});

idElements.signupForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const signupFormData = new FormData(event.target);
  try {
    const response = await fetch("../../../controllers/landing_page_controllers/signup_controller/signup_controller_main.php", {
      method: "POST",
      body: signupFormData,
    });
    const result = await response.json();
    if (result.status === "success") {
      Utils.switchElements(idElements.signupSuccessContainer, idElements.signupErrorContainer);
      Utils.switchElements(idElements.loginPopup, idElements.signupPopup);
    } else {
      idElements.signupErrorContainer.innerHTML = result.message;
      Utils.toggleVisibility(idElements.signupErrorContainer, true);
    }
  } catch (error) {
    console.error("Internal server error: " + error.message);
  }
});

// Handle show password...

classElements.passwordInputs.forEach((input) => {
  input.addEventListener("focusin", () => {
    input.getAttribute("type") == "password"
      ? classElements.showPasswordIconsTrue.forEach((icon) => {
          Utils.toggleVisibility(icon, true);
        })
      : classElements.showPasswordIconsFalse.forEach((icon) => {
          Utils.toggleVisibility(icon, true);
        });
  });

  input.addEventListener("blur", (event) => {
    input.getAttribute("type") == "password"
      ? classElements.showPasswordIconsTrue.forEach((icon) => {
          Utils.toggleVisibility(icon, false);
        })
      : classElements.showPasswordIconsFalse.forEach((icon) => {
          Utils.toggleVisibility(icon, false);
        });
  });
});

classElements.confirmPasswordInputs.forEach((input) => {
  input.addEventListener("focusin", () => {
    input.getAttribute("type") == "password"
      ? classElements.showConfirmPasswordIconsTrue.forEach((icon) => {
          Utils.toggleVisibility(icon, true);
        })
      : classElements.showConfirmPasswordIconsFalse.forEach((icon) => {
          Utils.toggleVisibility(icon, true);
        });
  });

  input.addEventListener("blur", (event) => {
    input.getAttribute("type") == "password"
      ? classElements.showConfirmPasswordIconsTrue.forEach((icon) => {
          Utils.toggleVisibility(icon, false);
        })
      : classElements.showConfirmPasswordIconsFalse.forEach((icon) => {
          Utils.toggleVisibility(icon, false);
        });
  });
});
