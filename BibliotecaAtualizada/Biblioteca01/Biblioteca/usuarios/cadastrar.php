<?php
require '../conexao.php';
$mensagem="";
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = password_hash($_POST['senha'],PASSWORD_DEFAULT);
    $tipo = $_POST['tipo'];

    try{
        //Criando o comando para salvar no banco
        $sql="INSERT INTO usuarios(nome, email, senha, tipo)
        VALUES(:nome ,:email, :senha, :tipo)";
        //Preparando o sql antes de executar
        $stmt = $pdo->prepare($sql);
        //Executando o comando
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha,
            ':tipo' => $tipo
        ]);
        $mensagem="<p class='errosucesso'>Cadastrado com sucesso!</php>";
        header("location:../painel.php");
        exit;
    }catch(PDOException $e){
        //Caso aconteça algum erro
        $mensagem = "<p class='erro'>Erro ao cadastrar.".$e->getMessage()."</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Usuários</h1>
        <?php echo $mensagem;?>
    <form method="post">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <select name="tipo">
            <option value="admin">Admin</option>
            <option value="aluno">Aluno</option>
        </select>
        <button type="submit">Cadastrar</button>
    </form>
    </div>
</body>
</html>
