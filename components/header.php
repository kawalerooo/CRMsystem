<?php
declare(strict_types=1);
session_start();
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">

                    <?php
                    include_once "db/handler.php";

                    $db = new DBHandler();

                    if (!isset($_SESSION["is_authenticated"])) {
                        echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='signup.php'>Rejestracja</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='login.php'>Logowanie</a>
                            </li>";
                    } else {
                        echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='index.php'>Zlecenia</a>
                            </li>";
                    }
                    ?>
                </ul>
            </div>

            <?php
            if (isset($_SESSION["is_authenticated"])) {
                echo "
                    <ul class='navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link' href='actions/logout.php'>Wyloguj</a>
                        </li>
                    </ul>";
            }
            ?>
        </div>
    </nav>
</header>
