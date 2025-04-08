<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <link rel="stylesheet" href="pagina.css">
</head>
<body>
    <div class="container">
        <h2>Menu</h2>
        
        <ul class="menu">
            <li><a href="index.html" onclick="mostrarSecao('inicio'); return false;" id="linkInicio">Início</a></li>
            <li><a href="areadedenuncia.html" onclick="mostrarSecao('denuncias'); return false;" id="linkDenuncias">Área de Denúncias</a></li>
            <li><a href="relatoriodb.html" onclick="mostrarSecao('relatorio'); return false;" id="linkRelatorio">Relatório com Dashboard</a></li>
            <li><a href="formulario.html" onclick="mostrarSecao('formulario'); return false;" id="linkRelatorio">Formulário</a></li>
            <li><a href="opcoes.html" onclick="mostrarSecao('opcoes'); return false;" id="linkOpcoes">Opções</a></li>            
            <li><a href="login.html" onclick="sair(); return false;">Sair</a></li>
        </ul>
        
        <div>
            <div id="inicio" class="conteudo">
                <h3>Início</h3>
                <p>Bem Vindo!!!</p>
            </div>
        </div>
    </div>