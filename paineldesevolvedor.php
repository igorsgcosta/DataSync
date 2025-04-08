<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dsync";

// Criando a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para obter os níveis de acesso
$sql = "SELECT idnivel, descricaodenivel FROM niveldeacesso";
$funcaoResult = $conn->query($sql);

if (!$funcaoResult) {
    die("Erro ao buscar níveis de acesso: " . $conn->error);
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Permissões - Web</title>
    <style>
        /* Estilo Geral */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: white;
            padding-top: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            color: #fff;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px;
            text-align: center;
            cursor: pointer;
            border-bottom: 1px solid #444;
        }

        .sidebar ul li:hover {
            background-color: #555;
        }

        .sidebar ul li.active {
            background-color: #4CAF50;
        }

        /* Área de Conteúdo */
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        /* Estilo dos botões de Ação */
        .action-button {
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        .action-button:hover {
            opacity: 0.8;
        }

        /* Formulários de Criação */
        input[type="text"], input[type="email"], input[type="password"], input[type="file"], select, input[type="date"], input[type="cpf"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .permissions-section {
            margin-top: 20px;
        }

        .permissions-section input[type="checkbox"] {
            margin-right: 10px;
        }

        /* Estilo dos Cartões de Usuários */
        .user-list {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .user-card {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            width: 180px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .user-card:hover {
            background-color: #4CAF50;
            color: white;
        }

        .user-card.active {
            background-color: #4CAF50;
            color: white;
        }

        .user-card h4 {
            margin: 10px 0;
        }

        .user-card p {
            font-size: 14px;
            color: #555;
        }

        /* Tabela de Permissões */
        .permissions-form {
            margin-top: 20px;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Painel de Permissões</h2>
        <ul>
            <li id="btn-cadastrar-admin" class="active">Cadastrar Admin</li>
            <li id="btn-notificacao">Notificação</li>
            <li id="btn-usuarios">Usuários</li>
            <li id="btn-financeiro">Financeiro</li>
        </ul>
    </div>

    <!-- Conteúdo Principal -->
    <div class="content">
                <div class="modal-body">
                    <form action="devsalvar_usuario.php" method="POST" id="formNovoUsuario">
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

        <div id="content-notificacao" class="content-section" style="display: none;">
            <h3>Notificação</h3>
            <p>Gerencie suas notificações aqui.</p>
            <button class="action-button">Enviar Notificação</button>
        </div>

        <div id="content-usuarios" class="content-section" style="display: none;">
            <h3>Usuários Cadastrados</h3>

            <!-- Seleção de Função de Usuário -->
            <label for="user-role">Selecione o Usuário para Administrador:</label>
            <select id="user-role" name="user-role">
                <option value="">Escolha um usuário</option>
                <!-- As opções de usuários serão preenchidas dinamicamente -->
            </select><br><br>

            <!-- Lista de Usuários -->
            <div class="user-list" id="user-list">
                <!-- Cartões de usuários serão inseridos aqui -->
            </div>

            <!-- Permissões de Usuário -->
            <h3>Editar Permissões</h3>
            <form id="permissions-form" class="permissions-form">
                <label><input type="checkbox" name="permissions" value="view-dashboard"> Visualizar Dashboard</label><br>
                <label><input type="checkbox" name="permissions" value="manage-users"> Gerenciar Usuários</label><br>
                <label><input type="checkbox" name="permissions" value="access-settings"> Acessar Configurações</label><br>
                <label><input type="checkbox" name="permissions" value="modify-content"> Modificar Conteúdo</label><br>
                <label><input type="checkbox" name="permissions" value="view-reports"> Visualizar Relatórios</label><br>
                <label><input type="checkbox" name="permissions" value="view-workspace"> Visualizar Área de Trabalho</label><br><br>

                <button type="submit" class="action-button">Salvar Permissões</button>
            </form>
        </div>

        <div id="content-financeiro" class="content-section" style="display: none;">
            <h3>Financeiro</h3>
            <p>Gerencie informações financeiras aqui.</p>
            <button class="action-button">Ver Relatórios Financeiros</button>
        </div>
    </div>

    <script>
        // Gerenciar as seções visíveis
        const contentSections = document.querySelectorAll('.content-section');
        const sidebarLinks = document.querySelectorAll('.sidebar ul li');

        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Remove a classe active de todos os links
                sidebarLinks.forEach(item => item.classList.remove('active'));
                link.classList.add('active');

                // Esconde todas as seções de conteúdo
                contentSections.forEach(section => {
                    section.style.display = 'none';
                });

                // Mostra a seção correspondente ao link clicado
                if (link.id === 'btn-cadastrar-admin') {
                    document.getElementById('content-cadastrar-admin').style.display = 'block';
                } else if (link.id === 'btn-notificacao') {
                    document.getElementById('content-notificacao').style.display = 'block';
                } else if (link.id === 'btn-usuarios') {
                    document.getElementById('content-usuarios').style.display = 'block';
                    loadUserList(); // Carrega a lista de usuários
                } else if (link.id === 'btn-financeiro') {
                    document.getElementById('content-financeiro').style.display = 'block';
                }
            });
        });

        // Definir comportamento padrão (primeira opção)
        document.getElementById('btn-cadastrar-admin').click();

        // Dados de usuários simulados (para fins de demonstração)
        const users = [
            { name: 'João Silva', email: 'joao@example.com', role: 'Admin', permissions: ['view-dashboard', 'manage-users', 'access-settings'] },
            { name: 'Maria Souza', email: 'maria@example.com', role: 'Moderador', permissions: ['view-dashboard', 'view-reports'] },
            { name: 'Carlos Oliveira', email: 'carlos@example.com', role: 'Usuário', permissions: ['view-dashboard'] }
        ];

        // Função para carregar a lista de usuários como cartões
        function loadUserList() {
            const userList = document.getElementById('user-list');
            const userRoleSelect = document.getElementById('user-role');
            userList.innerHTML = ''; // Limpa a lista
            userRoleSelect.innerHTML = '<option value="">Escolha um usuário</option>'; // Limpa o select

            users.forEach(user => {
                // Adiciona usuários aos cartões
                const card = document.createElement('div');
                card.classList.add('user-card');
                card.innerHTML = `
                    <h4>${user.name}</h4>
                    <p>${user.role}</p>
                `;
                card.onclick = () => selectUser(user);
                userList.appendChild(card);

                // Adiciona os usuários no select
                const option = document.createElement('option');
                option.value = user.email;
                option.textContent = user.name;
                userRoleSelect.appendChild(option);
            });
        }

        // Função para selecionar um usuário
        function selectUser(user) {
            // Desmarcar qualquer usuário previamente selecionado
            const allCards = document.querySelectorAll('.user-card');
            allCards.forEach(card => card.classList.remove('active'));

            // Marcar o cartão selecionado
            const selectedCard = event.target;
            selectedCard.classList.add('active');

            // Preencher o formulário com as permissões do usuário
            const checkboxes = document.querySelectorAll('#permissions-form input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = user.permissions.includes(checkbox.value);
            });

            alert(`Usuário ${user.name} selecionado. Edite as permissões abaixo.`);
        }

        // Exemplo de função para salvar o novo role do usuário
        document.getElementById('permissions-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const selectedEmail = document.getElementById('user-role').value;
            const selectedRole = document.getElementById('admin-role').value;

            if (selectedEmail && selectedRole) {
                const user = users.find(u => u.email === selectedEmail);
                if (user) {
                    user.role = selectedRole;
                    alert(`O usuário ${user.name} agora é ${selectedRole}`);
                }
            }
        });
    </script>

</body>
</html>