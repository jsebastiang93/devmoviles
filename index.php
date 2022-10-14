<?php
//include "conn.php";
//include "utils.php";
//$dbconn = connect($db);

include 'conexion.php';

$dbconn = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    # Endpoint = Consultar por filtro id_usuario
    if (isset($_GET['id_usuario'])) {
        $id_usuario = $_GET['id_usuario'];
        $dbconn->query("SET NAMES 'UTF8'");
        $sql = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";
        $stmt = $dbconn->prepare($sql);
        $stmt->execute();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Credentials: *");

        if (!$sql) {
            echo "Error en la consulta";
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $salidadatos = json_encode($stmt->fetchAll());
            echo '{"userData": ' . $salidadatos . '}';
        }
    } else {
        # Endpoint = Consultar todos los Usuarios
        $dbconn->query("SET NAMES 'UTF8'");
        $sql = "SELECT * FROM usuarios";
        $stmt = $dbconn->prepare($sql);
        $stmt->execute();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Credentials: *");
        if (!$sql) {
            echo "Error en la consulta";
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $salidadatos = json_encode($stmt->fetchAll());
            echo '{"userData": ' . $salidadatos . '}';
        }
    }
}

# Crear un nuevo registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $dbconn->query("SET NAMES 'UTF8'");
    $sql = "INSERT INTO usuarios (usuario,nombre,password,correo,estado) 
            VALUES (:usuario,:nombre,:password,:correo,:estado)";
    $stmt = $dbconn->prepare($sql);

    $stmt->bindValue(':usuario', $_POST['usuario']);
    $stmt->bindValue(':nombre', $_POST['nombre']);
    $stmt->bindValue(':password', $_POST['password']);
    $stmt->bindValue(':correo', $_POST['correo']);
    $stmt->bindValue(':estado', $_POST['estado']);
    $stmt->execute();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Credentials: *");
    $salidadatos= "Registro insertado: id = ".$dbconn->lastInsertId();
    echo json_encode($salidadatos);
    exit();
}

# Actualizar un registro
if ($_SERVER['REQUEST_METHOD'] == 'PUT') 
{
    $dbconn->query("SET NAMES 'UTF8'");
    $sql = "UPDATE usuarios 
            SET usuario =:usuario, 
                nombre = :nombre,
                password = :password,
                correo = :correo,
                estado = :estado
            WHERE id_usuario = :id_usuario";
    $stmt = $dbconn->prepare($sql);

    $stmt->bindValue(':id_usuario',     $_GET['id_usuario']);
    $stmt->bindValue(':usuario',        $_GET['usuario']);
    $stmt->bindValue(':nombre',         $_GET['nombre']);
    $stmt->bindValue(':password',       $_GET['password']);
    $stmt->bindValue(':correo',         $_GET['correo']);
    $stmt->bindValue(':estado',         $_GET['estado']);
    $stmt->execute();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Credentials: *");
    $salidadatos= "Registro Actualizado ";
    echo json_encode($salidadatos);
    exit();
}

# Eliminar un registro
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') 
{
    $dbconn->query("SET NAMES 'UTF8'");
    $sql = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
    $stmt = $dbconn->prepare($sql);

    $stmt->bindValue(':id_usuario', $_GET['id_usuario']);

    $stmt->execute();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Credentials: *");
    $salidadatos= "Registro Eliminado ";
    echo json_encode($salidadatos);
    exit();
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
?>
