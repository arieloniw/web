<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome_de_usuario_correto = "fael";
    $senha_correta = "12345";

    $nome_de_usuario_digitado = $_POST["nome"];
    $senha_digitada = $_POST["senha"];

    if ($nome_de_usuario_digitado === $nome_de_usuario_correto && $senha_digitada === $senha_correta) {

        header("Location: menu.php");
    } else {

        header("Location: login.php?erro=1");
    }
}
?>
