<nav class=" navbar navbar-expand navbar-dark bg-dark" style="margin-bottom:80px;">
        <div class="container">
            <a href="dashboad.php" class="navbar-brand">
                <h1 class="h4">The Company</h1>
            </a>
            <div class="navbar-nav">
                <li class="nav-item">
                    <span class="navbar-text">
                        <?= $_SESSION['username']?>
                    </span>
                </li>
                <li class="nav-item">
                    <form action="../actions/logout.php" method="POST" class="d-flex ms-2">
                        <button type="submit" class="text-danger bg-transparent border-0">Log out</button>
                    </form>
                </li>
            </div>
        </div>
</nav>