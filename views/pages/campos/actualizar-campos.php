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
    <?= Helper::renderContentHeader("Actualización de Campos", "Inicio", SERVERURL . "views/") ?>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Formulario de actualización -->
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
                    <!-- Tipo de campo -->
                    <div class="col-md-6 form-group">
                      <label for="tipo-campo">Selecciona un Tipo de campo:</label>
                      <select class="form-control" id="tipo-campo" required>
                        <option value="">Selecciona un campo</option>
                        <option value="Futbol" <?= ($registro[0]['tipo_campo'] == 'Futbol') ? 'selected' : ''; ?>>Futbol</option>
                        <option value="Baloncesto" <?= ($registro[0]['tipo_campo'] == 'Baloncesto') ? 'selected' : ''; ?>>Baloncesto</option>
                        <option value="Bolleyball" <?= ($registro[0]['tipo_campo'] == 'Bolleyball') ? 'selected' : ''; ?>>Bolleyball</option>
                      </select>
                    </div>
                    <!-- Nombre -->
                    <div class="col-md-6 form-group">
                      <label for="nombre">Nombre:</label>
                      <input type="text" class="form-control" id="nombre" value="<?= $registro[0]['nombre'] ?>" required>
                    </div>
                    <!-- Latitud -->
                    <div class="col-md-4 form-group">
                      <label for="latitud">Latitud:</label>
                      <input type="number" class="form-control" id="latitud" value="<?= $registro[0]['latitud'] ?>" required step="any">
                    </div>
                    <!-- Longitud -->
                    <div class="col-md-4 form-group">
                      <label for="longitud">Longitud:</label>
                      <input type="number" class="form-control" id="longitud" value="<?= $registro[0]['longitud'] ?>" required step="any">
                    </div>
                    <!-- Dirección -->
                    <div class="col-md-4 form-group">
                      <label for="direccion">Dirección:</label>
                      <input type="text" class="form-control" id="direccion" value="<?= $registro[0]['direccion'] ?>" required>
                    </div>
                    <!-- Distrito -->
                    <div class="col-md-6 form-group">
                      <label for="distrito">Distrito:</label>
                      <select class="form-control" id="distrito" required>
                        <option value="Alto Laran" <?= ($registro[0]['distrito'] == 'Alto Laran') ? 'selected' : ''; ?>>Alto Laran</option>
                        <option value="Chavin" <?= ($registro[0]['distrito'] == 'Chavin') ? 'selected' : ''; ?>>Chavin</option>
                        <option value="Chincha Alta" <?= ($registro[0]['distrito'] == 'Chincha Alta') ? 'selected' : ''; ?>>Chincha Alta</option>
                        <option value="Chincha Baja" <?= ($registro[0]['distrito'] == 'Chincha Baja') ? 'selected' : ''; ?>>Chincha Baja</option>
                        <option value="Grocio Prado" <?= ($registro[0]['distrito'] == 'Grocio Prado') ? 'selected' : ''; ?>>Grocio Prado</option>
                        <option value="Pueblo Nuevo" <?= ($registro[0]['distrito'] == 'Pueblo Nuevo') ? 'selected' : ''; ?>>Pueblo Nuevo</option>
                        <option value="Tambo de Mora" <?= ($registro[0]['distrito'] == 'Tambo de Mora') ? 'selected' : ''; ?>>Tambo de Mora</option>
                        <option value="San Juan de Yanac" <?= ($registro[0]['distrito'] == 'San Juan de Yanac') ? 'selected' : ''; ?>>San Juan de Yanac</option>
                        <option value="San Pedro de Huacarpana" <?= ($registro[0]['distrito'] == 'San Pedro de Huacarpana') ? 'selected' : ''; ?>>San Pedro de Huacarpana</option>
                        <option value="Sunampe" <?= ($registro[0]['distrito'] == 'Sunampe') ? 'selected' : ''; ?>>Sunampe</option>
                        <option value="El Carmen" <?= ($registro[0]['distrito'] == 'El Carmen') ? 'selected' : ''; ?>>El Carmen</option>
                      </select>
                    </div>
                    <!-- Teléfono -->
                    <div class="col-md-6 form-group">
                      <label for="telefono">Teléfono:</label>
                      <input type="tel" class="form-control" id="telefono" value="<?= $registro[0]['telefono'] ?>" pattern="9[0-9]{8}" maxlength="9" minlength="9" required>
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
    </div>
  </div>

  <!-- partial:partials/_footer.html - FOOTER-->
  <?php
  require_once '../../partials/_footer.php';
  ?>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const form = document.getElementById("formActualizarCampos");

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
        datos.append("operation", "UpdateCampos");
        datos.append("idcampo", "<?= $registro[0]['idcampo'] ?>"); // ID del campo a actualizar
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
          if (result.actualizado) {
            alert("Campo actualizado correctamente.");
          } else {
            alert("Error al actualizar el campo.");
          }
        } catch (error) {
          console.error("Error:", error);
          alert("Ocurrió un error en la solicitud.");
        }
      });
    });
    document.addEventListener("DOMContentLoaded", async () => {
    const idCampo = sessionStorage.getItem("idCampo");

    if (idCampo) {
      try {
        const response = await fetch('../../../app/controllers/CamposController.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ operation: 'GetCampoById', idCampo })
        });

        if (!response.ok) throw new Error('Error en la solicitud');

        const registro = await response.json();

        if (registro) {
          // Pre-cargar los datos en los campos del formulario.
          document.getElementById("nombre").value = registro.nombre;
          document.getElementById("tipo-campo").value = registro.tipoCampo;
          // Rellena los demás campos según el registro obtenido.
        }
      } catch (error) {
        console.error("Error al obtener los datos del campo:", error);
      }
    } else {
      console.error("ID de campo no encontrado en sessionStorage");
    }
  });
    
  </script>

</body>
</html>
