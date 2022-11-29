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
        $sql = "SELECT  em.id_emocion_x_usuario, em.id_usuario, 
                        u.usuario,  e.descripcion as emocion,
                        em.fecha, e.dir_imagen
                FROM emocionxUsuario em
                inner join emociones e
                on em.id_emocion=e.id_emocion
                inner join usuarios u
                on em.id_usuario=u.id_usuario
                WHERE em.id_usuario='$id_usuario'
                order by em.fecha desc";
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
            //echo '{"userData": ' . $salidadatos . '}';
            echo $salidadatos ;
        }
    }  else {
        # Endpoint = Consultar todos los Usuarios
        $dbconn->query("SET NAMES 'UTF8'");
        $sql = "SELECT  em.id_emocion_x_usuario, em.id_usuario, 
                        u.usuario,  e.descripcion as emocion,
                        em.fecha, e.dir_imagen
                FROM emocionxUsuario em
                inner join emociones e
                on em.id_emocion=e.id_emocion
                inner join usuarios u
                on em.id_usuario=u.id_usuario
                order by em.fecha desc";
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
            //echo '{"userData": ' . $salidadatos . '}';
            echo $salidadatos ;
        }
    }
}