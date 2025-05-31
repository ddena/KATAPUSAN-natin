<?php 
session_start();

$user_id = $_SESSION['user_id'];


?>
<!doctype html>
<html lang="en">
    <head>
        <title>Employee Borrowers</title>

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
                    <a class="navbar-brand d-flex align-items-center me-3" href="employee_dashboard.php">
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
                        <li class="nav-item"><a class="nav-link" href="employee_dashboard.php">OVERVIEW</a></li>
                        <li class="nav-item"><a class="nav-link active" href="em_borrower.php">BORROWERS</a></li>
                        <li class="nav-item"><a class="nav-link" href="em_loan.php">LOANS</a></li>
                        <li class="nav-item"><a class="nav-link" href="em_payments.php">PAYMENTS</a></li>
                        </ul>

                        <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-prof dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/profile-icon-transparent.png" alt="Profile" />
                            <span>EMPLOYEE</span>
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
                        <h2 class="text-light mb-2">LIST OF BORROWERS</h2>

                        <div class="d-flex align-items-center">
                            <input type="button"  value="ADD +" name = "btn_add" class="btn fw-bold btn-add me-3"data-bs-toggle="modal" data-bs-target="#addBorrowerModal">
                            <form method="POST" action="em_borrower.php" class="d-flex flex-nowrap">
                                <input type="search" name="search_in" placeholder="Search" class="form-control srch-inp">
                                <input type="submit" name="btn_search" value="🔍︎" class="btn btn-srch">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="modal fade" id="addBorrowerModal" tabindex="-1" aria-labelledby="addBorrowerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="crud_btn.php" method="post">
                    <input type="hidden" name="action" value="add_borrower">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addBorrowerModalLabel">Add New Borrower</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="newMemberName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="newMemberName" name="member_name" required>
                            </div>
                        <div class="mb-3">
                            <label for="newEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="newEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="newContact" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="newContact" name="contact_information" required>
                        </div>
                        <div class="mb-3">
                            <label for="newAddress" class="form-label">Address</label>
                            <textarea class="form-control" id="newAddress" name="address" required></textarea>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-add">Add Borrower</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

    <?php 

        require_once "connection.php";

        if (isset($_POST['btn_search'])) {
            $search_in = $_POST['search_in'];

            $selectsql = "SELECT * FROM tbl_members WHERE 
                member_id LIKE '".$search_in."%' OR 
                member_name LIKE '%".$search_in."%' OR 
                email LIKE '".$search_in."%' OR 
                contact_information LIKE '".$search_in."%' OR 
                address LIKE '".$search_in."%'";
        } else {
            $selectsql = "SELECT * FROM tbl_members";
        }

        // Table
        $result = $conn->query($selectsql);

        if ($result -> num_rows > 0) {
            ?> 
            
            <div class="row mt-10">
                <div class="col">
                    <table class = "table table-bg mb-1">
                        <tr>
                            <th>Member ID</th>
                            <th>Full name</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th></th>
                        </tr>
            
                <?php
            
                foreach ($result as $borrower_field) {
                    echo "<tr>";
                    echo "<td>".$borrower_field['member_id']."</td>";        
                    echo "<td>".$borrower_field['member_name']."</td>";
                    echo "<td>".$borrower_field['email']."</td>";
                    echo "<td>".$borrower_field['contact_information']."</td>";
                    echo "<td>".$borrower_field['address']."</td>"; 
                ?>
                    <td>
                        <div class="d-flex gap-1">
                            <!-- Edit button triggers modal -->
                            <button class="btn btn-md btn-edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $borrower_field['member_id']; ?>">Edit</button>

                            <!-- Delete form -->
                            <form action="crud_btn.php" method="post" onsubmit="return confirm('Are you sure you want to delete this borrower?')">
                                <input type="hidden" name="action" value="delete_borrower">
                                <input type="hidden" name="member_id" value="<?= $borrower_field['member_id']; ?>">
                                <button type="submit" class="btn btn-md btn-delete">Delete</button>                        
                            </form>
                        </div>
                    </td>
                <?php echo "</tr>"; ?>

                <div class="modal fade" id="editModal<?= $borrower_field['member_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $borrower_field['member_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="crud_btn.php" method="post">
                            <input type="hidden" name="action" value="edit_borrower">
                            <input type="hidden" name="member_id" value="<?= $borrower_field['member_id']; ?>">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?= $borrower_field['member_id']; ?>">Edit Borrower</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <div class="modal-body">
                            <div class="mb-3">
                                <label for="memberName<?= $borrower_field['member_id']; ?>" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="memberName<?= $borrower_field['member_id']; ?>" name="member_name" value="<?= htmlspecialchars($borrower_field['member_name']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email<?= $borrower_field['member_id']; ?>" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email<?= $borrower_field['member_id']; ?>" name="email" value="<?= htmlspecialchars($borrower_field['email']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact<?= $borrower_field['member_id']; ?>" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact<?= $borrower_field['member_id']; ?>" name="contact_information" value="<?= htmlspecialchars($borrower_field['contact_information']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="address<?= $borrower_field['member_id']; ?>" class="form-label">Address</label>
                                <textarea class="form-control" id="address<?= $borrower_field['member_id']; ?>" name="address" required><?= htmlspecialchars($borrower_field['address']); ?></textarea>
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
