<?php
session_start();
include __DIR__ . '/ConnectionDB.php';

$conexion = ConnectionDB::getInstance()->getConnection();

if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data)
    {
        return trim($data);
        /* $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data; */
    }

    // $nombre__usuario = validate($_POST['nombre__usuario']);
    $identifier = validate($_POST['email']);
    $clave = validate($_POST['password']);

    if (empty($identifier)) {
        header("Location: ../../public/lenguajesHome.php?error=Usuario o email necesarios.");
        exit();
    } elseif (empty($clave)) {
        header("Location: ../../public/lenguajesHome.php?error=Contraseña necesaria.");
        exit();
    } else {
        // $clave_hashed_for_db = md5($clave);
        $sql = "SELECT * FROM users WHERE password = :clave AND (usuario = :identifier OR email = :identifier)";
        $resultado = $conexion->prepare($sql);
        $resultado->bindParam(':identifier', $identifier);
        $resultado->bindParam(':clave', $clave);
        $resultado->execute();

        if ($resultado->rowCount() > 0) {

            $user = $resultado->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nombre__usuario'] = $user['usuario'];
            $_SESSION['email'] = $user['email'];
            // var_dump($_SESSION);
            header("Location: ../../public/lenguajesHome.php");
            exit();
        } else {
            header("Location: ../../public/lenguajesHome.php?error=Credenciales inválidas.");
            exit();
        }
    }
}