<?php

$host = 'Localhost';
$usuario = 'root';
$senha = '';
$banco_de_dados = 'produtos';

$conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);


if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}


$loja = $_POST['nome'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$quantidade_loja = $_POST['quantidade_loja'];


$sql = "INSERT INTO loja (loja, endereco, cidade, quantidade_loja) VALUES ('$loja', '$endereco', '$cidade', $quantidade_loja)";

if ($conexao->query($sql) === TRUE) {
    header("location: cadastro_empresa.php");
} else {
    echo "Erro ao cadastrar a empresa: " . $conexao->error;
}


$conexao->close();
?>
