<?php 
session_start();

$user_id = $_SESSION['user_id'];

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Admin Payments</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Stylesheets -->
        <link rel="stylesheet" href="style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <div class="page-container d-flex flex-column min-vh-100">
            <header>
                <hr class="upper-hr" />
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <a class="navbar-brand d-flex align-items-center me-3" href="admin_dashboard.php">
                            <img src="img/fundifyme-transparent.png" alt="Fundify Me" />
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title">FUNDIFY ME</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav mx-auto main-nav">
                                    <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">OVERVIEW</a></li>
                                    <li class="nav-item"><a class="nav-link" href="ad_borrower.php">BORROWERS</a></li>
                                    <li class="nav-item"><a class="nav-link" href="ad_loan.php">LOANS</a></li>
                                    <li class="nav-item"><a class="nav-link active" href="ad_payments.php">PAYMENTS</a></li>
                                    <li class="nav-item"><a class="nav-link" href="ad_users.php">USERS</a></li>
                                    <li class="nav-item"><a class="nav-link" href="ad_logs.php">LOGS</a></li>
                                </ul>
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link nav-prof dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                            <img src="img/profile-icon-transparent.png" alt="Profile" />
                                            <span>ADMIN</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="login.php">Log Out</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <hr class="lower-hr" />
            </header>

            <main class="flex-grow-1">
                <div class="container-fluid mt-3">
                    <div class="row search_bar mb-1">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h2 class="text-light mb-2">PAYMENT HISTORY</h2>
                            <div class="d-flex align-items-center">
                                <input type="button" value="ADD +" class="btn fw-bold btn-add me-3" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                                <form method="POST" action="ad_payments.php" class="d-flex flex-nowrap">
                                    <input type="search" name="search_in" placeholder="Search" class="form-control srch-inp">
                                    <input type="submit" name="btn_search" value="🔍︎" class="btn btn-srch">
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="crud_btn.php" method="post">
                                <input type="hidden" name="action" value="add_payment">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addPaymentModalLabel">Add New Payment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="newLoanId" class="form-label">Loan ID</label>
                                            <select class="form-select" id="newLoanId" name="loan_id" required>
                                                <option value="">Select Loan ID</option>
                                                <?php
                                                require_once "connection.php";
                                                $loan_sql = "SELECT loan_id FROM tbl_loan";
                                                $borrowers = $conn->query($loan_sql);
                                                while ($row = $borrowers->fetch_assoc()) {
                                                    echo "<option value='{$row['loan_id']}'>{$row['loan_id']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPaymentAmount" class="form-label">Payment Amount</label>
                                            <input type="number" class="form-control" id="newPaymentAmount" name="payment_amount" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPaymentDate" class="form-label">Payment Date</label>
                                            <input type="date" class="form-control" id="newPaymentDate" name="payment_date" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Payment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                    require_once "connection.php";
                    if (isset($_POST['btn_search'])) {
                        $search_in = $_POST['search_in'];
                        $selectsql = "SELECT * FROM tbl_payment WHERE 
                            payment_id LIKE '$search_in%' OR 
                            loan_id LIKE '$search_in%' OR 
                            payment_amount LIKE '$search_in%' OR 
                            payment_date LIKE '$search_in%'";
                    } else {
                        $selectsql = "SELECT * FROM tbl_payment ORDER BY payment_date DESC";
                    }

                    $result = $conn->query($selectsql);

                    if ($result->num_rows > 0){ ?>
                        <div class="row mt-10">
                        <div class="col">
                            <table class = "table table-bg mb-1">
                                        <tr>
                                            <th>Payment ID</th>
                                            <th>Loan ID</th>
                                            <th>Payment Amount</th>
                                            <th>Payment Date</th>
                                            <th></th>
                                        </tr>
                    <?php                    

                            foreach ($result as $payments_field) {
                                echo "<tr>";
                                echo "<td>".$payments_field['payment_id']."</td>";        
                                echo "<td>".$payments_field['loan_id']."</td>";
                                echo "<td>".$payments_field['payment_amount']."</td>";
                                echo "<td>".$payments_field['payment_date']."</td>";                     
                            ?>
                                <td>
                                    <div class="d-flex gap-1">
                                        <!-- Edit button -->
                                        <button class="btn btn-md btn-edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $payments_field['payment_id']; ?>">Edit</button>

                                        <!-- Delete button -->
                                        <form action="crud_btn.php" method="post" onsubmit="return confirm('Are you sure you want to delete this payment record?')">
                                            <input type="hidden" name="action" value="delete_payment">
                                            <input type="hidden" name="payment_id" value="<?= $payments_field['payment_id']; ?>">
                                            <button type="submit" class="btn btn-md btn-delete">Delete</button>                        
                                        </form>
                                    </div>
                                </td>
                            <?php
                                echo "</tr>";
                            ?>
                                <!-- Edit Payment Modal -->
                                <div class="modal fade" id="editModal<?= $payments_field['payment_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $payments_field['payment_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="crud_btn.php" method="post">
                                            <input type="hidden" name="action" value="edit_payment">
                                            <input type="hidden" name="payment_id" value="<?= $payments_field['payment_id']; ?>">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?= $payments_field['payment_id']; ?>">Edit Payment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="loanId<?= $payments_field['payment_id']; ?>" class="form-label">Loan ID</label>
                                                        <select class="form-select" id="loanId<?= $payments_field['payment_id']; ?>" name="loan_id" required>
                                                            <?php
                                                            // Populate loan options again here, marking selected one
                                                            $loan_sql = "SELECT loan_id FROM tbl_loan";
                                                            $loans = $conn->query($loan_sql);
                                                            while ($loan = $loans->fetch_assoc()) {
                                                                $selected = ($loan['loan_id'] == $payments_field['loan_id']) ? "selected" : "";
                                                                echo "<option value='{$loan['loan_id']}' $selected>{$loan['loan_id']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="paymentAmount<?= $payments_field['payment_id']; ?>" class="form-label">Payment Amount</label>
                                                        <input type="number" class="form-control" id="paymentAmount<?= $payments_field['payment_id']; ?>" name="payment_amount" value="<?= htmlspecialchars($payments_field['payment_amount']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="paymentDate<?= $payments_field['payment_id']; ?>" class="form-label">Payment Date</label>
                                                        <input type="date" class="form-control" id="paymentDate<?= $payments_field['payment_id']; ?>" name="payment_date" value="<?= htmlspecialchars($payments_field['payment_date']); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>
                
                <?php    
                    
                    } else {
                        echo '<div class="col-12">
                                <div class="alert text-center p-4 border-0">
                                    <div class="alert-content">
                                        <i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                                        <h5>No Payment Records Found</h5>
                                    </div>
                                </div>
                            </div>';
                }


                ?>
            </main>
        <footer>
             <div>© 2025 Fundify Me. All rights reserved.</div>
        </footer>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

        </div>
    </body>
</html>
