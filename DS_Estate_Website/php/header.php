<header class="header">
    <nav class="navbar">
        <a href="index.php" class="navLogo"> <!-- redirect to the feed -->
           <img src="../images/LogobyAnastasiaKoutougdi.png" alt="DS Estate Logo" class="logoImage">
        </a>
        <a href="index.php" class="navLogo"> <!-- redirect to the feed -->
            <img src="../images/LogoLettering.png" alt="Logo Lettering" class="secondImage">
        </a>
        <ul class="navMenu"> <!-- navigation menu list -->
        <li class="navItem">
                <a href="index.php" class="navLink">Feed</a>
                </li>
                <!-- navigation item displayed changes based on login status -->
                <?php if (isset($_SESSION["loggedInStatus"])): ?>
                    <li class="navItem">
                        <a href="logout.php" class="navLink">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="navItem">
                        <a href="login.php" class="navLink">Login</a>
                    </li>
                <?php endif; ?>
                <li class="navItem">
                    <a href="interface4.php" class="navLink">Create Listing</a>
                </li>
            </ul>
            <div class="hamburger"> <!-- hamburger menu for mobile devices -->
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
    </nav>
</header>