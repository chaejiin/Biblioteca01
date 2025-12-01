<?php
require '../conexao.php';
//comando para buscar informações do banco
$sql = "SELECT *FROM usuarios";
//executa o comando sql por que não há parametros
$stmt = $pdo->query($sql);
//pega o resultado e salva em um array
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
?>


<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
 
<body>
    <div class="listar-container">
        <h1>Lista de Usuários</h1>
        <table class="tabela-usuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['nome'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td><?= ucfirst($u['tipo']) ?></td>
                        <td>
                            <a class="btn-editar"
                                href="editar.php?id=<?= $u['id'] ?>">Editar</a>
                            <a class="btn-editar"
                                href="excluir.php?id=<?= $u['id'] ?>" onclick="return confirm('Deseja realmente ?')">Exclir</a>
 
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
 
    </div>
</body>
 
</html>