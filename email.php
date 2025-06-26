<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Dados do formulário
    $nome = filter_var(trim($_POST["nome"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $mensagem = filter_var(trim($_POST["mensagem"]), FILTER_SANITIZE_STRING);

    if (!$nome || !$email || !$mensagem) {
        http_response_code(400);
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Configurações do email
    $para = "seuemail@dominio.com"; // <-- coloque seu email aqui
    $assunto = "Nova mensagem do site - Contato";

    $corpo = "Nome: $nome\n";
    $corpo .= "Email: $email\n\n";
    $corpo .= "Mensagem:\n$mensagem\n";

    $headers = "From: $nome <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envia email
    if (mail($para, $assunto, $corpo, $headers)) {
        http_response_code(200);
        echo "Mensagem enviada com sucesso! Obrigado pelo contato.";
    } else {
        http_response_code(500);
        echo "Erro ao enviar a mensagem. Tente novamente mais tarde.";
    }
} else {
    http_response_code(405);
    echo "Método não permitido.";
}
?>
