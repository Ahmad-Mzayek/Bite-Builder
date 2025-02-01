import { idElements, classElements } from "./meal_page_elements.js";
import * as MealPageUtils from "./meal_page_utils.js";
import * as Utils from "../../global_views/javascript/global_utils.js";

let themeSwitch = true;

idElements.overlay.classList.replace("z-10", "z-20");

idElements.themeSwitchButton.addEventListener("click", () => {
  themeSwitch = !themeSwitch;
  if (themeSwitch) {
    const isDark = document.body.classList.toggle("dark");
    document.body.classList.toggle("light", !isDark);
  }
});

idElements.hamburgerMenu.addEventListener("click", () => {
  idElements.hamburgerMenu.classList.toggle("active");
  idElements.dropdownMenuOverlay.classList.toggle("hidden");

  if (idElements.hamburgerMenu.classList.contains("active")) {
    idElements.dropdownMenuList.classList.replace("-top-[150px]", "top-[64px]");
    idElements.dropdownMenuList.classList.replace("-z-10", "z-10");
    idElements.dropdownMenuList.classList.replace("opacity-0", "opacity-100");
    document.body.classList.toggle("overflow-y-hidden", true);
  } else {
    idElements.dropdownMenuList.classList.replace("top-[64px]", "-top-[150px]");
    idElements.dropdownMenuList.classList.replace("z-10", "-z-10");
    idElements.dropdownMenuList.classList.replace("opacity-100", "opacity-0");
    document.body.classList.toggle("overflow-y-hidden", false);
  }
});

idElements.closeFiltersPopupButton.addEventListener("click", () => {
  Utils.toggleVisibility(idElements.overlay, false);
  Utils.toggleVisibility(idElements.mealFiltersPopup, false);
  document.body.classList.toggle("overflow-y-hidden", false);
});

idElements.filterButton.addEventListener("click", async (event) => {
  event.preventDefault();
  Utils.toggleVisibility(idElements.overlay, true);
  Utils.toggleVisibility(idElements.mealFiltersPopup, true);
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
      }
    );

    const categories = await response.json();

    if (categories.status !== "success") throw new Error("Categories not fetched.");

    MealPageUtils.fetchCategories(categories);
  } catch (error) {
    console.error("Internal server error: " + error.message);
  }
});

idElements.mealFiltersForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const mealFiltersFormData = new FormData(event.target);

  try {
    const response = await fetch(
      "../../../controllers/meal_page_controllers/preferences_controller/preferences_controller_main.php",
      {
        method: "POST",
        body: mealFiltersFormData,
      }
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
  }
});
