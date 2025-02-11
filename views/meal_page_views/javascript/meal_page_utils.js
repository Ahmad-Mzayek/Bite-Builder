export const fetchAndUpdateCategories = (categoriesContainer, categories) => {
  for (const [categoryName, isCategorySelected] of Object.entries(categories)) {
    let categoryContainerChild = document.createElement("div");
    categoryContainerChild.classList.add("flex", "items-center", "space-x-3");

    let categoryContainerChildLabel = document.createElement("label");
    categoryContainerChildLabel.classList.add("flex", "items-center", "cursor-pointer", "group");

    let categoryContainerChildLabelInput = document.createElement("input");
    categoryContainerChildLabelInput.classList.add("hidden", "peer");
    categoryContainerChildLabelInput.setAttribute("type", "checkbox");
    categoryContainerChildLabelInput.setAttribute("name", "meal_categories[]");
    categoryContainerChildLabelInput.setAttribute("value", categoryName);
    categoryContainerChildLabelInput.checked = isCategorySelected;

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
      "font-medium",
      "text-gray-700",
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
    categoriesContainer.appendChild(categoryContainerChild);
  }
};

export const toggleInputSelection = (button, checked) => {
  button.checked = checked;
};

// export const initializePreferencesPopupOptions()

// export const renderMealDetails(meal, mealCard, mealDetailsPopup) => {

// }
