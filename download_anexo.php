<?php
// Configurações do banco de dados
$host = "localhost";
$dbname = "dsync";
$username = "root";
$password = "";

// Estabelecer conexão com o banco de dados
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro: Falha na conexão com o banco de dados.");
}

// Verificar se o ID da denúncia foi passado
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitizar o ID da denúncia para evitar SQL Injection
    $iddenuncia = (int)$_GET['id'];

    // Buscar os anexos associados à denúncia no banco de dados
    $query = "SELECT caminhoarquivo, tipoarquivo FROM anexos WHERE iddenuncia = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $iddenuncia);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar se existem anexos para a denúncia
        if ($result->num_rows > 0) {
            // Caminho relativo para a pasta de uploads
            $upload_dir = 'uploads/';
            
            // Criar um novo arquivo ZIP
            $zip = new ZipArchive();
            $zip_filename = 'anexos_denuncia_' . $iddenuncia . '.zip';

            if ($zip->open($zip_filename, ZipArchive::CREATE) === TRUE) {
                // Adicionar cada anexo ao arquivo ZIP
                while ($anexo = $result->fetch_assoc()) {
                    $filepath = $upload_dir . basename(trim($anexo['caminhoarquivo']));
                    if (file_exists($filepath) && is_readable($filepath)) {
                        // Adiciona o arquivo ao ZIP
                        $zip->addFile($filepath, basename($filepath));
                    }
                }

                // Fechar o arquivo ZIP
                $zip->close();

                // Configurar cabeçalhos para download do ZIP
                header('Content-Description: File Transfer');
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="' . basename($zip_filename) . '"');
                header('Content-Length: ' . filesize($zip_filename));
                header('Cache-Control: no-cache, no-store, must-revalidate');
                header('Pragma: no-cache');
                header('Expires: 0');

                // Ler o arquivo ZIP e enviá-lo para o navegador
                readfile($zip_filename);

                // Deletar o arquivo ZIP após o download
                unlink($zip_filename);
                exit; // Parar a execução após o download
            } else {
                echo "Erro: Não foi possível criar o arquivo ZIP.";
            }
        } else {
            echo "Erro: Nenhum anexo encontrado para esta denúncia.";
        }
        $stmt->close();
    } else {
        echo "Erro: Não foi possível consultar o banco de dados.";
    }
} else {
    echo "Erro: ID da denúncia não informado.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
