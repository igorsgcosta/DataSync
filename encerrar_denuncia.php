<?php
include 'conexao.php';

$denunciaId = $_GET['id'];
$query = "UPDATE denuncias SET status = 'encerrado' WHERE iddenuncia = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $denunciaId);

if ($stmt->execute()) {
    header("Location: listardenuncia.php");
    exit;
} else {
    echo "Erro ao encerrar denúncia: " . $conn->error;
}
?>
