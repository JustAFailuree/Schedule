<!DOCTYPE html>
<?php
session_start();
include 'pma.php';

echo $_SESSION['id'] . ' | ' . $_SESSION['role'];

// === Obsługa USUWANIA kierunku ===
if (isset($_GET['delete_kierunek_id'])) {
    $delete_id = intval($_GET['delete_kierunek_id']);
    $stmt = $conn->prepare("DELETE FROM kierunki WHERE id_kierunku = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
    exit();
}

// === Obsługa EDYCJI kierunku ===
if (isset($_POST['update_kierunek_id'])) {
    $update_id = intval($_POST['update_kierunek_id']);
    $new_name = $_POST['nazwa_kierunku'];
    $stmt = $conn->prepare("UPDATE kierunki SET nazwa_kierunku = ? WHERE id_kierunku = ?");
    $stmt->bind_param("si", $new_name, $update_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
    exit();
}
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administratora</title>
</head>
<body>
    <a href="index.php">Powrót</a>

    <h2>Lista kierunków</h2>
    <?php
    $result = $conn->query("SELECT * FROM kierunki");
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID Kierunku</th><th>Nazwa Kierunku</th><th>Akcje</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            if (isset($_GET['edit_kierunek_id']) && $_GET['edit_kierunek_id'] == $row['id_kierunku']) {
                echo "<form method='post'>";
                echo "<td>" . $row['id_kierunku'] . "</td>";
                echo "<td><input type='text' name='nazwa_kierunku' value='" . htmlspecialchars($row['nazwa_kierunku']) . "'></td>";
                echo "<td>
                    <input type='hidden' name='update_kierunek_id' value='{$row['id_kierunku']}'>
                    <button type='submit'>Zapisz</button>
                    <a href='?'>Anuluj</a>
                </td>";
                echo "</form>";
            } else {
                echo "<td>{$row['id_kierunku']}</td>";
                echo "<td>" . htmlspecialchars($row['nazwa_kierunku']) . "</td>";
                echo "<td>
                    <a href='?edit_kierunek_id={$row['id_kierunku']}'>Edytuj</a> |
                    <a href='?delete_kierunek_id={$row['id_kierunku']}' onclick=\"return confirm('Usunąć kierunek?')\">Usuń</a>
                </td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Brak kierunków.";
    }

    // === Obsługa USUWANIA użytkownika ===
    if (isset($_GET['delete_user_id'])) {
        $delete_id = intval($_GET['delete_user_id']);
        $stmt = $conn->prepare("DELETE FROM users WHERE user_ID = ?");
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $stmt->close();
        header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
        exit();
    }

    // === Obsługa EDYCJI użytkownika ===
    if (isset($_POST['update_user_id'])) {
        $stmt = $conn->prepare("UPDATE users SET 
            Nazwa = ?, Imie = ?, Nazwisko = ?, Email = ?, Telefon = ?, Miasto = ?, Ulice = ?, Numer_mieszkania = ?, 
            Rola = ?, rok_studiow = ?, id_kierunku = ?, tytul_naukowy = ? WHERE user_ID = ?");

        $stmt->bind_param("sssssissisiis",
            $_POST['Nazwa'], $_POST['Imie'], $_POST['Nazwisko'], $_POST['Email'], $_POST['Telefon'],
            $_POST['Miasto'], $_POST['Ulice'], $_POST['Numer_mieszkania'], $_POST['Rola'],
            $_POST['rok_studiow'], $_POST['id_kierunku'], $_POST['tytul_naukowy'], $_POST['update_user_id']
        );

        $stmt->execute();
        $stmt->close();
        header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
        exit();
    }

    // === Lista użytkowników ===
    echo "<h2>Lista użytkowników</h2>";
    $users = $conn->query("SELECT u.*, k.nazwa_kierunku FROM users u LEFT JOIN kierunki k ON u.id_kierunku = k.id_kierunku");
    if ($users->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Nazwa</th><th>Imię</th><th>Nazwisko</th><th>Email</th><th>Telefon</th><th>Miasto</th><th>Ulica</th><th>Nr miesz.</th><th>Rola</th><th>Rok</th><th>Kierunek</th><th>Tytuł</th><th>Akcje</th></tr>";
        while ($user = $users->fetch_assoc()) {
            echo "<tr>";
            if (isset($_GET['edit_user_id']) && $_GET['edit_user_id'] == $user['user_ID']) {
                echo "<form method='post'>";
                echo "<td>{$user['user_ID']}</td>";
                echo "<td><input type='text' name='Nazwa' value='" . htmlspecialchars($user['Nazwa']) . "'></td>";
                echo "<td><input type='text' name='Imie' value='" . htmlspecialchars($user['Imie']) . "'></td>";
                echo "<td><input type='text' name='Nazwisko' value='" . htmlspecialchars($user['Nazwisko']) . "'></td>";
                echo "<td><input type='email' name='Email' value='" . htmlspecialchars($user['Email']) . "'></td>";
                echo "<td><input type='text' name='Telefon' value='" . htmlspecialchars($user['Telefon']) . "'></td>";
                echo "<td><input type='text' name='Miasto' value='" . htmlspecialchars($user['Miasto']) . "'></td>";
                echo "<td><input type='text' name='Ulice' value='" . htmlspecialchars($user['Ulice']) . "'></td>";
                echo "<td><input type='number' name='Numer_mieszkania' value='" . htmlspecialchars($user['Numer_mieszkania']) . "'></td>";
                echo "<td>
                    <select name='Rola'>
                        <option value='U'" . ($user['Rola'] == 'U' ? ' selected' : '') . ">Użytkownik</option>
                        <option value='A'" . ($user['Rola'] == 'A' ? ' selected' : '') . ">Admin</option>
                        <option value='W'" . ($user['Rola'] == 'W' ? ' selected' : '') . ">Wykładowca</option>
                    </select>
                </td>";
                echo "<td><input type='number' name='rok_studiow' value='" . htmlspecialchars($user['rok_studiow']) . "'></td>";
                echo "<td><select name='id_kierunku'>";
                $kierunki = $conn->query("SELECT * FROM kierunki");
                while ($k = $kierunki->fetch_assoc()) {
                    $sel = $k['id_kierunku'] == $user['id_kierunku'] ? 'selected' : '';
                    echo "<option value='{$k['id_kierunku']}' $sel>" . htmlspecialchars($k['nazwa_kierunku']) . "</option>";
                }
                echo "</select></td>";
                echo "<td><input type='text' name='tytul_naukowy' value='" . htmlspecialchars($user['tytul_naukowy']) . "'></td>";
                echo "<td>
                    <input type='hidden' name='update_user_id' value='{$user['user_ID']}'>
                    <button type='submit'>Zapisz</button>
                    <a href='?'>Anuluj</a>
                </td>";
                echo "</form>";
            } else {
                echo "<td>{$user['user_ID']}</td>";
                echo "<td>" . htmlspecialchars($user['Nazwa']) . "</td>";
                echo "<td>" . htmlspecialchars($user['Imie']) . "</td>";
                echo "<td>" . htmlspecialchars($user['Nazwisko']) . "</td>";
                echo "<td>" . htmlspecialchars($user['Email']) . "</td>";
                echo "<td>" . htmlspecialchars($user['Telefon']) . "</td>";
                echo "<td>" . htmlspecialchars($user['Miasto']) . "</td>";
                echo "<td>" . htmlspecialchars($user['Ulice']) . "</td>";
                echo "<td>" . htmlspecialchars($user['Numer_mieszkania']) . "</td>";
                echo "<td>" . htmlspecialchars($user['Rola']) . "</td>";
                echo "<td>" . htmlspecialchars($user['rok_studiow']) . "</td>";
                echo "<td>" . htmlspecialchars($user['nazwa_kierunku']) . "</td>";
                echo "<td>" . htmlspecialchars($user['tytul_naukowy']) . "</td>";
                echo "<td>
                    <a href='?edit_user_id={$user['user_ID']}'>Edytuj</a> |
                    <a href='?delete_user_id={$user['user_ID']}' onclick=\"return confirm('Usunąć użytkownika?')\">Usuń</a>
                </td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Brak użytkowników.";
    }
    ?>

    <h2>Dodaj użytkownika</h2>
    <form method="post">
        <input type="text" name="Nazwa" placeholder="Login" required><br>
        <input type="password" name="Haslo" placeholder="Hasło" required><br>
        <input type="text" name="Imie" placeholder="Imię" required><br>
        <input type="text" name="Nazwisko" placeholder="Nazwisko" required><br>
        <input type="email" name="Email" placeholder="Email" required><br>
        <input type="text" name="Telefon" placeholder="Telefon" required><br>
        <input type="text" name="Miasto" placeholder="Miasto" required><br>
        <input type="text" name="Ulice" placeholder="Ulica" required><br>
        <input type="number" name="Numer_mieszkania" placeholder="Nr mieszkania" required><br>
        <select name="Rola" required>
            <option value="U">Użytkownik</option>
            <option value="A">Administrator</option>
            <option value="W">Wykładowca</option>
        </select><br>
        <input type="number" name="rok_studiow" placeholder="Rok studiów"><br>
        <input type="number" name="id_kierunku" placeholder="ID Kierunku" required><br>
        <input type="text" name="tytul_naukowy" placeholder="Tytuł naukowy"><br>
        <button type="submit">Dodaj</button>
    </form>

<?php
// Dodawanie nowego użytkownika
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['update_user_id'])) {
    $stmt = $conn->prepare("INSERT INTO users (
        Nazwa, Haslo, Imie, Nazwisko, Email, Telefon, Miasto, Ulice, Numer_mieszkania, Rola, rok_studiow, id_kierunku, tytul_naukowy
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssissisiis",
        $_POST['Nazwa'], $_POST['Haslo'], $_POST['Imie'], $_POST['Nazwisko'],
        $_POST['Email'], $_POST['Telefon'], $_POST['Miasto'], $_POST['Ulice'],
        $_POST['Numer_mieszkania'], $_POST['Rola'], $_POST['rok_studiow'],
        $_POST['id_kierunku'], $_POST['tytul_naukowy']
    );
    if ($stmt->execute()) {
        echo "Dodano użytkownika.";
    } else {
        echo "Błąd: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>

<?php
include 'pma.php';

// === USUWANIE klasy ===
if (isset($_GET['delete_class_id'])) {
    $stmt = $conn->prepare("DELETE FROM classes WHERE class_ID = ?");
    $stmt->bind_param("i", $_GET['delete_class_id']);
    $stmt->execute();
    $stmt->close();
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

// === AKTUALIZACJA klasy ===
if (isset($_POST['update_class_id'])) {
    $stmt = $conn->prepare("UPDATE classes SET 
        class_name = ?, Data_zajec = ?, Godzina_rozpoczecia = ?, Godzina_zakonczenia = ?, Typ_zajec = ?, 
        id_kierunku = ?, budynek = ?, numer_sali = ? WHERE class_ID = ?");
    $stmt->bind_param("sssssisii",
        $_POST['class_name'], $_POST['Data_zajec'], $_POST['Godzina_rozpoczecia'],
        $_POST['Godzina_zakonczenia'], $_POST['Typ_zajec'], $_POST['id_kierunku'],
        $_POST['budynek'], $_POST['numer_sali'], $_POST['update_class_id']
    );
    $stmt->execute();
    $stmt->close();
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

// === LISTA klas ===
echo "<h2>Lista zajęć</h2>";
$result = $conn->query("SELECT c.*, k.nazwa_kierunku FROM classes c LEFT JOIN kierunki k ON c.id_kierunku = k.id_kierunku");

echo "<table border='1' cellpadding='8'><tr>
    <th>ID</th><th>Nazwa</th><th>Data</th><th>Początek</th><th>Koniec</th><th>Typ</th>
    <th>Kierunek</th><th>Budynek</th><th>Sala</th><th>Akcje</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    if (isset($_GET['edit_class_id']) && $_GET['edit_class_id'] == $row['class_ID']) {
        echo "<form method='post'>";
        echo "<td>{$row['class_ID']}</td>";
        echo "<td><input name='class_name' value='" . htmlspecialchars($row['class_name']) . "'></td>";
        echo "<td><input type='date' name='Data_zajec' value='{$row['Data_zajec']}'></td>";
        echo "<td><input type='time' name='Godzina_rozpoczecia' value='{$row['Godzina_rozpoczecia']}'></td>";
        echo "<td><input type='time' name='Godzina_zakonczenia' value='{$row['Godzina_zakonczenia']}'></td>";
        echo "<td><input name='Typ_zajec' value='{$row['Typ_zajec']}'></td>";

        // Select kierunek
        $kierunki = $conn->query("SELECT * FROM kierunki");
        echo "<td><select name='id_kierunku'>";
        while ($k = $kierunki->fetch_assoc()) {
            $sel = $row['id_kierunku'] == $k['id_kierunku'] ? "selected" : "";
            echo "<option value='{$k['id_kierunku']}' $sel>{$k['nazwa_kierunku']}</option>";
        }
        echo "</select></td>";

        echo "<td><input name='budynek' value='{$row['budynek']}'></td>";
        echo "<td><input name='numer_sali' value='{$row['numer_sali']}'></td>";

        echo "<td>
            <input type='hidden' name='update_class_id' value='{$row['class_ID']}'>
            <button type='submit'>Zapisz</button> <a href='?'>Anuluj</a>
        </td>";
        echo "</form>";
    } else {
        echo "<td>{$row['class_ID']}</td>";
        echo "<td>" . htmlspecialchars($row['class_name']) . "</td>";
        echo "<td>{$row['Data_zajec']}</td>";
        echo "<td>{$row['Godzina_rozpoczecia']}</td>";
        echo "<td>{$row['Godzina_zakonczenia']}</td>";
        echo "<td>{$row['Typ_zajec']}</td>";
        echo "<td>{$row['nazwa_kierunku']}</td>";
        echo "<td>{$row['budynek']}</td>";
        echo "<td>{$row['numer_sali']}</td>";
        echo "<td>
            <a href='?edit_class_id={$row['class_ID']}'>Edytuj</a> |
            <a href='?delete_class_id={$row['class_ID']}' onclick=\"return confirm('Usunąć zajęcia?')\">Usuń</a>
        </td>";
    }
    echo "</tr>";
}
echo "</table>";
?>

<h2>Dodaj nowe zajęcia</h2>
<form method="post">
    <input type="text" name="class_name" placeholder="Nazwa zajęć" required><br>
    <input type="date" name="Data_zajec" required><br>
    <input type="time" name="Godzina_rozpoczecia" required><br>
    <input type="time" name="Godzina_zakonczenia" required><br>
    <input type="text" name="Typ_zajec" placeholder="Typ zajęć" required><br>

    <select name="id_kierunku" required>
        <option value="">--Wybierz kierunek--</option>
        <?php
        $res = $conn->query("SELECT * FROM kierunki");
        while ($r = $res->fetch_assoc()) {
            echo "<option value='{$r['id_kierunku']}'>" . htmlspecialchars($r['nazwa_kierunku']) . "</option>";
        }
        ?>
    </select><br>

    <input type="text" name="budynek" placeholder="Budynek" required><br>
    <input type="text" name="numer_sali" placeholder="Numer sali" required><br>
    <button type="submit" name="add_class">Dodaj zajęcia</button>
</form>

<?php
// DODAWANIE klasy
if (isset($_POST['add_class'])) {
    $stmt = $conn->prepare("INSERT INTO classes (
        class_name, Data_zajec, Godzina_rozpoczecia, Godzina_zakonczenia, Typ_zajec,
        id_kierunku, budynek, numer_sali
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisss",
        $_POST['class_name'], $_POST['Data_zajec'], $_POST['Godzina_rozpoczecia'],
        $_POST['Godzina_zakonczenia'], $_POST['Typ_zajec'], $_POST['id_kierunku'],
        $_POST['budynek'], $_POST['numer_sali']
    );
    if ($stmt->execute()) {
        echo "Dodano zajęcia.";
    } else {
        echo "Błąd: " . $stmt->error;
    }
    $stmt->close();
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}
$conn->close();
?>

</body>
</html>
