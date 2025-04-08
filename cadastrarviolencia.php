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
    $descricao = trim($_POST['descricao']);
    
    // Validar entrada
    if (!empty($descricao)) {
        // Gera o código tipo automaticamente (sequencial)
        $sql_codtipo = "SELECT MAX(CAST(codtipo AS UNSIGNED)) AS maxtotal FROM tipodeviolencia";
        $result = $conn->query($sql_codtipo);
        
        if ($result) {
            $row = $result->fetch_assoc();
            // Verifica se já existem registros e incrementa o maior valor encontrado
            $codTipo = isset($row['maxtotal']) ? str_pad($row['maxtotal'] + 1, 5, '0', STR_PAD_LEFT) : '00001';

            // Preparar e executar a inserção no banco de dados
            $stmt = $conn->prepare("INSERT INTO tipodeviolencia (codtipo, descricao) VALUES (?, ?)");
            $stmt->bind_param("ss", $codTipo, $descricao);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Tipo de violência cadastrado com sucesso!');
                        window.location.href = 'tiposdeviolencias.php';</script>";
            } else {
                echo "<script>
                        alert('Erro ao cadastrar o tipo de violência: " . $conn->error . "');
                      </script>";
            }

            $stmt->close();
        } else {
            echo "<script>
                    alert('Erro ao verificar o código do tipo de violência: " . $conn->error . "');
                  </script>";
        }
    } else {
        echo "<script>
                alert('Por favor, preencha todos os campos.');
              </script>";
    }
}

$conn->close();
?>
