<?php
session_start();
require_once "./app/config/app.php";

if (isset($_SESSION["login"]) && $_SESSION["login"]["status"] == true) {
  header("Location: " . SERVERURL . "views/home/welcome");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Corona Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= SERVERURL ?>/views/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= SERVERURL ?>/views/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?= SERVERURL ?>/views/assets/css/style.css">
  <link rel="stylesheet" href="<?= SERVERURL ?>/views/assets/css/form.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?= SERVERURL ?>/views/assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Registrar</h3>
              <form id="formRegisterUserPerson" autocomplete="off">
                <div class="form-group">
                  <label for="dni">DNI</label>
                  <input type="text" class="form-control p_input" id="dni" name="dni" maxlength="8" minlength="8" required autofocus>
                </div>
                <div class="form-group" id="resultDni">

                </div>
                <div class="form-group">
                  <label for="nomUser">Nombre de Usuario</label>
                  <input type="text" class="form-control p_input" id="nomUser" name="nomUser" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control p_input" id="email" name="email" required>
                </div>
                <div class="form-group">
                  <label for="telefono">Telefono</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">+51</span>
                    </div>
                    <input type="tel" class="form-control p_input" id="telefono" name="telefono" pattern="9[0-9]{8}" maxlength="9" minlength="9" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="passUser">Contraseña</label>
                  <input type="password" class="form-control p_input" id="passUser" name="passUser" required>
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input"> Remember me </label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">Registrarme</button>
                </div>

                <p class="sign-up text-center">¿Ya tienes una cuenta? <a href="./index.php">Sign In</a></p>
              </form>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= SERVERURL ?>/views/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= SERVERURL ?>/views/assets/js/off-canvas.js"></script>
  <script src="<?= SERVERURL ?>/views/assets/js/hoverable-collapse.js"></script>
  <script src="<?= SERVERURL ?>/views/assets/js/misc.js"></script>
  <script src="<?= SERVERURL ?>/views/assets/js/settings.js"></script>
  <script src="<?= SERVERURL ?>/views/assets/js/todolist.js"></script>
  <!-- endinject -->

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- SweetAlert Customer -->
  <script src="<?= SERVERURL ?>views/assets/js/swalcustom.js"></script>

  <script>
    //1 Primero validamos el dni con el api
    //2 Primero registrar la persona para obtner su id 
    //3 Registrar el usuario con idObtenido 
    document.addEventListener("DOMContentLoaded", () => {
      const form = document.querySelector("#formRegisterUserPerson");


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
          const response = await fetch(`app/controllers/PersonaController.php`, {
            method: "POST",
            body: params
          });

          const data = await response.json();
          return data;
        } catch (error) {
          console.error("Error en la solicitud:", error);
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
          const response = await fetch(`app/controllers/UsuarioController.php`, {
            method: "POST",
            body: params
          });

          const data = await response.json();
          return data;
        } catch (error) {
          console.error("Error en la solicitud:", error);
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
              "idTipoUsuario": 3,
              "email": document.querySelector("#email").value,
              "nomUser": document.querySelector("#nomUser").value,
              "passUser": document.querySelector("#passUser").value
            }

            const statusRegisterUser = await registerUser(dataUser);
            // REGISTRO EXITOSO DE USUARIO
            if (statusRegisterUser.status) showToast(statusRegisterUser.message, "SUCCESS", 1500, "<?= SERVERURL ?>")
            else showToast(statusRegisterUser.message, "ERROR", 1500)

          } else {
            showToast(statusRegisterPerson.message, "ERROR", 1500)
          }
        } else {
          showToast("DNI no valido", "ERROR", 1500)
        }
      });
    });
  </script>

</body>

</html>