<?php
// Inclui a conexão com o banco de dados
include("conexao.php");

// Inicializa variáveis
$errorMessage = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $idusuario = intval($_POST['idusuario']);
    $nome = htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8');
    $datanascimento = $_POST['datanascimento'];
    $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
    $cpf = htmlspecialchars(trim($_POST['cpf']), ENT_QUOTES, 'UTF-8');
    $cargofuncao = htmlspecialchars(trim($_POST['cargofuncao']), ENT_QUOTES, 'UTF-8');
    $idnivel = intval($_POST['niveldeacesso']);
    $senha = trim($_POST['senha']); // Senha opcional

    // Prepara a consulta para atualização de dados do usuário
    $sql = "UPDATE usuarios SET nome=?, datanascimento=?, usuario=?, cpf=?, cargofuncao=?, idnivel=?";

    $params = [$nome, $datanascimento, $usuario, $cpf, $cargofuncao, $idnivel];

    // Se a senha foi fornecida, adiciona ao SQL
    if (!empty($senha)) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql .= ", senha=?";
        $params[] = $senhaHash;
    }

    // Finaliza a consulta
    $sql .= " WHERE idusuario=?";
    $params[] = $idusuario;

    // Executa a atualização no banco de dados
    try {
        $stmt = $mysqli->prepare($sql);

        // Define os tipos de parâmetros dinamicamente
        $types = str_repeat("s", count($params) - 1) . "i"; // Ajusta os tipos (strings e inteiro)
        $stmt->bind_param($types, ...$params); // Associa os parâmetros

        // Executa a query
        if ($stmt->execute()) {
            echo "<script>alert('Usuário atualizado com sucesso!'); window.location.href = 'listarusuario.php';</script>";
            exit;
        } else {
            $errorMessage = "Erro ao atualizar o usuário. Por favor, tente novamente.";
        }
    } catch (mysqli_sql_exception $e) {
        $errorMessage = "Erro SQL: " . $e->getMessage(); // Log para depuração
    }
} elseif (isset($_GET['idusuario']) && !empty($_GET['idusuario'])) {
    // Verifica se o ID do usuário foi passado pela URL
    $idusuario = intval($_GET['idusuario']);
    $sql = "
        SELECT u.idusuario, u.nome, u.datanascimento, u.usuario, u.cpf, 
               u.cargofuncao, u.idnivel, n.descricaodenivel
        FROM usuarios u
        JOIN niveldeacesso n ON u.idnivel = n.idnivel
        WHERE u.idusuario = ?
    ";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        $errorMessage = "Usuário não encontrado.";
    }
} else {
    $errorMessage = "ID do usuário não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Usuário</h2>
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger"><?= $errorMessage ?></div>
    <?php endif; ?>
    <?php if (isset($usuario)): ?>
        <form action="editar_usuario.php" method="POST">
            <input type="hidden" name="idusuario" value="<?= htmlspecialchars($usuario['idusuario']) ?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                <input name="nome" type="text" class="form-control" id="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required />
            </div>
            <div class="mb-3">
                <label for="datanascimento" class="form-label">Data de Nascimento</label>
                <input name="datanascimento" type="date" class="form-control" id="datanascimento" value="<?= htmlspecialchars($usuario['datanascimento']) ?>" required />
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input name="usuario" type="text" class="form-control" id="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required />
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input name="cpf" type="text" class="form-control" id="cpf" value="<?= htmlspecialchars($usuario['cpf']) ?>" required />
            </div>
            <div class="mb-3">
                <label for="cargofuncao" class="form-label">Cargo/Função</label>
                <input name="cargofuncao" type="text" class="form-control" id="cargofuncao" value="<?= htmlspecialchars($usuario['cargofuncao']) ?>" required />
            </div>
            <div class="mb-3">
                <label for="niveldeacesso" class="form-label">Nível de Acesso</label>
                <select name="niveldeacesso" class="form-select" id="niveldeacesso" required>
                    <?php
                    // Carrega os níveis de acesso
                    $sql_nivel = "SELECT idnivel, descricaodenivel FROM niveldeacesso ORDER BY descricaodenivel ASC";
                    $result_nivel = $mysqli->query($sql_nivel);
                    while ($nivel = $result_nivel->fetch_assoc()) {
                        $selected = ($usuario['idnivel'] == $nivel['idnivel']) ? 'selected' : '';
                        echo "<option value='{$nivel['idnivel']}' $selected>{$nivel['descricaodenivel']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Nova Senha (opcional)</label>
                <input name="senha" type="password" class="form-control" id="senha" placeholder="Digite a nova senha" />
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$mysqli->close();
?>
