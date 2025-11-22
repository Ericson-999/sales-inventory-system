document.addEventListener("DOMContentLoaded", function () {
  const toggles = document.querySelectorAll(".toggle-password");

  toggles.forEach(function (toggleBtn) {
    const input = toggleBtn.previousElementSibling;

    toggleBtn.addEventListener("click", function () {
      const isHidden = input.type === "password";
      input.type = isHidden ? "text" : "password";

      // Swap icon
      this.querySelector("i").classList.toggle("fa-eye-slash");
      this.querySelector("i").classList.toggle("fa-eye");

      // Optional: update aria-label
      this.setAttribute("aria-label", isHidden ? "Hide password" : "Show password");
    });
  });
});
