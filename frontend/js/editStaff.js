document.addEventListener("DOMContentLoaded", function () {
  const editButtons = document.querySelectorAll(".btn-edit");

  editButtons.forEach(button => {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      const userId = this.getAttribute("href").split("=")[1];

      fetch("../backend/routes/get_user.php?id=" + userId)
        .then(response => response.json())
        .then(user => {
          if (user) {
            // Fill modal fields
            document.getElementById("modalTitle").textContent = "Edit User";
            document.getElementById("userId").value = user.id;
            document.getElementById("name").value = user.name;
            document.getElementById("username").value = user.username;
            document.getElementById("password").value = "";
            document.getElementById("userType").value = user.user_type;

            // Change form action to update
            document.getElementById("userForm").action = "../backend/routes/update_staff.php";

            // Open modal
            openModal();
          } else {
            alert("User not found.");
          }
        })
        .catch(error => {
          console.error("Error:", error);
          alert("Failed to load user data.");
        });
    });
  });
});
