<?php
   
    $host = "localhost";
    $dbname = "tarea27";
    $username = "root";
    $password = "";

     
            $conn = mysqli_connect($host, $username, $password, $dbname);

            if (!$conn) {
                die("Error de conexión a la base de datos: " . mysqli_connect_error());
            }
            

?>