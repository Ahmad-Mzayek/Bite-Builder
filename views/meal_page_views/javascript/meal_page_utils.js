export const fetchCategories = (categories) => {
  categories.forEach((category) => {
    categoryContainerChild = document.createElement("div");
    categoryContainerChild.classList.add("flex items-center space-x-3");

    categoryContainerChildLabel = document.createElement("label");
    categoryContainerChildLabel.classList.add("group flex items-center cursor-pointer");

    categoryContainerChildLabelInput = document.createElement("input");
    categoryContainerChildInput.classList.add("hidden peer");
    categoryContainerChildInput.setAttribute("type", "checkbox");
    categoryContainerChildInput.setAttribute("name", "meal_categories[]");
    categoryContainerChildInput.setAttribute("value", category.name);

    categoryContainerChildFirstSpan = document.createElement("span");
    categoryContainerChildFirstSpan.classList.add(
      "relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105"
    );

    categoryContainerChildSpanChildSpan = document.createElement("span");
    categoryContainerChildSecondSpan.classList.add(
      "absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"
    );

    categoryContainerChildSpanSvg = document.createElement("svg");
    categoryContainerChildSpanSvg.setAttribute("fill", "currentColor");
    categoryContainerChildSpanSvg.setAttribute("viewBox", "0 0 20 20");
    categoryContainerChildSpanSvg.setAttribute("xmlns", "http://www.w3.org/2000/svg");

    categoryContainerChildSpanSvg.classList.add(
      "hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
    );

    categoryContainerChildSpanSvgPath = document.createElement("path");
    categoryContainerChildSpanSvgPath.setAttribute("clip-rule", "evenodd");
    categoryContainerChildSpanSvgPath.setAttribute("fill-rule", "evenodd");
    categoryContainerChildSpanSvgPath.setAttribute(
      "d",
      "M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
    );

    categoryContainerChildSpan = document.createElement("span");
    categoryContainerChildSpan.classList.add(
      "ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300"
    );
    categoryContainerChildSpan.innerHTML = `${category.name}`;
  });
};
