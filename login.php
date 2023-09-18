<?php
session_start();
include_once('./db.php');

if($_POST){
    $_SESSION['correo'] = "";
    $_SESSION['logueado'] = false;
    $sentencia=$conexion->prepare("SELECT *, count(*) as total FROM usuarios WHERE correo=:txtCorreo AND clave=:txtClave");
    $txtCorreo = $_POST['txtCorreo'];
    $txtClave = $_POST['txtClave'];

    $sentencia->bindParam(":txtCorreo", $txtCorreo);
    $sentencia->bindParam(":txtClave", $txtClave);

    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    if($registro['total'] > 0){
        $_SESSION['fullName'] = $registro['nombre'] . " " . $registro['apellido'];
        $_SESSION['correo'] = $registro['correo'];
        $_SESSION['logueado'] = true;
        header("Location: index.php");
    }else{
        $mensaje = "Error: usuario y/o clave incorrectos";
        $_SESSION['correo'] = "";
        $_SESSION['logueado'] = false;
    }

}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <br><br>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if(isset($mensaje)){?>
                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo $mensaje; ?></strong>
                        </div>
                        <?php } ?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label" for="idCorreo">Correo:</label>
                                <input class="form-control" type="email" name="txtCorreo" id="idCorreo">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="idClave">Clave:</label>
                                <input class="form-control" type="password" name="txtClave" id="idClave">
                            </div>

                            <button type="submit" class="btn btn-primary">Entrar</button>

                        </form>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>