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
    <?= Helper::renderContentHeader("Registro Campos", "Inicio", SERVERURL . "views/") ?>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <form id="formRegistroZonaCampos" autocomplete="off">
              <div class="card card-outline card-primary">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">Complete los datos</div>
                    <div class="col-md-6 text-right">
                      <a href="./lista-zonascampos" class="btn btn-sm btn-primary">Mostrar Lista</a>
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
                  <button class="btn btn-sm btn-primary" type="submit">Registrar</button>
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
        document.addEventListener("DOMContentLoaded", () => {
          const form = document.getElementById("formRegistroZonaCampos");

          form.addEventListener("submit", async (event) => {
            event.preventDefault();

            const campo = document.getElementById("campo").value;
            const NombreZonaCampo = document.getElementById("nombre-zonaCampo").value;
            const capacidad = document.getElementById("capacidad").value;
            const superficie = document.getElementById("superficie").value;
            const dimensiones = document.getElementById("dimensiones").value;
            const preciohora = document.getElementById("preciohora").value;
            const descripcion = document.getElementById("descripcion").value;
            const estado = document.getElementById("estado").value;

            const datos = new FormData();
            datos.append("operation", "AddZonaCampos");
            datos.append("campo", campo);
            datos.append("nombre-zonaCampo", NombreZonaCampo);
            datos.append("capacidad", capacidad);
            datos.append("superficie", superficie);
            datos.append("dimensiones", dimensiones);
            datos.append("preciohora", preciohora);
            datos.append("descripcion", descripcion);
            datos.append("estado", estado);

            try {
              const response = await fetch("../../../app/controllers/ZonasCamposController.php", {
                method: "POST",
                body: datos
              });
              if (!response.ok) {
                throw new Error("Error en la respuesta del servidor");
              }
              const result = await response.json();

              if (result.guardado) {
                showToast("Zona de campo registrado correctamente", "SUCCESS", 1500, "./lista-zonascampos")
                form.reset();
              } else {
                showToast("Ocurrio un error al registrar la zona del campo", "ERROR")
              }
            } catch (error) {
              console.error("Error:", error);
              showToast("Ocurrio un error al registrar la zona del campo", "ERROR")
            }
          });

          const selectCampos = document.querySelector("#campo");
          let dataCampos = [];

          const listSelectCampos = async () => {
            const params = new FormData();
            params.append("operation", "GetListSelectCampos");
            try {
              const response = await fetch('../../../app/controllers/ZonasCamposController.php', {
                method: "POST",
                body: params
              });
              
              
              if (!response.ok) {
                throw new Error('Error en la solicitud Campos');
              }

              const data = await response.json();
              dataCampos = data;

              selectCampos.innerHTML = '<option value="">Seleccione un campo</option>';
              data.forEach(element => {
                const tagOption = document.createElement("option");
                tagOption.value = element.idcampo;
                tagOption.textContent = element.nombre;
                selectCampos.appendChild(tagOption);
              });

            } catch (error) {
              console.error("ERROR al traer lista campos ", error.message);
            }
          };

          // Llamar a la función después de definirla
          listSelectCampos();
        });
      </script>
      </body>

      </html>