<?php  
include('../../db.php');

if($_POST){
    //print_r($_POST);
    //print_r($_FILES);

    //RECOLECTAMOS LOS DATOS DEL METODO POST
    $txtPrimerNombre = (isset($_POST['txtPrimerNombre']) ? $_POST['txtPrimerNombre'] : "");
    $txtSegundoNombre = (isset($_POST['txtSegundoNombre']) ? $_POST['txtSegundoNombre'] : "");
    $txtPrimerApellido = (isset($_POST['txtPrimerApellido']) ? $_POST['txtPrimerApellido'] : "");
    $txtSegundoApellido = (isset($_POST['txtSegundoApellido']) ? $_POST['txtSegundoApellido'] : "");
    $txtIdPuesto = (isset($_POST['txtIdPuesto']) ? $_POST['txtIdPuesto'] : "");
    $txtFechaIngreso = (isset($_POST['txtFechaIngreso']) ? $_POST['txtFechaIngreso'] : "");
    
    $txtFoto = (isset($_FILES['txtFoto']['name']) ? $_FILES['txtFoto']['name'] : "");
    $txtCv = (isset($_FILES['txtCv']['name']) ? $_FILES['txtCv']['name'] : "");

    //PREPARAR LA INSERCION DE DATOS
    $sentencia=$conexion->prepare("INSERT INTO empleados (idEmpleado, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, idPuesto, fecha_ingreso, foto, cv) VALUES(null, :txtPrimerNombre, :txtSegundoNombre, :txtPrimerApellido, :txtSegundoApellido, :txtIdPuesto, :txtFechaIngreso, :txtFoto, :txtCv)");   

    //ASIGNANDO LOS VALORES QUE VIENEN DEL METODO POST
    $sentencia->bindParam(":txtPrimerApellido", $txtPrimerApellido);
    $sentencia->bindParam(":txtSegundoApellido", $txtSegundoApellido);
    $sentencia->bindParam(":txtPrimerNombre", $txtPrimerNombre);
    $sentencia->bindParam(":txtSegundoNombre", $txtSegundoNombre);
    $sentencia->bindParam(":txtIdPuesto", $txtIdPuesto);
    $sentencia->bindParam(":txtFechaIngreso", $txtFechaIngreso);

    $fecha = new DateTime();
    $nmbreArchivoFoto = ($txtFoto!="") ? $fecha->getTimestamp()."_".$_FILES['txtFoto']['name'] : "silueta.png";
    $tmp_foto = $_FILES['txtFoto']['tmp_name'];
    $ruta_foto = '../../assets/img/fotos/';
    if($tmp_foto != ""){
        move_uploaded_file($tmp_foto, $ruta_foto . $nmbreArchivoFoto);
    }
    $sentencia->bindParam(":txtFoto", $nmbreArchivoFoto);


    $nmbreArchivoCV = ($txtCv!="") ? $fecha->getTimestamp()."_".$_FILES['txtCv']['name'] : "";
    $tmp_CV = $_FILES['txtCv']['tmp_name'];
    $ruta_CV = '../../assets/pdf/';
    if($tmp_CV != ""){
        move_uploaded_file($tmp_CV, $ruta_CV . $nmbreArchivoCV);
    }
    $sentencia->bindParam(":txtCv", $txtCv);

    $sentencia->execute();
    header("location: index.php");
}


$sentencia=$conexion->prepare("SELECT * FROM puestos");
$sentencia->execute();
$lista_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../templates/header.php") ?>

<div class="card">
    <div class="card-header">
        <h2>Crear Empleados</h2>

    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="idPrimerApellido" class="form-label">Primer Apellido:</label>
                <input type="text" class="form-control" name="txtPrimerApellido" id="idPrimerApellido"
                    aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idSegundoApellido" class="form-label">Segundo Apellido:</label>
                <input type="text" class="form-control" name="txtSegundoApellido" id="idSegundoApellido"
                    aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idPrimerNombre" class="form-label">Primer Nombre:</label>
                <input type="text" class="form-control" name="txtPrimerNombre" id="idPrimerNombre"
                    aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idSegundoNombre" class="form-label">Segundo Nombre:</label>
                <input type="text" class="form-control" name="txtSegundoNombre" id="idSegundoNombre"
                    aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idFoto" class="form-label">Foto:</label>
                <input type="file" class="form-control" name="txtFoto" id="idFoto" placeholder=""
                    aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idCv" class="form-label">CV (pdf):</label>
                <input type="file" class="form-control" name="txtCv" id="idCv" placeholder=""
                    aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto:</label>
                <select class="form-select form-select-sm" name="txtIdPuesto" id="idPuesto">
                    <option selected>Select one</option>
                    <?php foreach($lista_puestos as $puesto){ ?>
                        <option value="<?php echo $puesto['idPuesto']; ?>"><?php echo  $puesto['puesto']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="idFechaIngreso" class="form-label">Fecha de Ingreso:</label>
                <input type="date" class="form-control" name="txtFechaIngreso" id="idFechaIngreso"
                    aria-describedby="emailHelpId" placeholder="abc@mail.com">
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