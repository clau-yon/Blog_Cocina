<?php
   
<<<<<<< HEAD
            $host = "localhost:3307";
            $dbname = "tarea27";
            $username = "root";
            $password = "";
=======
    $host = "localhost";
    $dbname = "tarea27";
    $username = "root";
    $password = "";
>>>>>>> 9b301db87745f2c6509f06953475a77c6fc4e708

     
            $conn = mysqli_connect($host, $username, $password, $dbname);

            if (!$conn) {
                die("Error de conexión a la base de datos: " . mysqli_connect_error());
            }
            

?>