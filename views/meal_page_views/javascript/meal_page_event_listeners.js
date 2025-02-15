import { idElements, classElements } from "./meal_page_elements.js";
import * as MealPageUtils from "./meal_page_utils.js";
import * as Utils from "../../global_views/javascript/global_utils.js";

let themeSwitch = true;
let isDarkModeOn = localStorage.getItem("isDarkModeOn") || "true";

let userInfo;
let userShoppingList;
let currentMeal;
let searchedMealName = "";
let numberInputs;

// localStorage.clear(); // TODO REMOVE LATER --------------------------------------------------------------------------------

let mealIds = localStorage.getItem("meal_ids");
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
      userShoppingList = userInfo.shopping_list;

      console.log(userInfo);

      idElements.profilePopupUsernameInput.value = userInfo.username;

      if (userInfo.phone_number === null) idElements.profilePopupPhoneNumberInput.value = "Not Specified";
      else idElements.profilePopupPhoneNumberInput.value = userInfo.phone_number;

      idElements.profilePopupEmail.innerHTML = userInfo.email_address;

      if (userInfo.is_male === 1) MealPageUtils.toggleInputSelection(idElements.profilePopupMaleRadioInput, true);
      else MealPageUtils.toggleInputSelection(idElements.profilePopupFemaleRadioInput, true);

      numberInputs = [
        minNbCaloriesPerPortion,
        maxNbCaloriesPerPortion,
        minPreparationDurationMinutes,
        maxPreparationDurationMinutes
      ];

      MealPageUtils.fetchAndUpdateMealCategories(idElements.categoriesContainer, userInfo.meal_categories);
      MealPageUtils.updateIsFavoritesCheckedFilter(idElements.dietaryFiltersContainer, isFavoritesChecked);
      MealPageUtils.updateDietaryFilters(idElements.dietaryFiltersContainer, userInfo.dietary_filters, numberInputs);
      MealPageUtils.updateOrder(idElements.sortAndOrderContainer, order);
      MealPageUtils.updateSortBy(idElements.sortAndOrderContainer, sort_by);
      MealPageUtils.addMealIngredientsToShoppingList(userShoppingList, idElements.shoppingListGridContainer);

      let deleteIngredientIcons = document.querySelectorAll(".delete-ingredient-icon");

      addShoppingListDeleteIngredientIconEventListeners(deleteIngredientIcons);
    }

    if (mealIds === null) {
      let formData = new FormData();

      formData.append("is_favorites_checked", isFavoritesChecked);
      formData.append("sort_by", sort_by);
      formData.append("order", order);
      formData.append("searched_meal_name", searchedMealName);
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
        localStorage.setItem("meal_ids", JSON.stringify(result.message));

        mealIds = JSON.parse(localStorage.getItem("meal_ids"));
      }
    }

    if (mealIds.length === 0) {
      currentMeal = null;
      MealPageUtils.refreshMealCardAndDetails(
        null,
        idElements.addToFavoritesButton,
        idElements.mealImage,
        idElements.mealName,
        idElements.mealCategory,
        idElements.totalCaloriesSpan,
        idElements.totalMinutesSpan,
        idElements.totalPortionsSpan
      );
      idElements.totalMealsSpan.innerHTML = `(0 / ${mealIds.length})`;
      idElements.openMealDetailsPopupButton.disabled = true;
      idElements.addToFavoritesButton.disabled = true;
      idElements.addToShoppingListButton.disabled = true;
    } else {
      let currentMealId = new URLSearchParams({
        meal_id: mealIds[currentMealIdsIndex]
      });

      result = await Utils.fetchData(
        "../../../controllers/meal_page_controllers/meal_card_controller/meal_card_controller_main.php",
        currentMealId
      );

      if (result.status === "success") {
        currentMeal = result.message;
        console.log(currentMeal);

        MealPageUtils.refreshMealCardAndDetails(
          currentMeal,
          idElements.addToFavoritesButton,
          idElements.mealImage,
          idElements.mealName,
          idElements.mealCategory,
          idElements.totalCaloriesSpan,
          idElements.totalMinutesSpan,
          idElements.totalPortionsSpan
        );

        idElements.totalMealsSpan.innerHTML = `(${currentMealIdsIndex + 1} / ${mealIds.length})`;
        idElements.openMealDetailsPopupButton.disabled = false;
        idElements.addToFavoritesButton.disabled = false;
        idElements.addToShoppingListButton.disabled = false;
      } else alert("Failed Fetching Meal.");
    }
  } catch (error) {
    console.log("Internal server error: " + error.message);
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
    console.log("Internal server error: " + error.message);
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
    console.log("Internal server error: " + error.message);
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
    console.log("Internal server error: " + error.message);
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
    console.log("Internal server error: " + error.message);
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
    console.log("Internal server error: " + error.message);
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
    console.log("Internal server error: " + error.message);
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
    console.log("Internal server error: " + error.message);
  }
});

idElements.searchIcon.addEventListener("click", async () => {
  const searchInput = idElements.searchIcon.previousElementSibling;
  searchedMealName = searchInput.value;

  let formData = new FormData();

  formData.append("is_favorites_checked", isFavoritesChecked);
  formData.append("sort_by", sort_by);
  formData.append("order", order);
  formData.append("searched_meal_name", searchedMealName);
  formData.append("min_nb_calories_per_portion", minNbCaloriesPerPortion);
  formData.append("max_nb_calories_per_portion", maxNbCaloriesPerPortion);
  formData.append("min_preparation_duration_minutes", minPreparationDurationMinutes);
  formData.append("max_preparation_duration_minutes", maxPreparationDurationMinutes);

  for (const [category, isChecked] of Object.entries(userInfo.meal_categories)) {
    console.log(isChecked);
    if (isChecked == 1) formData.append("checked_categories[]", category);
  }

  if (!formData.get("checked_categories[]")) formData.append("checked_categories[]", "");

  if (userInfo.dietary_filters.length === 0) formData.append("checked_filters[]", "");
  else userInfo.dietary_filters.forEach((filter) => formData.append("checked_filters[]", filter));

  try {
    let result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/preferences_controller/preferences_controller_main.php",
      formData
    );

    if (result.status === "success") {
      localStorage.setItem("meal_ids", JSON.stringify(result.message));

      mealIds = JSON.parse(localStorage.getItem("meal_ids"));

      currentMealIdsIndex = 0;
    }

    if (mealIds.length === 0) {
      currentMeal = null;
      MealPageUtils.refreshMealCardAndDetails(
        null,
        idElements.addToFavoritesButton,
        idElements.mealImage,
        idElements.mealName,
        idElements.mealCategory,
        idElements.totalCaloriesSpan,
        idElements.totalMinutesSpan,
        idElements.totalPortionsSpan
      );
      idElements.totalMealsSpan.innerHTML = `(0 / ${mealIds.length})`;
      idElements.openMealDetailsPopupButton.disabled = true;
      idElements.addToFavoritesButton.disabled = true;
      idElements.addToShoppingListButton.disabled = true;
    } else {
      let currentMealId = new URLSearchParams({
        meal_id: mealIds[currentMealIdsIndex]
      });

      result = await Utils.fetchData(
        "../../../controllers/meal_page_controllers/meal_card_controller/meal_card_controller_main.php",
        currentMealId
      );

      if (result.status === "success") {
        currentMeal = result.message;
        console.log(currentMeal);

        MealPageUtils.refreshMealCardAndDetails(
          currentMeal,
          idElements.addToFavoritesButton,
          idElements.mealImage,
          idElements.mealName,
          idElements.mealCategory,
          idElements.totalCaloriesSpan,
          idElements.totalMinutesSpan,
          idElements.totalPortionsSpan
        );

        idElements.totalMealsSpan.innerHTML = `(${currentMealIdsIndex + 1} / ${mealIds.length})`;
        idElements.openMealDetailsPopupButton.disabled = false;
        idElements.addToFavoritesButton.disabled = false;
        idElements.addToShoppingListButton.disabled = false;
      } else alert("Failed Fetching Meal.");
    }
  } catch (error) {
    console.log("Internal server error: " + error.message);
  }
});

idElements.closePreferencesPopupButton.addEventListener("click", (event) => {
  event.preventDefault();

  Utils.toggleVisibility(idElements.overlay, false);
  Utils.toggleVisibility(idElements.preferencesPopup, false);

  document.body.classList.toggle("overflow-y-hidden", false);

  numberInputs = [
    minNbCaloriesPerPortion,
    maxNbCaloriesPerPortion,
    minPreparationDurationMinutes,
    maxPreparationDurationMinutes
  ];

  MealPageUtils.updateMealCategories(idElements.categoriesContainer, userInfo.meal_categories);
  MealPageUtils.updateIsFavoritesCheckedFilter(idElements.dietaryFiltersContainer, isFavoritesChecked);
  MealPageUtils.updateDietaryFilters(idElements.dietaryFiltersContainer, userInfo.dietary_filters, numberInputs);
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

  preferencesFormData.append("searched_meal_name", searchedMealName);

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

  try {
    let result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/preferences_controller/preferences_controller_main.php",
      preferencesFormData
    );

    if (result.status === "success") {
      localStorage.setItem("meal_ids", JSON.stringify(result.message));
      mealIds = JSON.parse(localStorage.getItem("meal_ids"));

      currentMealIdsIndex = 0;

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
      minNbCaloriesPerPortion = localStorage.getItem("min_nb_calories_per_portion");
      maxNbCaloriesPerPortion = localStorage.getItem("max_nb_calories_per_portion");
      minPreparationDurationMinutes = localStorage.getItem("min_preparation_duration_minutes");
      maxPreparationDurationMinutes = localStorage.getItem("max_preparation_duration_minutes");
      sort_by = localStorage.getItem("sort_by");
      order = localStorage.getItem("order");

      let numberInputs = [
        minNbCaloriesPerPortion,
        maxNbCaloriesPerPortion,
        minPreparationDurationMinutes,
        maxPreparationDurationMinutes
      ];

      MealPageUtils.updateMealCategories(idElements.categoriesContainer, userInfo.meal_categories);
      MealPageUtils.updateIsFavoritesCheckedFilter(idElements.dietaryFiltersContainer, isFavoritesChecked);
      MealPageUtils.updateDietaryFilters(idElements.dietaryFiltersContainer, userInfo.dietary_filters, numberInputs);
      MealPageUtils.updateOrder(idElements.sortAndOrderContainer, order);
      MealPageUtils.updateSortBy(idElements.sortAndOrderContainer, sort_by);

      if (mealIds.length === 0) {
        currentMeal = null;
        MealPageUtils.refreshMealCardAndDetails(
          null,
          idElements.addToFavoritesButton,
          idElements.mealImage,
          idElements.mealName,
          idElements.mealCategory,
          idElements.totalCaloriesSpan,
          idElements.totalMinutesSpan,
          idElements.totalPortionsSpan
        );
        idElements.totalMealsSpan.innerHTML = `(0 / ${mealIds.length})`;
        idElements.openMealDetailsPopupButton.disabled = true;
        idElements.addToFavoritesButton.disabled = true;
        idElements.addToShoppingListButton.disabled = true;
      } else {
        let currentMealId = new URLSearchParams({
          meal_id: mealIds[currentMealIdsIndex]
        });

        result = await Utils.fetchData(
          "../../../controllers/meal_page_controllers/meal_card_controller/meal_card_controller_main.php",
          currentMealId
        );

        if (result.status === "success") {
          currentMeal = result.message;

          MealPageUtils.refreshMealCardAndDetails(
            currentMeal,
            idElements.addToFavoritesButton,
            idElements.mealImage,
            idElements.mealName,
            idElements.mealCategory,
            idElements.totalCaloriesSpan,
            idElements.totalMinutesSpan,
            idElements.totalPortionsSpan
          );
          idElements.totalMealsSpan.innerHTML = `(${currentMealIdsIndex + 1} / ${mealIds.length})`;
          idElements.openMealDetailsPopupButton.disabled = false;
          idElements.addToFavoritesButton.disabled = false;
          idElements.addToShoppingListButton.disabled = false;
        }
      }
    }
  } catch (error) {
    console.log("Internal server error: " + error.message);
  }
});

idElements.previousMealButton.addEventListener("click", async () => {
  if (mealIds.length === 0) return;

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
    currentMeal = result.message;

    MealPageUtils.refreshMealCardAndDetails(
      currentMeal,
      idElements.addToFavoritesButton,
      idElements.mealImage,
      idElements.mealName,
      idElements.mealCategory,
      idElements.totalCaloriesSpan,
      idElements.totalMinutesSpan,
      idElements.totalPortionsSpan
    );
  }
});

idElements.nextMealButton.addEventListener("click", async () => {
  if (mealIds.length === 0) return;

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
    currentMeal = result.message;

    MealPageUtils.refreshMealCardAndDetails(
      currentMeal,
      idElements.addToFavoritesButton,
      idElements.mealImage,
      idElements.mealName,
      idElements.mealCategory,
      idElements.totalCaloriesSpan,
      idElements.totalMinutesSpan,
      idElements.totalPortionsSpan
    );
  }
});

idElements.addToFavoritesButton.addEventListener("click", async () => {
  const currentMealInformation = new URLSearchParams({
    meal_id: currentMeal.meal_id,
    is_favorite: currentMeal.is_favorite === true ? 1 : 0
  });

  try {
    const result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/toggle_favorite_controller/toggle_favorite_controller_main.php",
      currentMealInformation
    );

    if (result.status === "success") {
      const isCurrentMealFavorited = result.message;

      currentMeal.is_favorite = isCurrentMealFavorited;

      MealPageUtils.toggleFavoritesIcon(idElements.addToFavoritesButton, isCurrentMealFavorited);
    }
  } catch (error) {
    console.log("Internal server error: " + error.message);
  }
});

idElements.addToShoppingListButton.addEventListener("click", async () => {
  const currentMealId = new URLSearchParams({
    meal_id: currentMeal.meal_id
  });

  try {
    let result = await Utils.fetchData(
      "../../../controllers/meal_page_controllers/add_to_shopping_list_controller/add_to_shopping_list_controller_main.php",
      currentMealId
    );

    if (result.status === "success") {
      // TODO Render Meal Ingredients In Shopping List.
      userShoppingList = result.message;

      MealPageUtils.addMealIngredientsToShoppingList(userShoppingList, idElements.shoppingListGridContainer);
      const deleteIngredientIcons = document.querySelectorAll(".delete-ingredient-icon");

      addShoppingListDeleteIngredientIconEventListeners(deleteIngredientIcons);
    }
  } catch (error) {
    console.log("Internal server error: " + error.message);
  }
});

const addShoppingListDeleteIngredientIconEventListeners = (deleteIngredientIcons) => {
  deleteIngredientIcons.forEach((icon) => {
    icon.addEventListener("click", async function () {
      let shoppingListIngredientTypeContainer = icon.parentElement.parentElement.previousElementSibling;

      let ingredientName = icon.parentElement.parentElement.getAttribute("ingredient-name");
      let ingredientToDeleteRequestData = new URLSearchParams({
        ingredient_name: ingredientName,
        new_quantity: 0
      });

      const result = await Utils.fetchData(
        "../../../controllers/meal_page_controllers/set_shopping_list_quantity_controller/set_shopping_list_quantity_controller_main.php",
        ingredientToDeleteRequestData
      );

      if (result.status === "success") {
        icon.parentElement.parentElement.remove();
        if (shoppingListIngredientTypeContainer.getAttribute("type-filter") !== null) {
          if (
            shoppingListIngredientTypeContainer.nextElementSibling === null ||
            shoppingListIngredientTypeContainer.nextElementSibling.getAttribute("type-filter") !== null
          )
            shoppingListIngredientTypeContainer.remove();
        }

        if (idElements.shoppingListGridContainer.querySelector("div") === null)
          idElements.shoppingListGridContainer.innerHTML = `<h1 class="place-self-center col-span-4">Shopping List Is Empty</h1>`;
      } else alert("Failed to remove ingredient from shopping list.");
    });
  });
};

idElements.openMealDetailsPopupButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.mealDetailsPopup, true);
  Utils.toggleVisibility(idElements.overlay, true);

  MealPageUtils.resetMealDetailsPopupIngredientsList(idElements.mealIngredientsListContainer);

  MealPageUtils.refreshMealDetailsPopup(
    currentMeal,
    idElements.mealDetailsImage,
    idElements.mealDetailsPopupMealName,
    idElements.mealDescription,
    idElements.mealIngredientsListContainer
  );
});
