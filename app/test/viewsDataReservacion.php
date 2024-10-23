<?php 
    require_once "../models/reservacionesModel.php";

    $reservacion = new ReservacionesModel();

    print_r($reservacion->getdataReservacion());

?>