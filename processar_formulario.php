<?php
date_default_timezone_set('America/Fortaleza');

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$host = 'db4free.net';
$dbname = 'db_ugtsi';
$username = 'db_ugtsi';
$password = '2ae8b906';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo = $_POST['cargo'];
    $escolaridade = $_POST['escolaridade'];
    $observacoes = $_POST['observacoes'];
    $dataHoraEnvio = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];

    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['arquivo']['name']);
    $extensoesPermitidas = ['doc', 'docx', 'pdf'];

    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadFile)) {
        $tamanhoArquivo = $_FILES['arquivo']['size'] / 1024 / 1024;
        if ($tamanhoArquivo > 1) {
            unlink($uploadFile);
            die("O tamanho do arquivo para ser anexado deve ser menor ou igual a 1 MB.");
        }

        $extensaoArquivo = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        if (!in_array($extensaoArquivo, $extensoesPermitidas)) {
            unlink($uploadFile);
            die('O arquivo deve ser do tipo *.doc, *.docx ou *.pdf.');
        }

        $stmt = $conn->prepare('INSERT INTO curriculos (nome, email, telefone, cargo, escolaridade, observacoes, arquivo, data_hora_envio, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$nome, $email, $telefone, $cargo, $escolaridade, $observacoes, $uploadFile, $dataHoraEnvio, $ip]);

        $mailConfirmacao = new PHPMailer(true);

        try {
            $mailConfirmacao->isSMTP();
            $mailConfirmacao->Host = 'smtp.gmail.com';
            $mailConfirmacao->SMTPAuth = true;
            $mailConfirmacao->Username = 'testesesap@gmail.com';
            $mailConfirmacao->Password = 'prqd shte ktxd blst';
            $mailConfirmacao->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mailConfirmacao->Port = 465;

            $mailConfirmacao->setFrom('testesesap@gmail.com', 'UGTSIC - SESAP');
            $mailConfirmacao->addAddress($email, $nome);
            $mailConfirmacao->Subject = 'Confirmação de Cadastro';

            $mailConfirmacao->CharSet = 'UTF-8';
            $dataHoraEnvioFormatada = date('d/m/Y - H:i:s', strtotime($dataHoraEnvio));
            $mailConfirmacao->Body = "Obrigado por cadastrar seu currículo! Segue dados para conferência. \n\nNome: $nome\nE-mail: $email\nTelefone: $telefone\nCargo: $cargo\nEscolaridade: $escolaridade\nObservações: $observacoes\nData e Hora de Envio: $dataHoraEnvioFormatada\n";

            $mailConfirmacao->send();
            echo 'Formulário enviado com sucesso! Um e-mail de confirmação foi enviado para o seu e-mail cadastrado.';
        } catch (Exception $e) {
            echo "Erro ao enviar e-mail de confirmação: {$mailConfirmacao->ErrorInfo}";
        }
    } else {
        echo 'Erro ao enviar arquivo.';
    }
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
?>