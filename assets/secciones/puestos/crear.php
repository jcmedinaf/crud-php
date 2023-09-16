<?php include("../../../templates/header.php") ?>

<div class="card">
    <div class="card-header">
        <h2>Crear Puestos</h2>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto:</label>
                <input type="text" class="form-control" name="txtPuesto" id="idPuesto" aria-describedby="helpId" placeholder="">
            </div>

            


            <div class="mb-3">
                <button name="" id="" class="btn btn-success" type="submit" value="Agregar">Agregar</button>
                <a name="" id=""  href="index.php" class="btn btn-primary" role="button">Cancelar</a>
            </div>


        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
    
</div>
<?php include("../../../templates/footer.php") ?>