<?php
include("conexao.php");  // Incluir a conexão com o banco de dados

// Verificar se o parâmetro 'idusuario' foi fornecido na URL e se é numérico
if (isset($_GET['idusuario']) && is_numeric($_GET['idusuario'])) {
    // Obter o ID do usuário via GET e garantir que seja um número inteiro
    $usu_id = intval($_GET['idusuario']); 

    // Usando prepared statement para prevenir SQL injection
    $sql_code = "DELETE FROM usuarios WHERE idusuario = ?";  // Nome correto da tabela: usuarios
    
    if ($stmt = $mysqli->prepare($sql_code)) {
        // Vincular o parâmetro 'idusuario' como inteiro
        $stmt->bind_param("i", $usu_id);  

        // Executar a consulta
        $stmt->execute();

        // Verificar se a exclusão foi bem-sucedida
        if ($stmt->affected_rows > 0) {
            // Se o usuário foi excluído com sucesso
            echo "
            <script> 
                alert('Usuário excluído com sucesso!');
                location.href='listarusuario.php?inicial';  // Redirecionar após exclusão
            </script>";
        } else {
            // Se nenhum usuário foi excluído (usuário não encontrado ou erro)
            echo "
            <script> 
                alert('Usuário não encontrado ou não foi possível deletá-lo.');
                location.href='listarusuario.php?inicial';  // Redirecionar para a lista
            </script>";
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        // Erro ao preparar a consulta
        echo "Erro ao preparar a consulta. Tente novamente mais tarde.";
    }
} else {
    // Se o parâmetro 'idusuario' não foi fornecido ou não é válido
    echo "
    <script> 
        alert('Parâmetro inválido ou ausente.');
        location.href='listarusuario.php?inicial';  // Redirecionar para a lista
    </script>";
}

// Fechar a conexão com o banco de dados
$mysqli->close();
?>
