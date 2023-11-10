<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto</title>
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
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Produto</h2>
        <?php
        if (isset($_GET['id'])) {
            $empresa_id = $_GET['id'];

     
            $host = 'localhost';
            $usuario = 'root';
            $senha = '';
            $banco_de_dados = 'produtos';

            $conexao = new mysqli($host, $usuario, $senha, $banco_de_dados);


            if ($conexao->connect_error) {
                die("Falha na conexão: " . $conexao->connect_error);
            }

 
            $sql = "SELECT * FROM produtos WHERE id = $empresa_id";
            $result = $conexao->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
   
                <form action="processa_edicao_produto.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nome" placeholder="Nome do Produto" value="<?php echo $row['nome_produto']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="marca" placeholder="Marca" value="<?php echo $row['marca']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="quantidade" placeholder="Quantidade" value="<?php echo $row['quantidade']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
                <?php
            } else {
                echo 'Produto não encontrado.';
            }

       
            $conexao->close();
        } else {
            echo 'ID do produto não especificado.';
        }
        ?>
    </div>
</body>
</html>
