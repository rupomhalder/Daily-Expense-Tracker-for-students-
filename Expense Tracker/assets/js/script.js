// Get elements
const addTransactionBtn = document.querySelector(".add");
const formSection = document.querySelector(".form-section");
const cancelBtn = document.querySelector(".cancel-transaction-btn");

// Show form when "Add Transaction" button clicked
addTransactionBtn.addEventListener("click", () => {
    formSection.style.display = "block";
    formSection.scrollIntoView({ behavior: "smooth" });
});

// Hide form when "Cancel" button clicked
cancelBtn.addEventListener("click", () => {
    formSection.style.display = "none";
});