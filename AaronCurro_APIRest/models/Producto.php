<?php
    /**
     * Clase Producto: Maneja operaciones relacionadas con la tabla de productos en la base de datos.
     */
    class Producto extends Conectar{

        /**
         * Método para obtener todos los productos disponibles.
         * @return array Arreglo asociativo que contiene todos los productos disponibles.
         */
        public function get_producto(){
            $conectar= parent::conexion(); // Obtiene la conexión a la base de datos
            parent::set_names(); // Establece el juego de caracteres a UTF-8
            $sql="SELECT * FROM tm_producto WHERE cant >= 1"; // Consulta SQL para obtener todos los productos disponibles
            $sql=$conectar->prepare($sql); // Prepara la consulta SQL
            $sql->execute(); // Ejecuta la consulta
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los productos disponibles como un arreglo asociativo
        }

        /**
         * Método para insertar un nuevo producto en la base de datos.
         * @param string $pro_nom Nombre del producto a insertar.
         * @param float $pro_precio Precio del producto a insertar.
         * @param int $cat_id ID de la categoría a la que pertenece el producto.
         * @param int $cant Cantidad disponible del producto a insertar.
         * @return array Arreglo asociativo que contiene los datos insertados del nuevo producto.
         */
        public function insert_producto($pro_nom,$pro_precio, $cat_id, $cant){
            $conectar= parent::conexion(); // Obtiene la conexión a la base de datos
            parent::set_names(); // Establece el juego de caracteres a UTF-8
            $sql="INSERT INTO tm_producto(pro_id,pro_nom,pro_precio, cat_id, cant) VALUES (NULL,?,?,?,?)"; // Consulta SQL para insertar un nuevo producto
            $sql=$conectar->prepare($sql); // Prepara la consulta SQL
            $sql->bindValue(1, $pro_nom); // Asigna el valor del parámetro pro_nom a la consulta SQL
            $sql->bindValue(2, $pro_precio); // Asigna el valor del parámetro pro_precio a la consulta SQL
            $sql->bindValue(3, $cat_id); // Asigna el valor del parámetro cat_id a la consulta SQL
            $sql->bindValue(4, $cant); // Asigna el valor del parámetro cant a la consulta SQL
            $sql->execute(); // Ejecuta la consulta
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC); // Retorna los datos insertados del nuevo producto como un arreglo asociativo
        }

    }