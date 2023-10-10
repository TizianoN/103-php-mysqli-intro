<?php

require_once __DIR__ . '/functions/functions.php';

// # Connect
define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "103_university_users");
define("DB_PORT", 3306);

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

// Check connection
if ($conn && $conn->connect_error) {
  throw new Exception("Connection failed: " . $conn->connect_error);
}

// # Login
if (isset($_POST['username']) && isset($_POST['password'])) {
  login($conn, $_POST['username'], $_POST['password']);
}

// # Logout
if (isset($_POST['logout'])) {
  logout();
}

// inizializzo la sessione
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// # SE L'UTENTE E' LOGGATO RECUPERO I DATI DA VISUALIZZARE
if (isset($_SESSION['user_id'])) {
  // genero un oggetto mysqli_results
  $departments_result = $conn->query("SELECT * FROM `departments`");
}