<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = strip_tags(trim($_POST["nombre"]));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $mensaje = trim($_POST["mensaje"]);

  if (empty($nombre) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($mensaje)) {
    http_response_code(400);
    echo "Por favor, completa el formulario correctamente.";
    exit;
  }

  $destinatario = "grobiglio@gmail.com"; // Reemplaza con tu correo
  $asunto = "Nuevo mensaje de contacto de $nombre";
  $contenido = "Nombre: $nombre\n";
  $contenido .= "Email: $email\n\n";
  $contenido .= "Mensaje:\n$mensaje\n";

  $cabeceras = "From: $nombre <$email>";

  if (mail($destinatario, $asunto, $contenido, $cabeceras)) {
    http_response_code(200);
    echo "Gracias por tu mensaje. Te responderé pronto.";
  } else {
    http_response_code(500);
    echo "Hubo un problema al enviar tu mensaje.";
  }
} else {
  http_response_code(403);
  echo "Hubo un problema con tu envío. Intenta de nuevo.";
}
?>