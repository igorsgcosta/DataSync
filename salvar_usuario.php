<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "dsync");

// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifique se o campo idnivel foi enviado via POST
if (!isset($_POST['idnivel']) || !is_numeric($_POST['idnivel'])) {
    die("Nível de acesso inválido.");
}

// Obtenha os dados do formulário
$nome = $_POST['nome'];
$datanascimento = $_POST['datanascimento'];
$cpf = $_POST['cpf'];
$usuario = $_POST['usuario'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$cargofuncao = $_POST['cargofuncao'];
$idnivel = $_POST['idnivel'];
$ativo = 1; // Padrão como ativo

// Verificar se o CPF já existe no banco de dados
$sql_check_cpf = "SELECT idusuario FROM usuarios WHERE cpf = ?";
$stmt_check_cpf = $conn->prepare($sql_check_cpf);
$stmt_check_cpf->bind_param("s", $cpf);
$stmt_check_cpf->execute();
$result_check_cpf = $stmt_check_cpf->get_result();

if ($result_check_cpf->num_rows > 0) {
    // CPF já cadastrado, redireciona para a página listarusuario.php
    header("Location: listarusuario.php?mensagem=usuario_existente");
    exit();
}

// Obtenha a descrição do nível de acesso
$sql_nivel = "SELECT descricaodenivel FROM niveldeacesso WHERE idnivel = ?";
$stmt_nivel = $conn->prepare($sql_nivel);
$stmt_nivel->bind_param("i", $idnivel);
$stmt_nivel->execute();
$result_nivel = $stmt_nivel->get_result();

if ($result_nivel->num_rows > 0) {
    $row = $result_nivel->fetch_assoc();
    $descricaodenivel = $row['descricaodenivel']; // Atribuindo a descrição do nível de acesso
} else {
    die("Nível de acesso inválido.");
}

// Insira os dados na tabela usuarios
$sql_insert = "INSERT INTO usuarios (idnivel, nome, datanascimento, cpf, usuario, senha, cargofuncao, descricaodenivel, ativo)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("isssssssi", $idnivel, $nome, $datanascimento, $cpf, $usuario, $senha, $cargofuncao, $descricaodenivel, $ativo);

if ($stmt_insert->execute()) {
    // Usuário salvo com sucesso, redireciona para a página listarusuario.php
    header("Location: listarusuario.php?mensagem=usuario_cadastrado");
    exit();
} else {
    echo "Erro ao salvar usuário: " . $stmt_insert->error;
}

// Fechar conexões
$stmt_nivel->close();
$stmt_insert->close();
$conn->close();
?>
