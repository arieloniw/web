<!DOCTYPE html>
<html>
<head>
    <title>Produtos com Preços Mais Baixos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .menu {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
        }

        .menu a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="menu">
        <a href="menu.php">Menu</a>
        <a href="cadastro_empresa.php">Cadastro de Empresa</a>
        <a href="cadastro_produto.php">Cadastro de Produto</a>
        <a href="cadastro_preco.php">Cadastro Preço</a>
    </div>
    <h2>Produtos com Preços Mais Baixos</h2>
    <table>
        <tr>
            <th>Produto</th>
            <th>Estabelecimento</th>
            <th>Preço Mais Baixo</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "produtos";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        $sql = "SELECT nome_produto, loja, MIN(preco) AS preco
                FROM produtos
                JOIN preco AS p ON produtos.id = p.produto_id
                JOIN loja ON p.loja_id = loja.id
                GROUP BY nome_produto
                ORDER BY preco ASC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nome_produto"] . "</td>";
                echo "<td>" . $row["loja"] . "</td>";
                echo "<td>R$" . number_format($row["preco"], 2, ',', '.') . "</td>";
                echo "</tr>";
            }
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
