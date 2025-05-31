<?php 
session_start();

$user_id = $_SESSION['user_id'];

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Admin Users</title>

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
                        <li class="nav-item"><a class="nav-link active" href="ad_users.php">USERS</a></li>
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
                            <h2 class="text-light mb-2">USER LIST</h2>
                            <div class="d-flex align-items-center">
                                <input type="button" value="ADD +" class="btn fw-bold btn-add me-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <form method="POST" action="ad_users.php" class="d-flex flex-nowrap">
                                    <input type="search" name="search_in" placeholder="Search" class="form-control srch-inp">
                                    <input type="submit" name="btn_search" value="🔍︎" class="btn btn-srch">
                                </form>
                            </div>
                        </div>
                    </div>
            
            <!-- Add Button -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="crud_btn.php" method="post">
                    <input type="hidden" name="action" value="add_user">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="newFullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="newFullName" name="full_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="newUserName" class="form-label">Username</label>
                                <input type="text" class="form-control" id="newUserName" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="newEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="newEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="newPassword" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="newRole" class="form-label">Role</label>
                                <input type="text" class="form-control" id="newRole" name="role" required>
                            </div>
                            <div class="mb-3">
                                <label for="newRole" class="form-label">Status</label>
                                <input type="text" class="form-control" id="newStatus" name="status" required>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-add">Add User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php 

                require_once "connection.php";

                if (isset($_POST['btn_search'])) {
                    $search_in = $_POST['search_in'];

                    $selectsql = "SELECT * FROM tbl_user WHERE 
                        user_id LIKE '".$search_in."%' OR 
                        full_name LIKE '".$search_in."%' OR 
                        username LIKE '".$search_in."%' OR 
                        email LIKE '".$search_in."%' OR 
                        password LIKE '".$search_in."%' OR 
                        role LIKE '".$search_in."%' OR 
                        status LIKE '".$search_in."%'";
                } else {
                    $selectsql = "SELECT * FROM tbl_user";
                }

                $result = $conn->query($selectsql);

                if ($result -> num_rows > 0) {
                    ?> 
                    
                    <div class="row mt-10">
                        <div class="col">
                            <table class = "table table-bg mb-1">
                                <tr>
                                    <th>User ID</th>
                                    <th>Fullname</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                    
                        <?php
                    
                        foreach ($result as $user_field) {
                            echo "<tr>";
                            echo "<td>".$user_field['user_id']."</td>";        
                            echo "<td>".$user_field['full_name']."</td>";
                            echo "<td>".$user_field['username']."</td>";
                            echo "<td>".$user_field['email']."</td>";
                            echo "<td>".$user_field['password']."</td>";
                            echo "<td>".$user_field['role']."</td>";
                            echo "<td>".$user_field['status']."</td>";
                            ?>
                                <td>
                                <div class="d-flex gap-1">
                                    <!-- Edit button -->
                                    <button class="btn btn-md btn-edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $user_field['user_id']; ?>">Edit</button>

                                    <!-- Delete button -->
                                    <form action="crud_btn.php" method="post" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        <input type="hidden" name="action" value="delete_user">
                                        <input type="hidden" name="user_id" value="<?= $user_field['user_id']; ?>">
                                        <button type="submit" class="btn btn-md btn-delete">Delete</button>                        
                                    </form>
                                </div>
                            </td>
                            <?php
                                echo "</tr>";
                            ?>
                                <!-- Edit User Modal -->
                                <div class="modal fade" id="editModal<?= $user_field['user_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $user_field['user_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="crud_btn.php" method="post">
                                            <input type="hidden" name="action" value="edit_user">
                                            <input type="hidden" name="user_id" value="<?= $user_field['user_id']; ?>">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?= $user_field['user_id']; ?>">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="editFullName<?= $user_field['user_id']; ?>" class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" id="editFullName<?= $user_field['user_id']; ?>" name="full_name" value="<?= htmlspecialchars($user_field['full_name']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editUserName<?= $user_field['user_id']; ?>" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="editUserName<?= $user_field['user_id']; ?>" name="username" value="<?= htmlspecialchars($user_field['username']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editEmail<?= $user_field['user_id']; ?>" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="editEmail<?= $user_field['user_id']; ?>" name="email" value="<?= htmlspecialchars($user_field['email']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editPassword<?= $user_field['user_id']; ?>" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="editPassword<?= $user_field['user_id']; ?>" name="password" value="<?= htmlspecialchars($user_field['password']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editRole<?= $user_field['user_id']; ?>" class="form-label">Role</label>
                                                        <input type="text" class="form-control" id="editRole<?= $user_field['user_id']; ?>" name="role" value="<?= htmlspecialchars($user_field['role']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editStatus<?= $user_field['user_id']; ?>" class="form-label">Status</label>
                                                        <input type="text" class="form-control" id="editStatus<?= $user_field['user_id']; ?>" name="status" value="<?= htmlspecialchars($user_field['status']); ?>" required>
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
