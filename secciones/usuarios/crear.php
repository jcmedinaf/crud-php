<?php  
include('../../db.php');

if($_POST){
    print_r($_POST);

//RECOLECTAMOS LOS DATOS DEL METODO POST
    $txtNombre = (isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "");
    $txtApellido = (isset($_POST['txtApellido']) ? $_POST['txtApellido'] : "");
    $txtCorreo = (isset($_POST['txtCorreo']) ? $_POST['txtCorreo'] : "");
    $txtContrasena = (isset($_POST['txtContrasena']) ? $_POST['txtContrasena'] : "");
//PREPARAR LA INSERCION DE DATOS
    $sentencia=$conexion->prepare("INSERT INTO usuarios (idUsuario, nombre, apellido, correo, clave) VALUES (null, :txtNombre, :txtApellido, :txtCorreo, :txtContrasena)");   

    //ASIGNANDO LOS VALORES QUE VIENEN DEL METODO POST
    $sentencia->bindParam(":txtNombre", $txtNombre);
    $sentencia->bindParam(":txtApellido", $txtApellido);
    $sentencia->bindParam(":txtCorreo", $txtCorreo);
    $sentencia->bindParam(":txtContrasena", MD5($txtContrasena));
    $sentencia->execute();
    header("location: index.php");
}

?>
<?php include("../../templates/header.php") ?>

<div class="card">
    <div class="card-header">
        <h2>Crear Usuarios</h2>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="idNombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="txtNombre" id="idNombre" aria-describedby="helpId"
                    placeholder="">
            </div>

            <div class="mb-3">
                <label for="idApellido" class="form-label">Apellido:</label>
                <input type="text" class="form-control" name="txtApellido" id="idApellido" aria-describedby="helpId"
                    placeholder="">
            </div>

            <div class="mb-3">
                <label for="idCorreo" class="form-label">Correo:</label>
                <input type="email" class="form-control" name="txtCorreo" id="idCorreo" aria-describedby="helpId"
                    placeholder="">
            </div>

            <div class="mb-3">
                <label for="idContrasena" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="txtContrasena" id="idContrasena" aria-describedby="helpId"
                    placeholder="">
            </div>

            <div class="mb-3">
                <button name="" id="" class="btn btn-success" type="submit" value="Agregar">Agregar</button>
                <a name="" id="" href="index.php" class="btn btn-primary" role="button">Cancelar</a>
            </div>


        </form>

    </div>
    <div class="card-footer text-muted">

    </div>

</div>

<?php include("../../templates/footer.php") ?>