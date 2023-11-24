<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Illarramendi</title>
    <link type="text/css" rel="stylesheet" href="./css/styles.css">
</head>
<body>
<?php

    $json = file_get_contents("http://127.0.0.1/model/libros.json");
    $libros = json_decode($json);

    $sin_stock_1 = rand(0,19);
    $sin_stock_2 = rand(0,19);
    $sin_stock_3 = rand(0,19);

    
    foreach($libros as $libro) {
        if($libro == $libros[$sin_stock_1]){
            $no_hay_1 = $libros[$sin_stock_1]->titulo;
        }
        if($libro == $libros[$sin_stock_2]){
            $no_hay_2 = $libros[$sin_stock_2]->titulo;
        }
        if($libro == $libros[$sin_stock_3]){
            $no_hay_3 = $libros[$sin_stock_3]->titulo;
        }
    }

    $letras = array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E','O');

    ?>
    <div class="formulario">
    <h1>Formulario de alquiler</h1>
        <form action="./controller/form.php" method="post" id="alquilar_libro">
                
                <input type="hidden" name="sin_stock_1" id="sin_stock_1" value="<?php echo $no_hay_1 ?>">
                <input type="hidden" name="sin_stock_2" id="sin_stock_2" value="<?php echo $no_hay_2 ?>">
                <input type="hidden" name="sin_stock_3" id="sin_stock_3" value="<?php echo $no_hay_3 ?>">
                
            <p>
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre" id="nombre">
            </p>
            <p>
                <label for="apellidos">Apellidos</label><br>
                <input type="text" name="apellidos" id="apellidos">
            </p>
            <p>
                <label for="libro">Escoge tu libro</label><br>
                <select name="libro" id="libro">
                    <?php
                        foreach($libros as $libro) {
                            echo '<option>' . $libro->titulo . '</option>';
                        }
                    ?>
                </select>
                </p> 
            <p>
                <label for="email">Email</label><br>
                <input type="text" name="email" id="email">
            </p>
            <p>  
                <label for="dni">DNI</label><br>
                <input type="number" name="dni" maxlength="8">
                <label for="ldni">Letra</label>
                <select name="ldni" style="text-transform:uppercase; width: 40px">
                    <?php
                        foreach($letras as $letra) {
                            echo '<option >' . $letra . '</option>';
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="fecha">Fecha de alquiler</label><br>
                <input type="date" name="fecha" change="fecha_vieja()" id="fecha">
            </p>
            <p>
                <input type="submit" name="submit" value="Enviar">
            </p>
        </form>
        
        <h2>Libros sin stock</h2>
        <p><error>En este momento no tenemos ninguna unidad disponible de los siguientes libros:</error><hr></p>
        <?php
        foreach($libros as $libro) {
            if($libro->titulo == $no_hay_1 || $libro->titulo == $no_hay_2 || $libro->titulo == $no_hay_3){
                echo '</p><b>Título: </b>' . $libro->titulo . '</p>';
            }  
        }
        ?>
    </div>
</body>
</html>