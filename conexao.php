<?php
$host = 'db4free.net';
$dbname = 'db';
$username = 'db';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Testar a conexão com o banco de dados
    $stmt = $conn->query('SELECT 1');
    $stmt->fetch(PDO::FETCH_ASSOC);

    echo 'Conexão bem-sucedida ao banco de dados!';
} catch (PDOException $e) {
    echo 'Erro de conexão ao banco de dados: ' . $e->getMessage();
}
?>
