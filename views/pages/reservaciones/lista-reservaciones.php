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
    <?= Helper::renderContentHeader("Lista Reservaciones", "Inicio", SERVERURL . "views/home/welcome") ?>

    <!-- Tabla de litado de reservaciones-->
    <div class="row">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6">Reservaciones</div>
              <div class="col-md-6 text-right">
                <a href="./registro-reservaciones" class="btn btn-sm btn-primary">Registrar</a>
                <a href="./registro-reservaciones" class="btn btn-sm btn-danger">Reporte</a>
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
              <table class="table table-hover" id="tabla-reservaciones">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Fecha Reserv.</th>
                    <th>H. Incio</th>
                    <th>H. Fin</th>
                    <th>H. Reservadas</th>
                    <th>Precio por H.</th>
                    <th>Estado de Pago</th>
                    <th>Zona Campo</th>
                    <th>Campo</th>
                    <th>Direccion</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Filas pintados desde JS -->
                </tbody>
              </table>
            </div> <!-- Fin de tabla -->

          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html - FOOTER-->
  <?php
  require_once '../../partials/_footer.php';
  ?>

  <script>
    document.addEventListener("DOMContentLoaded", (event) => {
      const tableBody = document.querySelector("#tabla-reservaciones tbody");

      const listTableRerservaciones = async () => {
        const params = new FormData();
        params.append("operation", "getListReservaciones");

        try {

          const response = await fetch(`../../../app/controllers/ReservacionController.php`, {
            method: "POST",
            body: params
          });

          if (!response.ok) {
            throw new Error('Error en la solicitud');
          }

          const data = await response.json();

          if (data.length > 0) {

            tableBody.innerHTML = "";

            const colorsStatusPago = {
                "Pendiente": "badge badge-danger",
                "Parcial": "badge badge-warning",
                "Pagado": "badge badge-success"
              }

            data.forEach(element => {

              const classStatusPago = colorsStatusPago[element.estadoPago];

              const render =
                `
                <tr data-id="${element.idReservacion}">
                  <td>${element.nombreCliente} ${element.apellidoUsuario}</td>
                  <td>${element.fechaReservacion}</td>
                  <td>${element.horaInicio}</td>
                  <td>${element.horaFin}</td>
                  <td>${element.cantidadHora}</td>
                  <td>${element.precioHora}</td>
                  <td><label class="${classStatusPago}">${element.estadoPago}</label></td>
                  <td>${element.nombreZona}</td>
                  <td>${element.nombreCampo}</td>
                  <td>${element.direccionCampo}</td>
                </tr>
                `
              tableBody.insertAdjacentHTML("beforeend", render);

            });

          } else {
            const noRows =
              `
              <tr>
                <td colspan="10" class="text-center text-muted">Registros vacíos</td>
              </tr>
              `;
            tableBody.insertAdjacentHTML("beforeend", noRows);
          }
        } catch (error) {
          console.error('Hubo un error: ', error.message);
        }
      }

      listTableRerservaciones();

    })
  </script>
  </body>

  </html>