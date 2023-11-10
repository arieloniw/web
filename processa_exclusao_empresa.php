<?php

if (isset($_POST['id'])) {
    $empresa_id = $_POST['id'];

    $host = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco_de_dados = 'produtos';

    $conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);

    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    $sql = "DELETE FROM loja WHERE id = $empresa_id";

    if ($conexao->query($sql) === TRUE) {
        header("location: cadastro_empresa.php");
    } else {
        echo "Erro ao excluir a empresa: " . $conexao->error;
    }

    $conexao->close();
} else {
    echo 'ID da empresa não especificado.';
}
?>
