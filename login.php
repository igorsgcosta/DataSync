<?php
include('conexao.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['usuario'])) {
        $erro = "Informe seu Usuário.";
    } elseif (empty($_POST['senha'])) {
        $erro = "Preencha sua senha.";
    } else {
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $_POST['senha'];

        $sql_code = "SELECT * FROM usuarios WHERE usuario = ?";
        $stmt = $mysqli->prepare($sql_code);

        if ($stmt) {
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $sql_query = $stmt->get_result();

            if ($sql_query->num_rows == 1) {
                $login = $sql_query->fetch_assoc();

                if (password_verify($senha, $login['senha'])) {
                    $_SESSION['id'] = $login['idusuario'];
                    $_SESSION['usuario'] = $login['usuario'];

                    header("Location: index.php");
                    exit();
                } else {
                    $erro = "Usuário ou senha incorretos.";
                }
            } else {
                $erro = "Usuário ou senha incorretos.";
            }

            $stmt->close();
        } else {
            $erro = "Erro na preparação da consulta SQL: " . $mysqli->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('tesdt.jpg');
            background-size: cover; 
            background-position: center;
            background-color: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative; 
        }

        .logo {
            position: absolute;
            top: 50px; 
            left: 50%; 
            transform: translateX(-50%); 
            width: 360px;
            height: auto; 
            z-index: 1; 
        }

        .login-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #2196f3;
            max-width: 280px;
            width: 100%; 
            box-sizing: border-box; 
            position: relative; 
            z-index: 2; 
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #2196f3;
            text-align: center;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: calc(100% - 20px); 
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; 
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #2196f3;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #1976d2;
        }
    </style>
</head>
<body>

    <img class="logo" src="logo.png" alt="Logo da Empresa">


    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($erro)): ?>
            <div class="error-message"><?php echo $erro; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <input type="submit" value="Entrar">
        </form>
    </div>

</body>
</html>
