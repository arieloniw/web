<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .login-container {
            width: 300px;
            margin: 0 auto;
            margin-top: 100px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="processa_login.php" method="POST">
            <input type="text" name="nome" placeholder="Nome de usuário" required>
            <br>
            <input type="password" name="senha" placeholder="Senha" required>
            <br>
            <input type="submit" value="Login">
        </form>
        <?php
        if (isset($_GET['erro']) && $_GET['erro'] === '1') {
            echo '<p class="error-message">Nome de usuário ou senha incorretos.</p>';
        }
        ?>
    </div>
</body>
</html>
