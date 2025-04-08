<?php  
// Configuração do banco de dados
$servername = "localhost";
$username = "root"; // Usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "dsync"; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Obter dados do formulário
$idempresa = $_POST['empresa'];
$idfuncao = $_POST['funcaoacusado'];
$idtipo = $_POST['descricaotipo'];
$nomeempresa = ""; // Inicializar para buscar no banco se necessário
$cnpj = ""; // Inicializar para buscar no banco se necessário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null; // Campo opcional
$identificacao = $_POST['identificacao'];
$orientacao = $_POST['orientacao'];
$acusado = $_POST['acusado'];
$frequencia = $_POST['frequencia'];
$dataocorrido = $_POST['dataocorrido'];
$resumo = $_POST['resumo']; // Mudou de descricao para resumo
$reincidente = "Não"; // Inicialmente marcado como "Não"

// Consultar CNPJ e Nome da empresa
$sqlEmpresa = "SELECT cnpj, nomeempresa FROM empresas WHERE idempresa = ?";
$stmtEmpresa = $conn->prepare($sqlEmpresa);
$stmtEmpresa->bind_param("i", $idempresa);
$stmtEmpresa->execute();
$stmtEmpresa->bind_result($cnpj, $nomeempresa);
$stmtEmpresa->fetch();
$stmtEmpresa->close();

// Consultar nome da função do acusado
$sqlFuncao = "SELECT funcaoacusado FROM funcao WHERE idfuncao = ?";
$stmtFuncao = $conn->prepare($sqlFuncao);
$stmtFuncao->bind_param("i", $idfuncao);
$stmtFuncao->execute();
$stmtFuncao->bind_result($nomefuncao);
$stmtFuncao->fetch();
$stmtFuncao->close();

// Consultar a descrição do tipo de violência
$sqlTipoViolencia = "SELECT descricaotipo FROM tipodeviolencia WHERE idtipo = ?";
$stmtTipoViolencia = $conn->prepare($sqlTipoViolencia);
$stmtTipoViolencia->bind_param("i", $idtipo);
$stmtTipoViolencia->execute();
$stmtTipoViolencia->bind_result($descricaoTipoViolencia);
$stmtTipoViolencia->fetch();
$stmtTipoViolencia->close();

// Manipular upload de arquivos
$uploadedFiles = [];
if (!empty($_FILES['anexos']['name'][0])) {
    $uploadDir = "uploads/"; // Diretório de upload
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    foreach ($_FILES['anexos']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['anexos']['name'][$key]);
        $fileType = $_FILES['anexos']['type'][$key];
        $fileSize = $_FILES['anexos']['size'][$key];
        $targetFilePath = $uploadDir . time() . "_" . $fileName;

        if (move_uploaded_file($tmpName, $targetFilePath)) {
            $uploadedFiles[] = [
                'nome' => $fileName,
                'caminho' => $targetFilePath,
                'tipo' => $fileType,
                'tamanho' => $fileSize
            ];
        }
    }
}

// Inserir dados na tabela denuncias
$sql = "INSERT INTO denuncias (
            idempresa, nomeempresa, cnpj, idfuncao, idtipo, descricaotipo, 
            nome, identificacao, orientacao, acusado, funcaoacusado, 
            frequencia, dataocorrido, resumo, criadoem, status, 
            reincidente, hora
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'Pendente', ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "issssssssssssss",
    $idempresa,
    $nomeempresa,
    $cnpj,
    $idfuncao,
    $idtipo,
    $descricaoTipoViolencia,
    $nome,
    $identificacao,
    $orientacao,
    $acusado,
    $nomefuncao,
    $frequencia,
    $dataocorrido,
    $resumo,
    $reincidente
);

if ($stmt->execute()) {
    $iddenuncia = $stmt->insert_id; // Capturar o ID da denúncia inserida

    // Inserir dados dos anexos na tabela `anexos`
    if (!empty($uploadedFiles)) {
        $sqlAnexos = "INSERT INTO anexos (iddenuncia, nomearquivo, caminhoarquivo, tipoarquivo, tamanhoarquivo, data) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmtAnexos = $conn->prepare($sqlAnexos);

        foreach ($uploadedFiles as $file) {
            $stmtAnexos->bind_param("isssi", $iddenuncia, $file['nome'], $file['caminho'], $file['tipo'], $file['tamanho']);
            $stmtAnexos->execute();
        }

        $stmtAnexos->close();
    }

    echo "<script>
        alert('Denúncia registrada com sucesso!');
        window.location.href = 'formulariousu.php';
    </script>";
} else {
    echo "<script>
        alert('Erro ao registrar denúncia: " . $stmt->error . "');
        window.location.href = 'formulariousu.php';
    </script>";
}

// Fechar conexões
$stmt->close();
$conn->close();
?>
