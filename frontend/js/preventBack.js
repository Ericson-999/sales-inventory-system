(function () {
  const isBackNav =
    performance.getEntriesByType("navigation")[0]?.type === "back_forward";

  window.addEventListener("pageshow", function (event) {
    if (event.persisted || isBackNav) {
      window.location.reload();
    }
  });
})();
