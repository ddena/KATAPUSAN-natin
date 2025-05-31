<!doctype html>
<html lang="en">
    <head>
        <title>Admin Overview</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link rel="stylesheet" href="admin_style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    </head>
    
    <style>

    /* NAVIGATION */
    .upper-hr {
    border-top: 30px solid #1e3a8a;
    width: 100%;
    margin: 0;
    opacity: 100%;
    }

    .navbar-brand img {
    height: 100px;
    width: auto;
    max-width: 250px;
    object-fit: contain;
    }

    .navbar-nav {
    display: flex;
    padding: 0;
    margin: 0;
    align-items: center;
    }

    .main-nav {
    gap: 5rem;
    }

    .nav-item {
    font-size: 1rem;
    font-weight: bolder;
    }

    .nav-link {
    color: #1e3a8a !important;
    }

    .nav-link img {
    margin-left: auto;
    padding: 10px 0px;
    height: 70px;
    }

    .nav-link:hover,
    .nav-link.active,
    .nav-link.active:hover {
    color: #4c5c8a !important;
    text-shadow: 0 0 6px rgba(212, 224, 179, 0.808);
    transition: color 0.2s ease-in-out, text-shadow 0.2s ease-in-out;
    }

    .lower-hr {
    border-top: 2px solid #b9b0b0;
    width: 100%;
    margin: 0;
    opacity: 100%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 991.98px) {
    .offcanvas .offcanvas-body {
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .offcanvas .navbar-nav {
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
        margin: 0;
        padding: 0;
        gap: 1rem;
    }

    .offcanvas .main-nav {
        width: 100%;
        padding: 1rem 0;
    }

    .offcanvas .nav-item {
        width: 100%;
        margin: 0;
    }

    .offcanvas .nav-link {
        width: 100%;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        text-align: left;
        display: flex;
        align-items: center;
        gap: 0.2rem;
    }

    .offcanvas .nav-link img {
        display: none;
    }
    }

    /* OVERVIEW.php */
    .admin_banner {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    }

    .admin_banner img {
    width: 100%;
    height: auto;
    object-fit: cover;
    filter: brightness(60%);
    }

    .banner_text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    color: white !important;
    text-shadow: 0 0 6px rgba(93, 96, 96, 0.808);
    text-align: center;
    }

    /* BORROWER.php */
    .search_bar {
    background-color: #1e3a8a;
    padding: 1rem;
    gap: 0;
    }

    .srch-inp {
    border-bottom-right-radius: 0 !important;
    border-top-right-radius: 0 !important;
    }
    .btn-set {
    background-color: #c6ceee !important;
    border-bottom-left-radius: 0 !important;
    border-top-left-radius: 0 !important;
    }

    .btn-set:hover {
    background-color: #7d8fc6 !important;
    transition: color 0.5s ease-in-out;
    }

    .custom-table {
    background-color: #7d8fc6 !important; 
    }
    </style>

    <body>
        <header>
            <hr class = "upper-hr">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-items-center me-3" href="admin_dashboard.php">
                    <img src="fundifyme-transparent.png" alt="Fundify Me" />
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
                        <li class="nav-item"><a class="nav-link active" href="admin_dashboard.php">OVERVIEW</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_borrower.php">BORROWERS</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_loan.php">LOANS</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_payments.php">PAYMENTS</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_users.php">USERS</a></li>
                        <li class="nav-item"><a class="nav-link" href="ad_logs.php">LOGS</a></li>
                        </ul>

                        <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-prof dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="profile-icon-transparent.png" alt="Profile" />
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

        <div class="container-fluid">
            <div class="row admin_banner">
                <div class="banner_text">
                    <h1 class= "display-1">Hello, Admin!</h1>
                </div>
                <img src="adm_banner.jpg" alt="Banner">
            </div>
        </div>

        </main>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>
