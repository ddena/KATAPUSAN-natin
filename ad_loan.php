<?php 
session_start();

$user_id = $_SESSION['user_id'];

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Admin Loan</title>

        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <link rel="stylesheet" href="style.css" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <div class="page-container d-flex flex-column min-vh-100">
        <header>
            <hr class = "upper-hr">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-items-center me-3" href="admin_dashboard.php">
                    <img src="img/fundifyme-transparent.png" alt="Fundify Me" />
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">FUNDIFY ME</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav mx-auto main-nav">
                        <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">OVERVIEW</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_borrower.php">BORROWERS</a></li>
                        <li class="nav-item"><a class="nav-link active" href="ad_loan.php">LOANS</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_payments.php">PAYMENTS</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_users.php">USERS</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_logs.php">LOGS</a></li>
                        </ul>

                        <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-prof dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <hr class="lower-hr">
        </header>

        <main class="flex-grow-1"> 
            <div class="container-fluid mt-3">
                <div class="row search_bar mb-1">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <h2 class="text-light mb-2">LOANS</h2>

                        <div class="d-flex align-items-center">
                            <input type="button"  value="ADD +" name = "btn_add" class="btn fw-bold btn-add me-3"data-bs-toggle="modal" data-bs-target="#addLoanModal">
                            <form method="POST" action="ad_loan.php" class="d-flex flex-nowrap">
                                <input type="search" name="search_in" placeholder="Search" class="form-control srch-inp">
                                <input type="submit" name="btn_search" value="🔍︎" class="btn btn-srch">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Add Button -->
            <div class="modal fade" id="addLoanModal" tabindex="-1" aria-labelledby="addLoanModalLabel" aria-hidden="true"> 
                <div class="modal-dialog">
                    <form action="crud_btn.php" method="post">
                    <input type="hidden" name="action" value="add_loan">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addLoanModalLabel">Add New Loan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="newBorrowerId" class="form-label">Borrower</label>
                                <select class="form-select" id="newBorrowerId" name="borrower_id" required>
                                    <option value="">Select Borrower</option>
                                    <?php
                                    require_once "connection.php";
                                    $borrower_sql = "SELECT member_id, member_name FROM tbl_members";
                                    $borrowers = $conn->query($borrower_sql);
                                    while ($row = $borrowers->fetch_assoc()) {
                                        echo "<option value='{$row['member_id']}'>{$row['member_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="newLoanAmount" class="form-label">Loan Amount</label>
                                <input type="number" class="form-control" id="newLoanAmount" name="loan_amount" required>
                            </div>    
                            <div class="mb-3">
                                <label for="newInterestRate" class="form-label">Interest Rate</label>
                                <input type="number" step="0.01" class="form-control" id="newInterestRate" name="interest_rate" required>
                            </div>
                            <div class="mb-3">
                                <label for="newLoanTerm" class="form-label">Loan Term</label>
                                <input type="number" class="form-control" id="newLoanTerm" name="loan_term" required>
                            </div>
                            <div class="mb-3">
                                <label for="newDateApplied" class="form-label">Date Applied</label>
                                <input type="date" class="form-control" id="newDateApplied" name="date_applied" required>
                            </div>
                            <div class="mb-3">
                                <label for="newDateApproved" class="form-label">Date Approved</label>
                                <input type="date" class="form-control" id="newDateApproved" name="date_approved" required>
                            </div>
                            <div class="mb-3">
                                <label for="newDateDisbursed" class="form-label">Date Disbursed</label>
                                <input type="date" class="form-control" id="newDateDisbursed" name="date_disbursed" required>
                            </div>
                            <div class="mb-3">
                                <label for="newOutstandingBalance" class="form-label">Outstanding Balance</label>
                                <input type="number" class="form-control" id="newOutstandingBalance" name="outstanding_balance" required>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-add">Add Loan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php 
                require_once "connection.php";

                //Search Bar
                if (isset($_POST['btn_search'])) {
                    $search_in = $_POST['search_in'];

                    $selectsql = "SELECT * FROM tbl_loan WHERE 
                        loan_id LIKE '".$search_in."%' OR 
                        borrower_id LIKE '".$search_in."%' OR 
                        loan_amount LIKE '".$search_in."%' OR 
                        interest_rate LIKE '".$search_in."%' OR 
                        loan_term LIKE '".$search_in."%' OR 
                        date_applied LIKE '".$search_in."%' OR 
                        date_approved LIKE '".$search_in."%' OR 
                        date_disbursed LIKE '".$search_in."%' OR 
                        outstanding_balance LIKE '".$search_in."%'";
                } else {
                    $selectsql = "SELECT * FROM tbl_loan ORDER BY date_applied DESC";
                }

                // Table
                $result = $conn->query($selectsql);

                if ($result -> num_rows > 0) {
                    ?> 
                    
                    <div class="row mt-10">
                        <div class="col">
                            <table class = "table table-bg mb-1">
                                <tr>
                                    <th>Loan ID</th>
                                    <th>Borrower ID</th>
                                    <th>Loan Amount</th>
                                    <th>Interest Rate</th>
                                    <th>Loan Term</th>
                                    <th>Date Applied</th>
                                    <th>Date Approved</th>
                                    <th>Date Disbursed</th>
                                    <th>Outstanding Balance</th>
                                    <th></th>
                                </tr>
                    <?php
                
                    foreach ($result as $loan_field) {
                        echo "<tr>";
                        echo "<td>".$loan_field['loan_id']."</td>";        
                        echo "<td>".$loan_field['borrower_id']."</td>";
                        echo "<td>".$loan_field['loan_amount']."</td>";
                        echo "<td>".$loan_field['interest_rate']."</td>";
                        echo "<td>".$loan_field['loan_term']."</td>";
                        echo "<td>".$loan_field['date_applied']."</td>";
                        echo "<td>".$loan_field['date_approved']."</td>";
                        echo "<td>".$loan_field['date_disbursed']."</td>";
                        echo "<td>".$loan_field['outstanding_balance']."</td>";
                    ?>
                        <td>
                            <div class="d-flex gap-1">
                                <!-- Edit button -->
                                <button class="btn btn-md btn-edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $loan_field['loan_id']; ?>">Edit</button>

                                <!-- Delete button -->
                                <form action="crud_btn.php" method="post" onsubmit="return confirm('Are you sure you want to delete this loan record?')">
                                    <input type="hidden" name="action" value="delete_loan">
                                    <input type="hidden" name="loan_id" value="<?= $loan_field['loan_id']; ?>">
                                    <button type="submit" class="btn btn-md btn-delete">Delete</button>                        
                                </form>
                            </div>
                        </td>
                       
                    <?php echo "</tr>"; ?>
                    <div class="modal fade" id="editModal<?= $loan_field['loan_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $loan_field['loan_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                         <form action="crud_btn.php" method="post">
                            <input type="hidden" name="action" value="edit_loan">
                            <input type="hidden" name="loan_id" value="<?= $loan_field['loan_id']; ?>">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?= $loan_field['loan_id']; ?>">Edit Loan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                     <div class="modal-body">
                                         <div class="mb-3">
                                            <label for="loanAmount<?= $loan_field['loan_id']; ?>" class="form-label">Loan Amount</label>
                                            <input type="number" class="form-control" id="loanAmount<?= $loan_field['loan_id']; ?>" name="loan_amount" value="<?= htmlspecialchars($loan_field['loan_amount']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="interestRate<?= $loan_field['loan_id']; ?>" class="form-label">Interest Rate</label>
                                            <input type="number"step="0.01" class="form-control" id="interestRate<?= $loan_field['loan_id']; ?>" name="interest_rate" value="<?= htmlspecialchars($loan_field['interest_rate']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="loanTerm<?= $loan_field['loan_id']; ?>" class="form-label">Loan Term</label>
                                            <input type="number" class="form-control" id="loanTerm<?= $loan_field['loan_id']; ?>" name="loan_term" value="<?= htmlspecialchars($loan_field['loan_term']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dateApproved<?= $loan_field['loan_id']; ?>" class="form-label">Date Approved</label>
                                            <input type="date" class="form-control" id="dateApproved<?= $loan_field['loan_id']; ?>" name="date_approved" value="<?= htmlspecialchars($loan_field['date_approved']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dateApplied<?= $loan_field['loan_id']; ?>" class="form-label">Date Applied</label>
                                            <input type="date" class="form-control" id="dateApplied<?= $loan_field['loan_id']; ?>" name="date_applied" value="<?= htmlspecialchars($loan_field['date_applied']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dateDisbursed<?= $loan_field['loan_id']; ?>" class="form-label">Date Disbursed</label>
                                            <input type="date" class="form-control" id="dateDisbursed<?= $loan_field['loan_id']; ?>" name="date_disbursed" value="<?= htmlspecialchars($loan_field['date_disbursed']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="outstandingBalance<?= $loan_field['loan_id']; ?>" class="form-label">Outstanding Balance</label>
                                            <input type="number" class="form-control" id="outstandingBalance<?= $loan_field['loan_id']; ?>" name="outstanding_balance" value="<?= htmlspecialchars($loan_field['outstanding_balance']); ?>" required>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                     </form>
                                </div>
                            </div>
                    <?php } ?>
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
