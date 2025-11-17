document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".btn-delete");

  deleteButtons.forEach(button => {
    button.addEventListener("click", function () {
      const userId = this.getAttribute("data-id");

      if (confirm("Are you sure you want to delete this user?")) {
        fetch("../backend/routes/delete_staff.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: `id=${userId}`
        })
        .then(response => response.text())
        .then(data => {
          if (data.trim() === "success") {
            // Remove the row from the table instantly
            this.closest("tr").remove();
          } else {
            alert("Failed to delete user.");
          }
        })
        .catch(error => {
          console.error("Error:", error);
          alert("Something went wrong.");
        });
      }
    });
  });
});
