import { idElements, classElements } from "./meal_page_elements.js";
import * as MealPageUtils from "./meal_page_utils.js";
import * as Utils from "../../global_views/javascript/global_utils.js";

let themeSwitch = true;
let isDarkModeOn = localStorage.getItem("isDarkModeOn") || "true";

let userInfo;

// localStorage.clear(); // TODO REMOVE LATER --------------------------------------------------------------------------------

let mealIds = localStorage.getItem("mealIds");
if (mealIds !== null) mealIds = JSON.parse(mealIds);

let currentMealIdsIndex = 0;

let isFavoritesChecked = localStorage.getItem("is_favorites_checked") || 0;
let minNbCaloriesPerPortion = localStorage.getItem("min_nb_calories_per_portion") || 0;
let maxNbCaloriesPerPortion = localStorage.getItem("max_nb_calories_per_portion") || 9999;
let minPreparationDurationMinutes = localStorage.getItem("min_preparation_duration_minutes") || 0;
let maxPreparationDurationMinutes = localStorage.getItem("max_preparation_duration_minutes") || 999999;
let sort_by = localStorage.getItem("sort_by") || "meal_name";
let order = localStorage.getItem("order") || "ASC";

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

      MealPageUtils.fetchAndUpdateMealCategories(idElements.categoriesContainer, userInfo.meal_categories);
      MealPageUtils.updateIsFavoritesCheckedFilter(idElements.dietaryFiltersContainer, isFavoritesChecked);
      MealPageUtils.updateDietaryFilters(idElements.dietaryFiltersContainer, userInfo.dietary_filters);
      MealPageUtils.updateOrder(idElements.sortAndOrderContainer, order);
      MealPageUtils.updateSortBy(idElements.sortAndOrderContainer, sort_by);
    }

    if (mealIds === null) {
      let formData = new FormData();

      formData.append("is_favorites_checked", isFavoritesChecked);
      formData.append("sort_by", sort_by);
      formData.append("order", order);
      formData.append("searched_meal_name", "");
      formData.append("min_nb_calories_per_portion", minNbCaloriesPerPortion);
      formData.append("max_nb_calories_per_portion", maxNbCaloriesPerPortion);
      formData.append("min_preparation_duration_minutes", minPreparationDurationMinutes);
      formData.append("max_preparation_duration_minutes", maxPreparationDurationMinutes);

      for (const [category, isChecked] of Object.entries(userInfo.meal_categories)) {
        formData.append("checked_categories[]", category);
      }

      [""].forEach((value) => formData.append("checked_filters[]", value));

      result = await Utils.fetchData(
        "../../../controllers/meal_page_controllers/preferences_controller/preferences_controller_main.php",
        formData
      );

      if (result.status === "success") {
        localStorage.setItem("mealIds", JSON.stringify(result.message));

        mealIds = JSON.parse(localStorage.getItem("mealIds"));

        if (mealIds.length === 0) idElements.totalMealsSpan.innerHTML = `(0 / ${mealIds.length})`;
      }
    }

    if (mealIds.length > 0) {
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
        idElements.mealDescription.innerHTML = meal.description;
        idElements.totalCaloriesSpan.innerHTML = `${meal.nb_calories_per_portion} Calories`;
        idElements.totalMinutesSpan.innerHTML = `${meal.preparation_duration_minutes} Minutes`;
        idElements.totalPortionsSpan.innerHTML = `${meal.nb_portions} Portions`;

        idElements.totalMealsSpan.innerHTML = `(${currentMealIdsIndex + 1} / ${mealIds.length})`;
      } else alert("Failed fetching meal.");
    }
  } catch (error) {
    console.log("Internal Server Error " + error.message);
  }
});

Utils.addThemeSwitchButtonEventListener(idElements.themeSwitchButton, themeSwitch, idElements.logoImage);

Utils.addClosePopupSvgListeners(classElements.closePopupSvgs, idElements.overlay, classElements.pagePopups);

Utils.addPasswordIconEventListeners(classElements.showPasswordIcons);

idElements.hamburgerMenu.addEventListener("click", () => {
  MealPageUtils.toggleDropDownMenu(
    idElements.hamburgerMenu,
    idElements.dropdownMenuOverlay,
    idElements.dropdownMenuList
  );
});

idElements.dropdownMenuOverlay.addEventListener("click", () => {
  MealPageUtils.toggleDropDownMenu(
    idElements.hamburgerMenu,
    idElements.dropdownMenuOverlay,
    idElements.dropdownMenuList
  );
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

    const result = await Utils.fetchData(
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

      if (result.status === "success") {
        localStorage.clear();
        window.location.replace("../../landing_page_views/php/landing_page.php");
      } else throw new Error(result.message);
    } else {
      idElements.deleteAccountConfirmationPopupErrorContainer.innerHTML = result.message;
      Utils.toggleVisibility(idElements.deleteAccountConfirmationPopupErrorContainer, true);
    }
  } catch (error) {
    console.log("Internal server error" + error.message);
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

  if (userInfo.is_male === 1) idElements.profilePopupMaleRadioInput.checked = true;
  else idElements.profilePopupFemaleRadioInput.checked = true;

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
    else {
      alert("Logout Failed. Internal Server Error.");
      throw new Error(result.message);
    }
  } catch (error) {
    console.log("Internal server error" + error.message);
  }
});

// idElements.searchIcon.addEventListener("click", async () => {}); // TODO ------------------------------------

idElements.closePreferencesPopupButton.addEventListener("click", (event) => {
  event.preventDefault();

  const numberInputs = event.target.parentElement.parentElement.querySelectorAll('input[type="number"]');

  Utils.toggleVisibility(idElements.overlay, false);
  Utils.toggleVisibility(idElements.preferencesPopup, false);

  document.body.classList.toggle("overflow-y-hidden", false);

  Utils.deleteInputData(numberInputs);

  console.log(order);
  console.log(sort_by);

  MealPageUtils.updateMealCategories(idElements.categoriesContainer, userInfo.meal_categories);
  MealPageUtils.updateIsFavoritesCheckedFilter(idElements.dietaryFiltersContainer, isFavoritesChecked);
  MealPageUtils.updateDietaryFilters(idElements.dietaryFiltersContainer, userInfo.dietary_filters);
  MealPageUtils.updateOrder(idElements.sortAndOrderContainer, order);
  MealPageUtils.updateSortBy(idElements.sortAndOrderContainer, sort_by);
});

idElements.filterButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.overlay, true);
  Utils.toggleVisibility(idElements.preferencesPopup, true);
  document.body.classList.toggle("overflow-y-hidden", true);
});

idElements.preferencesForm.addEventListener("submit", async (event) => {
  event.preventDefault();

  const preferencesFormData = new FormData(event.target);

  preferencesFormData.append("searched_meal_name", "");

  if (!preferencesFormData.has("is_favorites_checked")) preferencesFormData.append("is_favorites_checked", 0);

  if (!preferencesFormData.has("checked_filters[]")) preferencesFormData.append("checked_filters[]", "");

  if (!preferencesFormData.has("checked_categories[]")) preferencesFormData.append("checked_categories[]", "");

  if (preferencesFormData.get("min_nb_calories_per_portion") === "")
    preferencesFormData.set("min_nb_calories_per_portion", 0);

  if (preferencesFormData.get("max_nb_calories_per_portion") === "")
    preferencesFormData.set("max_nb_calories_per_portion", 9999);

  if (preferencesFormData.get("min_preparation_duration_minutes") === "")
    preferencesFormData.set("min_preparation_duration_minutes", 0);

  if (preferencesFormData.get("max_preparation_duration_minutes") === "")
    preferencesFormData.set("max_preparation_duration_minutes", 999999);

  for (const [key, value] of preferencesFormData.entries()) console.log(key + " ==> " + value);

  try {
    let result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/preferences_controller/preferences_controller_main.php",
      preferencesFormData
    );

    if (result.status === "success") {
      localStorage.setItem("mealIds", JSON.stringify(result.message));
      mealIds = JSON.parse(localStorage.getItem("mealIds"));

      console.log(mealIds);

      currentMealIdsIndex = 0;

      idElements.totalMealsSpan.innerHTML = `(${currentMealIdsIndex + 1} / ${mealIds.length})`;

      Utils.toggleVisibility(idElements.overlay, false);
      Utils.toggleVisibility(idElements.preferencesPopup, false);

      document.body.classList.toggle("overflow-y-hidden", false);

      MealPageUtils.updateUserInfoMealCategories(
        userInfo.meal_categories,
        preferencesFormData.getAll("checked_categories[]")
      );

      userInfo.dietary_filters = MealPageUtils.updateUserInfoDietaryFilters(
        userInfo.dietary_filters,
        preferencesFormData.getAll("checked_filters[]")
      );

      localStorage.setItem("is_favorites_checked", parseInt(preferencesFormData.get("is_favorites_checked")));
      localStorage.setItem("sort_by", preferencesFormData.get("sort_by"));
      localStorage.setItem("order", preferencesFormData.get("order"));
      localStorage.setItem(
        "min_nb_calories_per_portion",
        parseInt(preferencesFormData.get("min_nb_calories_per_portion"))
      );
      localStorage.setItem(
        "max_nb_calories_per_portion",
        parseInt(preferencesFormData.get("max_nb_calories_per_portion"))
      );
      localStorage.setItem(
        "min_preparation_duration_minutes",
        parseInt(preferencesFormData.get("min_preparation_duration_minutes"))
      );
      localStorage.setItem(
        "max_preparation_duration_minutes",
        parseInt(preferencesFormData.get("max_preparation_duration_minutes"))
      );

      isFavoritesChecked = localStorage.getItem("is_favorites_checked");
      sort_by = localStorage.getItem("sort_by");
      order = localStorage.getItem("order");

      MealPageUtils.updateMealCategories(idElements.categoriesContainer, userInfo.meal_categories);
      MealPageUtils.updateIsFavoritesCheckedFilter(idElements.dietaryFiltersContainer, isFavoritesChecked);
      MealPageUtils.updateDietaryFilters(idElements.dietaryFiltersContainer, userInfo.dietary_filters);
      MealPageUtils.updateOrder(idElements.sortAndOrderContainer, order);
      MealPageUtils.updateSortBy(idElements.sortAndOrderContainer, sort_by);
    }

    let currentMealId = new URLSearchParams({
      meal_id: mealIds[currentMealIdsIndex]
    });

    result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/meal_card_controller/meal_card_controller_main.php",
      currentMealId
    );

    if (result.status === "success") {
      const meal = result.message;

      MealPageUtils.refreshMealCardAndDetails(
        meal,
        idElements.mealImage,
        idElements.mealName,
        idElements.mealDescription,
        idElements.totalCaloriesSpan,
        idElements.totalMinutesSpan,
        idElements.totalPortionsSpan
      );
    }
  } catch (error) {
    console.log("Internal server error " + error.message);
  }
});

idElements.previousMealButton.addEventListener("click", async () => {
  if (currentMealIdsIndex === 0) currentMealIdsIndex = mealIds.length - 1;
  else currentMealIdsIndex--;

  idElements.totalMealsSpan.innerHTML = `(${currentMealIdsIndex + 1} / ${mealIds.length})`;

  let currentMealId = new URLSearchParams({
    meal_id: mealIds[currentMealIdsIndex]
  });

  const result = await Utils.fetchData(
    "../../../controllers/meal_page_controllers/meal_card_controller/meal_card_controller_main.php",
    currentMealId
  );

  if (result.status === "success") {
    const meal = result.message;

    MealPageUtils.refreshMealCardAndDetails(
      meal,
      idElements.mealImage,
      idElements.mealName,
      idElements.mealDescription,
      idElements.totalCaloriesSpan,
      idElements.totalMinutesSpan,
      idElements.totalPortionsSpan
    );
  }
});

idElements.nextMealButton.addEventListener("click", async () => {
  if (currentMealIdsIndex === mealIds.length - 1) currentMealIdsIndex = 0;
  else currentMealIdsIndex++;

  idElements.totalMealsSpan.innerHTML = `(${currentMealIdsIndex + 1} / ${mealIds.length})`;

  let currentMealId = new URLSearchParams({
    meal_id: mealIds[currentMealIdsIndex]
  });

  const result = await Utils.fetchData(
    "../../../controllers/meal_page_controllers/meal_card_controller/meal_card_controller_main.php",
    currentMealId
  );

  if (result.status === "success") {
    const meal = result.message;

    MealPageUtils.refreshMealCardAndDetails(
      meal,
      idElements.mealImage,
      idElements.mealName,
      idElements.mealDescription,
      idElements.totalCaloriesSpan,
      idElements.totalMinutesSpan,
      idElements.totalPortionsSpan
    );
  }
});
