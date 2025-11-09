<?php
header('Content-Type: application/json'); // Establece que la respuesta será en formato JSON

$nombre = $_POST['nombre']; // Obtiene el valor del campo nombre enviado por POST
$email = $_POST['email']; // Obtiene el valor del campo email
$telefono = $_POST['telefono']; // Obtiene el valor del campo telefono
$fecha_nacimiento = $_POST['fecha_nacimiento']; // Obtiene el valor del campo fecha_nacimiento
$genero = $_POST['genero']; // Obtiene el valor del radio button genero
$fecha_evento = $_POST['fecha_evento']; // Obtiene el valor del campo fecha_evento
$tipo_entrada = $_POST['tipo_entrada']; // Obtiene el valor del select tipo_entrada
$comida = isset($_POST['comida']) ? $_POST['comida'] : array(); // Verifica si existe el array comida, si no, crea array vacío
$nombre_usuario = $_POST['nombre_usuario']; // Obtiene el valor del campo username
$contraseña = $_POST['contraseña']; // Obtiene el valor del campo password
$confirmacion_contraseña = $_POST['confirmacion_contraseña']; // Obtiene el valor del campo password_confirm
$notificaciones = isset($_POST['notificaciones']) ? 'Sí' : 'No'; // Si está marcado el checkbox, asigna 'Sí', si no 'No'
$terminos = isset($_POST['terminos']) ? 'Aceptado' : 'No aceptado'; // Si está marcado el checkbox terminos, asigna 'Aceptado', si no 'No aceptado'
$calificacion = $_POST['calificacion']; // Obtiene el valor del range calificacion
$comentarios = $_POST['comentarios']; // Obtiene el valor del textarea comentarios
$archivo = isset($_FILES['archivo']['name']) ? $_FILES['archivo']['name'] : 'No se adjuntó archivo'; // Verifica si se subió archivo, obtiene el nombre o mensaje por defecto

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
if (!isset($_POST['terminos'])) $errores[] = "Debe aceptar los términos"; // Si no se marcó el checkbox terminos, añade error

if (!empty($errores)) { // Verifica si el array de errores tiene elementos
    echo json_encode([ // Convierte array PHP a formato JSON y lo imprime
        'success' => false, // Indica que la operación falló
        'errores' => $errores // Incluye el array de errores
    ]);
    exit; // Termina la ejecución del script
}

$comida_texto = !empty($comida) ? implode(', ', $comida) : 'Sin preferencias'; // Si hay preferencias de comida, las une con comas usando implode, si no mensaje por defecto

echo json_encode([ // Convierte array PHP a formato JSON y lo imprime
    'success' => true, // Indica que la operación fue exitosa
    'datos' => [ // Array asociativo con todos los datos recibidos
        'nombre' => $nombre, // Nombre del usuario
        'email' => $email, // Email del usuario
        'telefono' => $telefono, // Teléfono del usuario
        'fecha_nacimiento' => $fecha_nacimiento, // Fecha de nacimiento
        'genero' => $genero, // Género seleccionado
        'fecha_evento' => $fecha_evento, // Fecha del evento
        'tipo_entrada' => $tipo_entrada, // Tipo de entrada seleccionado
        'comida' => $comida_texto, // Preferencias de comida unidas en texto
        'nombre_usuario' => $nombre_usuario, // Nombre de usuario
        'notificaciones' => $notificaciones, // Sí o No
        'terminos' => $terminos, // Aceptado o No aceptado
        'calificacion' => $calificacion, // Valor del deslizador (1-10)
        'comentarios' => $comentarios, // Comentarios del usuario
        'archivo' => $archivo // Nombre del archivo adjunto
    ]
]);
?>