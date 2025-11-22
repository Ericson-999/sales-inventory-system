function showToast(message, type = "success") {
  const container = document.getElementById("toast-container");
  if (!container) return;

  const toast = document.createElement("div");

  // Validate type and fallback if needed
  const validTypes = ["error", "success", "edit-success"];
  const toastType = validTypes.includes(type) ? type : "error";

  toast.className = `toast toast-${toastType}`;
  toast.textContent = message;

  container.appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, 4000);
}

document.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);
  if (params.get("edit_success") === "1") {
    showToast("✅ Edit successful!", "edit-success");
  }
});