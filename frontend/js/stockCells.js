const stockCells = document.querySelectorAll('.stock');

  stockCells.forEach(cell => {
    const value = parseInt(cell.textContent);
    if (value === 0) {
      cell.classList.add('zero-stock');
    } else if (value < 5) {
      cell.classList.add('low-stock');
    }
  });