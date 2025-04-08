<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dsync";

// Conectar ao banco de dados
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($mysqli->connect_error) {
    die("Conexão falhou: " . $mysqli->connect_error);
}

// Obter os dados do formulário
$empresa = 1;  // ID da empresa a ser associada ao formulário (defina o ID corretamente)
$identificacao = $_POST['identificacao'];
$nome = $_POST['nome'];
$orientacao = $_POST['orientacao'];
$acusado = $_POST['acusado'];
$funcaoacusado = $_POST['funcaoacusado'];
$tipoviolencia = $_POST['tipoviolencia'];
$frequencia = $_POST['frequencia'];
$dataocorrido = $_POST['dataocorrido'];
$descricao_fato = $_POST['descricao_fato'];

// Processar arquivos anexados
$anexos = [];
if (isset($_FILES['anexos']) && !empty($_FILES['anexos']['name'][0])) {
    $anexos = $_FILES['anexos'];
}

// Preparar e inserir dados na tabela de denúncias
$sql = "INSERT INTO denuncias (empresa_id, identificacao, nome, orientacao, acusado, funcaoacusado, tipoviolencia, frequencia, dataocorrido, descricao_fato) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Usar prepared statements para evitar SQL injection
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("isssssssss", $empresa, $identificacao, $nome, $orientacao, $acusado, $funcaoacusado, $tipoviolencia, $frequencia, $dataocorrido, $descricao_fato);

// Executar a consulta
if ($stmt->execute()) {
    // Se houver arquivos anexados, faça o upload
    if (!empty($anexos)) {
        $ultimo_id = $stmt->insert_id; // ID da última denúncia inserida
        
        foreach ($anexos['name'] as $key => $filename) {
            $file_tmp = $anexos['tmp_name'][$key];
            $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $upload_dir = "uploads/";
            $new_filename = $ultimo_id . "_" . $key . "." . $file_ext;

            // Verificar se a extensão do arquivo é válida
            if (in_array($file_ext, ['jpg', 'jpeg', 'png'])) {
                if (move_uploaded_file($file_tmp, $upload_dir . $new_filename)) {
                    // Inserir os anexos no banco de dados
                    $sql_anexo = "INSERT INTO anexos (denuncia_id, nome_arquivo) VALUES (?, ?)";
                    $stmt_anexo = $mysqli->prepare($sql_anexo);
                    $stmt_anexo->bind_param("is", $ultimo_id, $new_filename);
                    $stmt_anexo->execute();
                }
            }
        }
    }
    echo "Formulário enviado com sucesso!";
} else {
    echo "Erro ao enviar o formulário: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
