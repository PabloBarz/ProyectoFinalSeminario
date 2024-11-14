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
                      <select class="form-control" id="tipo-campo" required></select>
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
                      <select class="form-control" id="distrito" required></select>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="telefono">Teléfono:</label>
                      <input type="tel" class="form-control" id="telefono" pattern="9[0-9]{8}" maxlength="9" minlength="9" required>
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
    document.addEventListener("DOMContentLoaded", async () => {
      const idCampo = sessionStorage.getItem("idCampo");

      if (!idCampo) {
        alert("ID de campo no encontrado.");
        window.location.href = "./lista-campos";
        return;
      }

      // Función para cargar los datos del campo específico
      const cargarDatosCampo = async (idCampo) => {
        try {
          const response = await fetch(`../../../app/controllers/CamposController.php?operation=GetCampoById&idCampo=${idCampo}`);
          if (!response.ok) {
            throw new Error("Error al cargar los datos del campo.");
          }
          const campo = await response.json();
          if (campo) {
            document.getElementById("tipo-campo").value = campo.tipoCampo;
            document.getElementById("nombre").value = campo.nombre;
            document.getElementById("latitud").value = campo.latitud;
            document.getElementById("longitud").value = campo.longitud;
            document.getElementById("direccion").value = campo.direccion;
            document.getElementById("distrito").value = campo.distrito;
            document.getElementById("telefono").value = campo.telefono;
          } else {
            throw new Error("No se encontró el campo.");
          }
        } catch (error) {
          console.error("Error:", error.message);
          alert("Ocurrió un error al cargar los datos del campo.");
        }
      };

      // Cargar los datos al iniciar la vista
      await cargarDatosCampo(idCampo);

      // Manejo del formulario de actualización
      const form = document.getElementById("formActualizarCampos");
      form.addEventListener("submit", async (event) => {
        event.preventDefault();
        const formData = new FormData(form);
        formData.append("operation", "UpdateCampo");
        formData.append("idCampo", idCampo);

        try {
          const response = await fetch(`../../../app/controllers/CamposController.php?operation=GetCampoById&idCampo=${idCampo}`);
          if (!response.ok) {
            const errorData = await response.json();
            console.error("Error response:", errorData);
            throw new Error(`Error al cargar los datos del campo: ${errorData.error}`);
          }
          const campo = await response.json();
          if (result.actualizado) {
            alert("Campo actualizado correctamente.");
            window.location.href = "./lista-campos";
          } else {
            alert("Error al actualizar el campo.");
          }
        } catch (error) {
          console.error("Error:", error.message);
          alert("Ocurrió un error al actualizar el campo.");
        }
      });
    });
  </script>
</div>