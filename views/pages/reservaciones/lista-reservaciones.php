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
    <?= Helper::renderContentHeader("Lista Reservaciones", "Inicio", SERVERURL . "views/") ?>

    <!-- Tabla de litado de reservaciones-->
    <div class="row">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Reservaciones</h5>
            <div>
              <button class="btn btn-primary">Registrar</button>
              <!-- Agregar mas botones PDF-->
              <button class="btn btn-secondary">Otro Botón</button>
              <button class="btn btn-success">Botón Adicional</button>
            </div>
          </div>
          <div class="card-body">

          <style>
            #tabla-reservaciones thead th {
              color: white; 
            }
          </style>

            <div class="table-responsive">
              <table class="table table-hover" id="tabla-reservaciones">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Fecha Reserv.</th>
                    <th>H. Incio</th>
                    <th>H. Fin</th>
                    <th>H. Reservadas</th>
                    <th>Precio por H.</th>
                    <th>Estado de Pago</th>
                    <th>Zona Campo</th>
                    <th>Campo</th>
                    <th>Direccion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Barzola Claudio Roberto Pablo</td>
                    <td>2024-10-30</td>
                    <td>10:00:00</td>
                    <td>12:00:00</td>
                    <td>2</td>
                    <td>50</td>
                    <td>Pagado</td>
                    <td>Zona A</td>
                    <td>Campo Central</td>
                    <td>Av .Principal 123</td>
                  </tr>
                  <tr>
                    <td>Barzola Claudio Roberto Pablo</td>
                    <td>2024-10-30</td>
                    <td>10:00:00</td>
                    <td>12:00:00</td>
                    <td>2</td>
                    <td>50</td>
                    <td>Pagado</td>
                    <td>Zona A</td>
                    <td>Campo Central</td>
                    <td>Av .Principal 123</td>
                  </tr>
                  <tr>
                    <td>Barzola Claudio Roberto Pablo</td>
                    <td>2024-10-30</td>
                    <td>10:00:00</td>
                    <td>12:00:00</td>
                    <td>2</td>
                    <td>50</td>
                    <td>Pagado</td>
                    <td>Zona A</td>
                    <td>Campo Central</td>
                    <td>Av .Principal 123</td>
                  </tr>
                </tbody>
              </table>
            </div> <!-- Fin de tabla -->

          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html - FOOTER-->
  <?php
  require_once '../../partials/_footer.php';
  ?>
  </body>

  </html>