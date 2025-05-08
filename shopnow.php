<?php
session_start(); 
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
    

    </style>
    <script type="text/javascript">
        // Função para mostrar a lista de produtos
        function mostrarProdutos() {
            var lista = document.getElementById('produtos');
            if (lista.style.display === 'none' || lista.style.display === '') {
                // Carregar produtos via AJAX
                fetch('listarprodutos.php') // Substitua pelo seu arquivo PHP
                    .then(response => {
                        // Verifica se a resposta foi bem-sucedida
                        if (!response.ok) {
                            throw new Error('Erro ao carregar os produtos: ' + response.status);
                        }
                        return response.text();
                    })
                    .then(data => {
                        document.getElementById('produtos-lista').innerHTML = data; // Atualiza a lista de produtos
                        lista.style.display = 'block'; // Exibe a lista
                    })
                    .catch(error => console.error('Erro ao carregar os produtos:', error));
            } else {
                lista.style.display = 'none'; // Oculta a lista se já estiver visível
            }
        }
    </script>
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
  
    <main>
    <div>
        <h1>Carrinho de Compras</h1><br><br>
        
    </div>

    <!-- Botão para mostrar/ocultar a lista de produtos -->
     <div class="nossosdiscos">
    <button  onclick="mostrarProdutos()">Nossos discos</button></div>

    <!-- Div onde os produtos serão exibidos ao clicar no botão -->
    <div id="produtos" style="display: none;"> <!-- A lista é inicialmente oculta -->
        <h2>Lista de Discos</h2>
        <div id="produtos-lista"></div> <!-- A lista de produtos será carregada aqui -->
    </div>

    <?php

// Conexão com a base de dados
$conn = new mysqli("localhost", "root", "", "loja_vinil");

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado para adicionar um produto ao carrinho
if (isset($_POST['adicionar_carrinho'])) {
    $produto_id = intval($_POST['produto_id']);
    $produto_nome = htmlspecialchars($_POST['produto_nome']);
    $produto_preco = floatval($_POST['produto_preco']);

    // Verificar se o produto está disponível em estoque
    $result = $conn->query("SELECT quantidade FROM produtos WHERE id = $produto_id");
    if ($result) { // Verificar se a consulta foi bem-sucedida
        $estoque = $result->fetch_assoc()['quantidade'];

        if ($estoque > 0) {
            // Verificar se o carrinho já existe
            if (!isset($_SESSION['carrinho'])) {
                $_SESSION['carrinho'] = array(); // Criar o carrinho se não existir
            }

            // Adicionar o produto ao carrinho (por ID)
            if (isset($_SESSION['carrinho'][$produto_id])) {
                // Verifica se há estoque suficiente para aumentar a quantidade
                if ($_SESSION['carrinho'][$produto_id]['quantidade'] < $estoque) {
                    $_SESSION['carrinho'][$produto_id]['quantidade'] += 1; // Incrementar a quantidade
                } else {
                    echo "<script>alert('Não há estoque suficiente para adicionar mais desse produto.');</script>";
                }
            } else {
                $_SESSION['carrinho'][$produto_id] = array(
                    'nome' => $produto_nome,
                    'preco' => $produto_preco,
                    'quantidade' => 1 // Inicializa a quantidade como 1
                );
            }

            // Reduzir a quantidade disponível no estoque
            if ($conn->query("UPDATE produtos SET quantidade = quantidade - 1 WHERE id = $produto_id") === FALSE) {
                echo "<script>alert('Erro ao atualizar o estoque: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Produto indisponível em estoque!');</script>"; // Mensagem de alerta se o produto estiver indisponível
        }
    }
}

// Verificar se o formulário foi enviado para zerar o carrinho
if (isset($_POST['zerar_carrinho'])) {
    // Verifica se o carrinho existe e se é um array
    if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
        // Retornar as quantidades dos produtos do carrinho para o estoque
        foreach ($_SESSION['carrinho'] as $produto_id => $produto) {
            $quantidade = intval($produto['quantidade']);
            
            // Atualiza o estoque na base de dados
            $sql = "UPDATE produtos SET quantidade = quantidade + $quantidade WHERE id = $produto_id";
            if ($conn->query($sql) === FALSE) {
                echo "<script>alert('Erro ao retornar produto ID $produto_id ao estoque: " . $conn->error . "');</script>";
            }
        }
        // Zera o carrinho
        unset($_SESSION['carrinho']);
        echo "<script>alert('Carrinho zerado com sucesso!');</script>";
    } else {
        echo "<script>alert('O carrinho está vazio ou não existe.');</script>";
    }
}

// Exibir o carrinho se houver produtos adicionados
if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    echo "<h2>Itens no Carrinho</h2>";
    echo "<ul id='lista-produtos'>"; // A lista é visível agora
    $total = 0;

    foreach ($_SESSION['carrinho'] as $produto_id => $produto) {
        echo "<li>" . htmlspecialchars($produto['nome']) . " - Quantidade: " . intval($produto['quantidade']) . " - Preço unitário: € " . number_format($produto['preco'], 2, ',', '.') . "</li>";
        $total += $produto['preco'] * intval($produto['quantidade']); // Corrigido para evitar avisos
    }

    echo "</ul>";
    echo "<p>Total: €  " . number_format($total, 2, ',', '.') . "</p>";
    echo "<div class='container-button'>";
    echo "<div style='display: flex; gap: 10px; justify-content: center; margin: auto;'>";
    // Botão para zerar o carrinho
    echo "<form method='POST' action=''>";
    echo "<button type='submit' name='zerar_carrinho'>Zerar Carrinho</button>";
    echo "</form>";

    // Botão para finalizar a compra
    echo "<form method='POST' action=''>";
    echo "<button type='submit' name='finalizar_compra' formaction='finalizar_compra.php'>Finalizar Compra</button>";
    echo "</form>";
} else {
    echo "<p>Seu carrinho está vazio.</p>";
}

$conn->close();


    ?><br><br>
</main>





  <!-- About Section -->
  <aside class="about"><br>
  <h2>Sobre SoundWave Vinyl</h2><br>
  <p class="p-sobre">Na SoundWave, somos apaixonados por música e pelo som autêntico dos discos de vinil. Nossa coleção é cuidadosamente selecionada para trazer a você o melhor de todos os gêneros e eras.</p>
</aside>

<!-- Footer -->
<footer style="margin-top: 0px">
  <p>&copy; 2024 SoundWave Vinyl. All rights reserved.</p>
  <div class="social-icons">
    <a href="https://www.facebook.com/linkinpark/" target="_blank"><i  class="fab fa-facebook-f"></i></a>
    <a href="https://www.instagram.com/linkinpark/" target="_blank"><i  class="fab fa-instagram-square "></i></a>
    <a href="https://x.com/linkinpark" target="_blank"><i class="fab fa-twitter-square"></i></a>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
