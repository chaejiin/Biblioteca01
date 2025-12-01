<?php
require 'conexao.php';

// 1. Verificar se existe o ID na URL
if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: listar.php");
    exit;
}

$id = intval($_GET['id']);

// 2. Buscar as informações do usuário atual
$sql = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não encontrar o usuário no banco, volta para a lista
if(!$usuario){
    header("Location: listar.php");
    exit;
}

// 3. Processar o formulário de edição
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    // Pegar os dados do formulário
    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $tipo  = trim($_POST['tipo']);

    // Verificar se a senha foi preenchida para decidir qual UPDATE fazer
    if(!empty($senha)){      
        // Se tem senha nova, criptografa e atualiza tudo
        $senha = password_hash($senha, PASSWORD_DEFAULT);   
        
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, tipo = :tipo WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome'  => $nome,
            ':email' => $email,
            ':senha' => $senha, // Aqui vai a senha já criptografada
            ':tipo'  => $tipo,
            ':id'    => $id
        ]);
    } else {
        // Se NÃO tem senha, mantém a antiga (não inclui senha no UPDATE)
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, tipo = :tipo WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome'  => $nome,
            ':email' => $email,
            ':tipo'  => $tipo,
            ':id'    => $id
        ]);
    }

    // Redireciona para a lista após a atualização
    header("Location: listar.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="card-editar">
        <h1>Editar Usuário</h1>
        <form method="POST">
            <div class="input-group">
                <label for="nome"> Nome</label>
                <input type="text" name="nome" value="<?= $usuario['nome'] ?>" required>

            </div>
            <div class="input-group">
                <label for="email"> Email</label>
                <input type="email" name="email" value="<?= $usuario['email'] ?>" required>

            </div>
            <div class="input-group">
                <label for="senha"> Nova senha <small> (opcional)</small></label>
                <input type="password" name="senha" placeholder="Deixe em branco para não alterar">
            </div>
            <div class="input-group">
                <label for="tipo">tipo</label>
                <select name="tipo">
                    <option value="admin"><?= $usuario['tipo'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="aluno"><?= $usuario['tipo'] == 'aluno' ? 'selected' : '' ?>>Aluno</option>
                </select>
                <button type="submit" class="btn">Salvar as alterações</button>
                <a href="listar.php" class="btn-voltar">Voltar</a>
            </div>
        </form>
    </div>

</body>

</html>