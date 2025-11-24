document.addEventListener("DOMContentLoaded", function() {
    const entriesSelect = document.getElementById("entriesSelect");
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("receivingEntriesBody");
    const rows = tableBody.getElementsByTagName("tr");

    function updateTable() {
        const maxEntries = parseInt(entriesSelect.value);
        const searchTerm = searchInput.value.toLowerCase();

        let visibleCount = 0;
        for (let i = 0; i < rows.length; i++) {
            const rowText = rows[i].innerText.toLowerCase();
            const matchesSearch = rowText.includes(searchTerm);

            if (matchesSearch && visibleCount < maxEntries) {
                rows[i].style.display = "";
                visibleCount++;
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    entriesSelect.addEventListener("change", updateTable);
    searchInput.addEventListener("keyup", updateTable);

    // Run once on load
    updateTable();
});
