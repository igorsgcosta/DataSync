<?php
// Conexão com o banco de dados
$host = "127.0.0.1";
$user = "root"; // Substitua pelo seu usuário
$password = ""; // Substitua pela sua senha
$dbname = "dsync"; // Substitua pelo nome do seu banco

$conn = new mysqli($host, $user, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Recebe o CNPJ enviado via POST
$cnpj = $_POST['cnpj'];

// Verifica se o CNPJ já está registrado no banco
$sqlCheck = $conn->prepare("SELECT * FROM empresas WHERE cnpj = ?");
$sqlCheck->bind_param("s", $cnpj);
$sqlCheck->execute();
$result = $sqlCheck->get_result();

if ($result->num_rows > 0) {
    // Retorna mensagem caso o CNPJ já exista
    echo "CNPJ já cadastrado";
} else {
    // Retorna mensagem vazia caso o CNPJ não exista
    echo "";
}

// Fecha a conexão
$conn->close();
?>
