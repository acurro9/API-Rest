<?php
/**
 * Clase Conectar: Maneja la conexión a la base de datos utilizando PDO.
 */
class Conectar{
    protected $dbh; // Objeto de conexión a la base de datos

    /**
     * Método para establecer la conexión a la base de datos.
     * @return PDO Retorna el objeto PDO si la conexión es exitosa.
     */
    protected function Conexion(){
        try{
            // Intenta establecer la conexión a la base de datos utilizando PDO
            $conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=andercode_webservice", "root", "");
            return $conectar; // Devuelve el objeto PDO si la conexión es exitosa
        } catch (Exception $e) {
            // Captura cualquier excepción que ocurra durante la conexión y muestra un mensaje de error
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die(); // Finaliza el script si hay un error de conexión
        }
    }

    /**
     * Método para establecer el juego de caracteres a UTF-8 en la conexión a la base de datos.
     * @return PDOStatement Retorna el resultado de la ejecución de la consulta SQL.
     */
    public function set_names(){
        // Ejecuta una consulta SQL para configurar el juego de caracteres a UTF-8 en la conexión a la base de datos
        return $this->dbh->query("SET NAMES 'utf8'");
    }
}