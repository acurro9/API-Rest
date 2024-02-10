<?php
    // Establece el encabezado HTTP para indicar que se está enviando una respuesta en formato JSON
    header('Content-Type: application/json');

    // Requiere el archivo de configuración de la conexión a la base de datos y la clase Producto
    require_once("../config/conexion.php");
    require_once("../models/Producto.php");

    // Crea una nueva instancia de la clase Producto
    $producto= new Producto();

    // Decodifica el cuerpo de la solicitud HTTP que se envía en formato JSON
    $body = json_decode(file_get_contents("php://input"), true);

    // Maneja las diferentes operaciones según el parámetro "op" en la solicitud GET
    switch($_GET["op"]){
        // Si la operación es "GetAll", obtiene todos los productos
        case "GetAll":
            $datos=$producto->get_producto();
            echo json_encode($datos);
        break;

        // Si la operación es "Insert", inserta un nuevo producto
        case "Insert":
            $datos=$producto->insert_producto($body["pro_nom"],$body["pro_precio"],$body["cat_id"],$body["cant"]);
            echo json_encode("Insert Correcto");
        break;
    }