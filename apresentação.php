<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataSync - Gestão Ética e Confiável</title>
    <style>
        /* Reset básico */
        body, h1, h2, h3, p, a {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            overflow-x: hidden;
        }
        header {
            background-color: #3a6ea5;
            color: white;
            padding: 20px 10px;
            text-align: center;
            position: relative;
        }
        header h1 {
            margin: 0;
            animation: fadeInDown 1s ease-in-out;
        }
        header p {
            font-size: 1.2rem;
            margin: 10px 0 0;
            animation: fadeInDown 1.2s ease-in-out;
        }
        .btn-header {
            position: absolute;
            top: 50%;
            right: 10%;
            transform: translateY(-50%);
            display: flex;
            gap: 10px;
        }
        .btn-header a {
            background-color: white;
            color: #3a6ea5;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }
        .btn-header a:hover {
            background-color: #2e5591;
            color: white;
        }
        main {
            padding: 20px;
            text-align: center;
        }
        main h2 {
            animation: fadeInUp 1.5s ease-in-out;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .feature-card {
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            text-align: left;
            transform: scale(0.9);
            transition: transform 0.3s ease-in-out;
            opacity: 0;
            animation: fadeIn 1s ease-in-out forwards;
        }
        .feature-card:hover {
            transform: scale(1);
        }
        .feature-card:nth-child(1) { animation-delay: 0.2s; }
        .feature-card:nth-child(2) { animation-delay: 0.4s; }
        .feature-card:nth-child(3) { animation-delay: 0.6s; }
        .feature-card:nth-child(4) { animation-delay: 0.8s; }
        .feature-card h3 {
            margin-top: 0;
            color: #3a6ea5;
        }
        .cta {
            margin-top: 30px;
            animation: fadeInUp 2s ease-in-out;
        }
        .cta a {
            background-color: #3a6ea5;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2rem;
            display: inline-block;
            transition: background-color 0.3s ease-in-out;
        }
        .cta a:hover {
            background-color: #2e5591;
        }
        .testimonial-section {
            background-color: #e8f4f8;
            padding: 40px 20px;
            margin-top: 40px;
            text-align: center;
        }
        .testimonial-section h2 {
            color: #3a6ea5;
            margin-bottom: 20px;
        }
        .testimonial-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .testimonial-card {
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: left;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }
        .testimonial-card:hover {
            transform: scale(1.05);
        }
        .testimonial-card img {
            border-radius: 50%;
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
        }
        footer {
            margin-top: 40px;
            background-color: #3a6ea5;
            color: white;
            padding: 10px;
            text-align: center;
        }
        /* Animações */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<header>
    <h1>DataSync</h1>
    <p>Transforme seu ambiente de trabalho com ética e segurança.</p>
    <div class="btn-header">
        <a href="#fale-especialista">Fale com Especialista</a>
        <a href="login.php">Login</a>
    </div>
</header>

<main>
    <h2>Por que escolher o DataSync?</h2>
    <p>
        O DataSync é o sistema definitivo para registrar, monitorar e resolver casos de assédio e violência no ambiente de trabalho. 
        Com funcionalidades inovadoras, ele promove um espaço ético e seguro para todos.
    </p>
    <div class="features">
        <div class="feature-card">
            <h3>Gestão Completa</h3>
            <p>Organize e acompanhe denúncias de forma centralizada e eficiente.</p>
        </div>
        <div class="feature-card">
            <h3>Confidencialidade Garantida</h3>
            <p>Permita que os denunciantes escolham entre anonimato ou identificação.</p>
        </div>
        <div class="feature-card">
            <h3>Identificação de Reincidências</h3>
            <p>Detecte comportamentos reincidentes com alertas automáticos.</p>
        </div>
        <div class="feature-card">
            <h3>Relatórios Personalizados</h3>
            <p>Gere gráficos detalhados para análise e decisões informadas.</p>
        </div>
    </div>

    <div class="testimonial-section">
        <h2>O que nossos clientes estão dizendo</h2>
        <div class="testimonial-cards">
            <div class="testimonial-card">
                <img src="https://via.placeholder.com/60" alt="Cliente 1">
                <p>"O DataSync ajudou a nossa empresa a criar um ambiente de trabalho mais seguro e respeitoso. Super recomendo!"</p>
                <h4>João Silva</h4>
                <p>Gerente de RH</p>
            </div>
            <div class="testimonial-card">
                <img src="https://via.placeholder.com/60" alt="Cliente 2">
                <p>"A transparência do DataSync nas análises nos permite agir rapidamente e tomar decisões fundamentadas."</p>
                <h4>Maria Oliveira</h4>
                <p>Diretora de Segurança</p>
            </div>
        </div>
    </div>

    <div class="cta">
        <a href="/register">Experimente Agora</a>
    </div>
</main>

<footer>
    <p>&copy; 2024 DataSync. Todos os direitos reservados.</p>
</footer>

</body>
</html>
