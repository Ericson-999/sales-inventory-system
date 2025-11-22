document.addEventListener("DOMContentLoaded", function () {
  const editButtons = document.querySelectorAll(".btn-edit");

  editButtons.forEach(button => {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      const userId = this.getAttribute("href").split("=")[1];

      fetch("../backend/routes/get_user.php?id=" + userId)
        .then(response => response.text())
        .then(text => {
          try {
            const user = JSON.parse(text);
            if (user && user.id) {
              document.getElementById("modalTitle").textContent = "Edit User";
              document.getElementById("userId").value = user.id;
              document.getElementById("name").value = user.name;
              document.getElementById("username").value = user.username;
              document.getElementById("password").value = "";
              document.getElementById("userType").value = user.user_type;

              document.getElementById("userForm").action = "../backend/routes/update_staff.php";
              openEditModal();
            } else {
              showToast("❌ User not found.", "error");
            }
          } catch (err) {
            console.error("JSON parse error:", err);
            showToast("❌ Failed to load user data.", "error");
          }
        })
        .catch(error => {
          console.error("Fetch error:", error);
          showToast("❌ Network error while loading user.", "error");
        });
    });
  });
});
