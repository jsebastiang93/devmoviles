<?php
//include "conn.php";
//include "utils.php";
//$dbconn = connect($db);

include 'conexion.php';

$dbconn = new Conexion();
# Eliminar un registro
if ($_SERVER['REQUEST_METHOD'] == 'GET') 
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

?>