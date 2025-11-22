document.addEventListener("DOMContentLoaded", function () {
  let deleteSupplierId = null;
  let deleteRowElement = null;

  const deleteButtons = document.querySelectorAll(".btn-delete");
  const confirmDeleteBtn = document.getElementById("confirmSupplierDeleteBtn");

  // Open delete modal
  window.openSupplierDeleteModal = function (id, rowElement) {
    deleteSupplierId = id;
    deleteRowElement = rowElement;
    document.getElementById("deleteSupplierModal").style.display = "block";
  };

  // Close delete modal
  window.closeSupplierDeleteModal = function () {
    deleteSupplierId = null;
    deleteRowElement = null;
    document.getElementById("deleteSupplierModal").style.display = "none";
  };

  // Attach delete button clicks
  deleteButtons.forEach(button => {
    button.addEventListener("click", function () {
      const id = this.dataset.id;
      const rowElement = this.closest("tr");
      openSupplierDeleteModal(id, rowElement);
    });
  });

  // Confirm delete
  confirmDeleteBtn.addEventListener("click", function () {
    if (!deleteSupplierId) return;

    fetch("../backend/routes/delete_supplier.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${deleteSupplierId}`
    })
    .then(response => response.text())
    .then(data => {
      if (data.trim() === "success") {
        deleteRowElement.remove();
        showToast("✅ Supplier deleted successfully!", "success");
      } else {
        showToast("❌ Failed to delete supplier.", "error");
      }
      closeSupplierDeleteModal();
    })
    .catch(error => {
      console.error("Error:", error);
      showToast("❌ Server error while deleting supplier.", "error");
      closeSupplierDeleteModal();
    });
  });
});
