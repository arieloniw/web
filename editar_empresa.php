<!DOCTYPE html>
<html>
<head>
    <title>Editar Empresa</title>
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
        <h2>Editar Empresa</h2>
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

            $sql = "SELECT * FROM loja WHERE id = $empresa_id";
            $result = $conexao->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>

                <form action="processa_edicao_empresa.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nome" placeholder="Nome da Empresa" value="<?php echo $row['loja']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="endereco" placeholder="Endereço" value="<?php echo $row['endereco']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="cidade" placeholder="Cidade" value="<?php echo $row['cidade']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="quantidade_loja" placeholder="Quantidade de Loja" value="<?php echo $row['quantidade_loja']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
                <?php
            } else {
                echo 'Empresa não encontrada.';
            }

       
            $conexao->close();
        } else {
            echo 'ID da empresa não especificado.';
        }
        ?>
    </div>
</body>
</html>
