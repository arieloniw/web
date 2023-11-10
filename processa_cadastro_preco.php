<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "produtos";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto_id = $_POST['produtos'];
    $loja_id = $_POST['loja'];
    $preco = $_POST['preco'];

    // Execute a consulta SQL para inserir o preço
    $sql = "INSERT INTO preco (produto_id, loja_id, preco) VALUES ('$produto_id', '$loja_id', '$preco')";

    if ($conn->query($sql) === TRUE) {
        header("location: cadastro_preco.php");
    } else {
        echo "Erro ao cadastrar o preço: " . $conn->error;
    }
}


$sql = "SELECT p.nome_produto, l.loja, preco.preco
        FROM preco
        INNER JOIN produtos p ON preco.produto_id = p.id
        INNER JOIN loja l ON preco.loja_id = l.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Produto</th><th>Loja</th><th>Preço</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'].'">'.$row['nome_produto'] . "</td>";
        echo "<td>" . $row['id'].'">'.$row['loja'] . "</td>";
        echo "<td>" . $row["preco"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum resultado encontrado.";
}

$conn->close();
?>