<?php
// Configuração de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loja_vinil";

// Criando a conexão
$conn = new mysqli("localhost", "root", "", "loja_vinil");
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Variável para armazenar a mensagem de feedback
$mensagem = "";

// Função para calcular a idade
function calculaIdade($data_nascimento) {
    $data_nascimento = new DateTime($data_nascimento);
    $hoje = new DateTime();
    return $hoje->diff($data_nascimento)->y;
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos estão definidos antes de acessá-los
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $data_nascimento = isset($_POST['data_nascimento']) ? trim($_POST['data_nascimento']) : '';
    $morada = isset($_POST['morada']) ? trim($_POST['morada']) : '';

    if (empty($nome) || empty($data_nascimento) || empty($morada)) {
        $mensagem = "Por favor, preencha todos os campos obrigatórios.";
    } else {
        $idade = calculaIdade($data_nascimento);
        if ($idade < 18) {
            $mensagem = "Você precisa ter pelo menos 18 anos para finalizar a compra.";
        } else {
            $stmt = $conn->prepare("INSERT INTO encomendas (nome, data_nascimento, morada) VALUES (?, ?, ?)");
            if ($stmt === false) {
                $mensagem = "Erro na preparação da consulta: " . $conn->error;
            } else {
                $stmt->bind_param("sss", $nome, $data_nascimento, $morada);
                if ($stmt->execute()) {
                    $mensagem = "Compra finalizada com sucesso!";
                } else {
                    $mensagem = "Erro ao finalizar a compra: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    }
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soundwave Vinyl - Loja</title>
    <meta name="description" content="A Soundwave é sua loja online de vinis, oferecendo uma vasta seleção de álbuns clássicos e novos lançamentos.">
    <meta name="keywords" content="Vinil, loja de vinil, música, álbuns, discos">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="soundwave.css">
    <style>
        /* css/style.css */
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            margin: 0;
            padding: 0;
            color:white;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: black;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            color:white;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .mensagem {
            color: white;
            background-color: rgb(100, 192, 100);
            padding: 10px;
            margin-bottom: 20px;
            border: 2px solid green;
            font-size:25px;
        }
    </style>
</head>
<body class="sobrenos">
    <!-- Header -->
    <header class="navbar">
    <div class="logo">
        <img src="imagens/soundwavelogo.png" alt="Soundwave Vinyl" width="200" height="100">
    </div>
    <nav>
        <ul>
            <li><a class="btn btn-outline-success me-1" href="soundwavehomepage.php">Home</a></li>
            <li><a class="btn btn-outline-success me-2" href="loja.html">Loja</a></li>
            <li><a class="btn btn-outline-success me-2" href="sobrenos.html">Sobre Nós</a></li>
            <li><a class="btn btn-outline-success me-2" href="admin_login.php">Login</a></li>
        </ul>
    </nav>
    <br>
</header>
<br>
    
    <section>
        <form id="form-compra" method="POST">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="nome" placeholder="Insira seu nome" required>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>
            </div>
            <div class="form-group">
                <label for="morada">Morada:</label>
                <input type="text" id="morada" name="morada" placeholder="Insira sua morada" required>
            </div>
            <button type="submit" class="submit-button">Concluir Compra</button><br><br><br>
            <div class="mensagem">
                <?php if (!empty($mensagem)) echo $mensagem; ?>
            </div>
        </form>
    </section>

    <!-- About Section -->
    <aside class="about"><br>
        <h2> SoundWave Vinyl</h2>
        <p class="p-sobre">Na SoundWave, somos apaixonados por música e pelo som autêntico dos discos de vinil. Nossa coleção é cuidadosamente selecionada para trazer a você o melhor de todos os gêneros e eras.</p>
    </aside>
    
    <footer>
        <p class="copy">&copy; 2024 SoundWave Vinyl. All rights reserved.</p>
        <div class="social-icons">
            <a href="https://www.facebook.com/linkinpark/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/linkinpark/" target="_blank"><i class="fab fa-instagram-square"></i></a>
            <a href="https://x.com/linkinpark" target="_blank"><i class="fab fa-twitter-square"></i></a>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>



