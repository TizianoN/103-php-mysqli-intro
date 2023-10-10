<?php
try {
  require_once __DIR__ . '/server.php';
} catch (Exception $e) {
  $error_meessage = $e->getMessage();
}

// inizializzo la sessione
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LC PHP</title>

  <!-- Bootstrap 5.3.0 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

  <!-- Font-awesome 6.4.2 -->
  <!-- <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    /> -->

  <!-- Custom style -->
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
  <div class="container mt-5">
    <!-- Se c'è un errore lo stampo -->
    <?php if (isset($error_meessage)): ?>
    <div class="alert alert-danger" role="alert">
      <strong>Errore</strong>
      <?= $error_meessage ?>
    </div>
    <?php endif; ?>

    <!-- Se l'utente è loggato -->
    <?php if (isset($_SESSION['user_id'])): ?>

    <!-- Stampo un messaggio di benvenuto -->
    <h3>
      Benvenuto
      <?= $_SESSION['user_name'] ?>
    </h3>

    <!-- Stampo il form per il logout -->
    <form method="POST">
      <input type="submit" name="logout" value="Logout" class="btn btn-primary">
    </form>

    <!-- Stampo la lista di dati sensibili -->
    <ul>
      <?php while ($department = $departments_result->fetch_assoc()): ?>
      <li>
        <strong>ID:
          <?= $department['id'] ?>
        </strong>
        <?= $department['name'] ?>
      </li>
      <?php endwhile; ?>
    </ul>

    <?php else: ?>
    <!-- Altimenti stampo il form di login -->
    <form method="POST">
      <div class="mb-3">
        <label for="username">Nome Utente</label>
        <input type="text" class="form-control" name="username" if="username">
      </div>
      <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" if="password">
      </div>

      <button class="btn btn-primary">Login</button>
    </form>
    <?php endif; ?>


  </div>
</body>




</html>