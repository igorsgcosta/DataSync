<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Histórico</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Oswald", sans-serif;
        }

        header {
            width: 100%;
        }

        .top-header {
            background-color: #fff;
            padding: 20px 4%;
        }

        .top-header .interface {
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        #assédio-e-violência, #leis-normas {
            padding: 40px 4%;
        }

        #assédio-e-violência {
            background-color: #f4f4f4;
        }

        #leis-normas {
            background-color: #e9ecef;
        }

        #assédio-e-violência h1, #leis-normas h1 {
            font-size: 2em;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        #assédio-e-violência h2, #leis-normas h2 {
            font-size: 1.5em;
            margin: 20px 0;
            color: #444;
        }

        #assédio-e-violência p, #leis-normas p {
            font-size: 1em;
            line-height: 1.6;
            color: #555;
            margin-bottom: 20px;
            text-align: center;
        }

        #assédio-e-violência ul, #leis-normas ul {
            list-style-type: disc;
            margin: 20px 0;
            padding-left: 20px;
        }

        #assédio-e-violência ul li, #leis-normas ul li {
            margin-bottom: 10px;
        }

        .modal-content {
            border-radius: 8px;
            overflow: hidden;
        }

        .modal-header {
            background-color: #424147;
            color: #fff;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-body .form-label {
            color: #333;
        }

        .modal-body .form-control {
            border-radius: 4px;
            border: 1px solid #ccc;
            box-shadow: none;
        }

        .modal-body .form-control:focus {
            border-color: #68eda4;
            box-shadow: 0 0 0 0.2rem rgba(104, 237, 164, 0.25);
        }

        .modal-body .btn-primary {
            background-color: #68eda4;
            border: none;
        }

        .modal-body .btn-primary:hover {
            background-color: #57d89a;
        }

        .modal-dialog {
            margin: 1.75rem auto;
        }

        .modal-content {
            background-color: #fff;
        }

        .btn-print {
            margin-top: 20px;
        }

        .btn-accept {
            margin: 0;
            padding: 5px 10px;
            font-size: 14px;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .btn-accept.yes {
            background-color: #28a745;
        }

        .btn-accept.no {
            background-color: #dc3545;
        }

        .btn-accept:hover {
            opacity: 0.8;
        }

        .btn-disabled {
            pointer-events: none;
            opacity: 0.6;
        }

        .table-container {
            padding: 40px 4%;
        }

        .table-container h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .table-container .btn-download {
            margin-top: 20px;
        }

        .btn-disabled {
            pointer-events: none;
            opacity: 0.6;
        }

        .btn-disabled {
            pointer-events: none;
            opacity: 0.6;
            color: #999;
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
                                <a href="#"data-bs-toggle="modal" data-bs-target="#excluirUsuarioModal">Excluir Usuário</a>
                            </div>
                        </li>
                        <li class="drop-hover"><a href="empresas.php">Empresas<i class="bi bi-caret-down-fill"></i></a>                        
                            <div class="drop">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#cadastroModal">Cadastrar</a>                                
                            </div>
                        </li>
                        <li class="drop-hover"><a href="#">Configurações<i class="bi bi-caret-down-fill"></i></a>                        
                            <div class="drop">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#funcaoCargoModal">Criar Cargo/Função</a>
                                <a href="tiposdeviolencias.php">Tipos de Violências</a>
                                <a href="notificacoes.php">Notificações</a>
                                <a href="formularios.php">Formulário</a>
                            </div>
                        </li>
                        <li class="drop-hover"><a href="#">Relatórios<i class="bi bi-caret-down-fill"></i></a>                        
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
        <h2>Histórico</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Acusado</th>
                    <th>Loja</th>
                    <th>Data da Denúncia</th>
                    <th>Tipo de Violência</th>
                    <th>Anexos</th>
                    <th>Relatório</th>
                    <th>Ações</th>
                </tr>
            </thead>
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

    
    <!-- Modal Excluir Usuário -->
    <div class="modal fade" id="excluirUsuarioModal" tabindex="-1" aria-labelledby="excluirUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="excluirUsuarioModalLabel">Excluir Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nomeCompleto" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nomeCompleto" placeholder="Digite o nome completo">
                        </div>
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" placeholder="Digite o CPF">
                        </div>
                        <button type="submit" class="btn btn-primary">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                        <form>
                            <!-- CNPJ e Nome da Empresa -->
                            <div class="mb-3">
                                <label for="cnpj" class="form-label">CNPJ</label>
                                <input type="text" class="form-control" id="cnpj" placeholder="Digite o CNPJ">
                            </div>
                            <div class="mb-3">
                                <label for="nomeEmpresa" class="form-label">Nome da Empresa</label>
                                <input type="text" class="form-control" id="nomeEmpresa" placeholder="Nome da Empresa">
                            </div>
    
                            <!-- Razão Social e Tipo -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="razao" class="form-label">Razão Social</label>
                                    <input type="text" class="form-control" id="razao" placeholder="Razão Social">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tipo" class="form-label">Tipo</label>
                                    <select class="form-select" id="tipo">
                                        <option value="" selected disabled>Selecione</option>
                                        <option value="filial">Filial</option>
                                        <option value="matriz">Matriz</option>
                                    </select>
                                </div>
                            </div>
    
                            <!-- Endereço -->
                            <div class="mb-3">
                                <label class="form-label">Endereço</label>
                                <div class="row g-2">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="endereco" placeholder="Logradouro">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="numero" placeholder="Nº">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="cep" placeholder="CEP">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="bairro" placeholder="Bairro">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select" id="uf">
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
                                        <input type="text" class="form-control" id="referencia" placeholder="Referência (Ex: Loja 1)">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="cidade" placeholder="Cidade">
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

    <!-- Modal Criar/Violência -->
    <div class="modal fade" id="funcao/cargoModal" tabindex="-1" aria-labelledby="funcao/cargoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcao/cargoModalLabel">Função/Cargo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nomeCompleto" class="form-label">Função ou Cargo</label>
                            <input type="text" class="form-control" id="nomeCompleto" placeholder="Função ou Cargo">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Desabilitar os links de download inicialmente
            const downloadLinks = document.querySelectorAll(".download-link");
            downloadLinks.forEach(link => {
                link.classList.add("btn-disabled");
                link.setAttribute("disabled", true);
            });
    
            // Habilitar o download após clicar em "Investigar"
            const investigateButtons = document.querySelectorAll(".investigate");
            investigateButtons.forEach((button, index) => {
                button.addEventListener("click", function () {
                    const associatedLinks = document.querySelectorAll("tbody tr")[index].querySelectorAll(".download-link");
                    associatedLinks.forEach(link => {
                        link.classList.remove("btn-disabled");
                        link.removeAttribute("disabled");
                    });
                    alert("Downloads habilitados para esta denúncia.");
                });
            });
        });

    
    </script>


</body>
</html>