document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('.product-form');
  if (!form) return;

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch(this.action, {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast('✅ Category saved successfully!');
        // reload after toast so table updates
        setTimeout(() => window.location.href = 'category_list.php', 1000);
      } else {
        showToast('❌ Error: ' + data.error);
      }
    })
    .catch(() => showToast('❌ Server error.'));
  });
});
