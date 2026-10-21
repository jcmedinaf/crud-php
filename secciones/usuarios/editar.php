<?php
/*
=====================================================================
 ARCHIVO: editar.php (Sección Usuarios)
 DESCRIPCIÓN: Edición y actualización de usuarios utilizando MySQLi.
 PROYECTO: crud-php (Fines educativos)
 AUTOR: Juan Carlos Medina
=====================================================================
*/

include_once __DIR__ . '/../../db.php';

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? mysqli_real_escape_string($conexion, $_GET['txtId']) : "";
    
    // Consulta preparada usando MySQLi para obtener los datos del usuario
    $sql = "SELECT * FROM usuarios WHERE idUsuario = ?";
    $sentencia = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($sentencia, "i", $txtId);
    mysqli_stmt_execute($sentencia);
    $resultado = mysqli_stmt_get_result($sentencia);
    
    if($usuario = mysqli_fetch_assoc($resultado)){
        $txtIdUsuario  = $usuario['idUsuario'];
        $txtNombre     = $usuario['nombre'];
        $txtApellido   = $usuario['apellido'];
        $txtCorreo     = $usuario['correo'];
        $txtContrasena = $usuario['clave'];
    }
}

if($_POST){
    // RECOLECTAMOS LOS DATOS DEL METODO POST DE FORMA SEGURA
    $txtIdUsuario  = isset($_POST['txtIdUsuario']) ? $_POST['txtIdUsuario'] : "";
    $txtNombre     = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
    $txtApellido   = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : "";
    $txtCorreo     = isset($_POST['txtCorreo']) ? $_POST['txtCorreo'] : "";
    $txtContrasena = isset($_POST['txtContrasena']) ? $_POST['txtContrasena'] : "";

    // PREPARAR LA ACTUALIZACION DE DATOS CON MYSQLI
    $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, correo = ?, clave = ? WHERE idUsuario = ?";
    $sentencia = mysqli_prepare($conexion, $sql);
    
    // ASIGNANDO LOS VALORES Y EJECUTANDO
    mysqli_stmt_bind_param($sentencia, "ssssi", $txtNombre, $txtApellido, $txtCorreo, $txtContrasena, $txtIdUsuario);
    mysqli_stmt_execute($sentencia);
    
    header("location: index.php");
    exit();
}

?>

<?php include_once("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        <h2>Editar Usuarios</h2>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="idUsuario" class="form-label">ID:</label>
                <input type="text" value="<?php echo isset($txtIdUsuario) ? $txtIdUsuario : ''; ?>" readonly class="form-control" name="txtIdUsuario"
                    id="idUsuario" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idNombre" class="form-label">Nombre:</label>
                <input type="text" value="<?php echo isset($txtNombre) ? $txtNombre : ''; ?>" class="form-control" name="txtNombre" id="idNombre" aria-describedby="helpId"
                    placeholder="" required>
            </div>

            <div class="mb-3">
                <label for="idApellido" class="form-label">Apellido:</label>
                <input type="text" value="<?php echo isset($txtApellido) ? $txtApellido : ''; ?>" class="form-control" name="txtApellido" id="idApellido" aria-describedby="helpId"
                    placeholder="" required>
            </div>

            <div class="mb-3">
                <label for="idCorreo" class="form-label">Correo:</label>
                <input type="email" value="<?php echo isset($txtCorreo) ? $txtCorreo : ''; ?>" class="form-control" name="txtCorreo" id="idCorreo" aria-describedby="helpId"
                    placeholder="" required>
            </div>

            <div class="mb-3">
                <label for="idContrasena" class="form-label">Contraseña:</label>
                <input type="text" value="<?php echo isset($txtContrasena) ? $txtContrasena : ''; ?>" class="form-control" name="txtContrasena" id="idContrasena" aria-describedby="helpId"
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