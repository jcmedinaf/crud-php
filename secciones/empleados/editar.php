<?php  
include('../../db.php');
$ruta_foto = '../../assets/img/fotos/';
$ruta_CV = '../../assets/pdf/';

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? $_GET['txtId'] : "";
    $sentencia=$conexion->prepare("SELECT * FROM empleados WHERE idEmpleado=:txtId");   
    $sentencia->bindParam(":txtId", $txtId);
    $sentencia->execute();
    $empleado=$sentencia->fetch(PDO::FETCH_LAZY);
    $txtID = $empleado['idEmpleado'];
  

    $txtPrimerNombre = $empleado['primer_nombre'];
    $txtSegundoNombre = $empleado['segundo_nombre'];
    $txtPrimerApellido = $empleado['primer_apellido'];
    $txtSegundoApellido = $empleado['segundo_apellido'];
    $txtIdPuesto = $empleado['idPuesto'];
    $txtFechaIngreso = $empleado['fecha_ingreso'];
    
    $txtFoto = $empleado['foto'];
    $txtCV = $empleado['cv'];


    $sentencia=$conexion->prepare("SELECT * FROM puestos");
    $sentencia->execute();
    $lista_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

}

if($_POST){
    print_r($_POST);
    print_r($_FILES);

    //RECOLECTAMOS LOS DATOS DEL METODO POST
    $txtIdEmpleado = (isset($_POST['txtIdEmpleado']) ? $_POST['txtIdEmpleado'] : "");

    $txtPrimerNombre = (isset($_POST['txtPrimerNombre']) ? $_POST['txtPrimerNombre'] : "");
    $txtSegundoNombre = (isset($_POST['txtSegundoNombre']) ? $_POST['txtSegundoNombre'] : "");
    $txtPrimerApellido = (isset($_POST['txtPrimerApellido']) ? $_POST['txtPrimerApellido'] : "");
    $txtSegundoApellido = (isset($_POST['txtSegundoApellido']) ? $_POST['txtSegundoApellido'] : "");
    $txtIdPuesto = (isset($_POST['txtIdPuesto']) ? $_POST['txtIdPuesto'] : "");
    $txtFechaIngreso = (isset($_POST['txtFechaIngreso']) ? $_POST['txtFechaIngreso'] : "");
    
   

    //PREPARAR LA INSERCION DE DATOS
    $sentencia=$conexion->prepare("UPDATE empleados SET  primer_nombre=:txtPrimerNombre, segundo_nombre=:txtSegundoNombre, primer_apellido=:txtPrimerApellido, segundo_apellido=:txtSegundoApellido, idPuesto=:txtIdPuesto, fecha_ingreso=:txtFechaIngreso WHERE idEmpleado=:txtIdEmpleado");   
    
    //ASIGNANDO LOS VALORES QUE VIENEN DEL METODO POST
    $sentencia->bindParam(":txtPrimerApellido", $txtPrimerApellido);
    $sentencia->bindParam(":txtSegundoApellido", $txtSegundoApellido);
    $sentencia->bindParam(":txtPrimerNombre", $txtPrimerNombre);
    $sentencia->bindParam(":txtSegundoNombre", $txtSegundoNombre);
    $sentencia->bindParam(":txtIdPuesto", $txtIdPuesto);
    $sentencia->bindParam(":txtFechaIngreso", $txtFechaIngreso);
    $sentencia->bindParam(":txtIdEmpleado", $txtIdEmpleado);
    $sentencia->execute();


    $fecha = new DateTime();
    
    $txtFoto = (isset($_FILES['txtFoto']['name']) ? $_FILES['txtFoto']['name'] : "");
    
    $nmbreArchivoFoto = ($txtFoto!="") ? $fecha->getTimestamp()."_".$_FILES['txtFoto']['name'] : "silueta.png";
    $tmp_foto = $_FILES['txtFoto']['tmp_name'];
    if($tmp_foto != ""){
        move_uploaded_file($tmp_foto, $ruta_foto . $nmbreArchivoFoto);

        $sentencia=$conexion->prepare("SELECT foto FROM empleados WHERE idEmpleado=:txtId");   
        $sentencia->bindParam(":txtId", $txtId);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        if(isset($registro['foto']) && $registro['foto'] !=""){
            if(file_exists($ruta_foto . $registro['foto'])){
                unlink($ruta_foto . $registro['foto']);
            }
        }

        $sentencia=$conexion->prepare("UPDATE empleados SET  foto=:txtFoto WHERE idEmpleado=:txtIdEmpleado");   
        $sentencia->bindParam(":txtFoto", $nmbreArchivoFoto);
        $sentencia->bindParam(":txtIdEmpleado", $txtIdEmpleado);
        $sentencia->execute();
    }


    $txtCv = (isset($_FILES['txtCv']['name']) ? $_FILES['txtCv']['name'] : "");
      
    $nmbreArchivoCV = ($txtCv!="") ? $fecha->getTimestamp()."_".$_FILES['txtCv']['name'] : "";
    $tmp_CV = $_FILES['txtCv']['tmp_name'];
    if($tmp_CV != ""){
        move_uploaded_file($tmp_CV, $ruta_CV . $nmbreArchivoCV);

        $sentencia=$conexion->prepare("SELECT cv FROM empleados WHERE idEmpleado=:txtId");   
        $sentencia->bindParam(":txtId", $txtId);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        if(isset($registro['cv']) && $registro['cv'] !=""){
            if(file_exists($ruta_CV . $registro['cv'])){
                unlink($ruta_CV . $registro['cv']);
            }
        }

        $sentencia=$conexion->prepare("UPDATE empleados SET   cv=txtCv WHERE idEmpleado=:txtIdEmpleado");   
        $sentencia->bindParam(":txtCv", $txtCv);
        $sentencia->bindParam(":txtIdEmpleado", $txtIdEmpleado);
        $sentencia->execute();
        
        header("location: index.php");
    }
            
}

?>
<?php include("../../templates/header.php") ?>

<div class="card">
    <div class="card-header">
        <h2>Editar Empleados</h2>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="idEmpleado" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID; ?>" readonly class="form-control" name="txtIdEmpleado"
                    id="idEmpleado" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idPrimerApellido" class="form-label">Primer Apellido:</label>
                <input type="text" value="<?php echo $txtPrimerApellido; ?>" class="form-control"
                    name="txtPrimerApellido" id="idPrimerApellido" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idSegundoApellido" class="form-label">Segundo Apellido:</label>
                <input type="text" value="<?php echo $txtSegundoApellido; ?>" class="form-control"
                    name="txtSegundoApellido" id="idSegundoApellido" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idPrimerNombre" class="form-label">Primer Nombre:</label>
                <input type="text" value="<?php echo $txtPrimerNombre; ?>" class="form-control" name="txtPrimerNombre"
                    id="idPrimerNombre" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idSegundoNombre" class="form-label">Segundo Nombre:</label>
                <input type="text" value="<?php echo $txtSegundoNombre; ?>" class="form-control" name="txtSegundoNombre"
                    id="idSegundoNombre" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idFoto" class="form-label">Foto:</label><br>
                <img width="50" src="<?php echo $ruta_foto.$txtFoto; ?>" alt="" class="img-fluid rounded">
                <input type="file" class="form-control" name="txtFoto" id="idFoto" placeholder=""
                    aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idCv" class="form-label">CV (pdf):</label><br>
                <a target="_blanck" href="<?php echo $ruta_CV.$txtCV; ?>"><?php echo $txtCV; ?></a>
                <input type="file" class="form-control" name="txtCv" id="idCv" placeholder=""
                    aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto: </label>
                <select class="form-select form-select-sm" name="txtIdPuesto" id="idPuesto">
                    <option selected>Select one</option>
                    <?php foreach($lista_puestos as $puesto){ ?>
                    <option <?php echo ($txtIdPuesto == $puesto['idPuesto']) ? "selected" : ""; ?>
                        value="<?php echo $puesto['idPuesto']; ?>"><?php echo  $puesto['puesto']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="idFechaIngreso" class="form-label">Fecha de Ingreso:</label>
                <input type="date" value="<?php echo $txtFechaIngreso; ?>" class="form-control" name="txtFechaIngreso"
                    id="idFechaIngreso" aria-describedby="emailHelpId" placeholder="abc@mail.com">
            </div>

            <div class="mb-3">
                <button name="" id="" class="btn btn-success" type="submit" value="Agregar">Actualizar</button>
                <a name="" id="" href="index.php" class="btn btn-primary" role="button">Cancelar</a>
            </div>


        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php") ?>