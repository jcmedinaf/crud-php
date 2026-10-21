<?php
/*
=====================================================================
 ARCHIVO: crear.php (Sección Puestos)
 DESCRIPCIÓN: Inserción de nuevos puestos utilizando MySQLi.
 PROYECTO: crud-php (Fines educativos)
 AUTOR: Juan Carlos Medina
=====================================================================
*/

include_once __DIR__ . '/../../db.php';

if($_POST){
    // RECOLECTAMOS LOS DATOS DEL METODO POST
    $txtPuesto = isset($_POST['txtPuesto']) ? $_POST['txtPuesto'] : "";

    // PREPARAR LA INSERCION DE DATOS CON MYSQLI (usando ? en lugar de :parametros)
    $sql = "INSERT INTO puestos (puesto) VALUES (?)";
    $sentencia = mysqli_prepare($conexion, $sql);

    // ASIGNANDO LOS VALORES Y EJECUTANDO
    mysqli_stmt_bind_param($sentencia, "s", $txtPuesto);
    mysqli_stmt_execute($sentencia);
    
    header("location: index.php");
    exit();
}

?>
<?php include_once("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        <h2>Crear Puestos</h2>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto:</label>
                <input type="text" class="form-control" name="txtPuesto" id="idPuesto" aria-describedby="helpId" placeholder="" required>
            </div>

            <div class="mb-3">
                <button name="" id="" class="btn btn-success" type="submit" value="Agregar">Agregar</button>
                <a name="" id=""  href="index.php" class="btn btn-primary" role="button">Cancelar</a>
            </div>

        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
    
</div>
<?php include_once("../../templates/footer.php"); ?>