<?php
$host = 'db_host';
$dbname = 'db_name';
$username = 'db_username';
$password = 'db_password';

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
