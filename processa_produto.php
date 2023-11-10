<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nome']) && isset($_POST['marca']) && isset($_POST['quantidade'])) {
        $nome_produto = $_POST['nome'];
        $marca = $_POST['marca'];
        $quantidade = $_POST['quantidade'];

    
        $host = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco_de_dados = 'produtos';

        $conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);

        if ($conexao->connect_error) {
            die("Falha na conexão: " . $conexao->connect_error);
        }

     
        $sql = "INSERT INTO produtos (nome_produto, marca, quantidade) VALUES ('$nome_produto', '$marca', $quantidade)";

        if ($conexao->query($sql) === TRUE) {
            header("location: cadastro_produto.php");
        } else {
            echo "Erro no cadastro do produto: " . $conexao->error;
        }

        $conexao->close();
    } else {
        echo "Dados de cadastro ausentes ou incorretos.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
