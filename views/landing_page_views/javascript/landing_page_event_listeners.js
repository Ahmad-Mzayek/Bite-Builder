import { idElements, classElements } from "./landing_page_elements.js";
import * as LandingPageUtils from "./landing_page_utils.js";
import * as Utils from "../../global_views/javascript/global_utils.js";

let themeSwitch = true;

Utils.addThemeSwitchButtonEventListener(idElements.themeSwitchButton, themeSwitch, idElements.logoImage);

Utils.addClosePopupSvgListeners(
  classElements.closePopupSvgs,
  idElements.overlay,
  classElements.pagePopups,
);

Utils.addPasswordIconEventListeners(classElements.showPasswordIcons);

idElements.loginSignupButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.overlay, true);
  Utils.toggleVisibility(idElements.loginPopup, true);
});

idElements.showLoginButton.addEventListener("click", () => {
  let signupInputs = idElements.signupPopup.querySelectorAll(
    'input:is([type = "text"], [type = "email"], [type = "password"])',
  );
  Utils.switchElements(idElements.loginPopup, idElements.signupPopup);
  Utils.toggleVisibility(idElements.signupSuccessContainer, false);
  Utils.toggleVisibility(idElements.signupErrorContainer, false);
  Utils.deleteInputData(signupInputs);
});

idElements.showSignupButton.addEventListener("click", () => {
  let loginInputs = idElements.loginPopup.querySelectorAll(
    'input:is([type = "text"], [type = "email"], [type = "password"])',
  );
  Utils.switchElements(idElements.signupPopup, idElements.loginPopup);
  Utils.toggleVisibility(idElements.loginErrorContainer, false);
  Utils.deleteInputData(loginInputs);
});

idElements.resetPasswordButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.forgotPasswordPopup, true);
  idElements.overlay.classList.replace("z-20", "z-30");
});

idElements.loginForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const loginFormData = new FormData(event.target);
  Utils.toggleLoadingAnimation(idElements.overlay, idElements.loadingAnimationSpinner, true);

  try {
    const response = await fetch(
      "../../../controllers/landing_page_controllers/login_controller/login_controller_main.php",
      {
        method: "POST",
        body: loginFormData,
      },
    );
    const result = await response.json();
    if (result.status === "success") {
      Utils.toggleVisibility(idElements.loginErrorContainer, false);
      window.location.replace("../../meal_page_views/php/meal_page.php");
    } else {
      idElements.loginErrorContainer.innerHTML = result.message;
      Utils.toggleVisibility(idElements.loginErrorContainer, true);
    }
  } catch (error) {
    console.error("Internal server error: " + error.message);
  } finally {
    Utils.toggleLoadingAnimation(idElements.overlay, idElements.loadingAnimationSpinner, false);
    if (Utils.isAnyPopupVisible(classElements.pagePopups)) {
      Utils.toggleVisibility(idElements.overlay, true);
      idElements.overlay.classList.replace("z-30", "z-20");
    }
  }
});

idElements.signupForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const signupFormData = new FormData(event.target);
  Utils.toggleLoadingAnimation(idElements.overlay, idElements.loadingAnimationSpinner, true);

  try {
    const response = await fetch(
      "../../../controllers/landing_page_controllers/signup_controller/signup_controller_main.php",
      {
        method: "POST",
        body: signupFormData,
      },
    );
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
  } finally {
    Utils.toggleLoadingAnimation(idElements.overlay, idElements.loadingAnimationSpinner, false);
    if (Utils.isAnyPopupVisible(classElements.pagePopups)) {
      Utils.toggleVisibility(idElements.overlay, true);
      idElements.overlay.classList.replace("z-30", "z-20");
    }
  }
});
