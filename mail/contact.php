<?php
function isInjected($str) {
  $injections = array('(\n+)', '(\r+)', '(\t+)', '(%0A+)', '(%0D+)', '(%08+)', '(%09+)');
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  return preg_match($inject, $str);
}

if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || isInjected($_POST['name']) || isInjected($_POST['email']) || isInjected($_POST['subject'])) {
  http_response_code(400);
  echo 'Por favor, preencha todos os campos corretamente e forneça um e-mail válido.';
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "danielcostadev@outlook.com"; // Change this email to your //
$subject = "$m_subject: $name";
$body = "NOVA MENSAGEM DO PORTIFOLIO.\n\nAqui os detalhes:\n\nNome: $name\n\nE-mail: $email\n\nAssunto: $m_subject\n\nMensagem: $message";
$header = "De: $email\r\n";
$header .= "Reply-To: $email\r\n";

if(!mail($to, $subject, $body, $header)) {
  http_response_code(500);
  echo 'Ocorreu um erro ao enviar sua mensagem. Tente novamente mais tarde.';
}
?>
