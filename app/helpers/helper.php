<?php
// Aqui iran mas funciones de herramientas

class Helper
{

    public static function limpiarCadena($cadena): string
    {
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena); //Eliminar el backslash

        //Javascript
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src=", "", $cadena);
        $cadena = str_ireplace("<script type=", "", $cadena);
        $cadena = str_ireplace("'>", "", $cadena);

        //SQL
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DROP TABLE", "", $cadena);
        $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena = str_ireplace("SHOW TABLES", "", $cadena);
        $cadena = str_ireplace("SHOW DATABASE", "", $cadena);

        //Etiquetas
        $cadena = str_ireplace("<?php", "", $cadena);
        $cadena = str_ireplace("?>", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace(">", "", $cadena);
        $cadena = str_ireplace("<", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("{", "", $cadena);
        $cadena = str_ireplace("}", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace("===", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena); //ALT + 94
        $cadena = str_ireplace(";", "", $cadena);
        $cadena = str_ireplace("::", "", $cadena);

        $cadena = trim($cadena);
        return $cadena;
    }


    public static function renderContentHeader($title, $home, $path)
    {
        return "
            <div class='content-header'>
            <div class='container-fluid'>
                <div class='row mb-2'>
                <div class='col-sm-6'>
                    <h1 class='m-0'>{$title}</h1>
                </div>
                <div class='col-sm-6'>
                    <ol class='breadcrumb float-sm-right'>
                    <li class='breadcrumb-item'><a href='{$path}'>{$home}</a></li>
                    <li class='breadcrumb-item active'>{$title}</li>
                    </ol>
                </div>
                </div>
            </div>
            </div>
            ";
    }
}
