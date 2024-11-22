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
        <?php
        echo Helper::renderContentHeader("Registro Campos", "Inicios", SERVERURL . "views/home/welcome");
        ?>

        <div class="content-main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" id="formRegisterReserva" autocomplete="off">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">Complete los datos</div>
                                        <div class="col-md-6 text-right">
                                            <a href="./lista-reservaciones" class="btn btn-sm btn-primary">Mostrar Lista</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="row-cliente">
                                        <div class="col-md-2 form-group">
                                            <label for="dniCliente">DNI:</label>
                                            <input type="text" class="form-control bg-input" id="dniCliente" name="dniCliente" maxlength="8" minlength="8" autofocus required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="nomCliente">Cliente:</label>
                                            <input type="text" class="form-control" name="nomCliente" id="nomCliente" readonly required>
                                        </div>
                                        <input type="hidden" id="idUsuario">
                                        <div class="col-md-2 form-group"></div>
                                        <div class="col-md-2 form-group">
                                            <label for="horaReservadas">Horas:</label>
                                            <input type="number" class="form-control" value="1" id="horaReservadas" name="horaReservadas" min="1" step="1" max="6" required>
                                        </div>
                                    </div>
                                    <div class="row" id="row-fecha">
                                        <div class="col-md-4 form-group">
                                            <label for="fechaReservacion">Fecha</label>
                                            <input type="date" class="form-control" id="fechaReservacion" name="fechaReservacion" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="hInicio">Hora de Inicio:</label>
                                            <input type="time" class="form-control" id="hInicio" name="hInicio" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="hFin">Hora de Fin:</label>
                                            <input type="time" class="form-control" id="hFin" name="hFin" readonly required>
                                        </div>
                                    </div>
                                    <div class="row" id="row-campo">
                                        <div class="col-md-4 form-group">
                                            <label for="campo">Campo:</label>
                                            <select class="form-control" id="campo" name="campo" required>

                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="zonaCampo">Zona del campo:</label>
                                            <select class="form-control" id="zonaCampo" name="zonaCampo" required>

                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="direccion">Direccion:</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" readonly required>
                                        </div>
                                    </div>
                                    <div class="row" id="row-detalles-reserva">
                                        <div class="col-md-4 form-group">
                                            <label for="precioHora">Precio por Hora:</label>
                                            <input type="number" class="form-control" id="precioHora" name="precioHora" readonly required>
                                        </div>

                                        <div class="col-md-4 form-group"></div>
                                        <div class="col-md-4 form-group">
                                            <label for="total">Total:</label>
                                            <input type="number" class="form-control" id="total" name="total" readonly required>
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
                </div>
            </div>
        </div>
    </div>

    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html - FOOTER-->
    <?php
    require_once '../../partials/_footer.php';
    ?>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert Customer -->
    <script src="<?= SERVERURL ?>views/assets/js/swalcustom.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", event => {

            const dni = document.querySelector("#dniCliente");
            const nomCliente = document.querySelector("#nomCliente");
            const selectCampos = document.querySelector("#campo");
            const selectsZonaCampos = document.querySelector("#zonaCampo");
            const origen = sessionStorage.getItem("origen");

            let dataCampos = [];
            let dataZonasCampos = [];

            const listZonaCampoDisponible = async (formData = {}) => {
                const params = new FormData();
                params.append("fecha", formData.fecha);
                params.append("hInicio", formData.hInicio);
                params.append("hFin", formData.hFin);
                params.append("idCampo", formData.idCampo);
                params.append("operation", "getZonaCampoDisponible")

                try {
                    const response = await fetch('../../../app/controllers/ZonasCamposController.php', {
                        method: "POST",
                        body: params
                    });

                    if (!response.ok) {
                        throw new Error('Error en la solicitud ZonaCamposDisponibles')
                    }

                    const data = await response.json();
                    dataZonasCampos = data;
                    selectsZonaCampos.innerHTML = '<option value="">Seleccione una zona de campo</option>';
                    data.forEach(element => {
                        const tagOption = document.createElement("option");
                        tagOption.value = element.idZonaCampo;
                        tagOption.textContent = element.nombre;
                        selectsZonaCampos.appendChild(tagOption);
                    });



                } catch (Error) {
                    console.error("ERROR al traer lista zona campos ", error.message);
                }

            }

            const rellenarDatosByMapa = async () => {
                if (origen === "mapasCampo") {
                    console.log("Viniste de Mapas de Campo")
                    const idCampo = sessionStorage.getItem("idCampo");
                    const nombres = <?php echo json_encode($_SESSION['login']['nombres']); ?>;
                    const apellidos = <?php echo json_encode($_SESSION['login']['apellidos']); ?>;
                    const dni = <?php echo json_encode($_SESSION['login']['dni']); ?>;
                    const fecha = sessionStorage.getItem("fecha") || "";
                    const horaInicio = sessionStorage.getItem("horaInicio") || "";
                    const horaFin = sessionStorage.getItem("horaFin") || "";
                    const horas = sessionStorage.getItem("horas") || 1

                    const datosZonaDisponible = {
                        "fecha": fecha,
                        "hInicio": horaInicio,
                        "hFin": horaFin,
                        "idCampo": idCampo,
                    }

                    const statusDni = await verifyDni(dni);
                    showStatusDni(statusDni);

                    listZonaCampoDisponible(datosZonaDisponible)

                    document.querySelector("#dniCliente").value = dni
                    document.querySelector("#dniCliente").readOnly = true
                    //document.querySelector("#nomCliente").value = `${nombres} ${apellidos}`
                    document.querySelector("#fechaReservacion").value = fecha
                    document.querySelector("#hInicio").value = horaInicio
                    document.querySelector("#hFin").value = horaFin
                    document.querySelector("#campo").value = idCampo
                    document.querySelector("#horaReservadas").value = horas

                } else if (origen === "listaReservaciones") {
                    console.log("Viniste de lista")
                }
            }

            const listSelectCampos = async () => {
                const params = new FormData();
                params.append("operation", "GetListSelectCampos")
                try {
                    const response = await fetch('../../../app/controllers/CamposController.php', {
                        method: "POST",
                        body: params
                    })
                    if (!response.ok) {
                        throw new Error('Error en la solicitud Campos')
                    }

                    const data = await response.json();
                    dataCampos = data;

                    selectCampos.innerHTML = '<option value="">Seleccione un campo</option>';
                    data.forEach(element => {
                        const tagOption = document.createElement("option");
                        tagOption.value = element.idcampo;
                        tagOption.textContent = element.nombre;
                        selectCampos.appendChild(tagOption);
                    });

                    rellenarDatosByMapa();
                    const selectedCampo = dataCampos.find(campo => campo.idcampo === Number(sessionStorage.getItem("idCampo")));
                    if (selectedCampo) document.querySelector("#direccion").value = selectedCampo.direccion;


                } catch (error) {
                    console.error("ERROR al traer lista campos ", error.message);
                }
            }

            const listSelectZonaCampos = async (idCampo) => {
                const params = new FormData();
                params.append("operation", "getZonaCamposByCampos");
                params.append("idCampo", idCampo);

                try {
                    const response = await fetch('../../../app/controllers/ZonasCamposController.php', {
                        method: "POST",
                        body: params
                    });

                    if (!response.ok) {
                        throw new Error('Error en la solicitud ZonaCampos')
                    }

                    const data = await response.json();
                    dataZonasCampos = data;

                    selectsZonaCampos.innerHTML = '<option value="">Seleccione una zona de campo</option>';
                    data.forEach(element => {
                        const tagOption = document.createElement("option");
                        tagOption.value = element.idZonaCampo;
                        tagOption.textContent = element.nombre;
                        selectsZonaCampos.appendChild(tagOption);
                    });


                } catch (Error) {
                    console.error("ERROR al traer lista zona campos ", error.message);
                }
            }

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

            const calculatePrecio = () => {
                const hora = parseInt(document.querySelector("#horaReservadas").value);
                const precio = parseFloat(document.querySelector("#precioHora").value);

                if (hora && precio) {
                    document.querySelector("#total").value = hora * precio;
                } else document.querySelector("#total").value = ""
            }

            const validateFecha = () => {
                const inputFecha = document.getElementById('fechaReservacion');
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

            const verifyDni = async (dni) => {
                const params = new FormData();
                params.append("operation", "verifyPerson")
                params.append("dni", dni)
                try {
                    const response = await fetch('../../../app/controllers/PersonaController.php', {
                        method: "POST",
                        body: params
                    })

                    if (!response.ok) {
                        throw new Error('Error en la solicitud');
                    }

                    const data = await response.json();
                    return data;
                } catch (error) {
                    console.error('Hubo un error: ', error.message);
                    []
                }
            }

            const showStatusDni = (result) => {
                if (result.length > 0) {
                    nomCliente.value = result[0].nombres + ' ' + result[0].apellidos;
                    document.querySelector("#idUsuario").value = result[0].idPersona
                } else {
                    dni.value = ""
                    nomCliente.value = ""
                    showToast("DNI no valido", "ERROR")
                }
            }

            const registerReservacion = async (datos = {}) => {
                const params = new FormData()
                for (const key in datos) {
                    if (datos.hasOwnProperty(key)) {
                        params.append(key, datos[key]);
                    }
                };
                params.append("operation", "registerReservacion");

                try {
                    const response = await fetch("../../../app/controllers/ReservacionController.php", {
                        method: "POST",
                        body: params
                    });

                    if (!response.ok) {
                        throw new Error("Error en la respuesta del servidor");
                    }

                    const result = await response.json();

                    if (result.status) {
                        showToast(result.message, "SUCCESS", 1500, "./lista-reservaciones")
                    } else {
                        showToast(statusRegisterPerson.message, "ERROR", 1500)
                    }
                } catch (error) {
                    console.error("Error:", error);
                    console.error("Ocurrió un error en la solicitud registraReservacion.");
                }

            }



            selectCampos.addEventListener("change", (event) => {
                document.querySelector("#precioHora").value = ""
                document.querySelector("#total").value = ""

                const id = parseInt(event.target.value);
                const selectedCampo = dataCampos.find(campo => campo.idcampo === id);

                listSelectZonaCampos(id);
                if (selectedCampo) document.querySelector("#direccion").value = selectedCampo.direccion;
                else {
                    document.querySelector("#direccion").value = ""
                    document.querySelector("#precioHora").value = ""
                    document.querySelector("#total").value = ""
                }

            })

            selectsZonaCampos.addEventListener("change", (event) => {
                const id = parseInt(event.target.value);
                console.log(id)
                console.log(dataZonasCampos)
                const selectedZonaCampo = dataZonasCampos.find(zonaCampo => zonaCampo.idZonaCampo === id);
                console.log(selectedZonaCampo.precioHora)
                if (selectedZonaCampo) {
                    document.querySelector("#precioHora").value = selectedZonaCampo.precioHora;
                    calculatePrecio();
                } else {
                    document.querySelector("#precioHora").value = ""
                    document.querySelector("#total").value = ""
                }
            })

            dni.addEventListener("keydown", async (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();

                    const statusDni = await verifyDni(dni.value);
                    showStatusDni(statusDni);

                }
            })

            document.querySelector("#fechaReservacion").addEventListener("change", () => {
                validateFecha();
            })

            document.querySelector("#hInicio").addEventListener("input", () => {
                calcularHFin();
            });

            document.querySelector("#horaReservadas").addEventListener("input", () => {
                validateHora();
                calcularHFin();
                calculatePrecio();
            });

            document.querySelector("#formRegisterReserva").addEventListener("submit", (event) => {
                event.preventDefault();
                console.log("Click en evniar")

                datos = {
                    idZonaCampo: document.querySelector("#zonaCampo").value,
                    idUsuario: document.querySelector("#idUsuario").value,
                    fecha: document.querySelector("#fechaReservacion").value,
                    hInicio: document.querySelector("#hInicio").value,
                    hFin: document.querySelector("#hFin").value,
                    estadoPago: "Pendiente",
                    precioHora: document.querySelector("#precioHora").value,
                    cantidadHora: document.querySelector("#horaReservadas").value,
                    totalMonto: document.querySelector("#total").value
                };

                registerReservacion(datos);

            })

            listSelectCampos();
            rellenarDatosByMapa();

        });
    </script>
    </body>

    </html>