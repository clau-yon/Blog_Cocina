<?php
   
    $host = "localhost";
    $dbname = "tarea27";
    $username = "root";
    $password = "";

          /* try {
                $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }*/
            $conn = mysqli_connect($host, $username, $password, $dbname);

            if (!$conn) {
                die("Error de conexión a la base de datos: " . mysqli_connect_error());
            }
            

?>