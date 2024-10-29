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
        <?= Helper::renderContentHeader("Lista Mapas Campos", "Inicio", SERVERURL . "views/") ?>

        <div class="content-main">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div id="map" style="height: 400px; width: 100%;"></div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 id="campoNombre" class="mb-0"></h5>
                                <button class="btn btn-primary" id="reservarCampoBtn">Reservar Campo</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div id="map" style="height: 400px; width: 100%;"></div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 id="campoNombre" class="mb-0"></h5>
                                <button class="btn btn-primary" id="reservarCampoBtn">Reservar Campo</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div id="map" style="height: 400px; width: 100%;"></div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 id="campoNombre" class="mb-0"></h5>
                                <button class="btn btn-primary" id="reservarCampoBtn">Reservar Campo</button>
                            </div>
                        </div>
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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC264--FZ7dF8vsFtaglWrM77yRNyeAvTE&callback=initMap" async defer></script>

    <script>
        function initMap() {

            const campo = {
                idCampo: 1,
                nombre: 'Campo de Senati',
                latitud: -13.4458051,
                longitud: -76.1375517,
            };
            const location = {
                lat: campo.latitud,
                lng: campo.longitud
            };

            const map = new google.maps.Map(document.querySelector("#map"), {
                zoom: 15,
                center: location
            });

            const marker = new google.maps.Marker({
                position: location,
                map: map,
                title: campo.nombre
            });

            document.querySelector("#campoNombre").innerText = campo.nombre;

            document.getElementById('reservarCampoBtn').onclick = function() {
                alert('Reserva realizada para ' + campo.nombre);
            };
        }


    </script>

    </body>

    </html>