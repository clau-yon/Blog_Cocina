<?php
include "./config/database.php";
session_start();
$welcomeMessage = "Bienvenido";
$showUserPanel = false;

if (isset($_SESSION['username'])) {
    $welcomeMessage = "¡Bienvenido, " . $_SESSION['username'] . "!";
    $showUserPanel = true;
}

// Procesar el cierre de sesión
if (isset($_GET['logout'])) {
    // CERRAR SESIÓN
    session_unset();
    session_destroy();
    // REDIRIGIR AL INDEX
    header('Location: index.php');
    exit;
}

// Realizar una consulta para obtener los posts
$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
          <title>Chefs en Casa</title>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
          <script src="https://kit.fontawesome.com/6e316b87b7.js" crossorigin="anonymous"></script>
          <link rel="stylesheet" type="text/css" href="./assets/style.css">
    </head>
<body>
 
<header >
  <div class="navbar">  
    <h1>Chefs en Casa</h1>

    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="about.html">Acerca</a></li>
      <li><a href="contact.html">Contactanos</a></li>
      <li>
          <?php
               if ($showUserPanel) {
                  echo '<a href="?logout=1"><i class="fa-solid fa-sign-out"></i> Cerrar Sesión</a>';
              } else {
                  echo '<a href="./login.php"><i class="fa-regular fa-user"></i> Login</a>';
              }
          ?>
      </li>
    </ul>
    </div>
</header>

      

    <div class="cards">
      <div class="card" style="width: 18rem;">
        <img src="./assets/images/car01.jpg" width="50%"  class="card-img-top" alt="...">
        <div class="card-body">
          <button type="button" class="btn btn-dark">Pastas</button>
        </div>
      </div>
      <div class="card" style="width: 15rem;">
        <img src="./assets/images/car02.jpg" width="50%"  class="card-img-top" alt="...">
        <div class="card-body">
          <a href="#" class="btn btn-dark">Guisos</a>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img src="./assets/images/car03.jpg" width="50%"  class="card-img-top" alt="...">
        <div class="card-body">
          <button type="button" class="btn btn-dark">Postres</button>
        </div>
      </div>
  
</div>

      <div class="container">
      <?php
        echo '<div class="posts">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<p>" . $row['content'] . "</p>";
        }
        echo '</div>';
        ?>
        <div class="sidebar">
        <?php if ($showUserPanel): ?>
          <div class="user">
              <img src="./assets/images/login.jpg" width="20%">
              <p><?php echo $welcomeMessage; ?></p>
              <a href="./users/userhome.php" class="btn btn-danger">Panel de Usuario</a>
          </div>
        <?php endif; ?>
            <div class="search">
                <input type="text" placeholder="Buscar...">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>

            </div>
            <div>
                AQUI REDES SOCIALES
            </div>

            <div class="">
                COSAS POPULARES
            </div>
        </div>
    </div>

    </body>
    </html>
    