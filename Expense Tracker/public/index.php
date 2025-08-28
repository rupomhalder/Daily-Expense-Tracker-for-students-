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

         <!-- Fixed class name -->
         <button class="toggle-transaction-form-btn">
             <i class="fa-solid fa-plus"></i> Add Transaction
         </button>
     </div>

     <!-- Add Transaction Form -->
     <form id="transaction-form">
         <select id="transaction-type" name="transaction_type">
             <option value="income">Income</option>
             <option value="expense">Expense</option>
         </select>
         <input id="transaction-description" name="transaction_description" type="text" placeholder="Description">
         <input id="transaction-amount" name="transaction_amount" type="number" step="0.01" placeholder="Amount">
         <button type="submit">Add Transaction</button>
     </form>


     <!-- Transactions Table -->
     <section class="table-section">
         <h2>Transactions</h2>
         <table class="transaction-table">
             <thead>
                 <tr>
                     <th>ID</th>
                     <th>Date</th>
                     <th>Type</th>
                     <th>Description</th>
                     <th>Amount</th>
                     <th>Action</th>
                 </tr>
             </thead>
             <tbody>
                 <!-- New rows will be added here -->
             </tbody>
         </table>
     </section>

     <div class="today-total">
         <h3>Today's Total: <span id="today-total">$0</span></h3>
     </div>

     <script type="module" src="../assets/js/script.js"></script>
 </body>

 </html>