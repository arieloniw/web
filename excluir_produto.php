<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produto_id = $_GET['id'];

    $host = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco_de_dados = 'produtos';

    $conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);

   
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    $sql = "DELETE FROM produtos WHERE id = $produto_id";

    if ($conexao->query($sql) === TRUE) {
        echo "Produto excluído com sucesso.";
    } else {
        echo "Erro ao excluir o produto: " . $conexao->error;
    }

    $conexao->close();
} else {
    echo "ID de produto inválido ou não fornecido.";
}

header("Location: cadastro_produto.php");
?>
