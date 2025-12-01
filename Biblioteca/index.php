<?php
//importar a conexao
require_once 'conexao.php';
//criando uma sessao para salvar informações do usuario logado.
session_start();
$mensagem = "";
if($_SERVER['REQUEST_METHOD']==='POST'){

    //pegar as informações do formulário
    $email=trim($_POST['email']);
    $senha=trim($_POST['senha']);
    //comando sql para buscar usuario e senha
    $sql="SELECT *FROM usuarios WHERE email=:email";
    //prepara para o comando SQL, evita SQL Injection
    $stmt = $pdo->prepare($sql);
    //executa o comando sql e substitui :email pelo valor digitado
    $stmt->execute([':email'=>$email]);
    //pega os dados do usuario encontrado(se existir)
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    //verificar se a senha é igual com o banco
    if($usuario && password_verify($senha,$usuario['senha'])){
        //salvar o nome e o tipo em sessão
        $_SESSION['usuario'] = $usuario['nome'];
        $_SESSION['tipo'] = $usuario['tipo'];
        header("location:painel.php");
       
        exit;
    }else{
        //caso o email ou senha estejam incorretos, mostra mensagem de erro
        $mensagem = "<p class='erro'>Email ou senha inválidos!</p>";
    }

}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php echo $mensagem;?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>


    </div>
    
</body>
</html>