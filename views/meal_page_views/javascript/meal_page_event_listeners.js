import { idElements, classElements } from "./meal_page_elements.js";
import * as MealPageUtils from "./meal_page_utils.js";
import * as Utils from "../../global_views/javascript/global_utils.js";

let themeSwitch = true;
let userInfo;
let mealIds = [];
let favoriteMeal = false;

document.addEventListener("DOMContentLoaded", async () => {
  try {
    const response = await fetch(
      "../../../controllers/meal_page_controllers/user_info_controller/user_info_controller_main.php",
    );

    const result = await response.json();

    if (result.status === "success") {
      userInfo = result.message;
      idElements.profilePopupUsernameInput.value = userInfo.username;
      if (userInfo.phone_number === null)
        idElements.profilePopupPhoneNumberInput.value = "Not Specified";
      else idElements.profilePopupPhoneNumberInput.value = userInfo.phone_number;
      idElements.profilePopupEmail.innerHTML = userInfo.email_address;
      if (userInfo.is_male === 1) {
        MealPageUtils.toggleRadioButtonSelection(idElements.profilePopupMaleRadioInput, true);
        MealPageUtils.toggleRadioButtonSelection(idElements.profilePopupFemaleRadioInput, false);
      } else {
        MealPageUtils.toggleRadioButtonSelection(idElements.profilePopupMaleRadioInput, false);
        MealPageUtils.toggleRadioButtonSelection(idElements.profilePopupFemaleRadioInput, true);
      }
    } else throw new Error(result.message);
  } catch (error) {
    console.log("Internal Server Error " + error.message);
  }
});

Utils.addClosePopupSvgListeners(
  classElements.closePopupSvgs,
  idElements.overlay,
  classElements.pagePopups,
);

Utils.addPasswordIconEventListeners(classElements.showPasswordIcons);

idElements.hamburgerMenu.addEventListener("click", () => {
  idElements.hamburgerMenu.classList.toggle("active");
  idElements.dropdownMenuOverlay.classList.toggle("hidden");

  if (idElements.hamburgerMenu.classList.contains("active")) {
    idElements.dropdownMenuList.classList.replace("-top-[150px]", "top-[70px]");
    idElements.dropdownMenuList.classList.replace("-z-10", "z-10");
    idElements.dropdownMenuList.classList.replace("opacity-0", "opacity-100");
  } else {
    idElements.dropdownMenuList.classList.replace("top-[70px]", "-top-[150px]");
    idElements.dropdownMenuList.classList.replace("z-10", "-z-10");
    idElements.dropdownMenuList.classList.replace("opacity-100", "opacity-0");
  }
});

idElements.profileIcon.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.profilePopup, true);
  Utils.toggleVisibility(idElements.overlay, true);

  Utils.toggleVisibility(idElements.profilePopupErrorContainer, false);
  Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);

  Utils.toggleVisibility(idElements.profilePopupEditUsernameButton, true);
  Utils.toggleVisibility(idElements.profilePopupEditPhoneNumberButton, true);

  Utils.toggleVisibility(idElements.profilePopupEditUsernameButtonContainer, false);
  Utils.toggleVisibility(idElements.profilePopupEditPhoneNumberButtonContainer, false);
  Utils.toggleVisibility(idElements.profilePopupEditGenderButtonContainer, false);

  idElements.profilePopupUsernameInput.value = userInfo.username;
  idElements.profilePopupUsernameInput.disabled = true;

  idElements.profilePopupPhoneNumberInput.value = userInfo.phone_number;
  idElements.profilePopupPhoneNumberInput.value =
    userInfo.phone_number === null ? "Not Specified" : userInfo.phone_number;
  idElements.profilePopupPhoneNumberInput.disabled = true;

  if (userInfo.is_male === 1) {
    MealPageUtils.toggleRadioButtonSelection(idElements.profilePopupMaleRadioInput, true);
    MealPageUtils.toggleRadioButtonSelection(idElements.profilePopupFemaleRadioInput, false);
  } else {
    MealPageUtils.toggleRadioButtonSelection(idElements.profilePopupMaleRadioInput, false);
    MealPageUtils.toggleRadioButtonSelection(idElements.profilePopupFemaleRadioInput, true);
  }
});

idElements.openChangePasswordPopupButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.changePasswordPopup, true);
  Utils.toggleVisibility(idElements.changePasswordPopupErrorContainer, false);
  Utils.toggleVisibility(idElements.changePasswordPopupSuccessContainer, false);
  idElements.overlay.classList.replace("z-20", "z-30");
});

idElements.closeChangePasswordPopupButton.addEventListener("click", (event) => {
  event.preventDefault();
  Utils.toggleVisibility(idElements.changePasswordPopup, false);
  Utils.toggleVisibility(idElements.changePasswordPopupErrorContainer, false);
  idElements.overlay.classList.replace("z-30", "z-20");
});

idElements.confirmChangePasswordButton.addEventListener("click", async (event) => {
  event.preventDefault();

  let newPasswordInput = idElements.newPasswordInput;

  if (newPasswordInput.value.length < 8) {
    idElements.changePasswordPopupErrorContainer.innerHTML =
      "Your password is less than 8 characters. Please make it longer.";
    Utils.toggleVisibility(idElements.changePasswordPopupErrorContainer, true);
    Utils.toggleVisibility(idElements.changePasswordPopupSuccessContainer, false);
    return;
  }

  const changePasswordForm = event.target.closest("form");
  const formData = new FormData(changePasswordForm);

  try {
    const response = await fetch(
      "../../../controllers/meal_page_controllers/change_password_controller/change_password_controller_main.php",
      {
        method: "POST",
        body: formData,
      },
    );

    const result = await response.json();

    if (result.status === "success") {
      Utils.toggleVisibility(idElements.changePasswordPopupSuccessContainer, true);
      Utils.toggleVisibility(idElements.changePasswordPopupErrorContainer, false);
    } else {
      idElements.changePasswordPopupErrorContainer.innerHTML = result.message;
      Utils.toggleVisibility(idElements.changePasswordPopupErrorContainer, true);
      Utils.toggleVisibility(idElements.changePasswordPopupSuccessContainer, false);
    }
  } catch (error) {
    console.log("Internal server error " + error.message);
  }
});

idElements.openDeleteAccountConfirmationPopupButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.deleteAccountConfirmationPopup, true);
  idElements.overlay.classList.replace("z-20", "z-30");
});

idElements.closeDeleteAccountConfirmationPopupButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.deleteAccountConfirmationPopup, false);
  idElements.overlay.classList.replace("z-30", "z-20");
});

idElements.confirmDeleteAccountButton.addEventListener("click", async () => {
  let password =
    idElements.confirmDeleteAccountButton.parentElement.previousElementSibling.firstChild
      .nextElementSibling.value;

  let formData = new FormData();
  formData.append("password_input", password);

  try {
    let response = await fetch(
      "../../../controllers/meal_page_controllers/delete_account_controller/delete_account_controller_main.php",
      {
        method: "POST",
        body: formData,
      },
    );

    const result = await response.json();

    if (result.status === "success") {
      Utils.toggleVisibility(idElements.deleteAccountConfirmationPopupErrorContainer, false);

      response = await fetch(
        "../../../controllers/meal_page_controllers/logout_controller/logout_controller_main.php",
      );

      const result = await response.json();

      if (result.status === "success")
        window.location.replace("../../landing_page_views/php/landing_page.php");
      else throw new Error(result.message);
    } else {
      idElements.deleteAccountConfirmationPopupErrorContainer.innerHTML = result.message;
      Utils.toggleVisibility(idElements.deleteAccountConfirmationPopupErrorContainer, true);
    }
  } catch (error) {
    console.log("Internal server error" + error.message);
  }
});

idElements.profilePopupEditUsernameButton.addEventListener("click", async (event) => {
  event.preventDefault();

  const usernameInput = idElements.profilePopupEditUsernameButton.previousElementSibling;

  try {
    const response = await fetch(
      "../../../controllers/meal_page_controllers/change_username_request_controller/change_username_request_controller_main.php",
    );

    const result = await response.json();

    if (result.status !== "success") {
      idElements.profilePopupErrorContainer.innerHTML = result.message;
      Utils.toggleVisibility(idElements.profilePopupErrorContainer, true);
      Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);
    } else {
      usernameInput.disabled = false;

      Utils.toggleVisibility(idElements.profilePopupEditUsernameButtonContainer, true);
      Utils.toggleVisibility(idElements.profilePopupEditUsernameButton, false);
    }
  } catch (error) {
    console.log("Internal server error " + error.message);
  }
});

idElements.cancelEditUsernameButton.addEventListener("click", (event) => {
  event.preventDefault();

  const usernameInput = idElements.profilePopupEditUsernameButton.previousElementSibling;
  usernameInput.value = userInfo.username;
  usernameInput.disabled = true;

  Utils.toggleVisibility(idElements.profilePopupEditUsernameButtonContainer, false);
  Utils.toggleVisibility(idElements.profilePopupEditUsernameButton, true);
});

idElements.saveEditUsernameButton.addEventListener("click", async (event) => {
  event.preventDefault();

  const usernameInput = idElements.profilePopupEditUsernameButton.previousElementSibling;

  if (usernameInput.value === userInfo.username) {
    idElements.profilePopupErrorContainer.innerHTML =
      "Please enter a different username than your current one.";
    Utils.toggleVisibility(idElements.profilePopupErrorContainer, true);
    Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);
    return;
  }

  if (usernameInput.value.length < 8) {
    idElements.profilePopupErrorContainer.innerHTML =
      "Your username is less than 8 characters. Please make it longer.";
    Utils.toggleVisibility(idElements.profilePopupErrorContainer, true);
    Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);
    return;
  }

  const formData = new FormData();
  formData.append("username_input", usernameInput.value);

  try {
    const response = await fetch(
      "../../../controllers/meal_page_controllers/change_username_controller/change_username_controller_main.php",
      {
        method: "POST",
        body: formData,
      },
    );

    const result = await response.json();

    if (result.status === "success") {
      userInfo.username = usernameInput.value;
      usernameInput.disabled = true;
      idElements.profilePopupSuccessContainer.innerHTML = "Username Successfully Updated!";
      Utils.toggleVisibility(idElements.profilePopupSuccessContainer, true);
      Utils.toggleVisibility(idElements.profilePopupErrorContainer, false);
      Utils.toggleVisibility(idElements.profilePopupEditUsernameButtonContainer, false);
      Utils.toggleVisibility(idElements.profilePopupEditUsernameButton, true);
    } else {
      idElements.profilePopupErrorContainer.innerHTML = result.message;
      Utils.toggleVisibility(idElements.profilePopupErrorContainer, true);
      Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);
    }
  } catch (error) {
    console.log("Error: " + error.message);
  }
});

idElements.profilePopupEditPhoneNumberButton.addEventListener("click", (event) => {
  event.preventDefault();

  const phoneNumberInput = idElements.profilePopupEditPhoneNumberButton.previousElementSibling;
  phoneNumberInput.disabled = false;

  Utils.toggleVisibility(idElements.profilePopupEditPhoneNumberButtonContainer, true);
  Utils.toggleVisibility(idElements.profilePopupEditPhoneNumberButton, false);
});

idElements.cancelEditPhoneNumberButton.addEventListener("click", (event) => {
  event.preventDefault();

  const phoneNumberInput = idElements.profilePopupEditPhoneNumberButton.previousElementSibling;

  phoneNumberInput.value = userInfo.phone_number === null ? "Not Specified" : userInfo.phone_number;
  phoneNumberInput.disabled = true;

  Utils.toggleVisibility(idElements.profilePopupEditPhoneNumberButtonContainer, false);
  Utils.toggleVisibility(idElements.profilePopupEditPhoneNumberButton, true);
});

idElements.saveEditPhoneNumberButton.addEventListener("click", async (event) => {
  event.preventDefault();

  const phoneNumberInput = idElements.profilePopupEditPhoneNumberButton.previousElementSibling;

  if (phoneNumberInput.value === userInfo.phone_number) {
    idElements.profilePopupErrorContainer.innerHTML =
      "Please enter a different phone number than your current one.";
    Utils.toggleVisibility(idElements.profilePopupErrorContainer, true);
    Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);
    return;
  }

  try {
    const formData = new FormData();
    formData.append("phone_number_input", phoneNumberInput.value);

    const response = await fetch(
      "../../../controllers/meal_page_controllers/change_phone_number_controller/change_phone_number_main.php",
      {
        method: "POST",
        body: formData,
      },
    );

    const result = await response.json();

    if (result.status === "success") {
      userInfo.phone_number = phoneNumberInput.value;
      phoneNumberInput.disabled = true;
      idElements.profilePopupSuccessContainer.innerHTML = "Phone Number Successfully Updated!";
      Utils.toggleVisibility(idElements.profilePopupSuccessContainer, true);
      Utils.toggleVisibility(idElements.profilePopupErrorContainer, false);
      Utils.toggleVisibility(idElements.profilePopupEditPhoneNumberButtonContainer, false);
      Utils.toggleVisibility(idElements.profilePopupEditPhoneNumberButton, true);
    } else {
      idElements.profilePopupErrorContainer.innerHTML = result.message;
      Utils.toggleVisibility(idElements.profilePopupErrorContainer, true);
      Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);
    }
  } catch (error) {
    console.log("Error: " + error.message);
  }
});

idElements.profilePopupMaleRadioInput.addEventListener("click", () => {
  idElements.profilePopupMaleRadioInput.checked = true;
  idElements.profilePopupFemaleRadioInput.checked = false;

  if (userInfo.is_male === 1) {
    Utils.toggleVisibility(idElements.profilePopupEditGenderButtonContainer, false);
    return;
  }

  Utils.toggleVisibility(idElements.profilePopupEditGenderButtonContainer, true);
});

idElements.profilePopupFemaleRadioInput.addEventListener("click", () => {
  idElements.profilePopupMaleRadioInput.checked = false;
  idElements.profilePopupFemaleRadioInput.checked = true;

  if (userInfo.is_male === 0) {
    Utils.toggleVisibility(idElements.profilePopupEditGenderButtonContainer, false);
    return;
  }

  Utils.toggleVisibility(idElements.profilePopupEditGenderButtonContainer, true);
});

idElements.cancelEditGenderButton.addEventListener("click", (event) => {
  event.preventDefault();

  if (userInfo.is_male === 1) {
    idElements.profilePopupMaleRadioInput.checked = true;
    idElements.profilePopupFemaleRadioInput.checked = false;
  } else {
    idElements.profilePopupMaleRadioInput.checked = false;
    idElements.profilePopupFemaleRadioInput.checked = true;
  }

  Utils.toggleVisibility(idElements.profilePopupEditGenderButtonContainer, false);
});

idElements.saveEditGenderButton.addEventListener("click", async (event) => {
  event.preventDefault();

  const genderForm = event.target.closest("form");

  const genderFormData = new FormData(genderForm);
  try {
    const response = await fetch(
      "../../../controllers/meal_page_controllers/change_gender_controller/change_gender_controller_main.php",
      {
        method: "POST",
        body: genderFormData,
      },
    );

    const result = await response.json();

    if (result.status === "success") {
      userInfo.is_male = parseInt(genderFormData.get("is_male"));
      idElements.profilePopupSuccessContainer.innerHTML = "Gender Successfully Updated!";
      Utils.toggleVisibility(idElements.profilePopupSuccessContainer, true);
      Utils.toggleVisibility(idElements.profilePopupErrorContainer, false);
      Utils.toggleVisibility(idElements.profilePopupEditGenderButtonContainer, false);
    } else {
      idElements.profilePopupErrorContainer.innerHTML = result.message;
      Utils.toggleVisibility(idElements.profilePopupErrorContainer, true);
      Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);
    }
  } catch (error) {
    console.log("Error: " + error.message);
  }
});

idElements.themeSwitchButton.addEventListener("click", () => {
  themeSwitch = !themeSwitch;
  if (themeSwitch) {
    const isDark = document.body.classList.toggle("dark");
    document.body.classList.toggle("light", !isDark);
  }
});

idElements.logoutButton.addEventListener("click", async () => {
  try {
    const response = await fetch(
      "../../../controllers/meal_page_controllers/logout_controller/logout_controller_main.php",
    );

    const result = await response.json();

    if (result.status === "success")
      window.location.replace("../../landing_page_views/php/landing_page.php");
    else throw new Error(result.message);
  } catch (error) {
    console.log("Internal server error" + error.message);
  }
});

idElements.closePreferencesPopupButton.addEventListener("click", (event) => {
  event.preventDefault();

  Utils.toggleVisibility(idElements.overlay, false);
  Utils.toggleVisibility(idElements.preferencesPopup, false);
  document.body.classList.toggle("overflow-y-hidden", false);
});

idElements.filterButton.addEventListener("click", async (event) => {
  event.preventDefault();
  Utils.toggleVisibility(idElements.overlay, true);
  Utils.toggleVisibility(idElements.preferencesPopup, true);
  document.body.classList.toggle("overflow-y-hidden", true);

  let requestBody = new URLSearchParams();
  requestBody.append("get_categories", "true");

  try {
    const response = await fetch(
      "../../../controllers/meal_page_controllers/preferences_controller/preferences_controller_main.php",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: requestBody.toString(),
      },
    );

    const categories = await response.json();

    if (categories.status !== "success") throw new Error("Categories not fetched.");

    MealPageUtils.fetchCategories(categories);
  } catch (error) {
    console.error("Internal server error: " + error.message);
  }
});

// idElements.preferencesForm.addEventListener("submit", async (event) => {
//   event.preventDefault();
//   const preferencesFormData = new FormData(event.target);

//   try {
//     const response = await fetch(
//       "../../../controllers/meal_page_controllers/preferences_controller/preferences_controller_main.php",
//       {
//         method: "POST",
//         body: preferencesFormData,
//       }
//     );

//     const result = await response.json();

//     if (result.status === "success") {
//       Utils.switchElements(idElements.signupSuccessContainer, idElements.signupErrorContainer);
//       Utils.switchElements(idElements.loginPopup, idElements.signupPopup);
//     } else {
//       idElements.signupErrorContainer.innerHTML = result.message;
//       Utils.toggleVisibility(idElements.signupErrorContainer, true);
//     }
//   } catch (error) {
//     console.error("Internal server error: " + error.message);
//   }
// });
