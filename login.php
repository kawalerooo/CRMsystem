<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kawalerski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="static/css/login.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-signin {
            max-width: 400px;
            padding: 15px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-signin h1 {
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
            text-align: center;
        }

        .form-signin .form-control {
            height: 45px;
            font-size: 16px;
            border-radius: 5px;
        }

        .form-signin label {
            font-weight: normal;
        }

        .form-signin button[type="submit"] {
            margin-top: 20px;
            height: 45px;
            font-size: 18px;
            border-radius: 5px;
            width: 100%;
        }

        .form-signin a.btn {
            margin-top: 10px;
            height: 45px;
            font-size: 18px;
            border-radius: 5px;
            width: 100%;
        }

        /* Nowe style */
        .form-signin p {
            font-size: 14px;
            color: #888;
            text-align: center;
            margin-top: 10px;
        }

        .form-signin p a {
            color: #888;
        }
    </style>
</head>

<body>
<main class="form-signin">
    <h1 class="h3 mb-3">Zaloguj się</h1>
    <form method="post" action="actions/login.php">
        <div class="mb-3">
            <label for="username" class="form-label">Login</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Hasło</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Zaloguj</button>
    </form>
    <p>Nie masz jeszcze konta? <a href="signup.php">Zarejestruj się</a></p>
</main>
</body>

</html>
