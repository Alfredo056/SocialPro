<?php
    $host = "localhost";
    $User = "host";
    $pass = "";
    $db = "dbsocialpro";

    $conexion = mysqli_connect($host, $User, $pass, $db);

    if (!$con){
    echo "Conexion fallida";
    }