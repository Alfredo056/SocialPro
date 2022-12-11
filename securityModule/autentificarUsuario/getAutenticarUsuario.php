<?php
session_start();
include('conexion.php');

if(isset($_POST['user']) && isset($_POST['pass']) ){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Usuario = validate($_POST['user']);
    $Clave = validate($_POST['pass']);

    if (empty($Usuario)){
        header("Location: Index.php?error=El usuario es requerido");
        exit();
    }elseif (empty($Clave)){
        header("Location: Index.php?error=La clave es requerida");  
        exit();
    }else{
        $Clave = md5($Clave);
        $Sql = "SELECT * FROM usuarios WHERE correo = '$Usuario' AND contrasenia = '$Clave'";
        $result = mysqli_query($conexion, $Sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if($row['correo'] === $Usuario && $row['contrasenia'] === $Clave){
                $_SESSION['correo'] = $row['correo']; 
                $_SESSION['id'] = $row['id']; 
                $_SESSION['nombre'] = $row['nombre']; 
                $_SESSION['apellido'] = $row['apellido'];
                header("Location: Inicio.php");
                exit();
            }else{
                header("Location: index.php?error=El usuario o la clave son incorrectos");
                exit();
            }
        }else{
            header("Location: index.php?error=El usuario o la clave son incorrectos");
            exit();
        }

    }

}else{
    header("Location: index.php");
    exit();
}
