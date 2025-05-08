<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Soundwave Vinyl - Login</title>
  <meta name="description" content="A Soundwave é sua loja online de vinis, oferecendo uma vasta seleção de álbuns clássicos e novos lançamentos.">
  <meta name="keywords" content="Vinil, loja de vinil, música, álbuns, discos">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="soundwave.css">
  
</head>
  <style>
    /* Estilo padrão para mobile-first */


    </style>
</head>
<body>
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
  
  <?php
session_start(); // Iniciar sessão

// Conectar ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'loja_vinil');
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificação direta para o admin
    if ($username === 'admin' && $password === '1234') {
        $_SESSION['admin'] = true; // Sessão do administrador
        $_SESSION['username'] = $username;
        header("Location: admin_page.php");
        exit();
    }

    // Consulta ao banco para outros utilizadores
    $stmt = $conn->prepare("SELECT * FROM Utilizadores WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar a senha usando password_verify
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin'] = false; // Sessão para utilizador comum
            $_SESSION['username'] = $username;
            header("Location: soundwavehomepage.php"); // Redirecionar para página principal
            exit();
        } else {
            $error_message = "Senha incorreta!";
        }
    } else {
        $error_message = "Nome de utilizador não encontrado!";
    }
}
?>
<section>
<div class="formlogin">
<h2>LOGIN</h2>
<?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>

<form method="POST" action="">
    <label for="username">Utilizador:</label>
    <input type="text" id="username" name="username" placeholder="Insira seu login" required>
    <br>
    <label for="password">Palavra-Passe:</label>
    <input type="password" id="password" name="password" placeholder="Confirme sua password" required>
    <br>
    <button class="btn btn-outline-success me-2" type="submit">Login</button>
</form>

<p><a href="registrar.php">Criar novo utilizador</a></p></div>
</section>
 <!-- About Section -->
 <aside class="about"><br>
  <h2> SoundWave Vinyl</h2><br>
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

