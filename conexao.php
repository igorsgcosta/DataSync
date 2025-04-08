<?php

$usuario = 'root';  // Nome do usuário do banco de dados
$senha = '';        // Senha do banco de dados
$database = 'dsync'; // Nome do banco de dados
$host = 'localhost'; // Endereço do servidor de banco de dados

// Criando a conexão
$mysqli = new mysqli($host, $usuario, $senha, $database);

// Verificando se houve erro na conexão
if ($mysqli->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
}
?>
