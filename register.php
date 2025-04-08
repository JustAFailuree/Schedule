<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="register-container">
        <div class="box">
            <h1 class="title has-text-centered has-text-white">Rejestracja</h1>
            <form id="registerForm">
            <div class="area">
                <div class="field">
                    <label class="label has-text-white">Imie:</label>
                    <div class="control">
                        <input class="input" type="text" id="regUserName" placeholder="Wprowadź imię" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-white">Nazwisko:</label>
                    <div class="control">
                        <input class="input" type="text" id="regUserLastName" placeholder="Wprowadź nazwisko" required>
                    </div>
                </div>
            </div>
                <div class="field">
                    <label class="label has-text-white">Login:</label>
                    <div class="control">
                        <input class="input" type="text" id="regLogin" placeholder="Wprowadź login" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-white">Hasło:</label>
                    <div class="control">
                        <input class="input" type="password" id="regPassword" placeholder="Wprowadź hasło" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-white">Email:</label>
                    <div class="control">
                        <input class="input" type="email" id="regMail" placeholder="Wprowadź adres email" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-white">Telefon:</label>
                    <div class="control">
                        <input class="input" type="text" id="regPhoneNumber" placeholder="Wprowadź numer telefonu" required>
                    </div>
                </div>
            <div class="area">
                <div class="field">
                    <label class="label has-text-white">Miasto:</label>
                    <div class="control">
                        <input class="input" type="text" id="regCity" placeholder="Wprowadź miasto zamieszkania" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-white">Ulica:</label>
                    <div class="control">
                        <input class="input" type="text" id="regStreet" placeholder="Wprowadź nazwę ulicy" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-white">Numer domu/mieszkania:</label>
                    <div class="control">
                        <input class="input" type="text" id="regHome" placeholder="Wprowadź numer domu/mieszkania" required>
                    </div>
                </div>
            </div>

                <div class="field is-centered">
                    <button class="button is-success" type="button">Zarejestruj się</button>

                </div>
            </form>
            <p id="registerErrorMessage" class="has-text-danger has-text-centered" style="display: none;">Rejestracja nie powiodła się</p>
            <p class="has-text-centered">
                Masz już konto? <a href="login.php">Zaloguj się</a>
            </p>
            <p class="has-text-centered">
                <a href="index.php">Strona Główna</a>
            </p>
        </div>
    </div>
</body>
</html>
