<?php
  session_start();
  require_once "./app/config/app.php";  

  if(isset($_SESSION["login"]) && $_SESSION["login"]["status"] == true){
    header("Location: " . SERVERURL . "views/");
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
    <link rel="stylesheet" href="<?= SERVERURL?>/views/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= SERVERURL?>/views/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= SERVERURL?>/views/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= SERVERURL?>/views/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Login</h3>

                <form method="POST" id="formLogin" autocomplete="off">
                  <div class="form-group">
                    <label for="nomUser">Nombre de Usuario *</label>
                    <input type="text" class="form-control p_input" id="nomUser" name="nomUser" required autofocus>
                  </div>
                  <div class="form-group">
                    <label for="passUser">Contraseña *</label>
                    <input type="text" class="form-control p_input" id="passUser" name="passUser" required>
                  </div>

                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="#" class="forgot-pass">Forgot password</a>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Ingresar</button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p>
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
    <script src="<?= SERVERURL?>/views/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= SERVERURL?>/views/assets/js/off-canvas.js"></script>
    <script src="<?= SERVERURL?>/views/assets/js/hoverable-collapse.js"></script>
    <script src="<?= SERVERURL?>/views/assets/js/misc.js"></script>
    <script src="<?= SERVERURL?>/views/assets/js/settings.js"></script>
    <script src="<?= SERVERURL?>/views/assets/js/todolist.js"></script>
    <!-- endinject -->

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert Customer -->
    <script src="<?= SERVERURL?>views/assets/js/swalcustom.js"></script>

    <script>
      document.addEventListener("DOMContentLoaded",  (event) =>{
        const formLogin = document.querySelector("#formLogin");

        formLogin.addEventListener("submit", async (event) => {
          event.preventDefault();
          const params = new FormData(formLogin);
          params.append("operation", "login");

          try{
            const response = await fetch(`app/controllers/UsuarioController.php`, {
              method: "POST",
              body: params
            });

            if (!response.ok) { 
              throw new Error('Error en la solicitud');
            }

            const data = await response.json();
            
            if (!data.esCorrecto){
              showToast(data.mensaje, 'WARNING');
            }else{
              showToast(data.mensaje, 'SUCCESS', 1500, 'views/');
            }

          }
          catch(error){
            console.error('Hubo un error: ', error.message);
          }   
        })
      })
    </script>

  </body>
</html>