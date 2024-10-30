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
    <?= Helper::renderContentHeader("Registro Usuarios", "Inicio", SERVERURL . "views/") ?>

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
                      <a href="./lista-usuarios" class="btn btn-sm btn-primary">Mostrar Lista</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-6 form-group">
                      <label for="tipo-usuario">Persona:</label>
                      <select class="form-control" id="tipo-usuario" required>
                        <option value="">Selecciona una persona</option>
                        <option value="Administrador">Barzola</option>
                        <option value="Supervisor">Karina</option>
                        <option value="Invitado">Carlos</option>
                      </select>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="tipo-usuario">Tipo de Usuario:</label>
                      <select class="form-control" id="tipo-usuario" required>
                        <option value="">Selecciona un tipo de usuario</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Invitado">Invitado</option>
                      </select>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="usuario">Usuario:</label>
                      <input type="text" class="form-control" id="usuario" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="password">Contraseña:</label>
                      <input type="text" class="form-control" id="password" required>
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