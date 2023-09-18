<?php
include('../../db.php');
$ruta_foto = '../../assets/img/fotos/';
$ruta_CV = '../../assets/pdf/';

if(isset($_GET['txtId'])){
    $txtId = isset($_GET['txtId']) ? $_GET['txtId'] : "";
    $sentencia=$conexion->prepare("SELECT *, (SELECT puesto FROM puestos p where p.idPuesto = e.idPuesto) as puesto FROM empleados e WHERE e.idEmpleado=:txtId");   
    $sentencia->bindParam(":txtId", $txtId);
    $sentencia->execute();
    $empleado=$sentencia->fetch(PDO::FETCH_LAZY);
    $txtID = $empleado['idEmpleado'];
  
    //print_r($empleado);

    $txtPrimerNombre = $empleado['primer_nombre'];
    $txtSegundoNombre = $empleado['segundo_nombre'];
    $txtPrimerApellido = $empleado['primer_apellido'];
    $txtSegundoApellido = $empleado['segundo_apellido'];
    $txtIdPuesto = $empleado['idPuesto'];
    $txtFechaIngreso = $empleado['fecha_ingreso'];
    $txtPuesto = $empleado['puesto'];

    $fechaInicio = new DateTime($txtFechaIngreso);
    $fechaFin = new DateTime(date('Y-m-d'));
    $diferencia = date_diff($fechaInicio, $fechaFin);
    $fechaActual = date('d-m-Y');

    $txtFoto = $empleado['foto'];
    $txtCV = $empleado['cv'];

    $fullName = $txtPrimerNombre . " " . $txtSegundoNombre. " " . $txtPrimerApellido . " " . $txtSegundoApellido;

    ob_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Carta de Recomendación Laboral</h1>
    <br><br>
    Maracaibo, <strong><?php echo $fechaActual;  ?></strong>
    <br><br>
    A quien pueda interesar:
    <br><br>
    Reciba un cordial y respetuoso saludo.
    <br><br>
    A través de estas líneas dese o hacer de su conocimiento que el(la) Sr(a) <strong><?php echo $fullName; ?></strong>, quíen laboró en mi organicación durante <strong><?php echo $diferencia->y; ?> años</strong>, es un ciudadano con una conducta intachable. Ha desmitrador ser un gran trabajador, comprometido, responsable y fiel cumplidor de sus tareas. Siempre ha manifestado preocupación por mejorar, capracitarse y actualzar sus conocimientos.
    <br><br>
    Durante estos años se ha desempeñado como: <strong> <?php echo $txtPuesto; ?> </strong>.
    Es por ellos le sugiero considere esta recomendación, con la confianza de que estará sempre a la altura de sus compromisos y responsabilidades.
    <br><br>
    Sin más nada a que referime y, esperando que esta misiva sea tomada en cuenta, dejo mi número de contacto para cualquier información de interés.
    <br><br><br>
    Atentamente,
    <br><br>

    Ing. Juan C. Medina
</body>
</html>

<?php
$HTML = ob_get_clean();
require_once('../../libs/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));

$dompdf->setOptions($opciones);
$dompdf->loadHtml($HTML);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf",array("Attachment"=>false));
?>