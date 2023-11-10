<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "produtos";

$conn = new mysqli($servername, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $preco_id = $_POST['preco_id'];
    $novo_preco = $_POST['novo_preco'];

    $sql = "UPDATE preco SET preco = $novo_preco WHERE id = $preco_id";

    if ($conn->query($sql) === TRUE) {
       header("location: cadastro_preco.php");
    } else {
        echo "Erro ao editar preço: " . $conn->error;
    }
}

$conn->close();
?>
