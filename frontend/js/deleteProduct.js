document.addEventListener("DOMContentLoaded", function () {
  let deleteProductId = null;
  let deleteRowElement = null;

  const deleteButtons = document.querySelectorAll(".btn-delete");
  const confirmDeleteBtn = document.getElementById("confirmProductDeleteBtn");

  // Open modal
  window.openProductDeleteModal = function (id, rowElement) {
    deleteProductId = id;
    deleteRowElement = rowElement;
    document.getElementById("deleteProductModal").style.display = "block";
  };

  // Close modal
  window.closeProductDeleteModal = function () {
    deleteProductId = null;
    deleteRowElement = null;
    document.getElementById("deleteProductModal").style.display = "none";
  };

  // Attach delete button clicks
  deleteButtons.forEach(button => {
    button.addEventListener("click", function () {
      const id = this.dataset.id;
      const rowElement = this.closest("tr");
      openProductDeleteModal(id, rowElement);
    });
  });

  // Confirm delete
  confirmDeleteBtn.addEventListener("click", function () {
    if (!deleteProductId) return;

    fetch("../backend/routes/delete_product.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${deleteProductId}`
    })
    .then(response => response.text())
    .then(data => {
      if (data.trim() === "success") {
        deleteRowElement.remove();
        showToast("✅ Product deleted successfully!", "success");
      } else {
        showToast("❌ Failed to delete product.", "error");
      }
      closeProductDeleteModal();
    })
    .catch(error => {
      console.error("Error:", error);
      showToast("❌ Server error while deleting product.", "error");
      closeProductDeleteModal();
    });
  });
});
