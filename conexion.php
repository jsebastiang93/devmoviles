<?php
class Conexion extends PDO{
    private $hostBD = 'localhost';
    private $nombreBD = 'id19640205_bdnikocalendar';
    private $userBD = 'id19640205_admin';
    private $passBD = 'BU.td.2022/*';

    public function __construct(){
        try {
            parent::__construct('mysql:host=' . $this->hostBD . '; dbname=' . $this->nombreBD . ';charset=utf8', $this->userBD, $this->passBD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            echo 'Error: '. $e->getMessage();
            exit;
        }
    }
}
?>