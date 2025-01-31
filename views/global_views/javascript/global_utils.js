export const toggleVisibility = (element, show) => {
  element.classList.toggle("hidden", !show);
  element.classList.toggle("flex", show);
};

export const switchElements = (elementToShow, elementToHide) => {
  toggleVisibility(elementToHide, false);
  toggleVisibility(elementToShow, true);
};

export const deleteInputData = (...inputs) => {
  inputs.forEach((input) => (input.value = ""));
};