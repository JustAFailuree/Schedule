<?php
// Parametry połączenia
$host = 'localhost'; // Adres serwera bazy danych
$user = 'root'; // Użytkownik bazy danych
$password = ''; // Hasło bazy danych
$dbname = 'schedule'; // Nazwa bazy danych

// Tworzenie połączenia
$conn = new mysqli($host, $user, $password, $dbname);

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
} else {
    echo "Połączenie udane!";
}

// Zamknięcie połączenia (opcjonalnie)
$conn->close();
?>
