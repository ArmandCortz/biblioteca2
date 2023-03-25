<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Biblioteca UNI | Panel Administracion</title>
    <link rel="shortcut icon" href="../images/iconolibreria.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/estilo.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="prestamos_libros/myjava.js"></script>
</head>

<body>
    <?php include('admin/navegacion.php'); ?>
    <div class="container">

        <div id="page-wrapper">
            <div class="container-fluid">
                <br>
                <h1 class="page-header">
                    <small><img src="images/logo.jpg"></small> Prestamos de Libros
                </h1>

                <table border="0" align="center">
                    <tr>
                        <td><B> Buscar Libros: </B></td>
                        <td>&nbsp; &nbsp;</td>
                        <td width="335"><input type="text" placeholder="Buscar" id="bs-prod"
                                style="border-radius:10px; padding-left:5px; heigth:25px; width:90%" /> </td>
                        <td width="116"></td>
                        <td>&nbsp;</td>
                        <td width="100"></td>
                    </tr>
                </table>
                <br>
                <center>
                    <ul class="pagination" id="pagination"></ul>
                </center>
            </div>
            <?php
            
            include('./admin/conexion.php');
            $paginaActual = $_POST['partida'];

            $nroProductos = mysqli_num_rows(mysqli_query($con, "SELECT * FROM libros"));
            $nroLotes = 8;
            $nroPaginas = ceil($nroProductos / $nroLotes);
            $lista = '';
            $tabla = '';

            if ($paginaActual > 1) {
                $lista = $lista . '<li><a href="javascript:pagination(' . ($paginaActual - 1) . ');">Anterior</a></li>';
            }
            for ($i = 1; $i <= $nroPaginas; $i++) {
                if ($i == $paginaActual) {
                    $lista = $lista . '<li class="active"><a href="javascript:pagination(' . $i . ');">' . $i . '</a></li>';
                } else {
                    $lista = $lista . '<li><a href="javascript:pagination(' . $i . ');">' . $i . '</a></li>';
                }
            }
            if ($paginaActual < $nroPaginas) {
                $lista = $lista . '<li><a href="javascript:pagination(' . ($paginaActual + 1) . ');">Siguiente</a></li>';
            }

            if ($paginaActual <= 1) {
                $limit = 0;
            } else {
                $limit = $nroLotes * ($paginaActual - 1);
            }
            $registro = mysqli_query($con, "SELECT * FROM libros LIMIT $limit, $nroLotes ");
            $tabla = $tabla . '<table class=table table-striped table-condensed table-hover table-responsive">
			<tr>
            <th width=300>Nombre<th width=300>Descripcion<th width=100>Disponible<th width=100>Categoria<th width=100>Subcategoria';
            while ($registro2 = mysqli_fetch_array($registro)) {
                $foto = $registro2['foto'];
                $imagen = '<img src="' . $foto . '" width="50" height="50">';
                $tabla = $tabla . '<tr>
        <td>' . $registro2['nombre'] . '<td>' . $registro2['descripcion'] . '<td>' . $registro2['disponible'] . '<td>' . $registro2['id_categoria'] . '<td>' . $registro2['id_subcategoria'];
            }

            $array = array(
                0 => $tabla,
                1 => $lista
            );
            echo json_encode($array);
            
            
            
            
            
            
            
            ?>
        </div>
    </div>


    <script src="js/busqueda.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</body>

</html>