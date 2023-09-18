<?php  
include('../../db.php');

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? $_GET['txtId'] : "";
    $sentencia=$conexion->prepare("DELETE FROM puestos WHERE idPuesto=:txtId");   
    $sentencia->bindParam(":txtId", $txtId);
    $sentencia->execute();
    header("location: index.php");
}

$sentencia=$conexion->prepare("SELECT * FROM puestos");
$sentencia->execute();
$lista_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
//print_r($lista_puestos);
?>
<?php  include_once('../../templates/header.php');  ?>

<h2>Listado de Puestos</h2>
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
                    <th scope="col">Puesto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_puestos as $puesto){ ?>
                    <tr class="">
                        <td scope="row"><?php echo $puesto['idPuesto']; ?></td>
                        <td><?php echo $puesto['puesto']; ?></td>
                        <td>
                            <a name="btn" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $puesto['idPuesto']; ?>" role="button">Editar</a>  
                            <a name="btn" id="" class="btn btn-danger" href="index.php?txtId=<?php echo $puesto['idPuesto']; ?>" role="button">Eliminar</a> 
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