<?php
$host = "localhost";
$banco = "sistema_clientes";
$usuario = "root";
$senha = ""; // coloque sua senha do MySQL, se houver

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro ao conectar: " . $e->getMessage();
}
?>
