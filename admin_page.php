<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Soundwave Vinyl - Administrador</title>
  <meta name="description" content="A Soundwave é sua loja online de vinis, oferecendo uma vasta seleção de álbuns clássicos e novos lançamentos.">
  <meta name="keywords" content="Vinil, loja de vinil, música, álbuns, discos">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="soundwave.css">
</head>
</head>
<body>
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

  <body>
  <?php
session_start(); // Iniciar a sessão
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Verificar se o administrador está logado
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Redirecionar para a página de login se não estiver logado
    header("Location: admin_login.php");
    exit();
}

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'loja_vinil');

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Manipular formulário de inserção/atualização de produtos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        // Inserir um novo produto
        $nome = trim($_POST['nome']);
        $quantidade = intval($_POST['quantidade']);
        $preco = floatval($_POST['preco']);

        if (!empty($nome) && $quantidade >= 0 && $preco >= 0) {
            $sql = "INSERT INTO Produtos (nome, quantidade, preco) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $nome, $quantidade, $preco);
            if ($stmt->execute()) {
                echo "<p style='color: green;'>Produto inserido com sucesso!</p>";
            } else {
                echo "<p style='color: red;'>Erro ao inserir produto: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p style='color: red;'>Todos os campos são obrigatórios e devem ter valores válidos.</p>";
        }
    } elseif (isset($_POST['update_product'])) {
        // Atualizar um produto existente
        $product_id = intval($_POST['product_id']);
        $quantidade = intval($_POST['quantidade']);
        $preco = floatval($_POST['preco']);

        if ($quantidade >= 0 && $preco >= 0) {
            $sql = "UPDATE Produtos SET quantidade = ?, preco = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $quantidade, $preco, $product_id);
            if ($stmt->execute()) {
                echo "<p style='color: green;'>Produto atualizado com sucesso!</p>";
            } else {
                echo "<p style='color: red;'>Erro ao atualizar produto: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p style='color: red;'>Quantidade e preço devem ter valores válidos.</p>";
        }
    }
}

// Listar encomendas
$sql_encomendas = "SELECT * FROM Encomendas";
$result_encomendas = $conn->query($sql_encomendas);

echo "<h2>Encomendas</h2>";
if ($result_encomendas) { // Verifica se a consulta foi bem-sucedida
    if ($result_encomendas->num_rows > 0) {
        while ($encomenda = $result_encomendas->fetch_assoc()) {
            echo "ID: " . $encomenda['id'] . " - Nome: " . $encomenda['nome'] . " - Produtos: " . $encomenda['produtos'] . "<br>";
        }
    } else {
        echo "Nenhuma encomenda encontrada.<br>";
    }
} else {
    echo "Erro ao buscar encomendas: " . $conn->error . "<br>";
}

// Listar produtos
$sql_produtos = "SELECT * FROM Produtos";
$result_produtos = $conn->query($sql_produtos);

echo "<h2>Produtos</h2>";
if ($result_produtos) { // Verifica se a consulta foi bem-sucedida
    if ($result_produtos->num_rows > 0) {
        while ($produto = $result_produtos->fetch_assoc()) {
            $quantidade = isset($produto['quantidade']) ? $produto['quantidade'] : 'N/A'; // Verifica se quantidade existe
            echo "<form action='' method='post'>
                    ID: " . $produto['id'] . " - Nome: " . $produto['nome'] . "<br>
                    Quantidade: <input type='number' name='quantidade' value='" . $quantidade . "' min='0' required><br>
                    Preço: € <input type='number' name='preco' value='" . $produto['preco'] . "' min='0' step='0.01' required><br>
                    <input type='hidden' name='product_id' value='" . $produto['id'] . "'>
                    <button type='submit' name='update_product'>Atualizar Produto</button>
                </form><br>";
        }
    } else {
        echo "Nenhum produto encontrado.<br>";
    }
} else {
    echo "Erro ao buscar produtos: " . $conn->error . "<br>";
}

// Formulário para adicionar novos produtos
?>
<h2>Adicionar Novo Produto</h2>
<form action="" method="post">
    Nome do Produto: <input type="text" name="nome" required><br>
    Quantidade Disponível: <input type="number" name="quantidade" min="0" required><br>
    Preço por Unidade: R$ <input type="number" name="preco" min="0" step="0.01" required><br>
    <button type="submit" name="add_product">Adicionar Produto</button>
</form>

<?php
// Fechar a conexão
$conn->close();
?>


 
<a href="logout.php">Logout</a>
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