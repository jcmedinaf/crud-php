<?php  
include('../../db.php');

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? $_GET['txtId'] : "";
    $sentencia=$conexion->prepare("SELECT * FROM usuarios WHERE idUsuario=:txtId");   
    $sentencia->bindParam(":txtId", $txtId);
    $sentencia->execute();
    $usuario=$sentencia->fetch(PDO::FETCH_LAZY);
    $txtIdUsuario = $usuario['idUsuario'];
    $txtNombre = $usuario['nombre'];
    $txtApellido = $usuario['apellido'];
    $txtCorreo = $usuario['correo'];
    $txtContrasena = $usuario['clave'];
    echo $txtApellido;
}


if($_POST){
    print_r($_POST);

//RECOLECTAMOS LOS DATOS DEL METODO POST
$txtIdUsuario = isset($_GET['txtId']) ? $_GET['txtId'] : "";
$txtNombre = (isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "");
$txtApellido = (isset($_POST['txtApellido']) ? $_POST['txtApellido'] : "");
$txtCorreo = (isset($_POST['txtCorreo']) ? $_POST['txtCorreo'] : "");
$txtContrasena = (isset($_POST['txtContrasena']) ? $_POST['txtContrasena'] : "");

//PREPARAR LA INSERCION DE DATOS
    $sentencia=$conexion->prepare("UPDATE usuarios SET nombre=:txtNombre, apellido=:txtApellido, correo=:txtCorreo, clave=:txtContrasena WHERE idUsuario=:txtIdUsuario");   

    //ASIGNANDO LOS VALORES QUE VIENEN DEL METODO POST
    $sentencia->bindParam(":txtIdUsuario", $txtIdUsuario);
    $sentencia->bindParam(":txtNombre", $txtNombre);
    $sentencia->bindParam(":txtApellido", $txtApellido);
    $sentencia->bindParam(":txtCorreo", $txtCorreo);
    $sentencia->bindParam(":txtContrasena", $txtContrasena);
    $sentencia->execute();
    header("location: index.php");
}


?>

<?php include("../../templates/header.php") ?>

<div class="card">
    <div class="card-header">
        <h2>Editar Usuarios</h2>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="idUsuario" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtIdUsuario; ?>" readonly class="form-control" name="txtIdUsuario"
                    id="idUsuario" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idNombre" class="form-label">Nombre:</label>
                <input type="text" value="<?php echo $txtNombre; ?>" class="form-control" name="txtNombre" id="idNombre" aria-describedby="helpId"
                    placeholder="">
            </div>

            <div class="mb-3">
                <label for="idApellido" class="form-label">Apellido:</label>
                <input type="text" value="<?php echo $txtApellido; ?>" class="form-control" name="txtApellido" id="idApellido" aria-describedby="helpId"
                    placeholder="">
            </div>

            <div class="mb-3">
                <label for="idCorreo" class="form-label">Correo:</label>
                <input type="email" value="<?php echo $txtCorreo; ?>" class="form-control" name="txtCorreo" id="idCorreo" aria-describedby="helpId"
                    placeholder="">
            </div>

            <div class="mb-3">
                <label for="idContrasena" class="form-label">Contraseña:</label>
                <input type="password" value="<?php echo $txtContrasena; ?>" class="form-control" name="txtContrasena" id="idContrasena" aria-describedby="helpId"
                    placeholder="">
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
<?php include("../../templates/footer.php") ?>