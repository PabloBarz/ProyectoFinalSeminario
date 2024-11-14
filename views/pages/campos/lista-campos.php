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
    <?= Helper::renderContentHeader("Lista Campos", "Inicio", SERVERURL . "views/home/welcome") ?>

    <div class="content-main">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">Campos</div>
                <div class="col-md-6 text-right">
                  <a href="./registro-campos" class="btn btn-sm btn-primary">Registrar</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <style>
                #tabla-reservaciones thead th {
                  color: white;
                }
              </style>

              <div class="table-responsive">
                <table class="table table-hover" id="tabla-campos">
                  <thead>
                    <tr>
                      <th>Tipo de Campo</th>
                      <th>Nombre</th>
                      <th>Latitud</th>
                      <th>Longitud</th>
                      <th>Direccion</th>
                      <th>Distrito</th>
                      <th>Telefono</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Datos pintados por JS -->
                    </tr>
                  </tbody>
                </table>
              </div> <!-- Fin de tabla -->
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html - FOOTER-->
          <?php
          require_once '../../partials/_footer.php';
          ?>
          </body>

          </html>

          <script>
            document.addEventListener("DOMContentLoaded", (event) => {
              console.log("DOM completamente cargado y analizado");

              const tableBody = document.querySelector("#tabla-campos tbody");

              const listTableCampos = async () => {
                try {
                  const params = new FormData();
                  params.append('operation', 'GetDataCampos');
                  const response = await fetch('../../../app/controllers/CamposController.php', {
                    method: 'POST',
                    body: params
                  });

                  if (!response.ok) {
                    throw new Error('Error en la solicitud');
                  }

                  const data = await response.json();

                  if (data.length > 0) {
                    tableBody.innerHTML = "";

                    data.forEach(element => {
                      const render = `
                      <tr data-id="${element.idCampo}">
                        <td>${element.tipoCampo}</td>
                        <td>${element.nombre}</td>
                        <td>${element.latitud}</td>
                        <td>${element.longitud}</td>
                        <td>${element.direccion}</td>
                        <td>${element.distrito}</td>
                        <td>${element.telefono ?? "No registrado"}</td>
                        <td>
                        <button class="btn btn-sm btn-warning">Actualizar</button>
                        </td>
                      </tr>
                      `;
                      tableBody.insertAdjacentHTML("beforeend", render);
                    });
                    document.querySelectorAll(".btn-warning").forEach(button => {
                      button.addEventListener("click", (event) => {
                        event.preventDefault();
                        console.log("boton presionado")
                        const idCampo = event.target.closest("tr").dataset.id;
                        sessionStorage.setItem("idCampo", idCampo);
                        window.location.href = "./actualizar-campos";
                      });
                    });
                  } else {
                    const noRows = `
            <tr>
              <td colspan="8" class="text-center text-muted">Registros vacíos</td>
            </tr>
          `;
                    tableBody.insertAdjacentHTML("beforeend", noRows);
                  }
                } catch (error) {
                  console.error("Hubo un error en la solicitud o en el procesamiento:", error.message);
                }
              };



              listTableCampos();
            });

            // Define la función cargarDatosParaActualizar para manejar la actualización
            function cargarDatosParaActualizar(idCampo) {
              // Aquí puedes hacer una solicitud al servidor para obtener los datos de un campo específico
              console.log("Actualizar campo con ID:", idCampo);

              // Puedes agregar lógica para abrir un formulario de actualización y precargar los datos aquí.
            }
          </script>