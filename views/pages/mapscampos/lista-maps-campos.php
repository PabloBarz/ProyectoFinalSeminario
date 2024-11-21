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
        <?= Helper::renderContentHeader("Campos Deportivos", "Inicio", SERVERURL . "views/home/welcome") ?>

        <div>
            <!-- Formulario de búsqueda -->
            <form id="form-busqueda" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="horaInicio">Hora de Inicio:</label>
                        <input type="time" id="horaInicio" name="horaInicio" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="horaFin">Hora de Fin:</label>
                        <input type="time" id="horaFin" name="horaFin" class="form-control" required>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-end" >
                        <button type="submit" class="btn btn-primary" style="height: 40px;">Buscar</button>
                    </div>
                </div>
            </form>
        </div>

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
        const formBusqueda = document.getElementById("form-busqueda");

        // Fetch todos los campos
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
                return [];
            }
        };

        // Fetch campos disponibles
        const fetchCamposDisponibles = async (fecha, horaInicio, horaFin) => {
            const params = new FormData();
            params.append("operation", "getCamposDisponibles");
            params.append("fecha", fecha);
            params.append("horaInicio", horaInicio);
            params.append("horaFin", horaFin);

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
                return [];
            }
        };

        // Renderizar campos (general)
        const renderCampos = (camposData) => {
            contentBody.innerHTML = ""; // Limpiar contenido previo

            if (camposData.length === 0) {
                contentBody.innerHTML = `<div class="col-12 text-center"><p>No hay campos disponibles.</p></div>`;
                return;
            }

            camposData.forEach(campo => {
                const render = `
                <div class="col-md-4 px-3 py-3">
                    <div id="map-${campo.idCampo}" style="height: 400px; width: 100%;"></div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex flex-column">
                            <h5 id="campoNombre-${campo.idCampo}" class="mb-0"></h5>
                            <h5 id="distritoCampo-${campo.idCampo}" class="mb-0"></h5>
                        </div>
                        <button class="btn btn-primary" id="reservarCampoBtn-${campo.idCampo}">Realizar reserva</button>
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
                document.querySelector(`#distritoCampo-${campo.idCampo}`).innerText = campo.distrito;

                document.getElementById(`reservarCampoBtn-${campo.idCampo}`).onclick = function() {
                    alert('Reserva realizada para ' + campo.nombre);
                };
            });
        };

        // Inicializar el mapa con todos los campos
        async function initMap() {
            const camposData = await fetchCampos();
            renderCampos(camposData);
        }

        // Manejar la búsqueda
        formBusqueda.addEventListener("submit", async (event) => {
            event.preventDefault();

            const fecha = document.getElementById("fecha").value;
            const horaInicio = document.getElementById("horaInicio").value;
            const horaFin = document.getElementById("horaFin").value;

            if (fecha && horaInicio && horaFin) {
                const camposDisponibles = await fetchCamposDisponibles(fecha, horaInicio, horaFin);
                renderCampos(camposDisponibles);
            } else {
                alert("Por favor, complete todos los campos del formulario de búsqueda.");
            }
        });
    </script>
</body>
</html>
