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
        <?= Helper::renderContentHeader("Registro Campos", "Inicio", SERVERURL . "views/") ?>

        <div class="content-main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" autocomplete="off">
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
                                        <div class="col-md-2 form-group"></div>
                                        <div class="col-md-2 form-group">
                                            <label for="horaReservadas">Horas:</label>
                                            <input type="number" class="form-control" value="1" id="horaReservadas" name="horaReservadas" min="1" step="1" required>
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
                                                <option value=""></option>
                                                <option value="Administrador">El Golazo</option>
                                                <option value="Supervisor">El volante</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="zonaCampo">Zona del campo:</label>
                                            <select class="form-control" id="zonaCampo" name="zonaCampo" required>
                                                <option value=""></option>
                                                <option value="1">Zona 1</option>
                                                <option value="2">Zona 3</option>
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
                }
            }

            const showMessage = (result) => {
                if (result.length > 0) {
                    nomCliente.value = result[0].nombres + ' ' + result[0].apellidos;
                } else {
                    dni.value = ""
                    nomCliente.value = ""
                    showToast("DNI no valido", "ERROR")
                }
            }

            dni.addEventListener("keydown", async (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();

                    const statusDni = await verifyDni(dni.value);
                    showMessage(statusDni);

                }
            })

            document.getElementById("horaReservadas").addEventListener("input", function() {
                const hInicio = document.getElementById("hInicio").value;
                const horas = parseInt(this.value, 10);

                console.log(typeof hInicio)
                console.log(horas);

                if (hInicio && horas) {
                    // Convierte la hora de inicio en un objeto Date
                    const [hora, minutos] = hInicio.split(":").map(Number);
                    const fechaInicio = new Date();
                    fechaInicio.setHours(hora, minutos);

                    // Incrementa las horas
                    fechaInicio.setHours(fechaInicio.getHours() + horas);

                    // Formatea la hora de fin
                    const horaFin = fechaInicio.toTimeString().slice(0, 5);
                    document.getElementById("hFin").value = horaFin;
                } else {
                    document.getElementById("hFin").value = ""; // Limpia si los valores son inválidos
                }
            });
            
            document.getElementById("horaReservadas").addEventListener("input", function() {
                // Asegura que el valor sea un número entero positivo
                if (this.value < 1) {
                    this.value = 1; // Si es menor que 1, restablece a 1
                } else {
                    // Elimina decimales si se ingresan
                    this.value = Math.floor(this.value);
                }
            });
        });
    </script>
    </body>

    </html>