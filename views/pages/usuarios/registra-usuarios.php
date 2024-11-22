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
    <?= Helper::renderContentHeader("Registro Usuarios", "Lista Usuarios", "./lista-usuarios") ?>

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
                    <div class="col-md-2 form-group">
                      <label for="dni">DNI:</label>
                      <input class="form-control" id="dni" name="dni" maxlength="8" minlength="8" required autofocus />
                    </div>
                    <div class="col-md-4 form-group" id="resultDni">

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
                      <label for="passUser">Contraseña:</label>
                      <input type="password" class="form-control" id="passUser" name="passUser" required>
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
                        <input type="tel" class="form-control p_input" id="telefono" name="telefono" pattern="9[0-9]{8}" maxlength="9" minlength="9">
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
      <!-- partial:partials/_footer.html - FOOTER-->
      <?php
      require_once '../../partials/_footer.php';
      ?>

      <script>
        // 1 Listar Tipos de usuarios
        // 1 validar dni 
        // 2 registrar persona 
        // 3 registar el usuario 
        document.addEventListener("DOMContentLoaded", (event) => {
          const form = document.querySelector("#formRegisterUserPerson");
          const selectTipoUsuario = document.querySelector("#tipoUsuario");

          const listSelectTipoUser = async () => {
            const params = new FormData()
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

          const verifyDNI = async (dni) => {
            try {
              const response = await fetch(`https://apiperu.dev/api/dni/${dni}?api_token=acd1e28dbc9751de891472cbc35f1ec73d23e92069e9051832ffafc70a170a36`);

              const data = await response.json();

              return data;
            } catch (error) {
              console.error("Error en la solicitud DNI:", error);
            }
          };

          const showPersonByDni = async (infoPerson) => {
            const inputPerson = document.querySelector("#resultDni");

            inputPerson.innerHTML = "";
            render =
              `
            <label for="dataPerson">Datos de la persona</label>
            <input type="text" class="form-control p_input" id="dataPerson" value="${infoPerson.data.apellido_paterno} ${infoPerson.data.apellido_materno} ${infoPerson.data.nombres}" name="nomUser" readonly>
          `

            inputPerson.insertAdjacentHTML("beforeend", render)
          }

          const registerPerson = async (dataPerson = {}) => {
            const params = new FormData();
            params.append("operation", "registerPerson")
            params.append("apellidos", dataPerson.apellidos),
              params.append("nombres", dataPerson.nombres),
              params.append("dni", dataPerson.dni),
              params.append("telefono", dataPerson.telefono)

            try {
              const response = await fetch(`../../../app/controllers/PersonaController.php`, {
                method: "POST",
                body: params
              });

              const data = await response.json();
              return data;
            } catch (error) {
              console.error("Error en la solicitud persona:", error);
            }
          }

          const registerUser = async (dataUser = {}) => {
            const params = new FormData();
            params.append("operation", "registerUser")
            params.append("idPersona", dataUser.idPersona)
            params.append("idTipoUsuario", dataUser.idTipoUsuario)
            params.append("email", dataUser.email)
            params.append("nomUser", dataUser.nomUser)
            params.append("passUser", dataUser.passUser)

            try {
              const response = await fetch(`../../../app/controllers/UsuarioController.php`, {
                method: "POST",
                body: params
              });

              const data = await response.json();
              return data;
            } catch (error) {
              console.error("Error en la solicitud usuario:", error);
            }
          }

          document.querySelector("#dni").addEventListener("keydown", async (event) => {
            if (event.key === 'Enter') {
              event.preventDefault();

              const infoPerson = await verifyDNI(event.target.value);
              if (infoPerson.success) {
                showPersonByDni(infoPerson);
              } else {
                showToast("DNI no valido", "ERROR", 1500);
                event.target.value = "";
                document.querySelector("#resultDni").innerHTML=""
              }
            }
          })


          form.addEventListener("submit", async (event) => {
            event.preventDefault();
            const dni = document.querySelector("#dni").value;

            const tipoUsuarioValue = document.querySelector("#tipoUsuario").value;
            if (!tipoUsuarioValue) {
              showToast("Debe seleccionar un tipo de usuario", "ERROR", 1500);
            }

            const infoPerson = await verifyDNI(dni);

            //DNI VALIDO
            if (infoPerson.success) {

              const dataPerson = {
                "apellidos": `${infoPerson.data.apellido_paterno} ${infoPerson.data.apellido_materno}`,
                "nombres": infoPerson.data.nombres,
                "dni": dni,
                "telefono": document.querySelector("#telefono").value
              }

              const statusRegisterPerson = await registerPerson(dataPerson);
              console.log(statusRegisterPerson)
              //REGISTRO EXITOSO DE PERSONA 
              if (statusRegisterPerson.status) {

                const dataUser = {
                  "idPersona": statusRegisterPerson.idPersona,
                  "idTipoUsuario": tipoUsuarioValue,
                  "email": document.querySelector("#email").value,
                  "nomUser": document.querySelector("#nomUser").value,
                  "passUser": document.querySelector("#passUser").value
                }

                const statusRegisterUser = await registerUser(dataUser);
                // REGISTRO EXITOSO DE USUARIO
                if (statusRegisterUser.status) showToast(statusRegisterUser.message, "SUCCESS", 1500, "./lista-usuarios")
                else showToast(statusRegisterUser.message, "ERROR", 1500)

              } else {
                showToast(statusRegisterPerson.message, "ERROR", 1500)
              }
            } else {
              showToast("DNI no valido", "ERROR", 1500)
            }
          });

          //LLamar funciones
          listSelectTipoUser();
        })
      </script>

      </body>

      </html>