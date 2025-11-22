document.getElementById("userForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const passwordInput = document.getElementById("password");
  const password = passwordInput.value;

  const strongPasswordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/;

  if (password.length > 0 && !strongPasswordRegex.test(password)) {
    showToast("❌ Password must be at least 8 characters, include uppercase, lowercase, number, and symbol.", "error");
    passwordInput.focus();
    return;
  }

  const formData = new FormData(this);
  const isEditMode = this.action.includes("update_staff.php"); // ✅ Detect mode

  fetch(this.action, {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(result => {
    if (result.success) {
      const toastMessage = isEditMode
        ? "✅ Edit successful!"
        : "✅ User added successfully!";
      showToast(toastMessage, "success");

      closeModal();
      setTimeout(() => location.reload(), 600);
    } else if (result.error) {
      showToast("❌ " + result.error, "error");
    }
  })
  .catch(() => {
    showToast("❌ Server error!", "error");
  });
});
