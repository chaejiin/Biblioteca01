<?php
$host="localhost";
$banco="biblioteca";
$usuario="root";
$senha="";

try{
    $pdo = new PDO ("mysql:host=$host;dbname=$banco;charset=utf8",
    $usuario,$senha);
    //define se acontecer algum erro na conexao  ou consulta;
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    //caso de algum erro de conexao mostra essa mensagem
    die("Erro ao conectar:".$e->getMessage());
}


?>