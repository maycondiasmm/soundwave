<?php
session_start(); // Iniciar a sessão
// Conexão com a base de dados
$conn = new mysqli("localhost", "root", "", "loja_vinil");

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Buscar todos os produtos da tabela produtos
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='produto'>";
        echo "<h3>" . htmlspecialchars($row['nome']) . "</h3>";
        echo "<p>Preço: R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
        echo "<p>Quantidade disponível: " . intval($row['quantidade']) . "</p>";
        
        if ($row['quantidade'] > 0) {
            echo "<form method='POST' action=''>"; // O action pode ficar vazio para enviar para a mesma página
            echo "<input type='hidden' name='produto_id' value='" . intval($row['id']) . "'>"; // Corrigido
            echo "<input type='hidden' name='produto_nome' value='" . htmlspecialchars($row['nome']) . "'>"; // Corrigido
            echo "<input type='hidden' name='produto_preco' value='" . floatval($row['preco']) . "'>"; // Corrigido
            echo "<button type='submit' name='adicionar_carrinho'>Adicionar ao carrinho</button>"; // Corrigido
            echo "</form>";
        } else {
            echo "<p style='color: red;'>Produto indisponível em estoque!</p>"; // Mensagem de indisponibilidade
        }

        echo "</div>";
    }
} else {
    echo "Nenhum produto encontrado.";
}

$conn->close();
?>




