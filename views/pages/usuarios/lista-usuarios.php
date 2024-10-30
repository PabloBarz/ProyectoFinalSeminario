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
    <?= Helper::renderContentHeader("Lista Usuarios", "Inicio", SERVERURL . "views/")?>

    <div class="content-main">
    <div class="row">

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">Horarios</div>
        <div class="col-md-6 text-right">
          <a href="./registra-usuarios" class="btn btn-sm btn-primary">Registrar</a>
          <a href="./registra-usuarios" class="btn btn-sm btn-danger">Reporte</a>
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
              <th>ID Usuario</th>
              <th>Tipo Usuario</th>
              <th>Usuario</th>
              <th>Contraseña</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Administrador</td>
              <td>Pablo</td>
              <td>plabo123</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Supervisor</td>
              <td>vaistaya</td>
              <td>vaista123</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Invitado</td>
              <td>Carlos</td>
              <td>carlos123</td>
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