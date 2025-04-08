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

// Recebe os dados do formulário
$cnpj = $_POST['cnpj'] ?? ''; // Recebe o CNPJ
$nomeempresa = $_POST['nomeempresa'] ?? null;
$razao = $_POST['razao'] ?? null;
$tipo = $_POST['tipo'] ?? null;
$logradouro = $_POST['logradouro'] ?? null;
$numero = $_POST['numero'] ?? null;
$cep = $_POST['cep'] ?? null;
$bairro = $_POST['bairro'] ?? null;
$uf = $_POST['uf'] ?? null;
$cidade = $_POST['cidade'] ?? null;
$referencia = $_POST['referencia'] ?? ''; // Referência é opcional
$status = $_POST['status'] ?? 'Ativo';

// Remove os caracteres não numéricos do CNPJ
$cnpjNumeros = preg_replace('/[^0-9]/', '', $cnpj);

// Verifica se o CNPJ já está cadastrado no banco de dados
$query = $conn->prepare("SELECT cnpj FROM empresas WHERE cnpj = ?");
$query->bind_param("s", $cnpj);
$query->execute();
$query->store_result();

if ($query->num_rows > 0) {
    echo "<script>
        alert('CNPJ já cadastrado. Cadastro não permitido.');
        window.history.back();
    </script>";
    $query->close();
    $conn->close();
    exit;
}
$query->close();

// Prepara a query SQL para inserção com prepared statements
$sql = $conn->prepare("INSERT INTO empresas (cnpj, nomeempresa, razao, tipo, logradouro, numero, cep, bairro, uf, cidade, referencia, status) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$sql->bind_param(
    "ssssssssssss", 
    $cnpj, $nomeempresa, $razao, $tipo, $logradouro, $numero, $cep, $bairro, $uf, $cidade, $referencia, $status
);

if ($sql->execute()) {
    // Exibe o CNPJ formatado com todos os caracteres
    echo "<script>
        alert('Empresa cadastrada com sucesso! CNPJ: " . formatarCNPJ($cnpj) . "');
        window.location.href = 'empresas.php';
    </script>";

    // Recupera o ID da nova empresa
    $id_empresa = $conn->insert_id;

    // Associa o usuário logado à nova empresa
    // Supondo que a sessão do usuário já esteja iniciada
    session_start();
    $id_usuario = $_SESSION['idusuario'];  // ID do usuário logado
    
    $sql_associar_empresa = $conn->prepare("INSERT INTO usuarios_empresas (idusuario, idempresa) VALUES (?, ?)");
    $sql_associar_empresa->bind_param("ii", $id_usuario, $id_empresa);

    if ($sql_associar_empresa->execute()) {
        // Associado com sucesso
        // Você pode adicionar mais ações aqui, como redirecionar ou mostrar uma mensagem
    } else {
        echo "<script>
                alert('Erro ao associar o usuário à empresa.');
                window.history.back();
              </script>";
    }

    // Fecha a preparação para associar
    $sql_associar_empresa->close();
} else {
    echo "<script>
        alert('Erro ao cadastrar: " . addslashes($conn->error) . "');
        window.history.back();
    </script>";
}

// Fecha a conexão
$conn->close();

// Função para formatar CNPJ
function formatarCNPJ($cnpj) {
    return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj);
}
?>
