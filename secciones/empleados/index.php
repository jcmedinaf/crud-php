<?php  
include('../../db.php');
$ruta_foto = '../../assets/img/fotos/';
$ruta_CV = '../../assets/pdf/';

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? $_GET['txtId'] : "";
    $sentencia=$conexion->prepare("SELECT foto, cv FROM empleados WHERE idEmpleado=:txtId");   
    $sentencia->bindParam(":txtId", $txtId);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    print_r($registro);
    if(isset($registro['foto']) && $registro['foto'] !=""){
        if(file_exists($ruta_foto . $registro['foto'])){
            unlink($ruta_foto . $registro['foto']);
        }
    }

    if(isset($registro['cv']) && $registro['cv'] !=""){
        if(file_exists($ruta_CV . $registro['cv'])){
            unlink($ruta_CV . $registro['cv']);
        }
    }

    $sentencia=$conexion->prepare("DELETE FROM empleados WHERE idEmpleado=:txtId");   
    $sentencia->bindParam(":txtId", $txtId);
    $sentencia->execute();
    header("location: index.php");
}

$sentencia=$conexion->prepare("SELECT *, (SELECT puesto FROM puestos p where p.idPuesto = e.idPuesto) as puesto FROM empleados e");
$sentencia->execute();
$lista_empleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);
//print_r($lista_empleados);
?>
<?php  include_once('../../templates/header.php');  ?>

<h2>Listado de Empleados</h2>
<div class="card">
    <div class="card-header">
        <a name="btn" id="" class="btn btn-primary" href="crear.php" role="button">Agregar</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tablaID">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de Ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_empleados as $empleados){ ?>
                    <tr class="">
                        <td scope="row"><?php echo $empleados['idEmpleado']; ?></td>
                        <td><?php echo $empleados['primer_nombre']; ?> <?php echo $empleados['segundo_nombre']; ?>
                            <?php echo $empleados['primer_apellido']; ?> <?php echo $empleados['segundo_apellido']; ?>
                        </td>
                        <td>
                            <img width="50" src="<?php echo $ruta_foto.$empleados['foto']; ?>" alt=""
                                class="img-fluid rounded">

                        </td>
                        <td><a href="<?php echo $ruta_CV . $empleados['cv']; ?>" target="_blank"><?php echo $empleados['cv']; ?></a></td>
                        <td><?php echo $empleados['puesto']; ?></td>
                        <td><?php echo $empleados['fecha_ingreso']; ?></td>
                        <td>
                            <a name="btn" id="" class="btn btn-secondary"  href="carta.php?txtId=<?php echo $empleados['idEmpleado']; ?>" role="button">Carta</a>
                            <a name="btn" id="" class="btn btn-info"
                                href="editar.php?txtId=<?php echo $empleados['idEmpleado']; ?>" role="button">Editar</a>
                            <a name="btn" id="" class="btn btn-danger"
                                href="index.php?txtId=<?php echo $empleados['idEmpleado']; ?>"
                                role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>


<?php  include_once('../../templates/footer.php');  ?>