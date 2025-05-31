<!doctype html>
<html lang="en">
    <head>
        <title>Admin Users</title>

        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <link rel="stylesheet" href="admin_style.css" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
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

        <main>
            <div class="container-fluid mt-3">
                <div class="row search_bar justify-content-end">
                    <div class="col">
                        <h2 class="text-light">USER LIST</h2>
                    </div>
                        <div class="col-4 d-flex">
                            <form method="POST" action="" class="d-flex w-100">
                                <input type="search" name="search_in" placeholder="Search" class="form-control srch-inp me-2">
                                <input type="submit" name="btn_search" value="🔍︎" class="btn btn-set">
                            </form>
                        </div>
                    </div>
                </div>
        

        </main>
        <footer>
            <!-- place footer here -->
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

    </body>
</html>


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
            <table class = "table table-light">
                <tr>
                    <th>User ID</th>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
    
        <?php
    
        foreach ($result as $field) {
            echo "<tr>";
            echo "<td>".$field['user_id']."</td>";        
            echo "<td>".$field['full_name']."</td>";
            echo "<td>".$field['username']."</td>";
            echo "<td>".$field['email']."</td>";
            echo "<td>".$field['password']."</td>";
            echo "<td>".$field['role']."</td>";
            echo "<td>".$field['status']."</td>";
            echo "</tr>";
    
        }
    
        ?>
            </table>
        </div>
    </div>
    
    <?php    
        
    } else {
        echo '<div class="col-12">
                <div class="alert alert-warning text-center p-4">
                    <i class="fas fa-exclamation-circle me-2 fs-4"></i>
                    <p class="mb-0">No borrower records found.</p>
                </div>
            </div>';
    }
    

?>