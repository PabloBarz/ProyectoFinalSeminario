<?php
require_once '../../../app/helpers/Helper.php';
require_once '../../../app/config/app.php';
require_once '../../partials/header.php';
?>

<style>
    input[readonly] {
            background-color: #2A3038 !important; /* Cambia el color de fondo */
        }

    input,select{
        color: white !important;
    }
</style>

<!-- partial - WRAPPER MAIN + FOOTER -->
<div class="main-panel">
    <!-- MAIN -->
    <div class="content-wrapper">
        <!-- Contenido main -->
        <?= Helper::renderContentHeader("Registro Campos", "Inicio", SERVERURL . "views/") ?>

        <div class="content">
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
                                            <input type="text" class="form-control bg-input" id="dniCliente" name="dniCliente" maxlength="8" minlength="8" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="nomCliente">Cliente:</label>
                                            <input type="text" class="form-control" value="Barzola Pablo" name="nomCliente" id="nomCliente" readonly required>
                                        </div>
                                        <div class="col-md-2 form-group"></div>
                                        <div class="col-md-2 form-group">
                                            <label for="horaReservadas">Horas:</label>
                                            <input type="number" class="form-control" id="horaReservadas" name="horaReservadas"  required>
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

                </div><!-- /.container-fluid -->
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html - FOOTER-->
            <?php
            require_once '../../partials/_footer.php';
            ?>
            </body>

            </html>