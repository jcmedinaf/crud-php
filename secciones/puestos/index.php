<?php  include_once('../../templates/header.php');  ?>

<h2>Listado de Puestos</h2>
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
                    <th scope="col">Puesto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td scope="row">1</td>
                    <td>Programador Junior</td>
                    <td>
                        <a name="btn" id="" class="btn btn-info" href="#" role="button">Editar</a>  
                        <a name="btn" id="" class="btn btn-danger" href="#" role="button">Eliminar</a> 
                    </td>
                </tr>
            </tbody>
        </table>
      </div>
      
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>
<?php include("../../../templates/footer.php") ?>