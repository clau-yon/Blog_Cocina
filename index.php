<?php
session_start();
$welcomeMessage = "Bienvenido"; // Mensaje predeterminado

if (isset($_SESSION['username'])) {
    $welcomeMessage = "Bienvenido, " . $_SESSION['username'] . "!";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
          <title>Name Blog</title>
          <link rel="stylesheet" type="text/css" href="./assets/style.css">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
          <script src="https://kit.fontawesome.com/6e316b87b7.js" crossorigin="anonymous"></script>
    </head>
  <!--  <body>
    
    <div class="navbar">
        <h1>Name Blog</h1>
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
        <a href="contact.html">Login</a>
    </div>-->
<?php include('./components/header.php'); ?>    
    <!-- INICIO DEL CARROSEL -->
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
<!--FIN-->

      <div class="container">
        <div class="posts">
            <!-- Contenido publicaciones  -->
        </div>
        <div class="sidebar">
            <div class="user">
                <img>
                <p>Name</p>
                <p><?php echo $welcomeMessage; ?></p>
            </div>
        </div>
    </div>

    </body>
    </html>
    