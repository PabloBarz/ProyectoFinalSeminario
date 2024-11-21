<?php
require_once '../../../app/helpers/Helper.php';
require_once '../../../app/config/app.php';
require_once '../../partials/header.php';
?>

<!-- partial - WRAPPER MAIN + FOOTER -->
<div class="main-panel">
  <!-- MAIN -->
  <div class="content-wrapper">
    <!-- Contenido main -->
    <?= Helper::renderContentHeader("Registro Zona Campos", "Inicio", SERVERURL . "views/") ?>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <form id="formActualizarZonaCampo" autocomplete="off">
              <div class="card card-outline card-primary">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">Actualize los datos</div>
                    <div class="col-md-6 text-right">
                      <a href="./lista-campos" class="btn btn-sm btn-primary">Mostrar Lista</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label for="campo">Campo:</label>
                      <select class="form-control" id="campo" name="campo" required>

                      </select>
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="nombre-zonaCampo">nombre:</label>
                      <input type="text" class="form-control" id="nombre-zonaCampo" required>
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="capacidad">Capacidad:</label>
                      <input type="number" class="form-control" id="capacidad" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="superficie">Tipo de superficie:</label>
                      <select class="form-control" id="superficie" required>
                        <option value="">Selecciona un tipo de superficie</option>
                        <option value="Grass-natural">Grass natural</option>
                        <option value="Grass-sintetico">Grass sintetico</option>
                        <option value="Loza">Loza</option>
                      </select>
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="dimensiones">Dimensiones:</label>
                      <input type="text" class="form-control" id="dimensiones" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="preciohora">Precio x hora:</label>
                      <input type="number" class="form-control" id="preciohora" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="descripcion">Descripcion:</label>
                      <input type="text" class="form-control" id="descripcion" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="estado">Estado:</label>
                      <select class="form-control" id="estado" required>
                        <option value="">Selecciona un estado</option>
                        <option value="Administrador">Disponible</option>
                        <option value="Supervisor">En mantenimiento</option>
                        <option value="Invitado">No disponible</option>
                      </select>
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

        </div><!-- /.container-fluid -->
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html - FOOTER-->
      <?php
      require_once '../../partials/_footer.php';
      ?>
      <script>
        document.addEventListener("DOMContentLoaded", (event) => {
          const idZonaCampo = sessionStorage.getItem("idZonaCampo");
          const selectCampos = document.querySelector("#campo"); // Aseguramos referencia correcta
          let dataCampos = [];

          const renderDataForm = async () => {
            try {
              const params = new FormData();
              params.append("operation", "getZonaCampoById");
              params.append("idZonaCampo", idZonaCampo);

              const response = await fetch("../../../app/controllers/ZonasCamposController.php", {
                method: "POST",
                body: params,
              });

              const data = await response.json();
              if (data.length > 0) {
                document.querySelector("#campo").value = data[0].Campo;
                document.querySelector("#nombre-zonaCampo").value = data[0].nombre_zonaCampo; // Propiedad corregida
                document.querySelector("#capacidad").value = data[0].capacidad;
                document.querySelector("#superficie").value = data[0].superficie;
                document.querySelector("#dimensiones").value = data[0].dimensiones;
                document.querySelector("#preciohora").value = data[0].preciohora;
                document.querySelector("#descripcion").value = data[0].descripcion;
                document.querySelector("#estado").value = data[0].estado;
              } else {
                alert("No se encontró información de la zona del campo.");
              }
            } catch (error) {
              console.log("Error en petición getZonaCampoById", error);
            }
          };

          const listSelectCampos = async () => {
            const params = new FormData();
            params.append("operation", "GetListSelectCampos");
            try {
              const response = await fetch("../../../app/controllers/CamposController.php", {
                method: "POST",
                body: params,
              });
              if (!response.ok) {
                throw new Error("Error en la solicitud Campos");
              }

              const data = await response.json();
              dataCampos = data;

              selectCampos.innerHTML = '<option value="">Seleccione un campo</option>';
              data.forEach((element) => {
                const tagOption = document.createElement("option");
                tagOption.value = element.idcampo;
                tagOption.textContent = element.nombre;
                selectCampos.appendChild(tagOption);
              });
            } catch (error) {
              console.error("ERROR al traer lista campos ", error.message);
            }
          };

          const form = document.querySelector("#formActualizarZonaCampo");
          form.addEventListener("submit", async (event) => {
            event.preventDefault();

            const idZonaCampo = sessionStorage.getItem("idZonaCampo");
            const campo = document.querySelector("#campo").value;
            const nombre_zonaCampo = document.querySelector("#nombre-zonaCampo").value;
            const capacidad = document.querySelector("#capacidad").value;
            const superficie = document.querySelector("#superficie").value;
            const dimensiones = document.querySelector("#dimensiones").value;
            const preciohora = document.querySelector("#preciohora").value;
            const descripcion = document.querySelector("#descripcion").value;
            const estado = document.querySelector("#estado").value;

            const params = new FormData();
            params.append("operation", "UpdateZonaCampo");
            params.append("idZonaCampo", idZonaCampo);
            params.append("campo", campo);
            params.append("nombre-zonaCampo", nombre_zonaCampo);
            params.append("capacidad", capacidad);
            params.append("superficie", superficie);
            params.append("dimensiones", dimensiones);
            params.append("preciohora", preciohora);
            params.append("descripcion", descripcion);
            params.append("estado", estado);

            try {
              const response = await fetch("../../../app/controllers/ZonasCamposController.php", {
                method: "POST",
                body: params,
              });

              const result = await response.json();
              console.log("Respuesta del servidor:", result);

              if (result.actualizado) {
                alert("Zona del campo actualizada correctamente");
                window.location.href = "./lista-zonascampos.php";
              } else {
                alert("Error al actualizar la zona del campo: " + (result.message || "Respuesta inesperada"));
              }
            } catch (error) {
              console.error("Error en la solicitud:", error);
              alert("Ocurrió un error al intentar actualizar la zona del campo.");
            }
          });

          listSelectCampos();
          renderDataForm();
        });
      </script>
      </body>

      </html>