<?php

    /**
     * Clase Categoria: Maneja operaciones relacionadas con la tabla de categorías en la base de datos.
     */
    class Categoria extends Conectar{
        
        /**
         * Método para obtener todas las categorías activas.
         * @return array Arreglo asociativo que contiene todas las categorías activas.
         */
        public function get_categoria(){
            $conectar = parent::conexion(); // Obtiene la conexión a la base de datos
            parent::set_names(); // Establece el juego de caracteres a UTF-8
            $sql = "SELECT * FROM tm_categoria WHERE est = 1"; // Consulta SQL para obtener todas las categorías activas
            $sql = $conectar->prepare($sql); // Prepara la consulta SQL
            $sql->execute(); // Ejecuta la consulta
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna todas las categorías activas como un arreglo asociativo
        }

        /**
         * Método para obtener una categoría por su ID.
         * @param int $cat_id ID de la categoría a buscar.
         * @return array Arreglo asociativo que contiene la categoría encontrada por su ID.
         */
        public function get_categoria_x_id($cat_id){
            $conectar = parent::conexion(); // Obtiene la conexión a la base de datos
            parent::set_names(); // Establece el juego de caracteres a UTF-8
            $sql = "SELECT * FROM tm_categoria WHERE est = 1 AND cat_id = ?"; // Consulta SQL para obtener una categoría por su ID
            $sql = $conectar->prepare($sql); // Prepara la consulta SQL
            $sql->bindValue(1, $cat_id); // Asigna el valor del parámetro cat_id a la consulta SQL
            $sql->execute(); // Ejecuta la consulta
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna la categoría encontrada por su ID como un arreglo asociativo
        }

        /**
         * Método para insertar una nueva categoría en la base de datos.
         * @param string $cat_nom Nombre de la categoría a insertar.
         * @param string $cat_obs Observaciones de la categoría a insertar.
         * @return array Arreglo asociativo que contiene los datos insertados de la nueva categoría.
         */
        public function insert_categoria($cat_nom, $cat_obs){
            $conectar = parent::conexion(); // Obtiene la conexión a la base de datos
            parent::set_names(); // Establece el juego de caracteres a UTF-8
            $sql = "INSERT INTO tm_categoria(cat_id, cat_nom, cat_obs, est) VALUES (NULL, ?, ?, '1')"; // Consulta SQL para insertar una nueva categoría
            $sql = $conectar->prepare($sql); // Prepara la consulta SQL
            $sql->bindValue(1, $cat_nom); // Asigna el valor del parámetro cat_nom a la consulta SQL
            $sql->bindValue(2, $cat_obs); // Asigna el valor del parámetro cat_obs a la consulta SQL
            $sql->execute(); // Ejecuta la consulta
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna los datos insertados de la nueva categoría como un arreglo asociativo
        }

        /**
         * Método para actualizar una categoría existente en la base de datos.
         * @param int $cat_id ID de la categoría a actualizar.
         * @param string $cat_nom Nuevo nombre de la categoría.
         * @param string $cat_obs Nuevas observaciones de la categoría.
         * @return array Arreglo asociativo que contiene los datos actualizados de la categoría.
         */
        public function update_categoria($cat_id, $cat_nom, $cat_obs){
            $conectar = parent::conexion(); // Obtiene la conexión a la base de datos
            parent::set_names(); // Establece el juego de caracteres a UTF-8
            $sql = "UPDATE tm_categoria SET cat_nom = ?, cat_obs = ? WHERE cat_id = ?"; // Consulta SQL para actualizar una categoría
            $sql = $conectar->prepare($sql); // Prepara la consulta SQL
            $sql->bindValue(1, $cat_nom); // Asigna el valor del parámetro cat_nom a la consulta SQL
            $sql->bindValue(2, $cat_obs); // Asigna el valor del parámetro cat_obs a la consulta SQL
            $sql->bindValue(3, $cat_id); // Asigna el valor del parámetro cat_id a la consulta SQL
            $sql->execute(); // Ejecuta la consulta
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna los datos actualizados de la categoría como un arreglo asociativo
        }

        /**
         * Método para eliminar una categoría existente de la base de datos.
         * @param int $cat_id ID de la categoría a eliminar.
         * @return array Arreglo asociativo que contiene los datos eliminados de la categoría.
         */
        public function delete_categoria($cat_id){
            $conectar = parent::conexion(); // Obtiene la conexión a la base de datos
            parent::set_names(); // Establece el juego de caracteres a UTF-8
            $sql = "UPDATE tm_categoria SET est = '0' WHERE cat_id = ?"; // Consulta SQL para eliminar una categoría
            $sql = $conectar->prepare($sql); // Prepara la consulta SQL
            $sql->bindValue(1, $cat_id); // Asigna el valor del parámetro cat_id a la consulta SQL
            $sql->execute(); // Ejecuta la consulta
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna los datos eliminados de la categoría como un arreglo asociativo
        }
    }