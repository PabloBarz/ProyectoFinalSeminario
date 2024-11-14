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
    <?= Helper::renderContentHeader("Lista Usuarios", "Inicio", SERVERURL . "views/home/welcome") ?>

    <div class="content-main">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">Usuarios</div>
                <div class="col-md-6 text-right">
                  <a href="./registra-usuarios" class="btn btn-sm btn-primary">Registrar</a>
                  <a href="./registra-usuarios" class="btn btn-sm btn-danger">Reporte</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <style>
                
              </style>

              <div class="table-responsive">
                <table class="table table-hover" id="tabla-usuarios">
                  <thead>
                    <tr>
                      <th>ID Usuario</th>
                      <th>Usuario</th>
                      <th>Tipo Usuario</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Email</th>
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
              const tableBody = document.querySelector("#tabla-usuarios tbody");

              const listTableUsers = async () => {
                try {
                  const params = new FormData();
                  params.append('operation', 'spGetDataUsers');

                  const response = await fetch('../../../app/controllers/UsuarioController.php', {
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
                        <tr data-id="${element.IDUsuario}">
                            <td>${element.IDUsuario}</td>
                            <td>${element.Usuario}</td>
                            <td>${element.TipoUsuario}</td>
                            <td>${element.Nombres}</td>
                            <td>${element.Apellidos}</td>
                            <td>${element.Email}</td>
                        </tr>
                    `;
                      tableBody.insertAdjacentHTML("beforeend", render);
                    });
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

              listTableUsers();
            });
          </script>