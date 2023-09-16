<?php include("../../../assets/templates/header.php") ?>

<h2>Listado de Empleados</h2>
<div class="card">
    <div class="card-header">
        <a name="btn" id="" class="btn btn-primary" href="crear.php" role="button">Agregar</a>
    </div>
    <div class="card-body">
      <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Foto</th>
                    <th scope="col">CV</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Fecha de Ingreso</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td scope="row">Juan Carlos Medina</td>
                    <td>Foto.jpg</td>
                    <td>CV.pdf</td>
                    <td>Jefe de unidad</td>
                    <td>12/12/2016</td>
                    <td>
                        <a name="btn" id="" class="btn btn-secondary" href="#" role="button">Carta</a> 
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


<?php include("../../../assets/templates/footer.php") ?>