<?php
// Inicie a sessão se for necessário verificar a autenticação
session_start();

// Verifique se o usuário está autenticado, se necessário
// if (!isset($_SESSION['usuario'])) {
//     http_response_code(403);
//     die('Acesso negado');
// }

// Recebe o nome do arquivo como parâmetro GET
$arquivo = $_GET['file'] ?? null;

if ($arquivo) {
    // Caminho completo do arquivo
    $caminho = __DIR__ . '/uploads/' . $arquivo;

    // Verifica se o arquivo existe
    if (file_exists($caminho)) {
        // Configura os cabeçalhos HTTP para download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($caminho) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($caminho));

        // Envia o arquivo para o navegador
        readfile($caminho);
        exit;
    } else {
        http_response_code(404);
        echo "Arquivo não encontrado.";
    }
} else {
    http_response_code(400);
    echo "Parâmetro de arquivo inválido.";
}
