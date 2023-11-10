<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Preço de Produto</title>
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

        form {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 90%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
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

        body {
            font-family: Arial, sans-serif;
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
        <a href= "menu.php">Menu</a>
        <a href="cadastro_empresa.php">Cadastro de Empresa</a>
        <a href="cadastro_produto.php">Cadastro de Produto</a>
        <a href="consultapreco.php">Preço mais baixo</a>
    </div>  
    <h2>Cadastro de Preço de Produto</h2>
    <form method="post" action="processa_cadastro_preco.php">
        <label for="produtos">Produto:</label>
        <select name="produtos" id="produtos" required>
            <option value="">Selecione um produto</option>
            <?php
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "produtos";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Falha na conexão com o banco de dados: " . $conn->connect_error);
            }

            $sql = "SELECT id, nome_produto FROM produtos  ORDER BY nome_produto ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nome_produto"] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>

        <label for="loja">Estabelecimento:</label>
        <select name="loja" id="loja" required>
            <option value="">Selecione um estabelecimento</option>
            <?php
            
            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Falha na conexão com o banco de dados: " . $conn->connect_error);
            }

            $sql = "SELECT id, loja FROM loja ORDER BY loja ASC ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["loja"] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" id="preco" required><br><br>

        <input type="submit" value="Cadastrar Preço">
    </form>

    <h2>Lista de Produtos e Preços Cadastrados</h2>
    <table>
    <tr>
        <th>Produto</th>
        <th>Estabelecimento</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $sql = "SELECT p.nome_produto, l.loja, preco.preco
    FROM preco
    INNER JOIN produtos p ON preco.produto_id = p.id
    INNER JOIN loja l ON preco.loja_id = l.id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" .$row['nome_produto'] . "</td>";
            echo "<td>" .$row['loja'] . "</td>";
            echo "<td>R$" . number_format($row["preco"], 2, ',', '.') . "</td>";
            echo "<td>";
            echo "<a href='editar_preco.php?id=" . $row["preco"] . "'>Editar</a>";
            echo " | ";
            echo "<a href='excluir_preco.php?id=" . $row["preco"] . "'>Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
    }
    $conn->close();
    ?>
</table>

</body>
</html>


