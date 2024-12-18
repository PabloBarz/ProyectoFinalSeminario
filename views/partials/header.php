<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["login"]["status"] == false) {
  header("Location: " . SERVERURL);
}

$listaPemisos = $_SESSION["login"]["permisos"];

$urlCompleta = $_SERVER["REQUEST_URI"];
$arraVista = explode("/", $urlCompleta);
$vistaActual = end($arraVista);

$encontrado = false;
foreach($listaPemisos as $permisos){
  if($vistaActual == $permisos["ruta"]){
    $encontrado = true;
  }
}

if(!$encontrado){
  header("Location: " .SERVERURL . "views/home/welcome");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sport TB</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= SERVERURL?>views/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= SERVERURL?>views/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= SERVERURL?>views/assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?= SERVERURL?>views/assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="<?= SERVERURL?>views/assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= SERVERURL?>views/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?= SERVERURL?>views/assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?= SERVERURL?>views/assets/images/favicon.png" />

  <!-- FonAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- ARCHIVO CSS PARA LOS COLORES DE LOS FORMULARIOS -->
  <link rel="stylesheet" href="<?= SERVERURL?>/views/assets/css/form.css">
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html - Sidebar left -->
    <sidebar class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="<?= SERVERURL?>views/home/welcome"><img src="<?= SERVERURL?>views/assets/images/logo.svg" alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="<?= SERVERURL?>views/home/welcome"><img src="<?= SERVERURL?>views/assets/images/logo-mini.svg" alt="logo" /></a>
  </div>
  
  <ul class="nav">         
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <?php
      foreach($listaPemisos as $permisos){
        if($permisos["visible"]){
          $vista = SERVERURL . "views" . "/pages" . "/" . $permisos["modulo"] . "/" . $permisos["ruta"];
          echo "
            <li class='nav-item menu-items'>
              <a class='nav-link' href='{$vista}'>
                <span class='menu-icon'>
                  <i class='{$permisos['icono']}'></i>
                </span>
                <span class='menu-title' >{$permisos['texto']}</span>
              </a>
            </li>
          ";
        }
      }
    ?>
  </ul>
</sidebar>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html - NAVBAR TOP -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?= SERVERURL?>views/assets/images/logo-mini.svg" alt="logo" /></a>
  </div>
  <!-- NAVAR ITEMS -->
  <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
   
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
          <div class="navbar-profile">
            <img class="img-xs rounded-circle" src="<?= SERVERURL?>views/assets/images/faces/face15.jpg" alt="">
            <p class="mb-0 d-none d-sm-block navbar-profile-name"><?= $_SESSION["login"]["nomUser"]?></p>
            <i class="mdi mdi-menu-down d-none d-sm-block"></i>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
          
          <h6 class="p-3 mb-0">Profile</h6>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Settings</p>
            </div>
          </a>
          
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="<?= SERVERURL?>app/controllers/UsuarioController.php?operation=destroy" role="button">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-logout text-danger"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Cerrar Sesión</p>
            </div>
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-format-line-spacing"></span>
    </button>
  </div>
</nav>