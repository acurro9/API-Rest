<?php
  // Establece el encabezado HTTP para indicar que se está enviando una respuesta en formato JSON
  header('Content-Type: application/json');

  // Requiere el archivo de configuración de la conexión a la base de datos y la clase Categoria
  require_once("../config/conexion.php");
  require_once("../models/Categoria.php");

  // Crea una nueva instancia de la clase Categoria
  $categoria = new Categoria();

  // Decodifica el cuerpo de la solicitud HTTP que se envía en formato JSON
  $body = json_decode(file_get_contents("php://input"), true);

  // Maneja las diferentes operaciones según el parámetro "op" en la solicitud GET
  switch($_GET["op"]){
      // Si la operación es "GetAll", obtiene todas las categorías
      case "GetAll":
          $datos = $categoria->get_categoria();
          echo json_encode($datos);
      break;

      // Si la operación es "GetId", obtiene una categoría por su ID
      case "GetId":
          $datos = $categoria->get_categoria_x_id($body["cat_id"]);
          echo json_encode($datos);
      break;

      // Si la operación es "Insert", inserta una nueva categoría
      case "Insert":
          $datos = $categoria->insert_categoria($body["cat_nom"],$body["cat_obs"]);
          echo json_encode("Insert Correcto");
      break;

      // Si la operación es "Update", actualiza una categoría existente
      case "Update":
          $datos = $categoria->update_categoria($body["cat_id"],$body["cat_nom"],$body["cat_obs"]);
          echo json_encode("Update Correcto");
      break;

      // Si la operación es "Delete", elimina una categoría existente
      case "Delete":
          $datos = $categoria->delete_categoria($body["cat_id"]);
          echo json_encode("Delete Correcto");
      break;
  }