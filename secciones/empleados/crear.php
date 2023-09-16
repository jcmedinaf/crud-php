<?php include("../../templates/header.php") ?>


<div class="card">
    <div class="card-header">
        <h2>Crear Empleados</h2>

    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="idPrimerApellido" class="form-label">Primer Apellido:</label>
                <input type="text" class="form-control" name="txtPrimerApellido" id="idPrimerApellido" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idSegundoApellido" class="form-label">Segundo Apellido:</label>
                <input type="text" class="form-control" name="txtSegundoApellido" id="idSegundoApellido" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idPrimerNombre" class="form-label">Primer Nombre:</label>
                <input type="text" class="form-control" name="txtPrimerNombre" id="idPrimerNombre" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idSegundoNombre" class="form-label">Segundo Nombre:</label>
                <input type="text" class="form-control" name="txtSegundoNombre" id="idSegundoNombre" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idFoto" class="form-label">Foto:</label>
                <input type="file" class="form-control" name="txtFoto" id="idFoto" placeholder="" aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idCv" class="form-label">CV (pdf):</label>
                <input type="file" class="form-control" name="txtCv" id="idCv" placeholder="" aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto:</label>
                <select class="form-select form-select-sm" name="txtPuesto" id="idPuesto">
                    <option selected>Select one</option>
                    <option value="">New Delhi</option>
                    <option value="">Istanbul</option>
                    <option value="">Jakarta</option>
                </select>
            </div>

            <div class="mb-3">
              <label for="idFechaIngreso" class="form-label">Fecha de Ingreso:</label>
              <input type="date" class="form-control" name="txtFechaIngreso" id="idFechaIngreso" aria-describedby="emailHelpId" placeholder="abc@mail.com">
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

<?php include("../../templates/footer.php") ?>