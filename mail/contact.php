<?php
if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "danielcostadev@outlook.com"; // Change this email to your //
$subject = "$m_subject:  $name";
$body = "NOVA MENSAGEM DO PORTIFOLIO.\n\n"."Aqui os detalhes:\n\nNome: $name\n\n\nE-mail: $email\n\nAssunto: $m_subject\n\nMensagem: $message";
$header = "De: $email";
$header .= "Responda para: $email";	

if(!mail($to, $subject, $body, $header))
  http_response_code(500);
?>
