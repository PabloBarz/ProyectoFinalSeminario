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
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="cliente">Cliente:</label>
                                            <input type="text" class="form-control" id="cliente" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="fecha-reservacion">Fecha reservacion:</label>
                                            <input type="date" class="form-control" id="fecha-reservacion" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="hinicio">Hora de inicio:</label>
                                            <input type="time" class="form-control" id="hinicio" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="hfinal">Hora de fin:</label>
                                            <input type="time" class="form-control" id="hfinal" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="hreservadas">Horas reservadas:</label>
                                            <input type="number" class="form-control" id="hreservadas" disabled required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="estado-pago">Estado de pago:</label>
                                            <select class="form-control" id="estado-pago" required>
                                                <option value="">Selecciona un estado</option>
                                                <option value="Administrador">Pagado</option>
                                                <option value="Supervisor">Pendiente</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="zona-campo">Zona del campo:</label>
                                            <input type="text" class="form-control" id="zona-campo" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="campo">Campo:</label>
                                            <input type="text" class="form-control" id="campo" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="direccion">Direccion:</label>
                                            <input type="number" class="form-control" id="direccion" required>
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