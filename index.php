<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kawalerski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="static/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }

        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
<?php require_once "components/header.php"; ?>
<main class="main-container">
    <section class="p-4">
        <div class="d-flex flex-column gap-4">
            <?php
            include_once "db/handler.php";

            $db = new DBHandler();

            if (!isset($_SESSION["is_authenticated"])) {

            } else {
                $current_user = mysqli_fetch_array($db->find_user_by_id($_SESSION["user_id"]));

                if ($current_user["role"] == 'admin') {
                    echo "<h4>Wszystkie zlecenia</h4>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Id</th>
                                        <th scope='col'>Kategoria</th>
                                        <th scope='col'>Ocena</th>
                                        <th scope='col'>Klient</th>
                                        <th scope='col'>Pracownik</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    $tickets = $db->find_all_tickets();
                    while ($ticket = mysqli_fetch_array($tickets)) {
                        $user1 = mysqli_fetch_array($db->find_user_by_id($ticket["issued_by"]));
                        echo "<tr>
                                <td>{$ticket["id"]}</td>
                                <td>{$ticket["category"]}</td>
                                <td>";
                        echo str_repeat("<span class='fa fa-star checked'></span>", intval($ticket["rating"]));
                        echo str_repeat("<span class='fa fa-star'></span>", 5 - intval($ticket["rating"]));
                        echo "</td>
                                <td>{$user1["username"]}</td>
                                <td>" . ($ticket["assigned_to"] ? mysqli_fetch_array($db->find_user_by_id($ticket["assigned_to"]))["username"] : "-") . "</td>
                            </tr>";
                    }
                    echo "</tbody>
                            </table>
                        </div>";

                    echo "<h4>Ukończone zlecenia</h4>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Id</th>
                                        <th scope='col'>Kategoria</th>
                                        <th scope='col'>Ocena</th>
                                        <th scope='col'>Klient</th>
                                        <th scope='col'>Pracownik</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    $tickets = $db->find_assigned_tickets();
                    while ($ticket = mysqli_fetch_array($tickets)) {
                        $user1 = mysqli_fetch_array($db->find_user_by_id($ticket["issued_by"]));
                        $user2 = mysqli_fetch_array($db->find_user_by_id($ticket["assigned_to"]));
                        echo "<tr>
                                <td>{$ticket["id"]}</td>
                                <td>{$ticket["category"]}</td>
                                <td>";
                        echo str_repeat("<span class='fa fa-star checked'></span>", intval($ticket["rating"]));
                        echo str_repeat("<span class='fa fa-star'></span>", 5 - intval($ticket["rating"]));
                        echo "</td>
                                <td>{$user1["username"]}</td>
                                <td>{$user2["username"]}</td>
                            </tr>";
                    }
                    echo "</tbody>
                            </table>
                        </div>";

                    echo "<h4>W trakcie prac</h4>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Id</th>
                                        <th scope='col'>Kategoria</th>
                                        <th scope='col'>Ocena</th>
                                        <th scope='col'>Klient</th>
                                        <th scope='col'>Pracownik</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    $tickets = $db->find_unassigned_tickets();
                    while ($ticket = mysqli_fetch_array($tickets)) {
                        $user1 = mysqli_fetch_array($db->find_user_by_id($ticket["issued_by"]));
                        echo "<tr>
                                <td>{$ticket["id"]}</td>
                                <td>{$ticket["category"]}</td>
                                <td>";
                        echo str_repeat("<span class='fa fa-star checked'></span>", intval($ticket["rating"]));
                        echo str_repeat("<span class='fa fa-star'></span>", 5 - intval($ticket["rating"]));
                        echo "</td>
                                <td>{$user1["username"]}</td>
                                <td>-</td>
                            </tr>";
                    }
                    echo "</tbody>
                            </table>
                        </div>";

                    echo "<h4>Statystyki pracowników</h4>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Id</th>
                                        <th scope='col'>Pracownik</th>
                                        <th scope='col'>Szybkość wykonania</th>
                                        <th scope='col'>Jakość</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    $workers = $db->find_all_workers();
                    while ($worker = mysqli_fetch_array($workers)) {
                        $avg = mysqli_fetch_array($db->find_avg_ticket_rating($worker["id"]));
                        $ts =  mysqli_num_rows($db->find_worker_tickets($worker["id"]));
                        echo "<tr>
                                <td>{$worker["id"]}</td>
                                <td>{$worker["username"]}</td>
                                <td><img width='45px' height='45px' src='static/svg/" . ($ts >= 2 ? "run.svg" : "turtle.svg") . "'/></td>
                                <td>";
                        echo str_repeat("<span class='fa fa-star checked'></span>", intval($avg["avg_rating"]));
                        echo str_repeat("<span class='fa fa-star'></span>", 5 - intval($avg["avg_rating"]));
                        echo "</td>
                            </tr>";
                    }
                    echo "</tbody>
                            </table>
                        </div>";
                } else if ($current_user["role"] == 'worker') {
                    echo "<h4>Twoje zlecenia</h4>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Id</th>
                                        <th scope='col'>Kategoria</th>
                                        <th scope='col'>Ocena</th>
                                        <th scope='col'>Autor</th>
                                        <th scope='col'>Opis zlecenia</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    $tickets = $db->find_worker_tickets($_SESSION["user_id"]);
                    while ($ticket = mysqli_fetch_array($tickets)) {
                        $user = mysqli_fetch_array($db->find_user_by_id($ticket["issued_by"]));
                        echo "<tr>
                                <td>{$ticket["id"]}</td>
                                <td>{$ticket["category"]}</td>
                                <td>";
                        echo str_repeat("<span class='fa fa-star checked'></span>", intval($ticket["rating"]));
                        echo str_repeat("<span class='fa fa-star'></span>", 5 - intval($ticket["rating"]));
                        echo "</td>
                                <td>{$user["username"]}</td>
                                <td><a class='btn btn-primary' href='ticket.php?id={$ticket["id"]}'>Pokaż zlecenie</a></td>
                            </tr>";
                    }
                    echo "</tbody>
                            </table>
                        </div>";

                    echo "<h4>Nieprzypisane bilety</h4>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Id</th>
                                        <th scope='col'>Kategoria</th>
                                        <th scope='col'>Ocena</th>
                                        <th scope='col'>Autor</th>
                                        <th scope='col'>Opis zlecenia</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    $tickets = $db->find_unassigned_tickets();
                    while ($ticket = mysqli_fetch_array($tickets)) {
                        $user = mysqli_fetch_array($db->find_user_by_id($ticket["issued_by"]));
                        echo "<tr>
                                <td>{$ticket["id"]}</td>
                                <td>{$ticket["category"]}</td>
                                <td>";
                        echo str_repeat("<span class='fa fa-star checked'></span>", intval($ticket["rating"]));
                        echo str_repeat("<span class='fa fa-star'></span>", 5 - intval($ticket["rating"]));
                        echo "</td>
                                <td>{$user["username"]}</td>
                                <td><a class='btn btn-primary' href='ticket.php?id={$ticket["id"]}'>Pokaż zlecenie</a></td>
                            </tr>";
                    }
                    echo "</tbody>
                            </table>
                        </div>";
                } else if ($current_user["role"] == 'client') {
                    echo "<a class='btn btn-primary' style='width:200px' type='button' href='ask.php'>Utwórz nowe zlecenie</a>
                        <table class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>Id</th>
                                    <th scope='col'>Kategoria</th>
                                    <th scope='col'>Ocena</th>
                                    <th scope='col'>Opis zlecenia</th>
                                </tr>
                            </thead>
                            <tbody>";
                    $tickets = $db->find_user_tickets($_SESSION["user_id"]);
                    while ($ticket = mysqli_fetch_array($tickets)) {
                        echo "<tr>
                                <td>{$ticket["id"]}</td>
                                <td>{$ticket["category"]}</td>
                                <td>";
                        echo str_repeat("<span class='fa fa-star checked'></span>", intval($ticket["rating"]));
                        echo str_repeat("<span class='fa fa-star'></span>", 5 - intval($ticket["rating"]));
                        echo "</td>
                                <td><a class='btn btn-primary' href='ticket.php?id={$ticket["id"]}'>Pokaż zlecenie</a></td>
                            </tr>";
                    }
                    echo "</tbody>
                            </table>";
                }
            }
            ?>
        </div>
    </section>
</main>
<?php require_once "components/footer.php"; ?>
</body>
</html>
