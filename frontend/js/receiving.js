let productList = [];
let receivingEntries = [];
let suppliers = [
    {
        value: "supplier1",
        text: "Supplier 1"
    },
    {
        value: "supplier2",
        text: "Supplier 2"
    },
    {
        value: "supplier3",
        text: "Supplier 3"
    },
];
let products = [
    {
        value: "powdered_milk",
        text: "Powdered Milk - Sample product"
    },
    {
        value: "chips_big",
        text: "Chips (Big)"
    },
    {
        value: "lemon_iced_tea",
        text: "Lemon Iced Tea"
    },
];
let editingIndex = -1;

function addProduct() {
    const productSelect = document.getElementById('product');
    const product = productSelect.options[productSelect.selectedIndex].text;
    const productValue = productSelect.value;
    const qty = document.getElementById('qty').value;
    const price = document.getElementById('price').value;

    if (!productValue || !qty || !price) {
        alert('Please fill in all fields.');
        return;
    }

    const amount = parseFloat(qty) * parseFloat(price);

    productList.push({
        product: product,
        productValue: productValue,
        qty: qty,
        price: price,
        amount: amount.toFixed(2)
    });

    updateProductListTable();
    clearInputFields();
}

function addNewSupplier() {
    const newSupplierName = document.getElementById("newSupplierName").value;
    if (newSupplierName) {
        const newSupplierValue = newSupplierName.toLowerCase().replace(/ /g, "_");
        suppliers.push({
            text: newSupplierName,
            value: newSupplierValue
        });
        populateSupplierOptions();
        document.getElementById("supplier").value = newSupplierValue;
        document.getElementById("newSupplierInput").style.display = "none";
        document.getElementById("newSupplierName").value = "";
    }
}

function addNewProduct() {
    const newProductName = document.getElementById("newProductName").value;
    if (newProductName) {
        const newProductValue = newProductName.toLowerCase().replace(/ /g, "_");
        products.push({
            text: newProductName,
            value: newProductValue
        });
        populateProductOptions();
        document.getElementById("product").value = newProductValue;
        document.getElementById("newProductInput").style.display = "none";
        document.getElementById("newProductName").value = "";
    }
}

function updateProductListTable() {
    const tableBody = document.querySelector('#productListTable tbody');
    tableBody.innerHTML = '';
    let total = 0;

    productList.forEach((item, index) => {
        let row = tableBody.insertRow();
        row.innerHTML = `
            <td>${item.product}</td>
            <td>${item.qty}</td>
            <td>${item.price}</td>
            <td>${item.amount}</td>
            <td class="action-buttons">
                <button class="delete-button" onclick="deleteProduct(${index})">Delete</button>
            </td>
        `;
        total += parseFloat(item.amount);
    });

    document.getElementById('totalAmount').textContent = total.toFixed(2);
}

function deleteProduct(index) {
    productList.splice(index, 1);
    updateProductListTable();
}

function clearInputFields() {
    document.getElementById('product').value = '';
    document.getElementById('qty').value = '';
    document.getElementById('price').value = '';
}

function saveData() {
    const supplierSelect = document.getElementById('supplier');
    const supplier = supplierSelect.options[supplierSelect.selectedIndex].text;

    if (productList.length === 0) {
        alert('Please add products to the list.');
        return;
    }

    const referenceNumber = generateReferenceNumber();
    const date = new Date().toLocaleDateString();

    const receivingEntry = {
        date: date,
        referenceNumber: referenceNumber,
        supplier: supplier,
        products: productList
    };

    receivingEntries.push(receivingEntry);
    saveReceivingEntries();
    productList = [];
    updateProductListTable();
    updateReceivingEntriesTable();

    showReceivingEntriesSection();

    alert('Data saved!');
}

function generateReferenceNumber() {
    return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
}

function editReceivingEntry(index) {
    editingIndex = index;
    const entry = receivingEntries[index];
    document.getElementById('supplier').value = entry.supplier;
    productList = entry.products;
    updateProductListTable();

}

function updateReceivingEntriesTable() {
    const tableBody = document.getElementById('receivingEntriesBody');
    tableBody.innerHTML = '';

    receivingEntries.forEach((entry, index) => {
        let row = tableBody.insertRow();
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${entry.date}</td>
            <td>${entry.referenceNumber}</td>
            <td>${entry.supplier}</td>
            <td class="action-buttons">
                <button class="edit-button" onclick="editReceivingEntry(${index})">Edit</button>
                <button class="delete-button" onclick="deleteReceivingEntry(${index})">Delete</button>
            </td>
        `;
    });
}

function deleteReceivingEntry(index) {
    receivingEntries.splice(index, 1);
    saveReceivingEntries();
    updateReceivingEntriesTable();
}

function saveReceivingEntries() {
    localStorage.setItem('receivingEntries', JSON.stringify(receivingEntries));
}

function loadReceivingEntries() {
    const storedEntries = localStorage.getItem('receivingEntries');
    if (storedEntries) {
        receivingEntries = JSON.parse(storedEntries);
        updateReceivingEntriesTable();
    }
}

function populateSupplierOptions() {
    const supplierSelect = document.getElementById("supplier");
    supplierSelect.innerHTML = "<option value=''>Please Select</option><option value='add_new_supplier'>Add New Supplier</option>";
    suppliers.forEach(supplier => {
        const option = document.createElement("option");
        option.value = supplier.value;
        option.text = supplier.text;
        supplierSelect.add(option);

    });
}

function populateProductOptions() {
    const productSelect = document.getElementById("product");
    productSelect.innerHTML = "<option value=''>Please Select</option><option value='add_new_product'>Add New Product</option>";
    products.forEach(product => {
        const option = document.createElement("option");
        option.value = product.value;
        option.text = product.text;
        productSelect.add(option);


    });
}

function showReceivingEntriesSection() {
    document.getElementById('newReceivingSection').classList.add('hidden');
    document.getElementById('receivingEntriesSection').classList.remove('hidden');
}

function showNewReceivingSection() {
    document.getElementById('newReceivingSection').classList.remove('hidden');
    document.getElementById('receivingEntriesSection').classList.add('hidden');
}
document.getElementById("supplier").addEventListener("change", function() {
    if (this.value === "add_new_supplier") {
        document.getElementById("newSupplierInput").style.display = "block";
    } else {
        document.getElementById("newSupplierInput").style.display = "none";
    }
});

document.getElementById("product").addEventListener("change", function() {
    if (this.value === "add_new_product") {
        document.getElementById("newProductInput").style.display = "block";
    } else {
        document.getElementById("newProductInput").style.display = "none";
        }
    });
    document.getElementById('newReceivingButton').addEventListener('click', function() {
        showNewReceivingSection();
    });
    document.getElementById('receivingEntriesButton').addEventListener('click', function() {
        showReceivingEntriesSection();
    });
    document.getElementById('returnToNewReceiving').addEventListener('click', function() {
        showNewReceivingSection();
    });
    loadReceivingEntries();
    populateSupplierOptions();
    populateProductOptions();
    document.getElementById('receivingEntriesSection').classList.add('hidden');