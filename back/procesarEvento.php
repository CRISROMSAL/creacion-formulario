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
$nombre_usuario = $_POST['nombre-usuario']; // Obtiene el valor del campo username
$contraseña = $_POST['contraseña']; // Obtiene el valor del campo password
$confirmacion_contraseña = $_POST['confirmacion-contraseña']; // Obtiene el valor del campo password_confirm
$notificaciones = isset($_POST['notificaciones']) ? 'Sí' : 'No'; // Si está marcado el checkbox, asigna 'Sí', si no 'No'
$terminos = isset($_POST['terminos']) ? 'Aceptado' : 'No aceptado'; // Si está marcado el checkbox terminos, asigna 'Aceptado', si no 'No aceptado'
$calificacion = $_POST['calificacion']; // Obtiene el valor del range calificacion
$comentarios = $_POST['comentarios']; // Obtiene el valor del textarea comentarios
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
if (empty($nombre_usuario)) $errores[] = "El nombre de usuario es obligatorio"; // Si username está vacío, añade error
if (empty($contraseña)) $errores[] = "La contraseña es obligatoria"; // Si password está vacía, añade error
if ($contraseña !== $confirmacion_contraseña) $errores[] = "Las contraseñas no coinciden"; // Si las contraseñas no son idénticas, añade error
if (!isset($_POST['terminos'])) $errores[] = "Debe aceptar los términos y condiciones"; // Si no se marcó el checkbox terminos, añade error

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

<!DOCTYPE html> <!-- Declaración del tipo de documento HTML5 -->
<html lang="es"> <!-- Etiqueta raíz HTML con idioma español -->
<head> <!-- Sección de metadatos del documento -->
    <meta charset="UTF-8"> <!-- Codificación de caracteres UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configuración responsive para dispositivos móviles -->
    <title>Recibo de Registro</title> <!-- Título que aparece en la pestaña del navegador -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Enlace a la hoja de estilos de Bootstrap 4.6 -->
</head>
<body> <!-- Cuerpo del documento HTML -->
    <div class="container my-5"> <!-- Contenedor principal de Bootstrap con margen vertical -->
        <div class="card"> <!-- Tarjeta de Bootstrap -->
            <div class="card-header bg-success text-white"> <!-- Cabecera de la tarjeta con fondo verde y texto blanco -->
                <h2>Registro Completado</h2> <!-- Título de la cabecera -->
            </div>
            <div class="card-body"> <!-- Cuerpo de la tarjeta donde va el contenido -->
                <h4>Información Personal</h4> <!-- Título de sección -->
                <p><strong>Nombre:</strong> <?php echo $nombre; ?></p> <!-- Imprime el nombre con echo -->
                <p><strong>Email:</strong> <?php echo $email; ?></p> <!-- Imprime el email con echo -->
                <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p> <!-- Imprime el teléfono con echo -->
                <p><strong>Fecha de nacimiento:</strong> <?php echo $fecha_nacimiento; ?></p> <!-- Imprime la fecha de nacimiento con echo -->
                <p><strong>Género:</strong> <?php echo $genero; ?></p> <!-- Imprime el género con echo -->
                
                <hr> <!-- Línea horizontal separadora -->
                <h4>Información del Evento</h4> <!-- Título de sección -->
                <p><strong>Fecha del evento:</strong> <?php echo $fecha_evento; ?></p> <!-- Imprime la fecha del evento con echo -->
                <p><strong>Tipo de entrada:</strong> <?php echo $tipo_entrada; ?></p> <!-- Imprime el tipo de entrada con echo -->
                <p><strong>Preferencias de comida:</strong> <?php echo !empty($comida) ? implode(', ', $comida) : 'Sin preferencias'; ?></p> <!-- Si hay preferencias de comida, las une con comas usando implode, si no muestra mensaje por defecto -->
                
                <hr> <!-- Línea horizontal separadora -->
                <h4>Información de Acceso</h4> <!-- Título de sección -->
                <p><strong>Nombre de usuario:</strong> <?php echo $nombre_usuario; ?></p> <!-- Imprime el nombre de usuario con echo -->
                <p><strong>Contraseña:</strong> ********</p> <!-- Muestra asteriscos en lugar de la contraseña real por seguridad -->
                
                <hr> <!-- Línea horizontal separadora -->
                <h4>Preferencias de Contacto</h4> <!-- Título de sección -->
                <p><strong>Notificaciones por email:</strong> <?php echo $notificaciones; ?></p> <!-- Imprime si acepta notificaciones (Sí o No) con echo -->
                <p><strong>Términos y condiciones:</strong> <?php echo $terminos; ?></p> <!-- Imprime si aceptó términos (Aceptado o No aceptado) con echo -->
                
                <hr> <!-- Línea horizontal separadora -->
                <h4>Encuesta Adicional</h4> <!-- Título de sección -->
                <p><strong>Calificación:</strong> <?php echo $calificacion; ?> / 10</p> <!-- Imprime la calificación del range con echo -->
                <p><strong>Comentarios:</strong> <?php echo $comentarios; ?></p> <!-- Imprime los comentarios del textarea con echo -->
                
                <hr> <!-- Línea horizontal separadora -->
                <h4>Archivo Adjunto</h4> <!-- Título de sección -->
                <p><strong>Archivo:</strong> <?php echo $archivo; ?></p> <!-- Imprime el nombre del archivo adjunto con echo -->
            </div> <!-- Cierre del cuerpo de la tarjeta -->
        </div> <!-- Cierre de la tarjeta -->
    </div> <!-- Cierre del contenedor principal -->
</body> <!-- Cierre del body -->
</html> <!-- Cierre del documento HTML -->