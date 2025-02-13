import * as Utils from "../../global_views/javascript/global_utils.js";

export const toggleGridVisibility = (element, show) => {
  element.classList.toggle("grid", show);
  element.classList.toggle("hidden", !show);
};

export const toggleDropDownMenu = (hamburgerMenu, overlay, dropdownMenu) => {
  hamburgerMenu.classList.toggle("active");
  overlay.classList.toggle("hidden");
  if (hamburgerMenu.classList.contains("active")) {
    dropdownMenu.classList.replace("-top-[350px]", "top-[60px]");
    dropdownMenu.classList.replace("-z-10", "z-10");
    dropdownMenu.classList.replace("opacity-0", "opacity-100");
  } else {
    dropdownMenu.classList.replace("top-[60px]", "-top-[350px]");
    dropdownMenu.classList.replace("z-10", "-z-10");
    dropdownMenu.classList.replace("opacity-100", "opacity-0");
  }
};

export const fetchAndUpdateMealCategories = (mealCategoriesContainer, mealCategories) => {
  for (const [categoryName, isCategoryChecked] of Object.entries(mealCategories)) {
    let categoryContainerChild = document.createElement("div");
    categoryContainerChild.classList.add("flex", "items-center", "space-x-3");

    let categoryContainerChildLabel = document.createElement("label");
    categoryContainerChildLabel.classList.add("flex", "items-center", "cursor-pointer", "group");

    let categoryContainerChildLabelInput = document.createElement("input");
    categoryContainerChildLabelInput.classList.add("hidden", "peer");
    categoryContainerChildLabelInput.setAttribute("type", "checkbox");
    categoryContainerChildLabelInput.setAttribute("name", "checked_categories[]");
    categoryContainerChildLabelInput.setAttribute("value", categoryName);
    categoryContainerChildLabelInput.checked = isCategoryChecked;

    let categoryContainerChildLabelFirstSpan = document.createElement("span");
    categoryContainerChildLabelFirstSpan.classList.add(
      "relative",
      "flex",
      "items-center",
      "justify-center",
      "w-8",
      "h-8",
      "transition-all",
      "duration-500",
      "bg-gray-100",
      "border-2",
      "border-gray-400",
      "rounded-md",
      "shadow-md",
      "peer-checked:border-blue-500",
      "peer-checked:bg-blue-500",
      "peer-hover:scale-105"
    );

    let categoryContainerChildLabelFirstSpanChildSpan = document.createElement("span");
    categoryContainerChildLabelFirstSpanChildSpan.classList.add(
      "absolute",
      "inset-0",
      "transition-all",
      "duration-500",
      "rounded-md",
      "opacity-0",
      "bg-gradient-to-br",
      "from-white/30",
      "to-white/10",
      "peer-checked:opacity-100",
      "peer-checked:animate-pulse"
    );

    let categoryContainerChildLabelFirstSpanSvg = document.createElement("svg");
    categoryContainerChildLabelFirstSpanSvg.setAttribute("fill", "currentColor");
    categoryContainerChildLabelFirstSpanSvg.setAttribute("viewBox", "0 0 20 20");
    categoryContainerChildLabelFirstSpanSvg.setAttribute("xmlns", "http://www.w3.org/2000/svg");

    categoryContainerChildLabelFirstSpanSvg.classList.add(
      "hidden",
      "w-5",
      "h-5",
      "text-white",
      "peer-checked:block",
      "transition-transform",
      "duration-500",
      "transform",
      "scale-50",
      "peer-checked:scale-100"
    );

    let categoryContainerChildLabelFirstSpanSvgPath = document.createElement("path");
    categoryContainerChildLabelFirstSpanSvgPath.setAttribute("clip-rule", "evenodd");
    categoryContainerChildLabelFirstSpanSvgPath.setAttribute("fill-rule", "evenodd");
    categoryContainerChildLabelFirstSpanSvgPath.setAttribute(
      "d",
      "M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
    );

    let categoryContainerChildLabelSecondSpan = document.createElement("span");
    categoryContainerChildLabelSecondSpan.classList.add(
      "ml-3",
      "transition-colors",
      "duration-300",
      "group-hover:text-blue-500"
    );
    categoryContainerChildLabelSecondSpan.innerHTML = `${categoryName}`;

    categoryContainerChild.appendChild(categoryContainerChildLabel);
    categoryContainerChildLabel.appendChild(categoryContainerChildLabelInput);
    categoryContainerChildLabel.appendChild(categoryContainerChildLabelFirstSpan);
    categoryContainerChildLabelFirstSpan.appendChild(categoryContainerChildLabelFirstSpanChildSpan);
    categoryContainerChildLabelFirstSpan.appendChild(categoryContainerChildLabelFirstSpanSvg);
    categoryContainerChildLabelFirstSpanSvg.appendChild(categoryContainerChildLabelFirstSpanSvgPath);
    categoryContainerChildLabel.appendChild(categoryContainerChildLabelSecondSpan);
    mealCategoriesContainer.appendChild(categoryContainerChild);
  }
};

export const toggleInputSelection = (button, checked) => {
  button.checked = checked;
};

export const refreshMealCardAndDetails = (
  meal,
  addToFavoritesButton,
  mealImageContainer,
  mealNameContainer,
  mealCategoryContainer,
  totalCaloriesSpan,
  totalMinutesSpan,
  totalPortionsSpan
) => {
  if (meal === null) {
    mealImageContainer.setAttribute("src", "../../../resources/images/default_meal_image.png");
    mealCategoryContainer.innerHTML = "No Category To Display";
    mealNameContainer.innerHTML = "No Meals Found!";
    totalCaloriesSpan.innerHTML = "0 Calories";
    totalMinutesSpan.innerHTML = "0 Minutes";
    totalPortionsSpan.innerHTML = "0 Portions";
    toggleFavoritesIcon(addToFavoritesButton, false);
  } else {
    mealImageContainer.setAttribute("src", `../../../resources/images/${meal.image_name}`);
    mealCategoryContainer.innerHTML = meal.category_name;
    mealNameContainer.innerHTML = meal.meal_name;
    totalCaloriesSpan.innerHTML = `${meal.nb_calories_per_portion} Calories`;
    totalMinutesSpan.innerHTML = `${meal.preparation_duration_minutes} Minutes`;
    totalPortionsSpan.innerHTML = `${meal.nb_portions} Portions`;
    toggleFavoritesIcon(addToFavoritesButton, meal.is_favorite);
  }
};

export const resetMealDetailsPopupIngredientsList = (mealIngredientsListContainer) => {
  mealIngredientsListContainer.textContent = "";
};

export const refreshMealDetailsPopup = (
  meal,
  mealImageContainer,
  mealNameContainer,
  mealDescriptionContainer,
  mealIngredientsListContainer
) => {
  console.log(meal.recipe);

  mealImageContainer.setAttribute("src", `../../../resources/images/${meal.image_name}`);
  mealNameContainer.innerHTML = meal.meal_name;
  mealDescriptionContainer.innerHTML = meal.description;

  for (const ingredient of meal.recipe) {
    let ingredientListContainerByType = mealIngredientsListContainer.querySelector(
      `div[type-filter=${ingredient.type_name}]`
    );

    if (ingredientListContainerByType === null) {
      let ingredientsListContainer = document.createElement("div");
      ingredientsListContainer.setAttribute("type-filter", ingredient.type_name);
      ingredientsListContainer.classList.add(
        "ingredients-list-container",
        "flex",
        "items-center",
        "gap-2",
        "bg-gray-500",
        "rounded-md",
        "w-full",
        "p-2",
        "cursor-pointer"
      );

      ingredientsListContainer.innerHTML = `
        <svg class="w-4 h-4 fill-white transition-all duration-100 rotate-90"
             xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 320 512">
          <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
        </svg>

        <h3>
          ${ingredient.type_name}
        </h3>
        `;

      mealIngredientsListContainer.appendChild(ingredientsListContainer);

      let ingredientsList = document.createElement("div");
      ingredientsList.classList.add(
        "grid",
        "w-full",
        "grid-cols-3",
        "gap-2",
        "p-4",
        "border-2",
        "ingredients-list",
        "place-items-center"
      );

      let ingredientName = document.createElement("h3");
      ingredientName.innerHTML = ingredient.ingredient_name;

      let ingredientQuantity = document.createElement("h3");
      ingredientQuantity.innerHTML = ingredient.quantity === null ? "User Preference" : ingredient.quantity;

      let ingredientUnit = document.createElement("h3");
      ingredientUnit.innerHTML =
        ingredient.quantity > 1 || ingredient.quantity === null
          ? ingredient.unit_name_plural
          : ingredient.unit_name_singular;

      ingredientsList.append(ingredientName, ingredientQuantity, ingredientUnit);

      mealIngredientsListContainer.appendChild(ingredientsList);
    } else {
      let suitableIngredientList = ingredientListContainerByType.nextElementSibling;
      console.log(suitableIngredientList);

      let ingredientName = document.createElement("h3");
      ingredientName.innerHTML = ingredient.ingredient_name;

      let ingredientQuantity = document.createElement("h3");
      ingredientQuantity.innerHTML = ingredient.quantity === null ? "User Preference" : ingredient.quantity;

      let ingredientUnit = document.createElement("h3");
      ingredientUnit.innerHTML =
        ingredient.quantity > 1 || ingredient.quantity === null
          ? ingredient.unit_name_plural
          : ingredient.unit_name_singular;

      suitableIngredientList.append(ingredientName, ingredientQuantity, ingredientUnit);
    }
  }

  document.querySelectorAll(".ingredients-list-container").forEach((container) => {
    container.addEventListener("click", () => {
      let categoryItemsList = container.nextElementSibling;
      let containerArrowSVG = container.querySelector("svg");

      if (categoryItemsList.classList.contains("grid")) {
        toggleGridVisibility(categoryItemsList, false);
        containerArrowSVG.classList.toggle("rotate-90", false);
      } else {
        toggleGridVisibility(categoryItemsList, true);
        containerArrowSVG.classList.toggle("rotate-90", true);
      }
      console.log(categoryItemsList);
    });
  });
};

export const updateUserInfoMealCategories = (userInfoMealCategories, checkedMealCategories) => {
  for (const mealCategory of Object.keys(userInfoMealCategories)) {
    userInfoMealCategories[mealCategory] = checkedMealCategories.includes(mealCategory) ? 1 : 0;
  }
};

export const updateUserInfoDietaryFilters = (userInfoDietaryFilters, checkedDietaryFilters) => {
  userInfoDietaryFilters = [];

  checkedDietaryFilters.forEach((dietaryFilter) => {
    userInfoDietaryFilters.push(dietaryFilter);
  });

  return userInfoDietaryFilters;
};

export const updateMealCategories = (categoriesContainer, userMealCategories) => {
  const categoryCheckboxes = categoriesContainer.querySelectorAll('input[type="checkbox"]');
  let checkboxInputIndex = 0;

  for (const [categoryName, isCategoryChecked] of Object.entries(userMealCategories)) {
    categoryCheckboxes[checkboxInputIndex].checked = isCategoryChecked;
    checkboxInputIndex++;
  }
};

export const updateIsFavoritesCheckedFilter = (filtersContainer, userIsFavoritesChecked) => {
  const isFavoritesCheckedCheckbox = filtersContainer.querySelector(
    'input[type="checkbox"][name="is_favorites_checked"]'
  );

  isFavoritesCheckedCheckbox.checked = userIsFavoritesChecked == "1" ? true : false;
};

export const updateDietaryFilters = (filtersContainer, userDietaryFilters, rangeFilters) => {
  const filtersCheckboxes = filtersContainer.querySelectorAll('input[type="checkbox"][name="checked_filters[]"]');
  const numberInputs = filtersContainer.querySelectorAll('input[type="number"]');

  for (const filterCheckbox of filtersCheckboxes)
    filterCheckbox.checked = userDietaryFilters.includes(filterCheckbox.value) ? true : false;

  for (let i = 0; i < numberInputs.length; i++) numberInputs[i].value = rangeFilters[i];

  if (rangeFilters[0] == 0) numberInputs[0].value = "";
  if (rangeFilters[1] == 9999) numberInputs[1].value = "";
  if (rangeFilters[2] == 0) numberInputs[2].value = "";
  if (rangeFilters[3] == 999999) numberInputs[3].value = "";
};

export const updateSortBy = (sortAndOrderContainer, userSortPreference) => {
  const sortByRadioInputs = sortAndOrderContainer.querySelectorAll('input[type="radio"][name="sort_by"]');

  for (const sortByRadioInput of sortByRadioInputs) {
    sortByRadioInput.checked = userSortPreference === sortByRadioInput.value ? true : false;
  }
};

export const updateOrder = (sortAndOrderContainer, userOrderPreference) => {
  const orderRadioInputs = sortAndOrderContainer.querySelectorAll('input[type="radio"][name="order"]');

  for (const orderRadioInput of orderRadioInputs) {
    orderRadioInput.checked = userOrderPreference === orderRadioInput.value ? true : false;
  }
};

export const toggleFavoritesIcon = (addToFavoritesButton, isMealFavorited) => {
  const addToFavoritesIcons = addToFavoritesButton.querySelectorAll("svg");

  if (isMealFavorited) {
    Utils.toggleVisibility(addToFavoritesIcons[0], false);
    Utils.toggleVisibility(addToFavoritesIcons[1], true);
  } else {
    Utils.toggleVisibility(addToFavoritesIcons[0], true);
    Utils.toggleVisibility(addToFavoritesIcons[1], false);
  }
};
