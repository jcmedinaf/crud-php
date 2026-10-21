<?php
/*
=====================================================================
 ARCHIVO: index.php (Sección Empleados)
 DESCRIPCIÓN: Listado, gestión, eliminación de archivos y registros con MySQLi.
 PROYECTO: crud-php (Fines educativos)
 AUTOR: Juan Carlos Medina
=====================================================================
*/

include_once __DIR__ . '/../../db.php';
$ruta_foto = '../../assets/img/fotos/';
$ruta_CV = '../../assets/pdf/';

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? mysqli_real_escape_string($conexion, $_GET['txtId']) : "";
    
    // Obtener los archivos asociados para eliminarlos del servidor usando MySQLi
    $sql = "SELECT foto, cv FROM empleados WHERE idEmpleado = ?";
    $sentencia = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($sentencia, "i", $txtId);
    mysqli_stmt_execute($sentencia);
    $resultado = mysqli_stmt_get_result($sentencia);
    
    if($registro = mysqli_fetch_assoc($resultado)){
        if(isset($registro['foto']) && $registro['foto'] != ""){
            if(file_exists($ruta_foto . $registro['foto'])){
                unlink($ruta_foto . $registro['foto']);
            }
        }

        if(isset($registro['cv']) && $registro['cv'] != ""){
            if(file_exists($ruta_CV . $registro['cv'])){
                unlink($ruta_CV . $registro['cv']);
            }
        }
    }

    // Eliminar el registro de la base de datos
    $sql_delete = "DELETE FROM empleados WHERE idEmpleado = ?";
    $sentencia_delete = mysqli_prepare($conexion, $sql_delete);
    mysqli_stmt_bind_param($sentencia_delete, "i", $txtId);
    mysqli_stmt_execute($sentencia_delete);
    
    header("location: index.php");
    exit();
}

// Obtener el listado completo de empleados usando MySQLi
$sql = "SELECT e.*, (SELECT puesto FROM puestos p WHERE p.idPuesto = e.idPuesto) as puesto FROM empleados e";
$resultado = mysqli_query($conexion, $sql);
$lista_empleados = [];
if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $lista_empleados[] = $fila;
    }
}
?>
<?php include_once('../../templates/header.php'); ?>

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
                        <td><a href="<?php echo $ruta_CV . $empleados['cv']; ?>"
                                target="_blank"><?php echo $empleados['cv']; ?></a></td>
                        <td><?php echo $empleados['puesto']; ?></td>
                        <td><?php echo $empleados['fecha_ingreso']; ?></td>
                        <td>
                            <a name="btn" id="" class="btn btn-secondary"
                                href="carta.php?txtId=<?php echo $empleados['idEmpleado']; ?>" role="button">Carta</a>
                            <a name="btn" id="" class="btn btn-info"
                                href="editar.php?txtId=<?php echo $empleados['idEmpleado']; ?>" role="button">Editar</a>
                            <a name="btn" id="" class="btn btn-danger"
                                href="javascript:borrar(<?php echo $empleados['idEmpleado']; ?>)"
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

<script>
function borrar(id) {
    Swal.fire({
        title: 'Estas seguro de Eliminar el registro?',
        showCancelButton: true,
        confirmButtonText: 'Si',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            window.location = 'index.php?txtId='+id;
            Swal.fire('Registro Eliminado!', '', 'success')
        } 
    })
}
</script>

<?php include_once('../../templates/footer.php'); ?>