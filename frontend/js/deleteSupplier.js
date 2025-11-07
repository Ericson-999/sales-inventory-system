document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".btn-delete").forEach(button => {
    button.addEventListener("click", function () {
      const id = this.dataset.id;
      if (confirm("Are you sure you want to delete this product?")) {
        fetch(`../backend/routes/delete_supplier.php?id=${id}`, {
          method: "GET"
        })
        .then(response => {
          if (response.ok) {
            // Remove the row from the table
            this.closest("tr").remove();
          } else {
            alert("Failed to delete supplier.");
          }
        });
      }
    });
  });
});
