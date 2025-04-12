<!DOCTYPE html>
<?php
//error_reporting(0);
session_start();
echo $_SESSION['id'], $_SESSION['role'];

?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administratora</title>
</head>
<body>
    <?php
    include 'pma.php';

    $sql = "SELECT id_kierunku, nazwa_kierunku FROM kierunki";
    $result = $conn->query($sql);

    echo "<h2>Lista kierunków</h2>";
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID Kierunku</th><th>Nazwa Kierunku</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id_kierunku']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nazwa_kierunku']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Brak kierunków do wyświetlenia.";
    }

    $conn->close();
    ?>
    <h2>Formularz rejestracji użytkownika</h2>
<form method="post">
    <label>Nazwa użytkownika: <input type="text" name="Nazwa" required maxlength="25"></label><br><br>
    <label>Hasło: <input type="password" name="Haslo" required minlength="6"></label><br><br>
    <label>Imię: <input type="text" name="Imie" required maxlength="255"></label><br><br>
    <label>Nazwisko: <input type="text" name="Nazwisko" required maxlength="255"></label><br><br>
    <label>Email: <input type="email" name="Email" required maxlength="50"></label><br><br>
    <label>Telefon: <input type="tel" name="Telefon" pattern="[0-9]{9,10}" required></label><br><br>
    <label>Miasto: <input type="text" name="Miasto" required maxlength="50"></label><br><br>
    <label>Ulica: <input type="text" name="Ulice" required maxlength="50"></label><br><br>
    <label>Numer mieszkania: <input type="number" name="Numer_mieszkania" required></label><br><br>
    <label>ID kierunku: <input type="number" name="id_kierunku"></label><br><br>
    <label>Rola: 
        <select name="Rola" required>
            <option value="U">Użytkownik</option>
            <option value="A">Administrator</option>
        </select>
    </label><br><br>
    <label>Rok studiów: <input type="number" name="rok_studiow" value="1"></label><br><br>
    
    <button type="submit">Dodaj użytkownika</button>
</form>

    <?php
    include 'pma.php';

    $Nazwa = $_POST['Nazwa'];
    $Haslo = $_POST['Haslo']; // Uwaga: powinno się użyć password_hash() w rzeczywistej aplikacji
    $Imie = $_POST['Imie'];
    $Nazwisko = $_POST['Nazwisko'];
    $Email = $_POST['Email'];
    $Telefon = $_POST['Telefon'];
    $Miasto = $_POST['Miasto'];
    $Ulice = $_POST['Ulice'];
    $Numer_mieszkania = $_POST['Numer_mieszkania'];
    $Rola = $_POST['Rola'];
    $rok_studiow = $_POST['rok_studiow'];
    $id_kierunku = $_POST['id_kierunku'] ?? null; // Dodane zgodnie z tabelą

    // Poprawiona kwerenda SQL zgodna z kolumnami w tabeli
    $sql = "INSERT INTO users (
        Nazwa, Haslo, Imie, Nazwisko, Email, Telefon, Miasto, Ulice, 
        Numer_mieszkania, Rola, rok_studiow, id_kierunku
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    // Poprawione typy w bind_param (s - string, i - integer)
    $stmt->bind_param(
        "sssssisisiis",
        $Nazwa, $Haslo, $Imie, $Nazwisko, $Email, $Telefon, $Miasto,
        $Ulice, $Numer_mieszkania, $Rola, $rok_studiow, $id_kierunku
    );

    if ($stmt->execute()) {
        echo "Użytkownik został dodany pomyślnie!";
    } else {
        echo "Błąd: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    ?>
</body>
</html>