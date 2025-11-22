// category.js

let deleteCategoryId = null;

// Attach click handlers to all delete buttons
document.querySelectorAll('.btn-delete').forEach(btn => {
  btn.addEventListener('click', function () {
    deleteCategoryId = this.getAttribute('data-id');
    openCategoryDeleteModal();
  });
});

// Open modal
function openCategoryDeleteModal() {
  document.getElementById('deleteCategoryModal').style.display = 'block';
}

// Close modal
function closeCategoryDeleteModal() {
  document.getElementById('deleteCategoryModal').style.display = 'none';
  deleteCategoryId = null;
}

// Confirm deletion
document.getElementById('confirmCategoryDeleteBtn').addEventListener('click', function () {
  if (!deleteCategoryId) return;

  fetch('../backend/routes/delete_category.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'id=' + encodeURIComponent(deleteCategoryId)
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      showToast('✅Category deleted successfully!');
      // Remove row from table without reload
      const row = document.querySelector(`.btn-delete[data-id="${deleteCategoryId}"]`).closest('tr');
      if (row) row.remove();
    } else {
      showToast('❌Error: ' + data.error);
    }
    closeCategoryDeleteModal();
  })
  .catch(() => {
    showToast('❌Server error.');
    closeCategoryDeleteModal();
  });
});

// Simple toast notification
function showToast(message) {
  const container = document.getElementById('toast-container');
  const toast = document.createElement('div');
  toast.className = 'toast';
  toast.textContent = message;
  container.appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, 3000);
}
