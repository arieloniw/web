<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['marca']) && isset($_POST['quantidade'])) {
        $empresa_id = $_POST['id'];
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

        $sql = "UPDATE produtos SET nome_produto='$nome_produto', marca='$marca', quantidade='$quantidade' WHERE id = $empresa_id";

        if ($conexao->query($sql) === TRUE) {
            header("location: cadastro_produto.php");
        } else {
            echo "Erro ao atualizar o produto: " . $conexao->error;
        }

        $conexao->close();
    } else {
        echo "Dados de edição ausentes ou incorretos.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
