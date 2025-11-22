document.addEventListener("DOMContentLoaded", function () {
  let deleteUserId = null;

  const deleteButtons = document.querySelectorAll(".btn-delete");
  const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

  // Open delete modal
  window.openDeleteModal = function (id, rowElement) {
    deleteUserId = { id, rowElement };
    document.getElementById("deleteConfirmModal").style.display = "block";
  };

  // Close delete modal
  window.closeDeleteModal = function () {
    deleteUserId = null;
    document.getElementById("deleteConfirmModal").style.display = "none";
  };

  // Attach delete button clicks
  deleteButtons.forEach(button => {
    button.addEventListener("click", function () {
      const userId = this.getAttribute("data-id");
      const rowElement = this.closest("tr");
      openDeleteModal(userId, rowElement);
    });
  });

  // Confirm delete
  confirmDeleteBtn.addEventListener("click", function () {
    if (!deleteUserId) return;

    fetch("../backend/routes/delete_staff.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${deleteUserId.id}`
    })
    .then(response => response.text())
    .then(data => {
      if (data.trim() === "success") {
        deleteUserId.rowElement.remove();
        showToast("✅ User deleted successfully!", "success");
      } else {
        showToast("❌ Failed to delete user.", "error");
      }
      closeDeleteModal();
    })
    .catch(error => {
      console.error("Error:", error);
      showToast("❌ Server error while deleting user.", "error");
      closeDeleteModal();
    });
  });
});
