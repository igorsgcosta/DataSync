<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dsync";

// Criar conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Definir a consulta SQL para buscar os usuários
$sql = "SELECT nome, datanascimento, usuario, cpf, cargofuncao, niveldeacesso FROM usuarios";
$result = $conn->query($sql);
?>






<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Tipos de Violências</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Oswald", sans-serif;
        }

        .interface {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header {
            width: 100%;
            background-color: #424147;
        }

        .top-header > .interface {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .top-header {
            background-color: #fff;
            padding: 20px 4%;
        }

        .top-header .logotipo img {
            max-width: 240px;
        }

        .top-header .btn-social {
            display: flex;
            gap: 10px;
            margin-left: auto;
        }

        .top-header .btn-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            font-size: 20px;
            border-radius: 50%;
            background-color: transparent;
            border: 2px solid #000;
            text-decoration: none;
            color: #000;
        }

        .bottom-header {
            background-color: #424147;
        }

        .bottom-header .interface {
            display: flex;
            justify-content: center;
        }

        .bottom-header nav ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .bottom-header nav ul li {
            position: relative;
        }

        .bottom-header nav ul li a {
            color: #fff;
            padding: 20px 40px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .bottom-header nav ul li a:hover {
            background-color: #68eda4;
            color: #424147;
            box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.3);
        }

        .drop-hover .drop {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #6f6d77;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: opacity 0.3s ease, transform 0.3s ease;
            opacity: 0;
            transform: translateY(-10px);
        }

        .drop-hover:hover .drop {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .drop-hover .drop a {
            color: #fff;
            padding: 10px;
            display: block;
            text-decoration: none;
            transition: background-color 0.2s ease;
            text-align: center;
        }

        .drop-hover .drop a:hover {
            background-color: #68eda4;
        }

        .table-container {
            padding: 40px 4%;
        }

        .table-container h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .countdown {
            font-size: 0.9em;
            color: #ff0000;
            margin-left: 10px;
        }

        .btn-disabled {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
</head>
<body>

    <header>
        <section class="top-header">
            <div class="interface">
                <div class="logotipo">
                    <a href="#">
                        <img src="logo.png" alt="Logotipo">
                    </a>
                </div>
                
                <div class="btn-social">
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </section>

        <section class="bottom-header">
            <div class="interface">
                <nav>
                    <ul>
                        <li class="drop-hover"><a href="index.php">Início<i class="bi bi-caret-down-fill"></i></a>
                            <div class="drop">
                                <a href="dashboard.php">Dashboard</a>
                            </div>
                        </li>
                        <li class="drop-hover"><a href="">Denúncias<i class="bi bi-caret-down-fill"></i></a>
                            <div class="drop">
                                <a href="novadenuncia.php">Nova Denúncia</a>
                                <a href="listardenuncia.php">Listar Denúncia</a>
                                <a href="arquivadas.php">Arquivadas</a>
                            </div>
                        </li>
                        <li class="drop-hover"><a href="#">Usuário<i class="bi bi-caret-down-fill"></i></a>
                            <div class="drop">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#novoUsuarioModal">Novo Usuário</a>
                                <a href="listarusuario.php">Listar Usuário</a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#excluirUsuarioModal">Excluir Usuário</a>
                            </div>
                        </li>
                        <li class="drop-hover"><a href="empresas.php">Empresas<i class="bi bi-caret-down-fill"></i></a>                        
                            <div class="drop">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#cadastroModal">Cadastrar</a>                                
                            </div>
                        </li>
                        <li class="drop-hover"><a href="#">Configurações<i class="bi bi-caret-down-fill"></i></a>                        
                            <div class="drop">
                                <a href="cargosfuncao.php">Cargo/Função</a>
                                <a href="tiposdeviolencias.php">Tipos de Violências</a>
                                <a href="notificacoes.php">Notificações</a>
                                <a href="formularios.php">Formulário</a>
                            </div>
                        </li>
                        <li class="drop-hover"><a href="gerarrelatorio.php">Relatórios<i class="bi bi-caret-down-fill"></i></a>                        
                            <div class="drop">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#filtroAssedioModal">Gerar Relatórios</a>
                                <a href="historico.php">Histórico</a>
                                <a href="planodeação.php">Plano de Ação</a>
                            </div>
                        </li>
                        <li class="drop-hover"><a href="#">Opções<i class="bi bi-caret-down-fill"></i></a>                        
                            <div class="drop">
                                <a href="#">Suporte</a>
                                <a href="#">FAQs</a>
                                <a href="login.php">Sair</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </header>

    <div class="container table-container"> 
        <h2>Tipos de Violências</h2>
        
        <!-- Botão para abrir o modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#criarViolenciaModal">
            Adicionar Tipo de Violência
        </button>

        <table class="table table-bordered" id="denunciasTable">
            <thead>
                <tr>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Exemplo de como listar os tipos de violência
                    // Substitua pela conexão e consulta ao seu banco de dados
                    include "conexao.php"; // Certifique-se de incluir sua conexão ao banco

                    $query = "SELECT descricaotipo FROM tipodeviolencia";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . htmlspecialchars($row['descricaotipo']) . "</td></tr>";
                        }
                    } else {
                        echo "<tr><td>Nenhum tipo de violência cadastrado.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>


    <!-- Modal Novo Usuário -->
    <div class="modal fade" id="novoUsuarioModal" tabindex="-1" aria-labelledby="novoUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="novoUsuarioModalLabel">Novo Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="salvar_usuario.php" method="POST" id="formNovoUsuario">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input name="nome" type="text" class="form-control" id="nome" placeholder="Digite o nome completo" 
                                pattern="[A-Za-zÀ-ÿ ]+" title="O nome deve conter apenas letras" required />
                        </div>
                        <div class="mb-3">
                            <label for="datanascimento" class="form-label">Data de Nascimento</label>
                            <input name="datanascimento" type="date" class="form-control" id="datanascimento" required />
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input name="usuario" type="text" class="form-control" id="usuario" placeholder="Usuário" 
                                pattern="^[A-Za-z0-9_]+$" title="O nome de usuário deve conter apenas letras, números e sublinhados" required />
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <small>(A senha deve ter entre 8 e 16 caracteres.)</small>
                            <input name="senha" type="password" class="form-control" id="senha" placeholder="Digite a Senha"
                                minlength="8" maxlength="16" required />
                        </div>
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF" 
                                oninput="mascaraCPF(this)" maxlength="14" required>
                            <span id="mensagemCPF" style="color: red;"></span> <!-- Exibição da mensagem de erro -->
                        </div>
                        <div class="mb-3">
                            <label for="cargofuncao" class="form-label">Cargo/Função</label>
                            <input name="cargofuncao" type="text" class="form-control" id="cargofuncao" placeholder="Digite o cargo ou função" required />
                        </div>
                        <div class="mb-3">
                            <label for="niveldeacesso" class="form-label">Nível de Acesso</label>
                            <select name="idnivel" class="form-select" id="niveldeacesso" required>
                                <option value="" disabled selected>Selecione...</option>
                                <?php while ($row = $funcaoResult->fetch_assoc()): ?>
                                    <option value="<?= htmlspecialchars($row['idnivel']); ?>">
                                        <?= htmlspecialchars($row['descricaodenivel']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    $conn->close();
    ?>


    
    <!-- Modal Empresas -->
    <div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Cabeçalho do Modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="cadastroModalLabel">Cadastrar Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <!-- Corpo do Modal -->
                <div class="modal-body">
                    <form action="cadastrar_empresa.php" method="POST" id="formEmpresa"> 
                        <!-- CNPJ e Nome da Empresa -->
                        <div class="mb-3">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Digite o CNPJ" 
                                oninput="mascaraCNPJ(this)" maxlength="18" required>
                            <span id="mensagemCNPJ" style="color: red;"></span> <!-- Exibição da mensagem de erro -->
                        </div>
                        <div class="mb-3">
                            <label for="nomeempresa" class="form-label">Nome da Empresa</label>
                            <input type="text" class="form-control" id="nomeempresa" name="nomeempresa" placeholder="Digite o Nome da Empresa">
                        </div>

                        <!-- Razão Social e Tipo -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="razao" class="form-label">Razão Social</label>
                                <input type="text" class="form-control" id="razao" name="razao" placeholder="Razão Social">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select class="form-select" id="tipo" name="tipo">
                                    <option value="" selected disabled>Selecione</option>
                                    <option value="filial">Filial</option>
                                    <option value="matriz">Matriz</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="" selected disabled>Selecione o Status</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                        </div>

                        <!-- Endereço -->
                        <div class="mb-3">
                            <label class="form-label">Endereço</label>
                            <div class="row g-2">
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Logradouro">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Nº">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" id="uf" name="uf">
                                        <option value="" selected disabled>UF</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Referência (Ex: Loja 1)">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
                                </div>
                            </div>
                        </div>

                        <!-- Botão de Cadastro -->
                        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Criar/Violência -->
    <div class="modal fade" id="criar/violenciaModal" tabindex="-1" aria-labelledby="criar/violenciaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="criar/violenciaModalLabel">Criar/Violência</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nomeCompleto" class="form-label">Tipo de Violência</label>
                            <input type="text" class="form-control" id="nomeCompleto" placeholder="Digite o tipo">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal funcao/cargo -->
    <div class="modal fade" id="funcaoCargoModal" tabindex="-1" aria-labelledby="funcaoCargoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcaoCargoModalLabel">Cadastrar Função/Cargo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form id="formFuncaoCargo">
                        <div class="mb-3">
                            <label for="funcaoCargo" class="form-label">Função ou Cargo</label>
                            <input type="text" class="form-control" id="funcaoCargo" placeholder="Insira a função ou cargo" required aria-describedby="funcaoCargoHelp">
                            <div id="funcaoCargoHelp" class="form-text">Exemplo: Analista de Sistemas, Gerente de Vendas.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                    <div id="feedback" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Filtro Assédio -->
    <div class="modal fade" id="filtroAssedioModal" tabindex="-1" aria-labelledby="filtroAssedioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filtroAssedioModalLabel">Gerar Relatório de Assédio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="periodo" class="form-label">Período</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="dataInicio" placeholder="Data Inicial">
                                </div>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="dataFim" placeholder="Data Final">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tipoAssedio" class="form-label">Tipo de Assédio</label>
                            <select class="form-select" id="tipoAssedio">
                                <option value="todos">Todos</option>
                                <option value="moral">Assédio Moral</option>
                                <option value="sexual">Assédio Sexual</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cargo" class="form-label">Cargo/Função</label>
                            <input type="text" class="form-control" id="cargo" placeholder="Digite o cargo ou função">
                        </div>
                        <div class="mb-3">
                            <label for="setor" class="form-label">Setor</label>
                            <input type="text" class="form-control" id="setor" placeholder="Digite o setor">
                        </div>
                        <div class="mb-3">
                            <label for="setor" class="form-label">Loja</label>
                            <input type="text" class="form-control" id="setor" placeholder="Digite a loja">
                        </div>
                        <button type="button" class="btn btn-primary">Gerar Relatório</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para a máscara de CNPJ -->
    <script>
        function mascaraCNPJ(cnpj) {
            var cnpjValue = cnpj.value;
            
            // Remove qualquer coisa que não seja número
            cnpjValue = cnpjValue.replace(/\D/g, '');
            
            // Aplica a máscara ao CNPJ
            if (cnpjValue.length <= 2) {
                cnpj.value = cnpjValue;
            } else if (cnpjValue.length <= 5) {
                cnpj.value = cnpjValue.replace(/(\d{2})(\d{1})/, '$1.$2');
            } else if (cnpjValue.length <= 8) {
                cnpj.value = cnpjValue.replace(/(\d{2})(\d{3})(\d{1})/, '$1.$2.$3');
            } else if (cnpjValue.length <= 12) {
                cnpj.value = cnpjValue.replace(/(\d{2})(\d{3})(\d{3})(\d{1})/, '$1.$2.$3/$4');
            } else {
                cnpj.value = cnpjValue.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
            }
        }
    </script>

    <script>
        function mascaraCPF(cpf) {
            var v = cpf.value.replace(/\D/g, ""); // Remove tudo o que não é número
            v = v.replace(/(\d{3})(\d)/, "$1.$2"); // Adiciona o ponto após os três primeiros números
            v = v.replace(/(\d{3})(\d)/, "$1.$2"); // Adiciona o ponto após os três próximos números
            v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); // Adiciona o traço
            cpf.value = v;
        }
    </script>

    


    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para a máscara de CNPJ -->
    <script>
        function mascaraCNPJ(cnpj) {
            var cnpjValue = cnpj.value;
            
            // Remove qualquer coisa que não seja número
            cnpjValue = cnpjValue.replace(/\D/g, '');
            
            // Aplica a máscara ao CNPJ
            if (cnpjValue.length <= 2) {
                cnpj.value = cnpjValue;
            } else if (cnpjValue.length <= 5) {
                cnpj.value = cnpjValue.replace(/(\d{2})(\d{1})/, '$1.$2');
            } else if (cnpjValue.length <= 8) {
                cnpj.value = cnpjValue.replace(/(\d{2})(\d{3})(\d{1})/, '$1.$2.$3');
            } else if (cnpjValue.length <= 12) {
                cnpj.value = cnpjValue.replace(/(\d{2})(\d{3})(\d{3})(\d{1})/, '$1.$2.$3/$4');
            } else {
                cnpj.value = cnpjValue.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
            }
        }
    </script>

    <script>
        function mascaraCPF(cpf) {
            var v = cpf.value.replace(/\D/g, ""); // Remove tudo o que não é número
            v = v.replace(/(\d{3})(\d)/, "$1.$2"); // Adiciona o ponto após os três primeiros números
            v = v.replace(/(\d{3})(\d)/, "$1.$2"); // Adiciona o ponto após os três próximos números
            v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); // Adiciona o traço
            cpf.value = v;
        }
    </script>

    <script>
        // Função de validação e mascaramento de CPF
        document.getElementById('formNovoUsuario').addEventListener('submit', function(e) {
            // Previne o envio do formulário para validação
            e.preventDefault();
            
            let valid = true;
            
            // Resetando mensagens de erro
            document.getElementById('mensagemCPF').innerText = "";

            // Validação de CPF
            const cpf = document.getElementById('cpf').value;
            if (!validarCPF(cpf)) {
                valid = false;
                document.getElementById('mensagemCPF').innerText = "CPF inválido!";
            }

            // Se o CPF for válido, envia o formulário
            if (valid) {
                this.submit();
            }
        });

        // Função de validação de CPF
        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos
            if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false; // CPF inválido (sequência de números iguais)

            let soma = 0;
            let resto;

            for (let i = 1; i <= 9; i++) {
                soma += parseInt(cpf.charAt(i - 1)) * (11 - i);
            }
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(9))) return false;

            soma = 0;
            for (let i = 1; i <= 10; i++) {
                soma += parseInt(cpf.charAt(i - 1)) * (12 - i);
            }
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(10))) return false;

            return true;
        }

        // Função de máscara do CPF
        function mascaraCPF(campo) {
            var cpf = campo.value;
            cpf = cpf.replace(/\D/g, ''); // Remove tudo o que não for número
            cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); // Aplica a máscara
            campo.value = cpf;
        }
    </script>
    <script>
        document.getElementById('formFuncaoCargo').addEventListener('submit', function (event) {
        event.preventDefault();
        const input = document.getElementById('funcaoCargo').value.trim();
        const feedback = document.getElementById('feedback');
        
        if (input === '') {
            feedback.textContent = 'Por favor, insira uma função ou cargo.';
            feedback.className = 'text-danger';
        } else {
            feedback.textContent = 'Função/Cargo cadastrado com sucesso!';
            feedback.className = 'text-success';
            this.reset();
        }
    });
    </script>
    
    
</body>
</html>