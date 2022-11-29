<?php
//include "conn.php";
//include "utils.php";
//$dbconn = connect($db);

include 'conexion.php';

$dbconn = new Conexion();

# Actualizar un registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
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

    $stmt->bindValue(':id_usuario',     $_POST['id_usuario']);
    $stmt->bindValue(':usuario',        $_POST['usuario']);
    $stmt->bindValue(':nombre',         $_POST['nombre']);
    $stmt->bindValue(':password',       $_POST['password']);
    $stmt->bindValue(':correo',         $_POST['correo']);
    $stmt->bindValue(':estado',         $_POST['estado']);
    $stmt->execute();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Credentials: *");
    $salidadatos= "Registro Actualizado ";
    echo json_encode($salidadatos);
    exit();
}
?>