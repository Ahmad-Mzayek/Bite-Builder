export const toggleVisibility = (element, show) => {
  element.classList.toggle("hidden", !show);
  element.classList.toggle("flex", show);
};

export const togglePointerEvents = (element, disable) => {
  element.classList.toggle("pointer-events-none", disable);
};

export const switchElements = (elementToShow, elementToHide) => {
  toggleVisibility(elementToHide, false);
  toggleVisibility(elementToShow, true);
};

export const deleteInputData = (...inputs) => {
  inputs.forEach((input) => (input.value = ""));
};

export const isOverlayVisible = (overlay) => {
  return overlay.classList.contains("flex");
};

export const isAnyPopupVisible = (...popups) => {
  return popups.some((popup) => {
    return popup.classList.contains("flex");
  });
};

export const toggleLoadingAnimation = (overlay, loadingAnimationSpinner, isLoading) => {
  toggleVisibility(overlay, isLoading);
  overlay.classList.replace("z-10", "z-30");
  toggleVisibility(loadingAnimationSpinner, isLoading);
};
