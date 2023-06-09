<?php
declare(strict_types=1);
session_start();
if (!isset($_SESSION["is_authenticated"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kawalerski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="static/css/styles.css">
    <link rel="stylesheet" type="text/css" href="static/css/add.css">
    <style>
        /* Dodane style */
        body {
            background-color: #f8f9fa;
        }

        h4 {
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        table {
            background-color: #fff;
            max-width: 600px;
            margin: 0 auto;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .section-container {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
<?php require_once "./components/header.php"; ?>
<main class="main-container">
    <section class="section-container p-4">
        <?php
        include_once "db/handler.php";

        $db = new DBHandler();

        $current_ticket = mysqli_fetch_array($db->find_ticket_by_id($_REQUEST["id"]));
        $current_user = mysqli_fetch_array($db->find_user_by_id($_SESSION["user_id"]));

        if ($current_user["role"] == "worker" && !$current_ticket["assigned_to"]) {
            echo sprintf(
                "<a class='btn btn-primary' style='width:200px' type='button' href='actions/assign_ticket.php?id=%s'>Zakończ realizacje zadania</a>",
                $current_ticket["id"]
            );
        }

        echo sprintf("<h4>Zlecenie #%s</h4>", $_REQUEST["id"]);
        ?>
        <table class='table table-bordered table-striped'>
            <thead>
            <tr>
                <th scope='col'>Wiadomość</th>
                <th scope='col'>Autor</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $messages = $db->find_ticket_messages($_REQUEST["id"]);
            while ($message = mysqli_fetch_array($messages)) {
                $user = mysqli_fetch_array($db->find_user_by_id($message["created_by"]));
                echo "<tr>";
                echo sprintf("<td>%s</td>", $message["content"]);
                echo sprintf("<td>%s</td>", $user["username"]);
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

        <?php
        echo sprintf("<form method='post' action='actions/answer_ticket.php?id=%s' class='d-flex flex-row justify-content-center'>", $_REQUEST["id"]);
        ?>
        <div class="input-group mb-3">
            <div class='form-floating'>
                <input type='text' class='form-control' name='content' id='content' placeholder='Message'>
                <label for='content'>Wiadomość</label>
            </div>
            <button class="btn btn-primary" type="submit">Wyślij</button>
        </div>
        </form>
        <?php
        if ($current_user["role"] == "client" && $current_ticket["assigned_to"]) {
            echo sprintf("<form method='post' action='actions/rate_ticket.php?id=%s'>", $_REQUEST["id"]);
            ?>
            <label for='rating' class='form-label'>Oceń nasze usługi</label>
            <div class='input-group mb-3'>
                <select class='form-select' id='rating' name='rating'>
                    <option value='1'>1/5</option>
                    <option value='2'>2/5</option>
                    <option value='3'>3/5</option>
                    <option value='4'>4/5</option>
                    <option value='5'>5/5</option>
                </select>
                <button class='btn btn-primary' type='submit'>Oceń</button>
            </div>
            </form>
        <?php } ?>
    </section>
</main>
</body>
</html>
