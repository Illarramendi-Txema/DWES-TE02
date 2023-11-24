<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Illarramendi</title>
    <link type="text/css" rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php

    $json = file_get_contents("http://127.0.0.1/model/libros.json");
    $libros = json_decode($json);

    $sin_stock_1 = $_POST["sin_stock_1"];
    $sin_stock_2 = $_POST["sin_stock_2"];
    $sin_stock_3 = $_POST["sin_stock_3"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $dni = $_POST["dni"];  
    $ldni = $_POST["ldni"];
    $titulo = $_POST['libro'];
    $fecha = date("d-m-Y");
    $fec_alq = $_POST["fecha"];

    
    $letra = substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);

?>

<div class="formulario">
<h1>Resultado del envio del formulario</h1>
<table>
    <?php

        //TÍTULO DEL LIBRO
        if($titulo == $sin_stock_1 || $titulo == $sin_stock_2 || $titulo == $sin_stock_3){
            echo "<tr><th>Libro selecionado: </th><td><error>" . $titulo . " no esta disponible</error></td>";
        } else {
            echo "<tr><th>Libro selecionado: </th><td>" . $titulo . "<br>";
        }


        //NOMBRE Y APELLIDOS
        if (strlen($nombre)<=1 ||  strlen($apellidos)<=1) {
            echo "<tr><th>Usuario: </th><td><error>Debes introducir un nombre y un apellido correctos</error></td></tr>";
        }else {
            echo "<tr><th>Usuario: </th><td>" . $nombre . " " . $apellidos . "</td></tr>";
        }


        //DNI
        if($letra != $ldni && strlen($dni) != 8){
            echo "<tr><th>DNI: </th><td><error>La letra del DNI  introducida (" . strtoupper($ldni) . ") no es correcta " . "<br>";
            echo "La letra correcta para el número de DNI introducido es: " . strtoupper($letra) . "<br>";
            echo "La parte numerica del DNI debe de tener una longitud de 8 digitos</error></td></tr>";
        }elseif($letra != $ldni){
            echo "<tr><th>DNI: </th><td><error>La letra del DNI  introducida (" . strtoupper($ldni) . ") no es correcta " . "<br>";
            echo "La letra correcta para el número de DNI introducido es: " . strtoupper($letra) . "<br>";
        }elseif(strlen($dni) != 8) {
            echo "<tr><th>DNI: </th><td><error>La parte numerica del DNI debe de tener una longitud de 8 digitos</error></td></tr>";
        }else{
            echo "<tr><th>DNI: </th><td>" . $dni . strtoupper($letra) . "</td></tr>";
        }


        //FECHA
        if(strtotime($fec_alq) < strtotime($fecha)){
            echo "<tr><th>Fecha de alquiler</th><td><error>La fecha de inicio del alquiler no puede ser anterior a la fecha actual</error></td></tr>";
        }else{
            echo "<tr><th>Fecha de alquiler: </th><td>" . date("d-m-Y",  strtotime($fec_alq)) . "</td></tr>";
            echo "<tr><th>Fecha de devolución: </th><td>" . date("d-m-Y", strtotime($fec_alq . "+ 10 day")) . "</td></tr>";
        }


        //EMAIL
        if(strlen($email)<=3 || !str_contains($email, '@') || !str_contains($email, '.')){
            echo "<tr><th>Email: </th><td><error>Debes introducir un email correcto</error></td></tr>";
        }else{
            echo "<tr><th>Email: </th><td>" . $email . "</td></tr>";
        }
    ?>
</table>
</div>
<div class="contenedor">
<div class="ficha">
    
<h1>Libro seleccionado</h1>
    <?php
    foreach($libros as $libro) {
        if($libro->titulo == $titulo){
            echo '</p><b>Título: </b>' . $libro->titulo . '</p>';
            echo '</p><b>Autor: </b>' . $libro->autor . '</p>';
            echo '</p><b>Sinopsis: </b>' . $libro->sinop . '</p>';
        }  
    }
    ?>
</div>
<div class="portada">
<?php
    foreach($libros as $libro) {
        if($libro->titulo == $titulo){
            echo $libro->img;
        }  
    }
    ?>
</div>
</div>
<div class="inicio">
<a href="http://127.0.0.1/index.php">Volver al formulario</a>
</div>
</body>
</html>