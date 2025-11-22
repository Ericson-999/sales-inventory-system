let salesList = [];

// Add product to list
document.querySelector('.add-to-list-btn').addEventListener('click', function () {
  const productSelect = document.getElementById('product-select');
  const productId = productSelect.value;
  const productName = productSelect.options[productSelect.selectedIndex].text;
  const price = parseFloat(productSelect.options[productSelect.selectedIndex].dataset.price);
  const qty = parseInt(document.getElementById('product-qty').value, 10);

  if (!productId || qty <= 0 || price <= 0) {
    alert('Please fill in all fields correctly.');
    return;
  }

  const amount = qty * price;

  salesList.push({
    product_id: productId,
    product_name: productName,
    qty: qty,
    price: price,
    amount: amount.toFixed(2)
  });

  updateSalesTable();
});

// Update table display
function updateSalesTable() {
  const tbody = document.getElementById('sales-list-body');
  tbody.innerHTML = '';
  let total = 0;

  salesList.forEach((item, index) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${item.product_name}</td>
      <td>${item.qty}</td>
      <td>${item.price}</td>
      <td>${item.amount}</td>
      <td><button onclick="deleteItem(${index})">Delete</button></td>
    `;
    tbody.appendChild(row);
    total += parseFloat(item.amount);
  });

  document.getElementById('total-sales-amount').textContent = total.toFixed(2);
}

// Delete product from list
function deleteItem(index) {
  salesList.splice(index, 1);
  updateSalesTable();
}

// Handle Pay button
document.querySelector('.pay-btn').addEventListener('click', function () {
  if (salesList.length === 0) {
    alert('No products in the list.');
    return;
  }

  const customerId = document.getElementById('customer-select').value;
  const staffId = document.getElementById('staff-id').value;
  const referenceNumber = document.getElementById('reference-number').value;

  fetch('../backend/routes/add_sale.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      reference_number: referenceNumber,
      customer_id: customerId,
      staff_id: staffId,
      payment_method: 'Cash',
      remarks: '',
      items: salesList
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert('Sale recorded successfully!');
      salesList = [];
      updateSalesTable();
    } else {
      alert('Error: ' + data.error);
    }
  })
  .catch(() => alert('Server error.'));
});
