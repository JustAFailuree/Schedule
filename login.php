<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="css/login.css">

    <script src="script.js"></script>
</head>
<body>
    <div class="login-container">
        <div class="box">
            <h1 class="title has-text-centered">Logowanie</h1>
            <form method="POST" action="zaloguj.php">
                <div class="field">
                    <label class="label">Nazwa użytkownika</label>
                    <div class="control">
                        <input class="input" type="text" id="userName" name="userName" placeholder="Wprowadź nazwę użytkownika" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Hasło</label>
                    <div class="control">
                        <input class="input" type="password" id="password" name="password" placeholder="Wprowadź hasło" required>
                    </div>
                </div>
                <div class="field">
                    <button class="button is-fullwidth" type="submit">Zaloguj się</button>
                </div>
            </form>
            <p id="errorMessage" class="has-text-danger has-text-centered" style="display: none;">Nieprawidłowe dane logowania</p>
            <p class="has-text-centered">
                Nie masz konta? <a href="register.php">Zarejestruj się</a>
            </p>
            <p class="has-text-centered">
                <a href="index.php">Strona Główna</a>
            </p>
        </div>
    </div> 
</body>
</html>
