<?php
/*
=====================================================================
 ARCHIVO: index.php (Sección Usuarios)
 DESCRIPCIÓN: Listado, gestión y eliminación de usuarios con MySQLi.
 PROYECTO: crud-php (Fines educativos)
 AUTOR: Juan Carlos Medina
=====================================================================
*/

include_once __DIR__ . '/../../db.php';

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? mysqli_real_escape_string($conexion, $_GET['txtId']) : "";
    
    // Consulta preparada usando MySQLi para eliminar
    $sql = "DELETE FROM usuarios WHERE idUsuario = ?";
    $sentencia = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($sentencia, "i", $txtId);
    mysqli_stmt_execute($sentencia);
    
    header("location: index.php");
    exit();
}

// Obtener el listado de usuarios usando MySQLi
$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexion, $sql);
$lista_usuarios = [];
if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $lista_usuarios[] = $fila;
    }
}
?>
<?php include_once('../../templates/header.php'); ?>

<h2>Listado de Usuarios</h2>
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
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Clave</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_usuarios as $usuarios){ ?>
                    <tr class="">
                        <td scope="row"><?php echo $usuarios['idUsuario']; ?></td>
                        <td><?php echo $usuarios['nombre']; ?></td>
                        <td><?php echo $usuarios['apellido']; ?></td>
                        <td><?php echo $usuarios['correo']; ?></td>
                        <td>****</td>
                        <td>
                            <a name="btn" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $usuarios['idUsuario']; ?>" role="button">Editar</a>  
                            <a name="btn" id="" class="btn btn-danger" href="javascript:borrar(<?php echo $usuarios['idUsuario']; ?>)" role="button">Eliminar</a> 
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

<?php include("../../templates/footer.php") ?>