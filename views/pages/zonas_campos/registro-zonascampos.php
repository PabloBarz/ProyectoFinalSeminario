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
                  <div class="col-md-4 form-group">
                      <label for="tipo-usuario">Campo:</label>
                      <select class="form-control" id="tipo-usuario" required>
                        <option value="">Selecciona un campo</option>
                        <option value="Administrador">Senati</option>
                        <option value="Supervisor">Balconcito</option>
                        <option value="Invitado">Cruz blanca</option>
                      </select>
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="nombre-campo">nombre:</label>
                      <input type="text" class="form-control" id="nombre-campo" required>
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="capacidad">Capacidad:</label>
                      <input type="number" class="form-control" id="capacidad" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="superficie">Tipo de superficie:</label>
                      <select class="form-control" id="superficie" required>
                        <option value="">Selecciona un tipo de superficie</option>
                        <option value="Grass-natural">Grass natural</option>
                        <option value="Grass-sintetico">Grass sintetico</option>
                        <option value="Loza">Loza</option>
                      </select>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="preciohora">Precio x hora:</label>
                      <input type="number" class="form-control" id="preciohora" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="descripcion">Descripcion:</label>
                      <input type="text" class="form-control" id="descripcion" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="tipo-usuario">Estado:</label>
                      <select class="form-control" id="tipo-usuario" required>
                        <option value="">Selecciona un estado</option>
                        <option value="Administrador">Disponible</option>
                        <option value="Supervisor">En mantenimiento</option>
                        <option value="Invitado">No disponible</option>
                      </select>
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