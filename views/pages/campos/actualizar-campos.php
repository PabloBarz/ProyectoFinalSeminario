<?php
require_once '../../../app/helpers/Helper.php';
require_once '../../../app/config/app.php';
require_once '../../partials/header.php';
?>

<div class="main-panel">
  <div class="content-wrapper">
    <?= Helper::renderContentHeader("Actualización de Campos", "Inicio", SERVERURL . "views/") ?>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <form id="formActualizarCampos" autocomplete="off">
              <div class="card card-outline card-primary">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">Actualice los datos</div>
                    <div class="col-md-6 text-right">
                      <a href="./lista-campos" class="btn btn-sm btn-primary">Mostrar Lista</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="tipo-campo">Selecciona un Tipo de campo:</label>
                      <select class="form-control" id="tipo-campo" required>
                        <option value="">Selecciona un campo</option>
                        <option value="Futbol">Futbol</option>
                        <option value="Baloncesto">Baloncesto</option>
                        <option value="Bolleyball">Bolleyball</option>
                      </select>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="nombre">Nombre:</label>
                      <input type="text" class="form-control" id="nombre" required>
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="latitud">Latitud:</label>
                      <input type="number" class="form-control" id="latitud" required step="any">
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="longitud">Longitud:</label>
                      <input type="number" class="form-control" id="longitud" required step="any">
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="direccion">Dirección:</label>
                      <input type="text" class="form-control" id="direccion" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="distrito">Distrito:</label>
                      <select class="form-control" id="distrito" required>
                        <!-- Opciones del distrito -->
                        <option value="Alto Laran">Alto Laran</option>
                        <option value="Chavin">Chavin</option>
                        <option value="Chincha Alta">Chincha Alta</option>
                        <option value="Chincha Baja">Chincha Baja</option>
                        <option value="Grocio Prado">Grocio Prado</option>
                        <option value="Pueblo Nuevo">Pueblo Nuevo</option>
                        <option value="Tambo de Mora">Tambo de Mora</option>
                        <option value="San Juan de Yanac">San Juan de Yanac</option>
                        <option value="San Pedro de Huacarpana">San Pedro de Huacarpana</option>
                        <option value="Sunampe">Sunampe</option>
                        <option value="El Carmen">El Carmen</option>
                      </select>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="telefono">Teléfono:</label>
                      <input type="tel" class="form-control" id="telefono" pattern="9[0-9]{8}" maxlength="9" minlength="9" >
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-sm btn-outline-secondary" type="reset">Cancelar</button>
                  <button class="btn btn-sm btn-primary" type="submit">Actualizar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once '../../partials/_footer.php';
  ?>

  <script>
    document.addEventListener("DOMContentLoaded", (event) => {

      const idCampo = sessionStorage.getItem("idCampo");
      const params = new FormData();
      params.append("operation", "GetCampoById");
      params.append("idCampo", idCampo);

      const renderDataForm = async () => {
        try {
          const response = await fetch("../../../app/controllers/CamposController.php", {
            method: "POST",
            body: params
          })
          data = await response.json();

          document.querySelector("#tipo-campo").value = data[0].tipoCampo
          document.querySelector("#nombre").value = data[0].nombre
          document.querySelector("#latitud").value = data[0].latitud
          document.querySelector("#longitud").value = data[0].longitud
          document.querySelector("#direccion").value = data[0].direccion
          document.querySelector("#distrito").value = data[0].distrito
          document.querySelector("#telefono").value = data[0].telefono
        } catch (error) {
          console.log("Error peticion GetCampoById", error)
        }
      }

      const form = document.querySelector("#formActualizarCampos");

      form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const idCampo = sessionStorage.getItem("idCampo");
        const tipoCampo = document.querySelector("#tipo-campo").value;
        const nombre = document.querySelector("#nombre").value;
        const latitud = parseFloat(document.querySelector("#latitud").value);
        const longitud = parseFloat(document.querySelector("#longitud").value);
        const direccion = document.querySelector("#direccion").value;
        const distrito = document.querySelector("#distrito").value;
        const telefono = document.querySelector("#telefono").value;

        const params = new FormData();
        params.append("operation", "UpdateCampo");
        params.append("idCampo", idCampo);
        params.append("tipoCampo", tipoCampo);
        params.append("nombre", nombre);
        params.append("latitud", latitud);
        params.append("longitud", longitud);
        params.append("direccion", direccion);
        params.append("distrito", distrito);
        params.append("telefono", telefono);

        try {
          const response = await fetch("../../../app/controllers/CamposController.php", {
            method: "POST",
            body: params
          });

          const result = await response.json();
          console.log("Respuesta del servidor:", result); // Log para inspeccionar la respuesta

          if (result.actualizado) {
            showToast("Campo actualizado correctamente", "SUCCESS", 1500, "./lista-campos")
          } else {
            showToast("Ocurrio un error al actualizar el campo", "ERROR")
          }
        } catch (error) {
          console.error("Error en la solicitud:", error); // Verifica si ocurrió un problema en la conexión
          showToast("Ocurrio un error al actualizar el campo", "ERROR")
        }





      })
      renderDataForm();

    })
  </script>
</div>