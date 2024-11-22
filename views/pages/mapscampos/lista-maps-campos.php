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
                        <label for="fechaReservacion">Fecha:</label>
                        <input type="date" id="fechaReservacion" name="fechaReservacion" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="hInicio">Hora de Inicio:</label>
                        <input type="time" id="hInicio" name="hInicio" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="hFin">Hora de Fin:</label>
                        <input type="time" id="hFin" name="hFin" class="form-control" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="horasReservadas">Horas:</label>
                        <input type="number" id="horaReservadas" name="horaReservadas" class="form-control">
                    </div>
                    <div class="col-md-1 d-flex justify-content-center align-items-end">
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
                <article class="col-md-4 px-3 py-3" data-id="${campo.idCampo}">
                    <div id="map-${campo.idCampo}" style="height: 400px; width: 100%;"></div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex flex-column">
                            <h5 id="campoNombre-${campo.idCampo}" class="mb-0">${campo.nombre}</h5>
                            <h5 id="distritoCampo-${campo.idCampo}" class="mb-0">${campo.distrito}</h5>
                        </div>
                        <button class="btn btn-primary btn-campo" id="reservarCampoBtn-${campo.idCampo}">Realizar reserva</button>
                    </div>
                </article>`;

                contentBody.insertAdjacentHTML("beforeend", render);

                // Selecciona solo el botón del campo actual
                const button = document.getElementById(`reservarCampoBtn-${campo.idCampo}`);
                button.addEventListener("click", (event) => {
                    event.preventDefault();
                    const idCampo = event.target.closest("article").dataset.id;

                    sessionStorage.setItem("idCampo", idCampo);
                    sessionStorage.setItem("origen", "mapasCampo");
                    sessionStorage.setItem("fecha", document.getElementById("fechaReservacion").value)
                    sessionStorage.setItem("horaInicio", document.getElementById("hInicio").value)
                    sessionStorage.setItem("horaFin", document.getElementById("hFin").value)
                    sessionStorage.setItem("horas", document.getElementById("horaReservadas").value)

                    window.location.href = `../reservaciones/registro-reservaciones`;
                });


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


            });
        };

        const calcularHFin = () => {
            const hInicio = document.querySelector("#hInicio").value;
            const horas = parseInt(document.querySelector("#horaReservadas").value);

            if (hInicio && horas) {
                const [hora, minutos] = hInicio.split(":").map(Number);

                const fechaInicio = new Date();
                fechaInicio.setHours(hora, minutos);
                fechaInicio.setHours(fechaInicio.getHours() + horas);

                const hFin = fechaInicio.toTimeString().slice(0, 5);
                document.querySelector("#hFin").value = hFin;
            } else {
                document.querySelector("#hFin").value = "";
            }
        }

        const validateHora = () => {
            const horasString = document.querySelector("#horaReservadas").value;

            if (horasString === "") document.querySelector("#horaReservadas").value = "1";
            else {
                const horasInt = parseInt(horasString)

                if (horasInt < 1) document.querySelector("#horaReservadas").value = 1
                else if (horasInt > 6) document.querySelector("#horaReservadas").value = 6
                else document.querySelector("#horaReservadas").value = horasInt;
            }
        }

        const validateFecha = () => {
            const inputFecha = document.querySelector('#fechaReservacion');
            const fechaActual = new Date();
            const fechaSeleccionada = new Date(inputFecha.value);

            // Establecer la hora de ambas fechas a 00:00:00
            fechaActual.setHours(0, 0, 0, 0);
            fechaSeleccionada.setHours(0, 0, 0, 0);

            // Comparar fechas solo por día, mes y año (sin horas)
            if (fechaSeleccionada < fechaActual) {
                showToast('No puedes registrar una fecha pasada.', "ERROR");
                inputFecha.value = '';
            }
        }

        // Inicializar el mapa con todos los campos
        async function initMap() {
            const camposData = await fetchCampos();
            renderCampos(camposData);
        }

        document.querySelector("#fechaReservacion").addEventListener("change", () => {
            validateFecha();
        })

        document.querySelector("#hInicio").addEventListener("input", () => {
            calcularHFin();
        });

        document.querySelector("#horaReservadas").addEventListener("input", () => {
            validateHora();
            calcularHFin();
        });


        // Manejar la búsqueda
        formBusqueda.addEventListener("submit", async (event) => {
            event.preventDefault();

            const fecha = document.getElementById("fechaReservacion").value; 
            const horaInicio = document.getElementById("hInicio").value;
            const horaFin = document.getElementById("hFin").value;

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