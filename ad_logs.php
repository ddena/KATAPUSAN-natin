<?php 
session_start();

$user_id = $_SESSION['user_id'];

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Admin Logs</title>

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
                        <li class="nav-item"><a class="nav-link" href="ad_loan.php">LOANS</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_payments.php">PAYMENTS</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_users.php">USERS</a></li>
                        <li class="nav-item"><a class="nav-link active" href="ad_logs.php">LOGS</a></li>
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
                            <h2 class="text-light mb-2">LOG HISTORY</h2>
                            <div class="d-flex align-items-center">
                                <input type="button" value="ADD +" class="btn fw-bold btn-add me-3" data-bs-toggle="modal" data-bs-target="#addLogModal">
                                <form method="POST" action="ad_logs.php" class="d-flex flex-nowrap">
                                    <input type="search" name="search_in" placeholder="Search" class="form-control srch-inp">
                                    <input type="submit" name="btn_search" value="🔍︎" class="btn btn-srch">
                                </form>
                            </div>
                        </div>
                    </div>
                    
                <!-- ADD LOG MODAL -->
                    <div class="modal fade" id="addLogModal" tabindex="-1" aria-labelledby="addLogModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="crud_btn.php" method="post">
                                <input type="hidden" name="action" value="add_log">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addLogModalLabel">Add New Log History</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="newUserId" class="form-label">User ID</label>
                                            <select class="form-select" id="newUserId" name="user_id" required>
                                                <option value="">Select User ID</option>
                                                <?php
                                                    require_once "connection.php";
                                                    $user_sql = "SELECT user_id FROM tbl_user";
                                                    $user = $conn->query($user_sql);
                                                    while ($row = $user->fetch_assoc()) {
                                                        echo "<option value='{$row['user_id']}'>{$row['user_id']}</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newAction" class="form-label">Action</label>
                                            <textarea class="form-control" id="newAction" name="actions" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newDateTime" class="form-label">Date and Time</label>
                                            <input type="datetime-local" class="form-control" id="newDateTime" name="datetime" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Add Log</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


            <?php 
                require_once "connection.php";

                if (isset($_POST['btn_search'])) {
                    $search_in = $_POST['search_in'];

                    $selectsql = "SELECT * FROM tbl_logs WHERE 
                        log_id LIKE '".$search_in."%' OR 
                        user_Id LIKE '".$search_in."%' OR 
                        action LIKE '".$search_in."%' OR 
                        datetime LIKE '".$search_in."%'";
                } else {
                    $selectsql = "SELECT * FROM tbl_logs ORDER BY datetime DESC";
                }

                $result = $conn->query($selectsql);

                if ($result -> num_rows > 0) {
                    ?> 
                    
                    <div class="row mt-10">
                        <div class="col">
                            <table class = "table table-bg mb-1">
                                <tr>
                                    <th>Log ID</th>
                                    <th>User ID</th>
                                    <th>Action</th>
                                    <th>Date and Time</th>
                                    <th></th>
                                    </tr>
                    
                      <?php
                        foreach ($result as $log_field) {
                            echo "<tr>";
                            echo "<td>".$log_field['log_id']."</td>";        
                            echo "<td>".$log_field['user_id']."</td>";
                            echo "<td>".$log_field['action']."</td>";
                            echo "<td>".$log_field['datetime']."</td>";
                        ?>
                            <td>
                                <div class="d-flex gap-1">
                                    <!-- Edit button -->
                                    <button class="btn btn-md btn-edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $log_field['log_id']; ?>">Edit</button>

                                    <!-- Delete button -->
                                    <form action="crud_btn.php" method="post" onsubmit="return confirm('Are you sure you want to delete this log record?')">
                                        <input type="hidden" name="action" value="delete_log">
                                        <input type="hidden" name="log_id" value="<?= $log_field['log_id']; ?>">
                                        <button type="submit" class="btn btn-md btn-delete">Delete</button>                        
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Log Modal -->
                        <div class="modal fade" id="editModal<?= $log_field['log_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $log_field['log_id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="crud_btn.php" method="post">
                                    <input type="hidden" name="action" value="edit_log">
                                    <input type="hidden" name="log_id" value="<?= $log_field['log_id']; ?>">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?= $log_field['log_id']; ?>">Edit Log</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="editUserId<?= $log_field['log_id']; ?>" class="form-label">User ID</label>
                                                <select class="form-select" id="editUserId<?= $log_field['log_id']; ?>" name="user_id" required>
                                                    <option value="">Select User ID</option>
                                                    <?php
                                                        $user_sql = "SELECT user_id FROM tbl_user";
                                                        $user = $conn->query($user_sql);
                                                        while ($row = $user->fetch_assoc()) {
                                                            $selected = ($row['user_id'] == $log_field['user_id']) ? "selected" : "";
                                                            echo "<option value='{$row['user_id']}' $selected>{$row['user_id']}</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editAction<?= $log_field['log_id']; ?>" class="form-label">Action</label>
                                                <textarea class="form-control" id="editAction<?= $log_field['log_id']; ?>" name="actions" required><?= htmlspecialchars($log_field['action']); ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editDateTime<?= $log_field['log_id']; ?>" class="form-label">Date and Time</label>
                                                <input type="datetime-local" class="form-control" id="editDateTime<?= $log_field['log_id']; ?>" name="datetime" value="<?= date('Y-m-d\TH:i', strtotime($log_field['datetime'])); ?>" required>
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
                                        <h5>No Log Records Found</h5>
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
