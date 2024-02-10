// Se espera a que envie el formulario para insertar
document.getElementById("cat_btn_insertar").addEventListener("click", (e) => {
  // Se previene que el formulario se envíe de forma predeterminada
  e.preventDefault();

  // Se obtienen los valores de los campos del formulario
  let cat_nom = $("#cat_nom").val();
  let cat_obs = $("#cat_obs").val();

  // Se guardan los datos que se enviarán
  let datos = {
    cat_nom: cat_nom,
    cat_obs: cat_obs,
  };

  // Se define la  url
  const url =
    "http://localhost/AaronCurro_APIRest/controller/categoria.php?op=Insert";

  // Se crea una nueva solicitud XMLHttpRequest
  const xhr = new XMLHttpRequest();

  // Se configura la solicitud
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
const obtenerCategorias = async () => {
  const url =
    "http://localhost/AaronCurro_APIRest/controller/categoria.php?op=GetAll";
  const resultado = await fetch(url);
  const datos = await resultado.json();
  console.log(datos);
  mostrarCategorias(datos);
};

// Se muestran los Categorias cogiendo el tbody e insertando los tr con los td necesarios
const mostrarCategorias = (Categorias) => {
  let tbody = document.getElementById("cat_tbody");

  Categorias.forEach((categoria) => {
    let tr = document.createElement("tr");
    tr.classList.add("cat_tr");

    let td_id = document.createElement("td");
    td_id.textContent = categoria.cat_id;

    let td_nom = document.createElement("td");
    td_nom.textContent = categoria.cat_nom;

    let td_obs = document.createElement("td");
    td_obs.textContent = categoria.cat_obs;

    let cat_id = document.createElement("td");
    cat_id.textContent = categoria.est;
    tr.appendChild(td_id);
    tr.appendChild(td_nom);
    tr.appendChild(td_obs);
    tr.appendChild(cat_id);
    tbody.appendChild(tr);
  });
};

// Se eliminan los tr para volver a mostrar los datos
const eliminarTR = () => {
  let trs = document.getElementById("cat_tbody").getElementsByTagName("tr");
  while (trs.length > 0) trs[0].parentNode.removeChild(trs[0]);

  document.getElementById("cat_nom").value = "";
  document.getElementById("cat_obs").value = "";

  const timeOut = setTimeout(obtenerCategorias, 100);
};
// Se llama a la función para obtener las categorias
obtenerCategorias();
