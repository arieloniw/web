<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['endereco']) && isset($_POST['cidade']) && isset($_POST['quantidade_loja'])) {
        $empresa_id = $_POST['id'];
        $loja = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $cidade = $_POST['cidade'];
        $quantidade_loja = $_POST['quantidade_loja'];

        $host = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco_de_dados = 'produtos';

        $conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);

        if ($conexao->connect_error) {
            die("Falha na conexão: " . $conexao->connect_error);
        }

        $sql = "UPDATE loja SET loja='$loja', endereco='$endereco', cidade='$cidade', quantidade_loja=$quantidade_loja WHERE id = $empresa_id";

        if ($conexao->query($sql) === TRUE) {
            header("location: cadastro_empresa.php");
        } else {
            echo "Erro ao atualizar a empresa: " . $conexao->error;
        }

        $conexao->close();
    } else {
        echo "Dados de edição ausentes ou incorretos.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
