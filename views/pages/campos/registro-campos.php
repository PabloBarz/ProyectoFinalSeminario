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
            <!-- Formulario actualizado con IDs únicos para cada input -->
            <form id="formRegistroCampos" autocomplete="off">
              <div class="card card-outline card-primary">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">Complete los datos</div>
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
                      <input type="tel" class="form-control p_input" id="telefono" name="telefono" pattern="9[0-9]{8}" maxlength="9" minlength="9" required>
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
          const form = document.getElementById("formRegistroCampos");

          form.addEventListener("submit", async (event) => {
            event.preventDefault();

            // Capturar los valores de cada campo
            const tipoCampo = document.getElementById("tipo-campo").value;
            const nombre = document.getElementById("nombre").value;
            const latitud = document.getElementById("latitud").value;
            const longitud = document.getElementById("longitud").value;
            const direccion = document.getElementById("direccion").value;
            const distrito = document.getElementById("distrito").value;
            const telefono = document.getElementById("telefono").value;

            // Crear el FormData para enviar
            const datos = new FormData();
            datos.append("operation", "AddCampos");
            datos.append("tipoCampo", tipoCampo);
            datos.append("nombre", nombre);
            datos.append("latitud", latitud);
            datos.append("longitud", longitud);
            datos.append("direccion", direccion);
            datos.append("distrito", distrito);
            datos.append("telefono", telefono);

            try {
              // Enviar los datos al controlador usando fetch
              const response = await fetch("../../../app/controllers/CamposController.php", {
                method: "POST",
                body: datos
              });

              // Verificar si la respuesta es exitosa
              if (!response.ok) {
                throw new Error("Error en la respuesta del servidor");
              }

              // Obtener la respuesta del servidor
              const result = await response.json();

              // Verificar la respuesta y mostrar un mensaje al usuario
              if (result.guardado) {
                alert("Campo registrado correctamente.");
                form.reset(); // Limpiar el formulario
              } else {
                alert("Error al registrar el campo.");
              }
            } catch (error) {
              console.error("Error:", error);
              alert("Ocurrió un error en la solicitud.");
            }
          });
        });
      </script>


      </body>

      </html>