<?php
/*
=====================================================================
 ARCHIVO: editar.php (Sección Puestos)
 DESCRIPCIÓN: Edición y actualización de puestos utilizando MySQLi.
 PROYECTO: crud-php (Fines educativos)
 AUTOR: Juan Carlos Medina
=====================================================================
*/

include_once __DIR__ . '/../../db.php';

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? mysqli_real_escape_string($conexion, $_GET['txtId']) : "";
    
    // Consulta preparada para obtener el puesto por ID usando MySQLi
    $sql = "SELECT * FROM puestos WHERE idPuesto = ?";
    $sentencia = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($sentencia, "i", $txtId);
    mysqli_stmt_execute($sentencia);
    $resultado = mysqli_stmt_get_result($sentencia);
    
    if($puestos = mysqli_fetch_assoc($resultado)){
        $txtID = $puestos['idPuesto'];
        $txtPuesto = $puestos['puesto'];
    }
}

if($_POST){
    // RECOLECTAMOS LOS DATOS DEL METODO POST
    $txtIdPuesto = isset($_POST['txtIdPuesto']) ? $_POST['txtIdPuesto'] : "";
    $txtPuesto = isset($_POST['txtPuesto']) ? $_POST['txtPuesto'] : "";

    // PREPARAR LA ACTUALIZACION DE DATOS CON MYSQLI
    $sql = "UPDATE puestos SET puesto = ? WHERE idPuesto = ?";
    $sentencia = mysqli_prepare($conexion, $sql);
    
    // ASIGNANDO LOS VALORES Y EJECUTANDO
    mysqli_stmt_bind_param($sentencia, "si", $txtPuesto, $txtIdPuesto);
    mysqli_stmt_execute($sentencia);
    
    header("location: index.php");
    exit();
}

?>

<?php include_once("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        <h2>Editar Puestos</h2>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="idPuesto" class="form-label">ID:</label>
                <input type="text" value="<?php echo isset($txtID) ? $txtID : ''; ?>" readonly class="form-control" name="txtIdPuesto" id="idPuesto" aria-describedby="helpId"
                    placeholder="">
            </div>

            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto:</label>
                <input type="text" value="<?php echo isset($txtPuesto) ? $txtPuesto : ''; ?>" class="form-control" name="txtPuesto" id="idPuesto" aria-describedby="helpId"
                    placeholder="" required>
            </div>

            <div class="mb-3">
                <button name="" id="" class="btn btn-success" type="submit" value="Actualizar">Actualizar</button>
                <a name="" id="" href="index.php" class="btn btn-primary" role="button">Cancelar</a>
            </div>

        </form>

    </div>
    <div class="card-footer text-muted">

    </div>

</div>
<?php include_once("../../templates/footer.php"); ?>