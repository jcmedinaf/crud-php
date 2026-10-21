<?php
/*
=====================================================================
 ARCHIVO: editar.php (Sección Empleados)
 DESCRIPCIÓN: Edición, actualización de datos y archivos con MySQLi.
 PROYECTO: crud-php (Fines educativos)
 AUTOR: Juan Carlos Medina
=====================================================================
*/

include_once __DIR__ . '/../../db.php';
$ruta_foto = '../../assets/img/fotos/';
$ruta_CV = '../../assets/pdf/';

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? mysqli_real_escape_string($conexion, $_GET['txtId']) : "";
    
    // Obtener datos del empleado usando MySQLi
    $sql = "SELECT * FROM empleados WHERE idEmpleado = ?";
    $sentencia = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($sentencia, "i", $txtId);
    mysqli_stmt_execute($sentencia);
    $resultado = mysqli_stmt_get_result($sentencia);
    
    if($empleado = mysqli_fetch_assoc($resultado)){
        $txtID = $empleado['idEmpleado'];
        $txtPrimerNombre = $empleado['primer_nombre'];
        $txtSegundoNombre = $empleado['segundo_nombre'];
        $txtPrimerApellido = $empleado['primer_apellido'];
        $txtSegundoApellido = $empleado['segundo_apellido'];
        $txtIdPuesto = $empleado['idPuesto'];
        $txtFechaIngreso = $empleado['fecha_ingreso'];
        $txtFoto = $empleado['foto'];
        $txtCV = $empleado['cv'];
    }

    // Obtener listado de puestos usando MySQLi
    $sql_puestos = "SELECT * FROM puestos";
    $resultado_puestos = mysqli_query($conexion, $sql_puestos);
    $lista_puestos = [];
    if ($resultado_puestos) {
        while ($fila = mysqli_fetch_assoc($resultado_puestos)) {
            $lista_puestos[] = $fila;
        }
    }
}

if($_POST){
    // RECOLECTAMOS LOS DATOS DEL METODO POST
    $txtIdEmpleado = isset($_POST['txtIdEmpleado']) ? $_POST['txtIdEmpleado'] : "";
    $txtPrimerNombre = isset($_POST['txtPrimerNombre']) ? $_POST['txtPrimerNombre'] : "";
    $txtSegundoNombre = isset($_POST['txtSegundoNombre']) ? $_POST['txtSegundoNombre'] : "";
    $txtPrimerApellido = isset($_POST['txtPrimerApellido']) ? $_POST['txtPrimerApellido'] : "";
    $txtSegundoApellido = isset($_POST['txtSegundoApellido']) ? $_POST['txtSegundoApellido'] : "";
    $txtIdPuesto = isset($_POST['txtIdPuesto']) ? $_POST['txtIdPuesto'] : "";
    $txtFechaIngreso = isset($_POST['txtFechaIngreso']) ? $_POST['txtFechaIngreso'] : "";
    
    // PREPARAR LA ACTUALIZACION DE DATOS CON MYSQLI
    $sql = "UPDATE empleados SET primer_nombre = ?, segundo_nombre = ?, primer_apellido = ?, segundo_apellido = ?, idPuesto = ?, fecha_ingreso = ? WHERE idEmpleado = ?";
    $sentencia = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($sentencia, "ssssisi", $txtPrimerNombre, $txtSegundoNombre, $txtPrimerApellido, $txtSegundoApellido, $txtIdPuesto, $txtFechaIngreso, $txtIdEmpleado);
    mysqli_stmt_execute($sentencia);

    $fecha = new DateTime();
    
    // GESTIÓN DE FOTO
    $txtFoto = isset($_FILES['txtFoto']['name']) ? $_FILES['txtFoto']['name'] : "";
    $tmp_foto = $_FILES['txtFoto']['tmp_name'];
    
    if($tmp_foto != ""){
        $nmbreArchivoFoto = $fecha->getTimestamp() . "_" . $_FILES['txtFoto']['name'];
        move_uploaded_file($tmp_foto, $ruta_foto . $nmbreArchivoFoto);

        // Buscar foto anterior para eliminarla
        $sql_foto = "SELECT foto FROM empleados WHERE idEmpleado = ?";
        $sentencia_foto = mysqli_prepare($conexion, $sql_foto);
        mysqli_stmt_bind_param($sentencia_foto, "i", $txtIdEmpleado);
        mysqli_stmt_execute($sentencia_foto);
        $res_foto = mysqli_stmt_get_result($sentencia_foto);
        
        if($registro = mysqli_fetch_assoc($res_foto)){
            if(isset($registro['foto']) && $registro['foto'] != "" && file_exists($ruta_foto . $registro['foto'])){
                unlink($ruta_foto . $registro['foto']);
            }
        }

        // Actualizar nueva foto
        $sql_upd_foto = "UPDATE empleados SET foto = ? WHERE idEmpleado = ?";
        $sentencia_upd_foto = mysqli_prepare($conexion, $sql_upd_foto);
        mysqli_stmt_bind_param($sentencia_upd_foto, "si", $nmbreArchivoFoto, $txtIdEmpleado);
        mysqli_stmt_execute($sentencia_upd_foto);
    }

    // GESTIÓN DE CV
    $txtCv = isset($_FILES['txtCv']['name']) ? $_FILES['txtCv']['name'] : "";
    $tmp_CV = $_FILES['txtCv']['tmp_name'];
    
    if($tmp_CV != ""){
        $nmbreArchivoCV = $fecha->getTimestamp() . "_" . $_FILES['txtCv']['name'];
        move_uploaded_file($tmp_CV, $ruta_CV . $nmbreArchivoCV);

        // Buscar CV anterior para eliminarlo
        $sql_cv = "SELECT cv FROM empleados WHERE idEmpleado = ?";
        $sentencia_cv = mysqli_prepare($conexion, $sql_cv);
        mysqli_stmt_bind_param($sentencia_cv, "i", $txtIdEmpleado);
        mysqli_stmt_execute($sentencia_cv);
        $res_cv = mysqli_stmt_get_result($sentencia_cv);
        
        if($registro = mysqli_fetch_assoc($res_cv)){
            if(isset($registro['cv']) && $registro['cv'] != "" && file_exists($ruta_CV . $registro['cv'])){
                unlink($ruta_CV . $registro['cv']);
            }
        }

        // Actualizar nuevo CV
        $sql_upd_cv = "UPDATE empleados SET cv = ? WHERE idEmpleado = ?";
        $sentencia_upd_cv = mysqli_prepare($conexion, $sql_upd_cv);
        mysqli_stmt_bind_param($sentencia_upd_cv, "si", $nmbreArchivoCV, $txtIdEmpleado);
        mysqli_stmt_execute($sentencia_upd_cv);
    }
        
    header("location: index.php");
    exit();
}

?>
<?php include_once("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        <h2>Editar Empleados</h2>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="idEmpleado" class="form-label">ID:</label>
                <input type="text" value="<?php echo isset($txtID) ? $txtID : ''; ?>" readonly class="form-control" name="txtIdEmpleado"
                    id="idEmpleado" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idPrimerApellido" class="form-label">Primer Apellido:</label>
                <input type="text" value="<?php echo isset($txtPrimerApellido) ? $txtPrimerApellido : ''; ?>" class="form-control"
                    name="txtPrimerApellido" id="idPrimerApellido" aria-describedby="helpId" placeholder="" required>
            </div>

            <div class="mb-3">
                <label for="idSegundoApellido" class="form-label">Segundo Apellido:</label>
                <input type="text" value="<?php echo isset($txtSegundoApellido) ? $txtSegundoApellido : ''; ?>" class="form-control"
                    name="txtSegundoApellido" id="idSegundoApellido" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idPrimerNombre" class="form-label">Primer Nombre:</label>
                <input type="text" value="<?php echo isset($txtPrimerNombre) ? $txtPrimerNombre : ''; ?>" class="form-control" name="txtPrimerNombre"
                    id="idPrimerNombre" aria-describedby="helpId" placeholder="" required>
            </div>

            <div class="mb-3">
                <label for="idSegundoNombre" class="form-label">Segundo Nombre:</label>
                <input type="text" value="<?php echo isset($txtSegundoNombre) ? $txtSegundoNombre : ''; ?>" class="form-control" name="txtSegundoNombre"
                    id="idSegundoNombre" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idFoto" class="form-label">Foto:</label><br>
                <img width="50" src="<?php echo $ruta_foto . (isset($txtFoto) ? $txtFoto : ''); ?>" alt="" class="img-fluid rounded">
                <input type="file" class="form-control mt-2" name="txtFoto" id="idFoto" placeholder=""
                    aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idCv" class="form-label">CV (pdf):</label><br>
                <a target="_blank" href="<?php echo $ruta_CV . (isset($txtCV) ? $txtCV : ''); ?>"><?php echo isset($txtCV) ? $txtCV : ''; ?></a>
                <input type="file" class="form-control mt-2" name="txtCv" id="idCv" placeholder=""
                    aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto: </label>
                <select class="form-select form-select-sm" name="txtIdPuesto" id="idPuesto" required>
                    <option value="">Select one</option>
                    <?php if(isset($lista_puestos)) { foreach($lista_puestos as $puesto){ ?>
                    <option <?php echo (isset($txtIdPuesto) && $txtIdPuesto == $puesto['idPuesto']) ? "selected" : ""; ?>
                        value="<?php echo $puesto['idPuesto']; ?>"><?php echo $puesto['puesto']; ?></option>
                    <?php }} ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="idFechaIngreso" class="form-label">Fecha de Ingreso:</label>
                <input type="date" value="<?php echo isset($txtFechaIngreso) ? $txtFechaIngreso : ''; ?>" class="form-control" name="txtFechaIngreso"
                    id="idFechaIngreso" aria-describedby="emailHelpId" required>
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