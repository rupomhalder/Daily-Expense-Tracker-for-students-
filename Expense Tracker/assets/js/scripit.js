 document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("transaction-form");
  const tableBody = document.querySelector(".transaction-table tbody");

  // ============================
  // Load existing transactions
  // ============================
  fetch("../api/get_transactions.php")
    .then(res => res.json())
    .then(data => {
      if (Array.isArray(data)) {
        data.forEach(tx => addRow(tx));
      } else {
        console.error("Invalid data from server:", data);
      }
    })
    .catch(err => console.error("Fetch error:", err));

  // ============================
  // Handle new transaction submit
  // ============================
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    try {
      let res = await fetch("../api/add_transaction.php", {
        method: "POST",
        body: formData
      });

      let data = await res.json();
      if (data.success) {
        // add row visually with response ID
        addRow({
          id: data.id,
          type: formData.get("transaction_type"),
          description: formData.get("transaction_description"),
          amount: formData.get("transaction_amount"),
          created_at: new Date().toISOString().split("T")[0]
        });
        form.reset();
      } else {
        alert("Error adding transaction: " + data.message);
      }
    } catch (err) {
      console.error("Add transaction failed:", err);
      alert("Something went wrong while adding transaction.");
    }
  });

  // ============================
  // Helper: Add row to table
  // ============================
  function addRow(tx) {
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
      <td>${tx.id}</td>
      <td>${tx.created_at}</td>
      <td>${tx.type}</td>
      <td>${tx.description}</td>
      <td>${parseFloat(tx.amount).toFixed(2)}</td>
      <td><button class="delete-btn">Delete</button></td>
    `;
    tableBody.appendChild(newRow);
  }
});
