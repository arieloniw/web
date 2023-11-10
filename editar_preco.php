<!DOCTYPE html>
<html>
<head>
    <title>Editar Preço de Produto</title>
    <style>
        /* Adicione o estilo aqui se necessário */
    </style>
</head>
<body>
    <h2>Editar Preço de Produto</h2>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "produtos";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $preco_id = $_GET['id'];

    $sql = "SELECT p.nome_produto, l.loja, preco.preco
    FROM preco
    INNER JOIN produtos p ON preco.produto_id = p.id
    INNER JOIN loja l ON preco.loja_id = l.id
    WHERE preco = $preco_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>

    <form method="post" action="processa_edicao_preco.php">
        <input type="hidden" name="preco_id" value="<?php echo $preco_id; ?>">

        <label for="preco">Novo Preço:</label>
        <input type="text" name="novo_preco" value="<?php echo $row['preco']; ?>" required><br><br>

        <input type="submit" value="Salvar Edição">
    </form>

    <?php
    } else {
        echo "Preço não encontrado.";
    }

    $conn->close();
    ?>

</body>
</html>
