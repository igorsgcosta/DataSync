<?php
// Configurações do banco de dados
$servidor = "localhost"; // Alterar se o servidor for diferente
$usuario = "root"; // Alterar para o nome de usuário do banco
$senha = ""; // Alterar para a senha do banco
$banco = "dsync"; // Alterar para o nome do banco

// Criar conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Consulta para obter empresas
$consultaempresas = "SELECT idempresa, nomeempresa FROM empresas";
$empresaResult = $conexao->query($consultaempresas);

// Consulta para obter funções/cargos
$consultafuncao = "SELECT idfuncao, funcaoacusado FROM funcao";
$funcaoResult = $conexao->query($consultafuncao);

// Consulta para obter tipos de violência
$consultatipodeviolencia = "SELECT idtipo, descricaotipo FROM tipodeviolencia";
$tipodeviolenciaResult = $conexao->query($consultatipodeviolencia);
?>

<?php
if (isset($_GET['success'])) {
    echo "<script>alert('Denúncia registrada com sucesso!');</script>";
} elseif (isset($_GET['error'])) {
    echo "<script>alert('Erro ao registrar denúncia. Tente novamente!');</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Notificação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        .required::after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulário de Notificação</h1>
        <form action="salvar_formulario.php" method="POST" enctype="multipart/form-data">
            <!-- Campo: Empresa -->
            <label class="required" for="empresa">Empresa</label>
            <select id="empresa" name="empresa" required>
                <option value="" disabled selected>Selecione...</option>
                <?php while ($row = $empresaResult->fetch_assoc()): ?>
                    <option value="<?= $row['idempresa']; ?>"><?= $row['nomeempresa']; ?></option>
                <?php endwhile; ?>
            </select>

            <!-- Campo: Como se identifica -->
            <label class="required" for="identificacao">Como se identifica?</label>
            <select id="identificacao" name="identificacao" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="Vitima do ato">Vítima do ato</option>
                <option value="Terceiro(a)">Terceiro(a)</option>
            </select>

            <!-- Campo: Nome Completo (Opcional) -->
            <label for="nome">Nome Completo (Opcional)</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo ou deixe em branco para enviar como anônimo">

            <!-- Campo: Qual sua orientação sexual -->
            <label class="required" for="orientacao">Qual sua orientação sexual?</label>
            <select id="orientacao" name="orientacao" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="Heterossexual">Heterossexual</option>
                <option value="Homossexual">Homossexual</option>
                <option value="Bissexual">Bissexual</option>
                <option value="Assexual">Assexual</option>
                <option value="Prefiro não informar">Prefiro não informar</option>
            </select>

            <!-- Campo: Nome do Acusado -->
            <label class="required" for="acusado">Nome do Acusado</label>
            <input type="text" id="acusado" name="acusado" placeholder="Digite o nome do acusado" required>

            <!-- Campo: Função/Cargo do Acusado -->
            <label class="required" for="funcaoacusado">Função/Cargo do Acusado</label>
            <select id="funcaoacusado" name="funcaoacusado" required>
                <option value="" disabled selected>Selecione...</option>
                <?php while ($row = $funcaoResult->fetch_assoc()): ?>
                    <option value="<?= $row['idfuncao']; ?>"><?= $row['funcaoacusado']; ?></option>
                <?php endwhile; ?>
            </select>

            <!-- Campo: Tipo de Violência -->
            <label class="required" for="descricaotipo">Tipo de Violência</label>
            <select id="descricaotipo" name="descricaotipo" required>
                <option value="" disabled selected>Selecione...</option>
                <?php while ($row = $tipodeviolenciaResult->fetch_assoc()): ?>
                    <option value="<?= $row['idtipo']; ?>"><?= $row['descricaotipo']; ?></option>
                <?php endwhile; ?>
            </select>

            <!-- Campo: Quando ocorreu -->
            <label class="required" for="frequencia">Quando ocorreu?</label>
            <select id="frequencia" name="frequencia" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="Primeira vez">Primeira vez</option>
                <option value="Recorrente">Recorrente</option>
            </select>

            <!-- Campo: Data do ocorrido -->
            <label class="required" for="dataocorrido">Data do ocorrido</label>
            <input type="date" id="dataocorrido" name="dataocorrido" required>

            <!-- Campo: Descrição do fato -->
            <label class="required" for="resumo">Descreva o fato ocorrido</label>
            <textarea id="resumo" name="resumo" placeholder="Inclua detalhes como local e contexto" required></textarea>

            <!-- Campo: Anexar arquivos -->
            <label for="anexos">Anexar arquivos:</label>
            <input type="file" id="anexos" name="anexos[]" multiple accept=".jpg,.jpeg,.png">

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>