(function hanldePopUp() {
  const button = document.getElementById("pop-up__close-button");
  const overlay = document.getElementById("pop-up__overlay");

  const removePopup = (popup = document.getElementById("pop-up")) => {
    popup ? popup.remove() : null;
  };

  button?.addEventListener("click", () => {
    removePopup();
  });

  overlay?.addEventListener("click", () => {
    removePopup();
  });
})();
