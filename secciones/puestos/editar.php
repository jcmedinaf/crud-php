<?php  
include('../../db.php');

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? $_GET['txtId'] : "";
    $sentencia=$conexion->prepare("SELECT * FROM puestos WHERE idPuesto=:txtId");   
    $sentencia->bindParam(":txtId", $txtId);
    $sentencia->execute();
    $puestos=$sentencia->fetch(PDO::FETCH_LAZY);
    $txtID = $puestos['idPuesto'];
    $txtPuesto = $puestos['puesto'];
}


if($_POST){
   // print_r($_POST);

//RECOLECTAMOS LOS DATOS DEL METODO POST
    $txtIdPuesto = (isset($_POST['txtIdPuesto']) ? $_POST['txtIdPuesto'] : "");
    $txtPuesto = (isset($_POST['txtPuesto']) ? $_POST['txtPuesto'] : "");
//PREPARAR LA INSERCION DE DATOS
    $sentencia=$conexion->prepare("UPDATE puestos SET puesto=:txtPuesto WHERE idPuesto=:txtIdPuesto");   

    //ASIGNANDO LOS VALORES QUE VIENEN DEL METODO POST
    $sentencia->bindParam(":txtIdPuesto", $txtIdPuesto);
    $sentencia->bindParam(":txtPuesto", $txtPuesto);
    $sentencia->execute();
    header("location: index.php");
}


?>

<?php include("../../templates/header.php") ?>

<div class="card">
    <div class="card-header">
        <h2>Editar Puestos</h2>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="idPuesto" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID; ?>" readonly class="form-control" name="txtIdPuesto" id="idPuesto" aria-describedby="helpId"
                    placeholder="">
            </div>

            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto:</label>
                <input type="text" value="<?php echo $txtPuesto; ?>" class="form-control" name="txtPuesto" id="idPuesto" aria-describedby="helpId"
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
