 // ==== DOM Elements ====
const addTransactionBtn = document.querySelector(".add");
const formSection = document.querySelector(".form-section");
const cancelBtn = document.querySelector(".cancel-transaction-btn");
const transactionForm = document.getElementById("transaction-form");
const tableBody = document.querySelector(".transaction-table tbody");

// Totals
const expenseTotal = document.getElementById("expense-total");
const incomeTotal = document.getElementById("income-total");
const balanceTotal = document.getElementById("balance-total");

// Backend API base URL
const API_URL = "http://localhost:5000/api/transactions";

// ==== Show & Hide Form ====
addTransactionBtn.addEventListener("click", () => {
    formSection.style.display = "block";
    formSection.scrollIntoView({ behavior: "smooth" });
});

cancelBtn.addEventListener("click", () => {
    formSection.style.display = "none";
});

// ==== Fetch Transactions ====
async function fetchTransactions() {
    try {
        const res = await fetch(API_URL);
        const data = await res.json();
        renderTransactions(data);
    } catch (err) {
        console.error("Error fetching transactions:", err);
    }
}

// ==== Render Transactions in Table ====
function renderTransactions(transactions) {
    tableBody.innerHTML = "";
    let expense = 0, income = 0;

    transactions.forEach(t => {
        if (t.type === "expense") expense += t.amount;
        else income += t.amount;

        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${t.id}</td>
            <td><span class="type-badge type-${t.type}">${t.type}</span></td>
            <td>${t.description}</td>
            <td class="amount-${t.type}">$${t.amount}</td>
            <td><button class="delete-button" data-id="${t.id}">
                <i class="fas fa-trash"></i> Delete
            </button></td>
        `;
        tableBody.appendChild(tr);
    });

    expenseTotal.textContent = expense.toFixed(2);
    incomeTotal.textContent = income.toFixed(2);
    balanceTotal.textContent = (income - expense).toFixed(2);

    // attach delete event
    document.querySelectorAll(".delete-button").forEach(btn => {
        btn.addEventListener("click", () => deleteTransaction(btn.dataset.id));
    });
}

// ==== Add Transaction ====
transactionForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const type = document.getElementById("transaction-type").value;
    const description = document.getElementById("transaction-description").value;
    const amount = parseFloat(document.getElementById("transaction-amount").value);

    try {
        await fetch(API_URL, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ type, description, amount })
        });

        transactionForm.reset();
        formSection.style.display = "none";
        fetchTransactions(); // reload
    } catch (err) {
        console.error("Error adding transaction:", err);
    }
});

// ==== Delete Transaction ====
async function deleteTransaction(id) {
    try {
        await fetch(`${API_URL}/${id}`, { method: "DELETE" });
        fetchTransactions();
    } catch (err) {
        console.error("Error deleting transaction:", err);
    }
}

// ==== Initial Load ====
fetchTransactions();
