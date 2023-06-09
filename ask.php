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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <style>
        html, body {
            height: 100%;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>
<body>
<?php require_once "./components/header.php"; ?>

<main class="main-container">
    <h1 class="h4 mb-3 fw-normal text-center">Nowe zlecenie...</h1>
    <form class="w-100" method="post" action="actions/create_ticket.php" style="max-width: 400px;">
        <div class="form-floating mb-3">
            <select class="form-select" name="category" id="category">
                <option value='CONNECTION_PROBLEM'>Problem z połączeniem</option>
                <option value='PAYMENT_ISSUE'>Problem z płatnością</option>
                <option value='WEAK_SIGNAL'>Słaby sygnał</option>
                <option value='OTHER'>Inne</option>
            </select>
            <label for="category">Kategoria...</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="content" id="content" placeholder="Content" required>
            <label for="content">Problem</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
    </form>
</main>
<?php require_once "./components/footer.php"; ?>
</body>
</html>
