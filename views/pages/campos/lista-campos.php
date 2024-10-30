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
    <?= Helper::renderContentHeader("Lista Campos", "Inicio", SERVERURL . "views/")?>

    <div class="content-main">
    <div class="row">

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">Campos</div>
        <div class="col-md-6 text-right">
          <a href="./registro-campos" class="btn btn-sm btn-primary">Registrar</a>
          <a href="./registro-campos" class="btn btn-sm btn-danger">Reporte</a>
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
        <table class="table table-hover" id="tabla-usuarios">
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
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Campo Senati</td>
              <td>El golazo</td>
              <td>Pablo</td>
              <td>22</td>
              <td>Cancha de loza</td>
              <td>50 x 70 m</td>
              <td>45</td>
              <td>Disponible</td>
            </tr>
            <tr>
            <td>Campo Senati</td>
              <td>El golazo</td>
              <td>Pablo</td>
              <td>22</td>
              <td>Cancha de loza</td>
              <td>50 x 70 m</td>
              <td>45</td>
              <td>Disponible</td>
            </tr>
            <tr>
            <td>Campo Senati</td>
              <td>El golazo</td>
              <td>Pablo</td>
              <td>22</td>
              <td>Cancha de loza</td>
              <td>50 x 70 m</td>
              <td>45</td>
              <td>Disponible</td>
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