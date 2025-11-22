document.addEventListener("DOMContentLoaded", function () {
  window.openAddModal = function () {
    const modal = document.getElementById('userModal');
    modal.style.display = 'block';

    document.getElementById("modalTitle").textContent = "New User";
    document.getElementById("userForm").action = "/sales-inventory-system/backend/routes/add_staff.php";
    document.getElementById("userId").value = "";
    document.getElementById("name").value = "";
    document.getElementById("username").value = "";
    document.getElementById("password").value = "";
    document.getElementById("userType").value = "staff";
  };

  window.openEditModal = function () {
    document.getElementById('userModal').style.display = 'block';
  };

  window.closeModal = function () {
    document.getElementById('userModal').style.display = 'none';
  };

  window.showToast = function (message, type = "success") {
    const container = document.getElementById("toast-container");
    if (!container) return;

    const validTypes = ["error", "success", "edit-success"];
    const toastType = validTypes.includes(type) ? type : "error";

    const toast = document.createElement("div");
    toast.className = `toast toast-${toastType}`;
    toast.textContent = message;

    container.appendChild(toast);

    setTimeout(() => {
      toast.remove();
    }, 4000);
  };
});
