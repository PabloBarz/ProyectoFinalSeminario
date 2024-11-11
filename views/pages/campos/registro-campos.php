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
            <form action="" autocomplete="off">
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
                      <label for="tipo-usuario">Selecciona un Tipo de campo:</label>
                      <select class="form-control" id="tipo-usuario" required>
                        <option value="">Selecciona un campo</option>
                        <option value="Futbol">Futbol</option>
                        <option value="Baloncesto">Baloncesto</option>
                        <option value="Bolleyball">Bolleyball</option>
                      </select>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="nombre-campo">nombre:</label>
                      <input type="text" class="form-control" id="nombre-campo" required>
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="latitud">Latitud:</label>
                      <input type="number" class="form-control" id="capacidad" required>
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="latitud">Longitud:</label>
                      <input type="number" class="form-control" id="capacidad" required>
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="nombre-campo">Direccion:</label>
                      <input type="text" class="form-control" id="nombre-campo" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="tipo-usuario">Distrito:</label>
                      <select class="form-control" id="tipo-usuario" required>
                        <option value="">Selecciona un distrito</option>
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
                      <label for="telefono">Telefono:</label>
                      <input type="text" class="form-control" id="telefono" pattern="[0-9]" minlength="9" maxlength="9"  required>
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
      </body>

      </html>