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
    <?= Helper::renderContentHeader("Lista Zona Campos", "Inicio", SERVERURL . "views/") ?>

    <div class="content-main">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">Zonas Campos</div>
                <div class="col-md-6 text-right">
                  <a href="./registro-zonascampos" class="btn btn-sm btn-primary">Registrar</a>
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
                      <th>Campo</th>
                      <th>Nombre</th>
                      <th>Capacidad</th>
                      <th>Superficie</th>
                      <th>Dimensiones</th>
                      <th>Precio x Hora</th>
                      <th>Descripcion</th>
                      <th>Estado</th>
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
                  params.append('operation', 'GetDataZonasCampos');
                  const response = await fetch('../../../app/controllers/ZonasCamposController.php', {
                    method: 'POST',
                    body: params
                  });

                  // Verificar que la respuesta sea válida y convertirla a JSON
                  if (!response.ok) {
                    throw new Error('Error en la solicitud');
                  }

                  const data = await response.json();

                  // Verifica si el array tiene datos
                  if (data.length > 0) {
                    tableBody.innerHTML = "";

                    data.forEach(element => {
                      const render = `
                        <tr data-id="${element.idZonaCampo}">
                            <td>${element.NombreCampo}</td>
                            <td>${element.NombreZonaCampo}</td>
                            <td>${element.CapacidadZonaCampo}</td>
                            <td>${element.SuperficieZonaCampo}</td>
                            <td>${element.DimensionesZonaCampo}</td>
                            <td>${element.PrecioPorHora}</td>
                            <td>${element.DescripcionZonaCampo}</td>
                            <td>${element.EstadoZonaCampo}</td>
                            <td>
                            <button class="btn btn-sm btn-warning">Actualizar</button>
                            </td>
                        </tr>
                    `;
                      tableBody.insertAdjacentHTML("beforeend", render);
                    });
                    document.querySelectorAll(".btn-warning").forEach(button =>{
                      button.addEventListener("click", (event) =>{
                        event.preventDefault();
                        const idZonaCampo = event.target.closest("tr").dataset.id;
                        console.log("ID de campo extraido:",idZonaCampo); //verificar si trae correctamente el id de Zona_Campo

                        if(idZonaCampo){
                          sessionStorage.setItem("idZonaCampo",idZonaCampo);
                          window.location.href = "./actualizar-zonascampo.php";

                        } else {
                          console.error ("IdZonaCampo no se obtuvo correctamente")
                        }
                      })
                    })
                  } else {
                    const noRows = `
                    <tr>
                        <td colspan="4" class="text-center text-muted">Registros vacíos</td>
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

            function cargarDatosParaActualizar(idZonaCampo) {
              console.log("Actualizar zona_campo con ID:",idZonaCampo);
            }
          </script>