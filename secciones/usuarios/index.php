<?php  
include('../../db.php');

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? $_GET['txtId'] : "";
    $sentencia=$conexion->prepare("DELETE FROM usuarios WHERE idUsuario=:txtId");   
    $sentencia->bindParam(":txtId", $txtId);
    $sentencia->execute();
    header("location: index.php");
}

$sentencia=$conexion->prepare("SELECT * FROM usuarios");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
//print_r($lista_usuarios);
?>
<?php  include_once('../../templates/header.php');  ?>

<h2>Listado de Usuarios</h2>
<div class="card">
    <div class="card-header">
        <a name="btn" id="" class="btn btn-primary" href="crear.php" role="button">Agregar</a>
    </div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <table class="table">
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
                        <td scope="row"><?php echo  $usuarios['idUsuario']; ?></td>
                        <td><?php echo  $usuarios['nombre']; ?></td>
                        <td><?php echo  $usuarios['apellido']; ?></td>
                        <td><?php echo  $usuarios['correo']; ?></td>
                        <td>****</td>
                        <td>
                            <a name="btn" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $usuarios['idUsuario']; ?>" role="button">Editar</a>  
                            <a name="btn" id="" class="btn btn-danger" href="index.php?txtId=<?php echo $usuarios['idUsuario']; ?>" role="button">Eliminar</a> 
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

<?php include("../../templates/footer.php") ?>