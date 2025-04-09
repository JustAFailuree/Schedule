<?php 
    session_start();  // Upewniamy się, że sesja jest rozpoczęta
    include 'pma.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['userName'];
        $haslo = $_POST['password'];

        // Tworzymy połączenie z bazą danych
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Używamy prepared statements, aby zapobiec SQL Injection
        $sql = "SELECT Haslo, Nazwa, Rola, user_ID FROM users WHERE Nazwa = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $login); // "s" oznacza string
        $stmt->execute();
        $result = $stmt->get_result();

        // Sprawdzamy, czy użytkownik istnieje
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $verify = password_verify($haslo, $row['Haslo']);

            if ($verify) {
                // Jeśli hasło jest poprawne, zapisujemy dane w sesji
                $_SESSION['role'] = $row['Rola'];
                $_SESSION['id'] = $row['user_ID'];
                echo "<script>window.location.href = 'index.php'; </script>";
                exit();
            } else {
                // Jeśli hasło jest niepoprawne, wyświetlamy błąd
                echo "<script> document.getElementById('errorMessage').style.display = 'block'; </script>";
            }
        } else {
            // Jeśli użytkownik nie istnieje, wyświetlamy błąd
            echo "<script> document.getElementById('errorMessage').style.display = 'block'; </script>";
        }

        $conn->close();
    }
?>