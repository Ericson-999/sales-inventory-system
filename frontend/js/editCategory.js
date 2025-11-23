document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('.product-form');
  if (!form) return;

  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    try {
      const res = await fetch(this.action, { method: 'POST', body: formData });
      const data = await res.json();

      if (!data.success) {
        showToast('❌ Error: ' + (data.error || 'Unknown error'));
        return;
      }

      showToast('✅ Category saved successfully!');

      const id = formData.get('id');
      const newCategory = formData.get('category');

      if (id) {
        // Edit: update existing row’s text
        const row = document.querySelector(`.btn-edit[href*="edit_id=${id}"]`)?.closest('tr');
        if (row) row.querySelector('td:nth-child(2)').textContent = newCategory;

        // Exit edit mode and clear the input explicitly
        const categoryInput = form.querySelector('input[name="category"]');
        categoryInput.value = '';                   // clear current value
        categoryInput.removeAttribute('value');     // remove initial value attribute
        form.querySelector('input[name="id"]')?.remove();
        form.action = '../backend/routes/save_category.php';

        // Remove edit_id from the URL so the page isn’t “sticky” in edit mode
        const url = new URL(window.location.href);
        url.searchParams.delete('edit_id');
        window.history.replaceState({}, '', url.toString());
      } else {
        // Add: either reload or append. Pick ONE approach. Easiest: reload.
        setTimeout(() => window.location.href = 'category_list.php', 800);
      }
    } catch {
      showToast('❌ Server error.');
    }
  });
});
