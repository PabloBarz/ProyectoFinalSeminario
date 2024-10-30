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
        <?= Helper::renderContentHeader("Campos Deportivos", "Inicio", SERVERURL . "views/") ?>

        <div class="content-main">
            <div class="card">
                <div class="card-body">
                    <div class="row" id="content-card"></div>
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
        const contentBody = document.querySelector("#content-card");

        const fetchCampos = async () => {
            const params = new FormData();
            params.append("operation", "getAllCampos");
            try {
                const response = await fetch(`../../../app/controllers/CamposMapsController.php`, {
                    method: "POST",
                    body: params
                });

                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }

                const data = await response.json();

                return data;

            } catch (error) {
                console.error('Hubo un error: ', error.message);
            }
        };

        async function initMap() {
            const camposData = await fetchCampos();
            contentBody.innerHTML = "";
            
            camposData.forEach(campo => {
                const render = `
                <div class="col-md-4 px-3 py-3">
                    <div id="map-${campo.idCampo}" style="height: 400px; width: 100%;"></div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h5 id="campoNombre-${campo.idCampo}" class="mb-0"></h5>
                        <button class="btn btn-primary" id="reservarCampoBtn-${campo.idCampo}">Reservar Campo</button>
                    </div>
                </div>`;

                contentBody.insertAdjacentHTML("beforeend", render);

                const location = {
                    lat: parseFloat(campo.latitud),
                    lng: parseFloat(campo.longitud)
                };

                const map = new google.maps.Map(document.querySelector(`#map-${campo.idCampo}`), {
                    zoom: 18,
                    center: location,
                    mapTypeId: google.maps.MapTypeId.SATELLITE
                });

                const marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    title: campo.nombre
                });

                document.querySelector(`#campoNombre-${campo.idCampo}`).innerText = campo.nombre;

                document.getElementById(`reservarCampoBtn-${campo.idCampo}`).onclick = function() {
                    alert('Reserva realizada para ' + campo.nombre);
                };
            });
        };
    </script>


    </body>

    </html>