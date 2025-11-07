<form action="../backend/routes/add_product.php" method="POST">
  <input type="text" name="name" placeholder="Name" required />
  <input type="text" name="category" placeholder="Category" required />
  <input type="number" name="price" placeholder="Price" step="0.01" required />
  <input type="number" name="quantity" placeholder="Quantity" required />
  <input type="submit" value="Add Product" />
</form>
