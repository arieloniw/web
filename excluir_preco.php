<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Configurações de conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "produtos";

    // Conecte ao banco de dados
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consulta SQL para excluir o registro com base no ID
    $sql = "DELETE FROM preco WHERE preco = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("location: cadastro_preco.php");
    } else {
        echo "Erro ao excluir o preço: " . $conn->error;
    }

    $conn->close();
}
?>
