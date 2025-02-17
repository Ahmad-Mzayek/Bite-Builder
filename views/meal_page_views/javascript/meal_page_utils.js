import * as Utils from "../../global_views/javascript/global_utils.js";

export const toggleGridVisibility = (element, show) => {
  element.classList.toggle("grid", show);
  element.classList.toggle("hidden", !show);
};

export const toggleDropDownMenu = (hamburgerMenu, overlay, dropdownMenu) => {
  hamburgerMenu.classList.toggle("active");
  hamburgerMenu.classList.toggle("z-30");

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
    totalMinutesSpan.innerHTML = `${meal.preparation_duration_minutes} ${meal.preparation_duration_minutes === 1 ? "Minute" : "Minutes"}`;
    totalPortionsSpan.innerHTML = `${meal.nb_portions} ${meal.nb_portions === 1 ? "Portion" : "Portions"}`;
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
  mealImageContainer.setAttribute("src", `../../../resources/images/${meal.image_name}`);
  mealNameContainer.innerHTML = meal.meal_name;
  mealDescriptionContainer.innerHTML = meal.description;

  for (const ingredient of meal.recipe) {
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
    ingredientsList.innerHTML = `
      <h3 class="justify-self-start">
        ${ingredient.ingredient_name}
      </h3>
      
      <h3>
        ${ingredient.quantity === null ? "Optional" : ingredient.quantity}
      </h3>
  
      <h3>
        ${ingredient.quantity === 1 ? ingredient.unit_name_singular : ingredient.quantity === null ? "" : ingredient.unit_name_plural} 
      </h3>
    `;

    let ingredientListContainerByType = mealIngredientsListContainer.querySelector(
      `div[type-filter="${ingredient.type_name}"]`
    );

    if (ingredientListContainerByType === null) {
      let ingredientsListContainer = document.createElement("div");
      ingredientsListContainer.setAttribute("type-filter", ingredient.type_name);
      ingredientsListContainer.classList.add(
        "ingredients-list-container",
        "flex",
        "items-center",
        "gap-2",
        "p-2",
        "bg-gray-500",
        "rounded-md",
        "w-full",
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

      mealIngredientsListContainer.appendChild(ingredientsList);
    } else {
      let suitableIngredientList = ingredientListContainerByType.nextElementSibling;

      let ingredientName = document.createElement("h3");
      ingredientName.classList.add("justify-self-start");
      ingredientName.innerHTML = ingredient.ingredient_name;

      let ingredientQuantity = document.createElement("h3");
      ingredientQuantity.innerHTML = ingredient.quantity === null ? "Optional" : ingredient.quantity;

      let ingredientUnit = document.createElement("h3");
      ingredientUnit.innerHTML =
        ingredient.quantity === 1
          ? ingredient.unit_name_singular
          : ingredient.quantity === null
            ? ""
            : ingredient.unit_name_plural;

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
    });
  });
};

export const addMealIngredientsToShoppingList = (shoppingList, shoppingListGridContainer) => {
  if (shoppingList.length === 0) {
    shoppingListGridContainer.innerHTML = `<h1 class="place-self-center col-span-4">Shopping List Is Empty</h1>`;
    return;
  }

  shoppingListGridContainer.innerHTML = "";

  for (const ingredient of shoppingList) {
    let ingredientContainer = document.createElement("div");
    ingredientContainer.setAttribute("ingredient-filter", ingredient.type_name);
    ingredientContainer.setAttribute("ingredient-name", ingredient.ingredient_name);
    ingredientContainer.classList.add("flex", "items-center", "gap-2", "p-2", "w-full", "col-span-4");
    ingredientContainer.innerHTML = `
      <h4 class="flex items-center justify-start gap-3 text-[1rem] basis-full text-wrap">
        <svg class="delete-ingredient-icon w-6 h-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
        </svg>

        <span>
          ${ingredient.ingredient_name}
        </span>
      </h4>

      <div class="flex items-center gap-4 quantity-container basis-full justify-start">
        <button class="decrement-ingredient-button relative w-8 h-8 bg-white rounded-full" ${ingredient.quantity === null || ingredient.quantity === 1 ? "disabled" : ""}>
            <span class="absolute w-3 h-[2px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-slate-600">
                
            </span>
        </button>

        <input type="number"
               value="${ingredient.quantity === null ? 1 : ingredient.quantity}"
               class="ingredient-quantity-input w-24 p-2 rounded-sm"
               name="new_quantity" 
               required>

        <button class="increment-ingredient-button relative w-8 h-8 bg-white rounded-full">
            <span class="absolute w-3 h-[2px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-slate-600">
                
            </span>

            <span class="absolute w-3 h-[2px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-slate-600 rotate-90">
              
            </span>
        </button>       
      </div>

      <h4 class="pr-2 text-[1.2rem] basis-1/2 text-end">
        ${ingredient.quantity === 1 || ingredient.quantity === null ? ingredient.unit_name_singular : ingredient.unit_name_plural}
      </h4>
    </div>
        `;

    let shoppingListIngredientTypeContainer = shoppingListGridContainer.querySelector(
      `div[type-filter="${ingredient.type_name}"]`
    );

    if (shoppingListIngredientTypeContainer === null) {
      let ingredientsListContainer = document.createElement("div");
      ingredientsListContainer.setAttribute("type-filter", ingredient.type_name);
      ingredientsListContainer.classList.add(
        "shopping-list-ingredient-type-container",
        "flex",
        "items-center",
        "w-full",
        "col-span-4",
        "p-2",
        "gap-2",
        "mb-2",
        "bg-gray-500",
        "cursor-pointer"
      );

      ingredientsListContainer.innerHTML = `
        <svg class="w-5 h-5 fill-white transition-all duration-100 rotate-90"
             xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 320 512">
          <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
        </svg>

        <h3>
          ${ingredient.type_name}
        </h3>
        `;

      shoppingListGridContainer.appendChild(ingredientsListContainer);
      shoppingListGridContainer.appendChild(ingredientContainer);
    } else {
      shoppingListGridContainer.insertBefore(
        ingredientContainer,
        shoppingListIngredientTypeContainer.nextElementSibling
      );
    }
  }

  shoppingListGridContainer.querySelectorAll(".shopping-list-ingredient-type-container").forEach((container) => {
    container.addEventListener("click", () => {
      let ingredientsOfTheSameType = shoppingListGridContainer.querySelectorAll(
        `div[ingredient-filter="${container.getAttribute("type-filter")}"]`
      );

      let containerArrowSVG = container.querySelector("svg");

      if (ingredientsOfTheSameType[0].classList.contains("flex")) {
        ingredientsOfTheSameType.forEach((ingredient) => {
          Utils.toggleVisibility(ingredient, false);
        });
        containerArrowSVG.classList.toggle("rotate-90", false);
      } else {
        ingredientsOfTheSameType.forEach((ingredient) => {
          Utils.toggleVisibility(ingredient, true);
        });
        containerArrowSVG.classList.toggle("rotate-90", true);
      }
    });
  });
};
