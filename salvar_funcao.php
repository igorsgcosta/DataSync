<?php 
// Configuração do banco de dados
$host = "localhost";
$user = "root";
$password = "";
$dbname = "dsync";

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Habilitar exibição de erros para depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = trim($_POST['descricao']); // Recebe o valor do campo "descricao"
    
    // Validar entrada
    if (!empty($descricao)) {
        // Gera o código função automaticamente (sequencial)
        $sql_codfuncao = "SELECT MAX(CAST(codfuncao AS UNSIGNED)) AS maxtotal FROM funcao";
        $result = $conn->query($sql_codfuncao);
        
        if ($result) {
            $row = $result->fetch_assoc();
            // Verifica se já existem registros e incrementa o maior valor encontrado
            $codFuncao = isset($row['maxtotal']) ? str_pad($row['maxtotal'] + 1, 5, '0', STR_PAD_LEFT) : '00001';

            // Preparar e executar a inserção no banco de dados
            $stmt = $conn->prepare("INSERT INTO funcao (codfuncao, descricao) VALUES (?, ?)");
            $stmt->bind_param("ss", $codFuncao, $descricao);

            if ($stmt->execute()) {
                // Redireciona ou exibe mensagem de sucesso
                echo "<script>
                        alert('Função/Cargo cadastrado com sucesso!');
                        window.location.href = 'cargosfuncao.php'; // Certifique-se de que esta página existe
                      </script>";
            } else {
                echo "<script>
                        alert('Erro ao cadastrar a Função/Cargo: " . $conn->error . "');
                      </script>";
            }

            $stmt->close(); // Fechar o statement
        } else {
            echo "<script>
                    alert('Erro ao verificar o código da Função/Cargo: " . $conn->error . "');
                  </script>";
        }
    } else {
        echo "<script>
                alert('Por favor, preencha todos os campos.');
              </script>";
    }
}

$conn->close(); // Fechar conexão
?>
