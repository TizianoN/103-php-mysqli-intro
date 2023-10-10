<?php

function login($conn, $username, $password)
{
  $password = md5($password);

  // inizializzo la sessione
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  // preparo la query
  $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = ? AND `password` = ?");

  // sostituisco i parametri
  $stmt->bind_param('ss', $username, $password);

  // la eseguo
  $stmt->execute();

  // metto i risultati (sotto forma di oggetto mysqli_result) dentro una variabile
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // utente trovato
    $row = $result->fetch_assoc();
    $_SESSION['user_name'] = $row['username'];
    $_SESSION['user_id'] = $row['ID'];
  }
}

function logout()
{
  // inizializzo la sessione
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  // la elimino
  session_destroy();
}