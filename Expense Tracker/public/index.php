 <?php
// dashboard.php
 session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$userName = $_SESSION['name'];
$userEmail = $_SESSION['email'];

?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Expense and Income Tracking</title>

     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

     <!-- Custom CSS -->
     <link rel="stylesheet" href="../assets/css/style.css">
 </head>

 <body>
     <!-- Header -->
     <header>
         <h1 id="header-title">Expense Tracker</h1>

         <!-- Profile + Logout -->
         <div class="profile-section">
             <i class="fa-solid fa-user-circle"></i>
             <span><?php echo htmlspecialchars($userName); ?> (<?php echo htmlspecialchars($userEmail); ?>)</span>
             <a href="../auth/login.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
         </div>
     </header>

     <!-- Dashboard Section -->
     <div class="dashboard">
         <div class="data-panel">
             <i class="fa-solid fa-cart-shopping"></i>
             <div>Expense: <span id="expense-total">100.00</span></div>
         </div>

         <div class="data-panel">
             <i class="fa-solid fa-money-bill-wave"></i>
             <div>Income: <span id="income-total">200.00</span></div>
         </div>

         <div class="data-panel">
             <i class="fa-solid fa-chart-pie"></i>
             <div>Balance: <span id="balance-total">100.00</span></div>
         </div>
         <button class="add Transaction"><i class="fa-solid fa-plus"></i>Add Transaction</button>
     </div>

     <!-- Add Transaction Form -->
     <section class="form-section">
         <h2>Add Transaction</h2>
         <form id="transaction-form">
             <div class="input-group">
                 <label for="transaction-type">Type</label>
                 <select id="transaction-type" required>
                     <option value="expense">Expense</option>
                     <option value="income">Income</option>
                 </select>
             </div>

             <div class="input-group">
                 <label for="transaction-description">Description</label>
                 <input type="text" id="transaction-description" placeholder="Enter transaction description" required>
             </div>

             <div class="input-group">
                 <label for="transaction-amount">Amount</label>
                 <input type="number" id="transaction-amount" placeholder="Enter transaction amount" required>
             </div>

             <div class="form-buttons">
                 <button type="submit" class="add-transaction-btn"><i class="fa-solid fa-plus"></i> Add</button>
                 <button type="reset" class="cancel-transaction-btn">Cancel</button>
             </div>
         </form>
     </section>

     <!-- Transactions Table -->
     <section class="table-section">
         <h2>Transactions</h2>
         <table class="transaction-table">
             <thead>
                 <tr>
                     <th>ID</th>
                     <th>Type</th>
                     <th>Description</th>
                     <th>Amount</th>
                     <th>Action</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>1</td>
                     <td><span class="type-badge type-expense">Expense</span></td>
                     <td>Gym</td>
                     <td class="amount-expense">$40</td>
                     <td><button class="delete-button"><i class="fas fa-trash"></i> Delete</button></td>
                 </tr>
                 <tr>
                     <td>2</td>
                     <td><span class="type-badge type-income">Income</span></td>
                     <td>Freelance Work</td>
                     <td class="amount-income">$200</td>
                     <td><button class="delete-button"><i class="fas fa-trash"></i> Delete</button></td>
                 </tr>
             </tbody>
         </table>
     </section>

     <script type="module" src="../assets/js/script.js"></script>
 </body>

 </html>