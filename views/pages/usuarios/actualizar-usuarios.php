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
    <?= Helper::renderContentHeader("Actualización de Campos", "Inicio", SERVERURL . "views/") ?>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <form id="formRegisterUserPerson" autocomplete="off">
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
                      <label for="dni">DNI:</label>
                      <input class="form-control" id="dni" name="dni" maxlength="8" minlength="8" required autofocus readonly />
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="tipoUsuario">Tipo de Usuario:</label>
                      <select class="form-control" id="tipoUsuario" name="tipoUsuario" required>
                      </select>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="nomUser">Usuario:</label>
                      <input type="text" class="form-control" id="nomUser" name="nomUser" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="email">Email:</label>
                      <input type="text" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="telefono">Telefono</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">+51</span>
                        </div>
                        <input type="tel" class="form-control p_input" id="telefono" name="telefono" pattern="9[0-9]{8}" maxlength="9" minlength="9" required>
                      </div>
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
    </div>
  </div>

  <!-- partial:partials/_footer.html - FOOTER-->
  <?php
  require_once '../../partials/_footer.php';
  ?>
  <script>
    document.addEventListener("DOMContentLoaded", (event) => {

      const listSelectTipoUser = async () => {

        const selectTipoUsuario = document.querySelector("#tipoUsuario");
        const params = new FormData();
        params.append("operation", "getListSelectTipoUsuario")

        try {
          const response = await fetch('../../../app/controllers/UsuarioController.php', {
            method: 'POST',
            body: params
          })

          const data = await response.json();

          if (!response.ok) {
            throw new Error('Error en la solicitud Tipos Usuarios')
          }

          selectTipoUsuario.innerHTML = '<option value="">Seleccione un tipo de usuario</option>';
          data.forEach(element => {
            const tagOption = document.createElement("option");
            tagOption.value = element.idTipoUsuario;
            tagOption.textContent = element.nombreRol;
            selectTipoUsuario.appendChild(tagOption);
          });

        } catch (error) {
          console.log(error)
        }
      }

      const renderDataForm = async () => {
        const idUser = sessionStorage.getItem("idUsuario");
        const params = new FormData();
        params.append("operation", "spGetUserById")
        params.append("idUser", idUser);

        try {
          const response = await fetch("../../../app/controllers/UsuarioController.php", {
            method: 'POST',
            body: params
          })

          data = await response.json();

          document.querySelector("#dni").value = data[0].Dni
          document.querySelector("#nomUser").value = data[0].Usuario
          document.querySelector("#email").value = data[0].Email
          document.querySelector("#telefono").value = data[0].Telefono
          document.querySelector("#tipoUsuario").value = data[0].idTipoUsuario

        } catch (error) {
          console.log("Error peticion spGetUserById", error)
        }
      }
      listSelectTipoUser();
      renderDataForm();
    })
  </script>

  </body>

  </html>