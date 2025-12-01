<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Bem vindo,<?php echo $_SESSION['usuario']; ?> !</h1>
        <nav class="menu">
        <div class="dropdown">
            <button class="dropbtn">Usuarios</button>
            <div class="dropdown-content">
                <a href="usuarios/cadastrar.php">Cadastrar Usuário</a>
                <a href="usuarios/listar.php">Lista Usuário</a>
                
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Livros</button>
            <div class="dropdown-content">
                <a href="livros/cadastrar.php">Cadastrar Livros</a>
                <a href="livros/listar.php">Lista Livros</a>
                
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Alugueis</button>
            <div class="dropdown-content">
                <a href="alugueis/cadastrar.php">Alugar Livro</a>
                <a href="alugueis/listar.php">Listar Alugueis</a>
                
            </div>
        </div>
        <a href="logout.php" class="logout">Sair</a>
</nav>

        

    </div>

    
</body>
</html>