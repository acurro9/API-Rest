// Se espera a que envie el formulario para insertar
document.getElementById("pro_btn").addEventListener("click", (e) => {
  // Se previene que el formulario se envíe de forma predeterminada
  e.preventDefault();

  // Se obtienen los valores de los campos del formulario
  let pro_nom = $("#pro_nom").val();
  let pro_precio = $("#pro_precio").val();
  let pro_cant = $("#pro_cant").val();
  let cat_id = $("#cat_id").val();

  // Se guardan los datos que se enviarán
  let datos = {
    pro_nom: pro_nom,
    pro_precio: pro_precio,
    cant: pro_cant,
    cat_id: cat_id,
  };

  // Se define la  url
  const url =
    "http://localhost/AaronCurro_APIRest/controller/producto.php?op=Insert";

  // Crear una nueva solicitud XMLHttpRequest
  const xhr = new XMLHttpRequest();

  // Configurar la solicitud
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  // Se maneja la respuesta del servidor
  xhr.onload = () => {
    if (xhr.status >= 200 && xhr.status < 300) {
      // En caso de solicitud fue exitosa
      console.log(xhr.responseText);
    } else {
      // En caso de solicitud fallidda
      console.error("Error en la solicitud");
    }
  };

  // Se manejan los errores
  xhr.onerror = () => {
    console.error("Error al enviar la solicitud");
  };

  // Se envia la solicitud con los datos del formulario
  xhr.send(JSON.stringify(datos));
  // Se eliminan los tr de la tabla
  eliminarTR();
});

// Se realiza la solicitud AJAX
const obtenerProductos = async () => {
  const url =
    "http://localhost/AaronCurro_APIRest/controller/producto.php?op=GetAll";
  const resultado = await fetch(url);
  const datos = await resultado.json();
  obtenerCategorias();
  mostrarProductos(datos);
};

// Se muestran los Categorias cogiendo el tbody e insertando los tr con los td necesarios
const mostrarProductos = (productos) => {
  let tbody = document.getElementById("pro_tbody");

  productos.forEach((producto) => {
    let tr = document.createElement("tr");
    tr.classList.add("pro_tr");

    let td_id = document.createElement("td");
    td_id.textContent = producto.pro_id;

    let td_nom = document.createElement("td");
    td_nom.textContent = producto.pro_nom;

    let td_precio = document.createElement("td");
    td_precio.textContent = producto.pro_precio;

    let td_cant = document.createElement("td");
    td_cant.textContent = producto.cant;

    let cat_id = document.createElement("td");
    cat_id.textContent = producto.cat_id;
    tr.appendChild(td_id);
    tr.appendChild(td_nom);
    tr.appendChild(td_precio);
    tr.appendChild(td_cant);
    tr.appendChild(cat_id);
    tbody.appendChild(tr);
    console.log(producto.pro_nom);
  });
};
// Se eliminan los tr para volver a mostrar los datos
const eliminarTR = () => {
  let trs = document.getElementById("pro_tbody").getElementsByTagName("tr");
  while (trs.length > 0) trs[0].parentNode.removeChild(trs[0]);

  document.getElementById("pro_nom").value = "";
  document.getElementById("pro_precio").value = "";
  document.getElementById("pro_cant").value = "";
  document.getElementById("cat_id").value = "";

  const timeOut = setTimeout(obtenerProductos, 100);
};
// Se obtienen las categorias y se crean options con sus valores
const obtenerCategorias = async () => {
  const url =
    "http://localhost/AaronCurro_APIRest/controller/categoria.php?op=GetAll";
  const resultado = await fetch(url);
  const datos = await resultado.json();
  añadirCategoria(datos);
};

const añadirCategoria = (categorias) => {
  let select = document.getElementById("cat_id");

  categorias.forEach((categoria) => {
    let option = document.createElement("option");
    option.value = categoria.cat_id;
    option.textContent = categoria.cat_nom;

    select.appendChild(option);
  });
};

// Se llama a la función para obtener los productos
obtenerProductos();
