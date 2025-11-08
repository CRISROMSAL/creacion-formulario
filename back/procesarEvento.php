<?php
// Recibir datos del formulario
$nombre = $_POST['nombre']; // Obtiene el valor del campo nombre enviado por POST
$email = $_POST['email']; // Obtiene el valor del campo email
$telefono = $_POST['telefono']; // Obtiene el valor del campo telefono
$fecha_nacimiento = $_POST['fecha_nacimiento']; // Obtiene el valor del campo fecha_nacimiento
$genero = $_POST['genero']; // Obtiene el valor del radio button genero
$fecha_evento = $_POST['fecha_evento']; // Obtiene el valor del campo fecha_evento
$tipo_entrada = $_POST['tipo_entrada']; // Obtiene el valor del select tipo_entrada
$comida = isset($_POST['comida']) ? $_POST['comida'] : array(); // Verifica si existe el array comida, si no, crea array vacío
$nombre_usuario = $_POST['nombre-usuario']; // Obtiene el valor del campo nombre usuario
$contraseña = $_POST['contraseña']; // Obtiene el valor del campo contraseña
$confirmacion_contraseña = $_POST['confirmacion-contraseña']; // Obtiene el valor del campo confirmacion contraseña
$notificaciones = isset($_POST['notificaciones']) ? 'Sí' : 'No'; // Si está marcado el checkbox, asigna 'Sí', si no 'No'
$terminos = isset($_POST['terminos']) ? 'Aceptado' : 'No aceptado'; // Si está marcado el checkbox terminos, asigna 'Aceptado', si no 'No aceptado'
$calificacion = $_POST['calificacion']; // Obtiene el valor de calificacion
$comentarios = $_POST['comentarios']; // Obtiene el valor de comentarios
$archivo = isset($_FILES['archivo']['name']) ? $_FILES['archivo']['name'] : 'No se adjuntó archivo'; // Verifica si se subió archivo, obtiene el nombre o mensaje por defecto

// Validaciones básicas
$errores = array(); // Crea un array vacío para almacenar los errores de validación

if (empty($nombre)) $errores[] = "El nombre es obligatorio"; // Si el nombre está vacío, añade error al array
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "Email inválido"; // Si email está vacío o no tiene formato válido, añade error
if (empty($telefono)) $errores[] = "El teléfono es obligatorio"; // Si telefono está vacío, añade error
if (empty($fecha_nacimiento)) $errores[] = "La fecha de nacimiento es obligatoria"; // Si fecha_nacimiento está vacía, añade error
if (empty($genero)) $errores[] = "El género es obligatorio"; // Si no se seleccionó género, añade error
if (empty($fecha_evento)) $errores[] = "La fecha del evento es obligatoria"; // Si fecha_evento está vacía, añade error
if (empty($tipo_entrada)) $errores[] = "El tipo de entrada es obligatorio"; // Si no se seleccionó tipo_entrada, añade error
if (empty($nombre_usuario)) $errores[] = "El nombre de usuario es obligatorio"; // Si nombre_usuario está vacío, añade error
if (empty($contraseña)) $errores[] = "La contraseña es obligatoria"; // Si contraseña está vacía, añade error
if ($contraseña !== $confirmacion_contraseña) $errores[] = "Las contraseñas no coinciden"; // Si las contraseñas no son idénticas, añade error
if (!isset($_POST['terminos'])) $errores[] = "Debe aceptar los términos y condiciones"; // Si no se marcó el checkbox de terminos, añade error

// Si hay errores, mostrarlos
if (!empty($errores)) { // Verifica si el array de errores tiene elementos
    echo '<h2>Errores de validación:</h2><ul>'; // Imprime título de errores y abre lista
    foreach ($errores as $error) { // Recorre cada error del array
        echo '<li>' . $error . '</li>'; // Imprime cada error como elemento de lista
    }
    echo '</ul><a href="javascript:history.back()">Volver</a>'; // Cierra lista y añade enlace para volver
    exit; // Termina la ejecución del script
}
?>

<!DOCTYPE html> 
<html lang="es"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Recibo de Registro</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body> 
    <div class="container my-5"> 
        <div class="card"> 
            <div class="card-header bg-success text-white"> 
                <h2>Registro Completado</h2> 
            </div>
            <div class="card-body"> 
                <h4>Información Personal</h4> 
                <p><strong>Nombre:</strong> <?php echo $nombre; ?></p> <!--con strong ponemos en negrita-->
                <p><strong>Email:</strong> <?php echo $email; ?></p> 
                <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p> 
                <p><strong>Fecha de nacimiento:</strong> <?php echo $fecha_nacimiento; ?></p> 
                <p><strong>Género:</strong> <?php echo $genero; ?></p> 
                
                <hr> <!-- Línea horizontal separadora -->
                <h4>Información del Evento</h4> 
                <p><strong>Fecha del evento:</strong> <?php echo $fecha_evento; ?></p> 
                <p><strong>Tipo de entrada:</strong> <?php echo $tipo_entrada; ?></p> 
                <p><strong>Preferencias de comida:</strong> <?php echo !empty($comida) ? implode(', ', $comida) : 'Sin preferencias'; ?></p> <!-- Si hay preferencias de comida, las une con comas usando implode, si no muestra mensaje por defecto que es de sin preferencias -->
                
                <hr> 
                <h4>Información de Acceso</h4> 
                <p><strong>Nombre de usuario:</strong> <?php echo $nombre_usuario; ?></p> 
                <p><strong>Contraseña:</strong> ********</p>  <!--Se pone los asteriscos en vez de $contraseá para ocultar la contraseña real por seguridad-->
                
                <hr> 
                <h4>Preferencias de Contacto</h4> 
                <p><strong>Notificaciones por email:</strong> <?php echo $notificaciones; ?></p> 
                <p><strong>Términos y condiciones:</strong> <?php echo $terminos; ?></p> 
                
                <hr> 
                <h4>Encuesta Adicional</h4> 
                <p><strong>Calificación:</strong> <?php echo $calificacion; ?> / 10</p> 
                <p><strong>Comentarios:</strong> <?php echo $comentarios; ?></p> 
                
                <hr> 
                <h4>Archivo Adjunto</h4> 
                <p><strong>Archivo:</strong> <?php echo $archivo; ?></p> 
            </div> 
        </div> 
    </div> 
</body> 
</html> 