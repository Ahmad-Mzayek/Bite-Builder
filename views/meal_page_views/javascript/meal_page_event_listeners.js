import { idElements, classElements } from "./meal_page_elements.js";
import * as MealPageUtils from "./meal_page_utils.js";
import * as Utils from "../../global_views/javascript/global_utils.js";

let themeSwitch = true;
let isDarkModeOn = localStorage.getItem("isDarkModeOn") || "true";

let userInfo;

localStorage.clear(); // REMOVE LATER --------------------------------------------------------------------------------

let mealIds = localStorage.getItem("mealIds");
if (mealIds !== null) mealIds = JSON.parse(mealIds);

let currentMealIdsIndex = 0;

let sort_by = localStorage.getItem("sort_by") || "meal_name";
let order = localStorage.getItem("order") || "ASC";
let minNbCaloriesPerPortion = localStorage.getItem("min_nb_calories_per_portion") || 0;
let maxNbCaloriesPerPortion = localStorage.getItem("max_nb_calories_per_portion") || 9999;
let minPreparationDurationMinutes = localStorage.getItem("min_preparation_duration_minutes") || 0;
let maxPreparationDurationMinutes = localStorage.getItem("max_preparation_duration_minutes") || 9999;

Utils.themeInitializer(idElements.themeSwitchButton, idElements.logoImage, isDarkModeOn);

document.addEventListener("DOMContentLoaded", async () => {
  try {
    let result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/user_info_controller/user_info_controller_main.php"
    );

    if (result.status === "success") {
      userInfo = result.message;
      console.log(userInfo);
      idElements.profilePopupUsernameInput.value = userInfo.username;

      if (userInfo.phone_number === null) idElements.profilePopupPhoneNumberInput.value = "Not Specified";
      else idElements.profilePopupPhoneNumberInput.value = userInfo.phone_number;

      idElements.profilePopupEmail.innerHTML = userInfo.email_address;

      if (userInfo.is_male === 1) MealPageUtils.toggleInputSelection(idElements.profilePopupMaleRadioInput, true);
      else MealPageUtils.toggleInputSelection(idElements.profilePopupFemaleRadioInput, true);

      MealPageUtils.fetchAndUpdateCategories(idElements.categoriesContainer, userInfo.meal_categories);
    }

    if (mealIds === null) {
      let formData = new FormData();

      formData.append("is_favorites_checked", "0");
      formData.append("sort_by", sort_by);
      formData.append("order", order);
      formData.append("searched_meal_name", "");
      formData.append("min_nb_calories_per_portion", minNbCaloriesPerPortion);
      formData.append("max_nb_calories_per_portion", maxNbCaloriesPerPortion);
      formData.append("min_preparation_duration_minutes", minPreparationDurationMinutes);
      formData.append("max_preparation_duration_minutes", maxPreparationDurationMinutes);

      for (const [category, isChecked] of Object.entries(userInfo.meal_categories)) {
        console.log("hi");
        formData.append("checked_categories[]", category);
      }

      [""].forEach((value) => formData.append("checked_filters[]", value)); // UPDATE dietary_filters SET "" = TRUE WHERE

      for (const [key, value] of formData.entries()) console.log(key + " ==> " + value);

      result = await Utils.fetchData(
        "../../../controllers/meal_page_controllers/preferences_controller/preferences_controller_main.php",
        formData
      );

      localStorage.setItem("mealIds", JSON.stringify(result.message));

      mealIds = JSON.parse(localStorage.getItem("mealIds"));

      // let favoriteMeal = new URLSearchParams({
      //   meal_id: 4,
      //   is_favorite: 1,
      // })

      // result = await Utils.fetchData("../../../controllers/meal_page_controllers/toggle_favorite_controller/toggle_favorite_controller_main.php", favoriteMeal);

      // console.log(result.message);

      // let mealId = new URLSearchParams({
      //   meal_id: "15",
      // });

      // response = await fetch(
      //   "../../../controllers/meal_page_controllers/meal_card_controller/meal_card_controller_main.php",
      //   {
      //     method: "POST",
      //     body: mealId,
      //   },
      // );

      // result = await response.json();

      // if(result.status === "success")
      //   idElements.mealImage.setAttribute("src", `../../../resources/images/${result.message.image_name}`)

      // console.log(result);
    }

    let currentMealId = new URLSearchParams({
      meal_id: mealIds[currentMealIdsIndex]
    });

    result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/meal_card_controller/meal_card_controller_main.php",
      currentMealId
    );

    if (result.status === "success") {
      let meal = result.message;
      console.log(result.message);
      idElements.mealImage.setAttribute("src", `../../../resources/images/${meal.image_name}`);
      idElements.mealName.innerHTML = meal.meal_name;
    }
  } catch (error) {
    console.log("Internal Server Error " + error.message);
  }
});

Utils.addThemeSwitchButtonEventListener(idElements.themeSwitchButton, themeSwitch, idElements.logoImage);

Utils.addClosePopupSvgListeners(classElements.closePopupSvgs, idElements.overlay, classElements.pagePopups);

Utils.addPasswordIconEventListeners(classElements.showPasswordIcons);

idElements.hamburgerMenu.addEventListener("click", () => {
  idElements.hamburgerMenu.classList.toggle("active");
  idElements.dropdownMenuOverlay.classList.toggle("hidden");

  if (idElements.hamburgerMenu.classList.contains("active")) {
    idElements.dropdownMenuList.classList.replace("-top-[350px]", "top-[60px]");
    idElements.dropdownMenuList.classList.replace("-z-10", "z-10");
    idElements.dropdownMenuList.classList.replace("opacity-0", "opacity-100");
  } else {
    idElements.dropdownMenuList.classList.replace("top-[60px]", "-top-[350px]");
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

  if (userInfo.is_male === 1) MealPageUtils.toggleInputSelection(idElements.profilePopupMaleRadioInput, true);
  else MealPageUtils.toggleInputSelection(idElements.profilePopupFemaleRadioInput, true);
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
    const result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/change_password_controller/change_password_controller_main.php",
      formData
    );

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
  Utils.toggleVisibility(idElements.deleteAccountConfirmationPopupErrorContainer, false);
  Utils.toggleVisibility(idElements.deleteAccountConfirmationPopup, true);
  idElements.overlay.classList.replace("z-20", "z-30");
});

idElements.closeDeleteAccountConfirmationPopupButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.deleteAccountConfirmationPopup, false);
  idElements.overlay.classList.replace("z-30", "z-20");
});

idElements.confirmDeleteAccountButton.addEventListener("click", async () => {
  let password =
    idElements.confirmDeleteAccountButton.parentElement.previousElementSibling.firstChild.nextElementSibling.value;

  let formData = new FormData();
  formData.append("password_input", password);

  try {
    const result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/delete_account_controller/delete_account_controller_main.php",
      formData
    );

    if (result.status === "success") {
      Utils.toggleVisibility(idElements.deleteAccountConfirmationPopupErrorContainer, false);

      const result = await Utils.fetchData(
        "../../../controllers/meal_page_controllers/logout_controller/logout_controller_main.php"
      );

      if (result.status === "success") window.location.replace("../../landing_page_views/php/landing_page.php");
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
    const result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/change_username_request_controller/change_username_request_controller_main.php"
    );

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
    idElements.profilePopupErrorContainer.innerHTML = "Please enter a different username than your current one.";
    Utils.toggleVisibility(idElements.profilePopupErrorContainer, true);
    Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);
    return;
  }

  if (usernameInput.value.length < 8) {
    idElements.profilePopupErrorContainer.innerHTML = "Your username is less than 8 characters. Please make it longer.";
    Utils.toggleVisibility(idElements.profilePopupErrorContainer, true);
    Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);
    return;
  }

  const formData = new FormData();
  formData.append("username_input", usernameInput.value);

  try {
    const result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/change_username_controller/change_username_controller_main.php",
      formData
    );

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
    idElements.profilePopupErrorContainer.innerHTML = "Please enter a different phone number than your current one.";
    Utils.toggleVisibility(idElements.profilePopupErrorContainer, true);
    Utils.toggleVisibility(idElements.profilePopupSuccessContainer, false);
    return;
  }

  try {
    const formData = new FormData();
    formData.append("phone_number_input", phoneNumberInput.value);

    const result = Utils.fetchData(
      "../../../controllers/meal_page_controllers/change_phone_number_controller/change_phone_number_main.php",
      formData
    );

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
    const result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/change_gender_controller/change_gender_controller_main.php",
      genderFormData
    );

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

idElements.logoutButton.addEventListener("click", async () => {
  try {
    const result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/logout_controller/logout_controller_main.php"
    );

    if (result.status === "success") window.location.replace("../../landing_page_views/php/landing_page.php");
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

idElements.filterButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.overlay, true);
  Utils.toggleVisibility(idElements.preferencesPopup, true);
  document.body.classList.toggle("overflow-y-hidden", true);
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

idElements.previousMealButton.addEventListener("click", async () => {
  if (currentMealIdsIndex === 0) currentMealIdsIndex = mealIds.length - 1;
  else currentMealIdsIndex--;

  let currentMealId = new URLSearchParams({
    meal_id: mealIds[currentMealIdsIndex]
  });

  const result = await Utils.fetchData(
    "../../../controllers/meal_page_controllers/meal_card_controller/meal_card_controller_main.php",
    currentMealId
  );

  if (result.status === "success") {
    let meal = result.message;
    idElements.mealImage.setAttribute("src", `../../../resources/images/${meal.image_name}`);
    idElements.mealName.innerHTML = meal.meal_name;
  }
});

idElements.nextMealButton.addEventListener("click", async () => {
  if (currentMealIdsIndex === mealIds.length - 1) currentMealIdsIndex = 0;
  else currentMealIdsIndex++;

  let currentMealId = new URLSearchParams({
    meal_id: mealIds[currentMealIdsIndex]
  });

  const result = await Utils.fetchData(
    "../../../controllers/meal_page_controllers/meal_card_controller/meal_card_controller_main.php",
    currentMealId
  );

  if (result.status === "success") {
    let meal = result.message;
    idElements.mealImage.setAttribute("src", `../../../resources/images/${meal.image_name}`);
    idElements.mealName.innerHTML = meal.meal_name;
  }
});
