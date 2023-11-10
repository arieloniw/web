<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .container h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-control {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-success:hover {
            background-color: #45a049;
        }

        .lista-empresas {
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .lista-empresas h2 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            margin: 0;
        }

        .lista-empresas table {
            width: 100%;
            border-collapse: collapse;
        }

        .lista-empresas th, .lista-empresas td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        .lista-empresas th {
            background-color: #f2f2f2;
        }

        .lista-empresas tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .editar-link, .excluir-link {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
            cursor: pointer;
        }

        .editar-link:hover, .excluir-link:hover {
            text-decoration: underline;
        }

        .excluir-link {
            color: #ff0000;
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
        <a href="cadastro_preco.php">Cadastro Preço</a>
        <a href="consultapreco.php">Preço mais baixo</a>
    </div>
    <div class="container">
        <h2>Cadastro de Produto</h2>
        <form action="processa_produto.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="nome" placeholder="Nome do Produto" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="marca" placeholder="Marca" required>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="quantidade" placeholder="Quantidade" required>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
    </div>

    <div class="lista-empresas">
        <h2>Lista de Produtos Cadastrados</h2>
        <?php
  
        $host = 'Localhost';
        $usuario = 'root';
        $senha = '';
        $banco_de_dados = 'produtos';

        $conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);

   
        if ($conexao->connect_error) {
            die("Falha na conexão: " . $conexao->connect_error);
        }

   
        $sql = "SELECT * FROM produtos";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Nome do Produto</th><th>Marca</th><th>Quantidade</th><th>Ações</th></tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nome_produto'] . '</td>';
                echo '<td>' . $row['marca'] . '</td>';
                echo '<td>' . $row['quantidade'] . '</td>';
                echo '<td>';
                echo '<a class="editar-link" href="editar_produto.php?id=' . $row['id'] . '">Editar</a>';
                echo '<a class="excluir-link" onclick="excluirProduto(' . $row['id'] . ')">Excluir</a>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'Nenhum produto cadastrado.';
        }


        $conexao->close();
        ?>
    </div>

    <script>
        function excluirProduto(id) {
            if (confirm('Tem certeza de que deseja excluir esta empresa?')) {
                window.location.href = 'excluir_produto.php?id=' + id;
            }
        }
    </script>
</body>
</html>
