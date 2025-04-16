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

        // Obsługa usuwania rekordu
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            $delete_sql = "DELETE FROM kierunki WHERE id_kierunku = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $delete_id);
            $stmt->execute();
            $stmt->close();
            header("Location: ".strtok($_SERVER['REQUEST_URI'], '?'));
            exit();
        }

        // Obsługa edycji rekordu
        if (isset($_POST['update_id'])) {
            $update_id = $_POST['update_id'];
            $new_name = $_POST['nazwa_kierunku'];
            
            $update_sql = "UPDATE kierunki SET nazwa_kierunku = ? WHERE id_kierunku = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("si", $new_name, $update_id);
            $stmt->execute();
            $stmt->close();
            header("Location: ".strtok($_SERVER['REQUEST_URI'], '?'));
            exit();
        }

        $sql = "SELECT id_kierunku, nazwa_kierunku FROM kierunki";
        $result = $conn->query($sql);

        echo "<h2>Lista kierunków</h2>";
        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID Kierunku</th><th>Nazwa Kierunku</th><th>Akcje</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";

                if (isset($_GET['edit_id']) && $_GET['edit_id'] == $row['id_kierunku']) {
                    echo "<form method='post' action=''>";
                    echo "<td>" . htmlspecialchars($row['id_kierunku']) . "</td>";
                    echo "<td><input type='text' name='nazwa_kierunku' value='" . htmlspecialchars($row['nazwa_kierunku']) . "'></td>";
                    echo "<td>";
                    echo "<input type='hidden' name='update_id' value='" . $row['id_kierunku'] . "'>";
                    echo "<button type='submit'>Zapisz</button> ";
                    echo "<a href='" . strtok($_SERVER['REQUEST_URI'], '?') . "'>Anuluj</a>";
                    echo "</td>";
                    echo "</form>";
                } else {
                    echo "<td>" . htmlspecialchars($row['id_kierunku']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nazwa_kierunku']) . "</td>";
                    echo "<td>";
                    echo "<a href='?edit_id=" . $row['id_kierunku'] . "'>Edytuj</a> | ";
                    echo "<a href='?delete_id=" . $row['id_kierunku'] . "' onclick=\"return confirm('Czy na pewno chcesz usunąć ten rekord?')\">Usuń</a>";
                    echo "</td>";
                }
                
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Brak kierunków do wyświetlenia.";
        }

        $conn->close();
    ?>

<?php
include 'pma.php';

// Obsługa usuwania użytkownika
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM users WHERE user_ID = ?";
    $stmt = $conn->prepare($delete_sql);

    if (!$stmt) {
        die("Błąd przygotowania DELETE: " . $conn->error);
    }

    $stmt->bind_param("i", $delete_id);

    if (!$stmt->execute()) {
        die("Błąd wykonania DELETE: " . $stmt->error);
    }

    $stmt->close();
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

// Obsługa edycji użytkownika
if (isset($_POST['update_id'])) {
    $update_id = intval($_POST['update_id']);
    $Nazwa = $_POST['Nazwa'];
    $Imie = $_POST['Imie'];
    $Nazwisko = $_POST['Nazwisko'];
    $Email = $_POST['Email'];
    $Telefon = $_POST['Telefon'];
    $Miasto = $_POST['Miasto'];
    $Ulice = $_POST['Ulice'];
    $Numer_mieszkania = $_POST['Numer_mieszkania'];
    $Rola = $_POST['Rola'];
    $rok_studiow = !empty($_POST['rok_studiow']) ? intval($_POST['rok_studiow']) : null;
    $id_kierunku = intval($_POST['id_kierunku']);
    $tytul_naukowy = !empty($_POST['tytul_naukowy']) ? $_POST['tytul_naukowy'] : null;

    $update_sql = "UPDATE users SET 
        Nazwa = ?, Imie = ?, Nazwisko = ?, Email = ?, Telefon = ?, 
        Miasto = ?, Ulice = ?, Numer_mieszkania = ?, Rola = ?, 
        rok_studiow = ?, id_kierunku = ?, tytul_naukowy = ?
        WHERE user_ID = ?";

    $stmt = $conn->prepare($update_sql);
    if (!$stmt) {
        die("Błąd prepare: " . $conn->error);
    }

    $stmt->bind_param(
        "sssssssssisii",
        $Nazwa, $Imie, $Nazwisko, $Email, $Telefon, $Miasto,
        $Ulice, $Numer_mieszkania, $Rola, $rok_studiow, 
        $id_kierunku, $tytul_naukowy, $update_id
    );

    if (!$stmt->execute()) {
        die("Błąd wykonania UPDATE: " . $stmt->error);
    }

    $stmt->close();
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

// Pobieranie listy użytkowników
$sql = "SELECT 
    u.user_ID, u.Nazwa, u.Imie, u.Nazwisko, u.Email, u.Telefon, 
    u.Miasto, u.Ulice, u.Numer_mieszkania, u.Rola, 
    u.rok_studiow, u.id_kierunku, k.nazwa_kierunku, u.tytul_naukowy 
    FROM users u
    LEFT JOIN kierunki k ON u.id_kierunku = k.id_kierunku
    ORDER BY u.Nazwisko, u.Imie";
$result = $conn->query($sql);

echo "<h2>Lista użytkowników</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8' style='width:100%; border-collapse:collapse;'>";
    echo "<thead><tr>
        <th>ID</th>
        <th>Nazwa</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>Telefon</th>
        <th>Miasto</th>
        <th>Ulica</th>
        <th>Nr miesz.</th>
        <th>Rola</th>
        <th>Rok studiów</th>
        <th>Kierunek</th>
        <th>Tytuł nauk.</th>
        <th>Akcje</th>
    </tr></thead><tbody>";

    while ($row = $result->fetch_assoc()) {
        if (isset($_GET['edit_id']) && $_GET['edit_id'] == $row['user_ID']) {
            echo "<form method='post' action=''>";
            echo "<tr>";
            echo "<td>" . $row['user_ID'] . "</td>";
            echo "<td><input type='text' name='Nazwa' value='" . htmlspecialchars($row['Nazwa']) . "'></td>";
            echo "<td><input type='text' name='Imie' value='" . htmlspecialchars($row['Imie']) . "'></td>";
            echo "<td><input type='text' name='Nazwisko' value='" . htmlspecialchars($row['Nazwisko']) . "'></td>";
            echo "<td><input type='text' name='Email' value='" . htmlspecialchars($row['Email']) . "'></td>";
            echo "<td><input type='text' name='Telefon' value='" . htmlspecialchars($row['Telefon']) . "'></td>";
            echo "<td><input type='text' name='Miasto' value='" . htmlspecialchars($row['Miasto']) . "'></td>";
            echo "<td><input type='text' name='Ulice' value='" . htmlspecialchars($row['Ulice']) . "'></td>";
            echo "<td><input type='text' name='Numer_mieszkania' value='" . htmlspecialchars($row['Numer_mieszkania']) . "'></td>";
            
            // Pole Rola jako select
            echo "<td><select name='Rola'>";
            $roles = ['U' => 'Użytkownik', 'A' => 'Admin', 'W' => 'Wykładowca', 'S' => 'Student'];
            foreach ($roles as $value => $label) {
                $selected = ($value == $row['Rola']) ? 'selected' : '';
                echo "<option value='$value' $selected>$label</option>";
            }
            echo "</select></td>";
            
            echo "<td><input type='number' name='rok_studiow' value='" . htmlspecialchars($row['rok_studiow']) . "' min='1' max='5'></td>";
            
            // Pole Kierunek jako select
            echo "<td>";
            $kierunki_sql = "SELECT id_kierunku, nazwa_kierunku FROM kierunki";
            $kierunki_result = $conn->query($kierunki_sql);
            echo "<select name='id_kierunku'>";
            while ($kierunek = $kierunki_result->fetch_assoc()) {
                $selected = ($kierunek['id_kierunku'] == $row['id_kierunku']) ? 'selected' : '';
                echo "<option value='" . $kierunek['id_kierunku'] . "' $selected>" . htmlspecialchars($kierunek['nazwa_kierunku']) . "</option>";
            }
            echo "</select></td>";
            
            echo "<td><input type='text' name='tytul_naukowy' value='" . htmlspecialchars($row['tytul_naukowy']) . "'></td>";
            
            echo "<td>";
            echo "<input type='hidden' name='update_id' value='" . $row['user_ID'] . "'>";
            echo "<button type='submit' style='padding:5px;'>Zapisz</button> ";
            echo "<a href='" . strtok($_SERVER['REQUEST_URI'], '?') . "' style='padding:5px;'>Anuluj</a>";
            echo "</td>";
            echo "</tr>";
            echo "</form>";
        } else {
            echo "<tr>";
            echo "<td>" . $row['user_ID'] . "</td>";
            echo "<td>" . htmlspecialchars($row['Nazwa']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Imie']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Nazwisko']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Telefon']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Miasto']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Ulice']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Numer_mieszkania']) . "</td>";
            
            // Wyświetlanie pełnej nazwy roli
            $role_names = ['U' => 'Użytkownik', 'A' => 'Admin', 'W' => 'Wykładowca', 'S' => 'Student'];
            $role_display = $role_names[$row['Rola']] ?? $row['Rola'];
            echo "<td>" . htmlspecialchars($role_display) . "</td>";
            
            echo "<td>" . htmlspecialchars($row['rok_studiow']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nazwa_kierunku']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tytul_naukowy']) . "</td>";
            echo "<td>";
            echo "<a href='?edit_id=" . $row['user_ID'] . "' style='margin-right:5px;'>Edytuj</a>";
            echo "<a href='?delete_id=" . $row['user_ID'] . "' onclick=\"return confirm('Czy na pewno chcesz usunąć tego użytkownika?')\">Usuń</a>";
            echo "</td>";
            echo "</tr>";
        }
    }

    echo "</tbody></table>";
} else {
    echo "<p>Brak użytkowników w bazie danych.</p>";
}

$conn->close();
?>





<h2>Formularz dodania użytkownika</h2>
<form method="post">
    <label>Nazwa użytkownika: <input type="text" name="Nazwa" required maxlength="25"></label><br><br>
    <label>Hasło: <input type="password" name="Haslo" required maxlength="25"></label><br><br>
    <label>Imię: <input type="text" name="Imie" required maxlength="255"></label><br><br>
    <label>Nazwisko: <input type="text" name="Nazwisko" required maxlength="255"></label><br><br>
    <label>Email: <input type="email" name="Email" required maxlength="50"></label><br><br>
    <label>Telefon: <input type="number" name="Telefon" required></label><br><br>
    <label>Miasto: <input type="text" name="Miasto" required maxlength="50"></label><br><br>
    <label>Ulica: <input type="text" name="Ulice" required maxlength="50"></label><br><br>
    <label>Numer mieszkania: <input type="number" name="Numer_mieszkania" required></label><br><br>
    <label>Rola: 
        <select name="Rola" required>
            <option value="U">Użytkownik</option>
            <option value="A">Administrator</option>
        </select>
    </label><br><br>
    <label>ID kierunku: <input type="number" name="id_kierunku" required></label><br><br>
    <label>Rok studiów: <input type="number" name="rok_studiow"></label><br><br>
    <label>Tytuł naukowy: <input type="text" name="tytul_naukowy" maxlength="255"></label><br><br>
    
    <button type="submit">Dodaj użytkownika</button>
</form>

<?php
include 'pma.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nazwa = $_POST['Nazwa'];
    $Haslo = $_POST['Haslo']; 
    $Imie = $_POST['Imie'];
    $Nazwisko = $_POST['Nazwisko'];
    $Email = $_POST['Email'];
    $Telefon = $_POST['Telefon'];
    $Miasto = $_POST['Miasto'];
    $Ulice = $_POST['Ulice'];
    $Numer_mieszkania = $_POST['Numer_mieszkania'];
    $Rola = $_POST['Rola'];
    $rok_studiow = $_POST['rok_studiow'] ?? null;
    $id_kierunku = $_POST['id_kierunku'];
    $tytul_naukowy = $_POST['tytul_naukowy'] ?? null;

    $sql = "INSERT INTO users (
        Nazwa, Haslo, Imie, Nazwisko, Email, Telefon, Miasto, Ulice, 
        Numer_mieszkania, Rola, rok_studiow, id_kierunku, tytul_naukowy
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param(
        "sssssisisiiss",
        $Nazwa, $Haslo, $Imie, $Nazwisko, $Email, $Telefon, $Miasto,
        $Ulice, $Numer_mieszkania, $Rola, $rok_studiow, $id_kierunku, $tytul_naukowy
    );

    if ($stmt->execute()) {
        echo "Użytkownik został dodany pomyślnie!";
    } else {
        echo "Błąd: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>