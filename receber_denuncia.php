<?php
// Definir as configurações do banco de dados
$host = 'localhost'; // Ou o seu host
$user = 'root'; // Seu usuário do banco de dados
$password = ''; // Sua senha do banco de dados
$dbname = 'dsync'; // Nome do banco de dados

// Estabelecer a conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID da denúncia foi passado na URL
if (isset($_GET['id'])) {
    $denunciaId = $_GET['id'];

    // Atualizar o status da denúncia para "Investigação"
    $query = "UPDATE denuncias SET status = 'Investigação' WHERE iddenuncia = ?";

    if ($stmt = $conn->prepare($query)) {
        // Vincula o parâmetro da consulta
        $stmt->bind_param("i", $denunciaId);

        // Executa a consulta
        if ($stmt->execute()) {
            // Redireciona para a página de lista de denúncias após a atualização
            header("Location: listardenuncia.php");
            exit();
        } else {
            // Caso ocorra um erro na execução da consulta
            echo "Erro ao atualizar o status da denúncia: " . $stmt->error;
        }
    } else {
        // Caso ocorra um erro na preparação da consulta
        echo "Erro na preparação da consulta: " . $conn->error;
    }
} else {
    // Caso o ID da denúncia não seja fornecido
    echo "ID de denúncia não fornecido.";
}

// Fechar a conexão
$conn->close();
?>

