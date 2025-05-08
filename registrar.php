<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Soundwave Vinyl - Registrar</title>
  <meta name="description" content="A Soundwave é sua loja online de vinis, oferecendo uma vasta seleção de álbuns clássicos e novos lançamentos.">
  <meta name="keywords" content="Vinil, loja de vinil, música, álbuns, discos">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="soundwave.css">
  
</head>
  <style>
  /* Estilo padrão para dispositivos móveis */

    
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

  <body>
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
    $confirm_password = $_POST['confirm_password'];
    $birthdate = $_POST['birthdate'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "As palavras-passe não coincidem!";
        header("Location: registrar.php");
        exit();
    }

    // Hash da senha
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserir novo utilizador como 'user' por padrão
    $stmt = $conn->prepare("INSERT INTO Utilizadores (username, password, birthdate, role) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $username, $hashed_password, $birthdate);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Utilizador registrado com sucesso!";
    } else {
        $_SESSION['error'] = "Erro ao registrar utilizador!";
    }

    header("Location: registrar.php");
    exit();
}
?>
<section><div class="formlogin">
<h2>REGISTRAR NOVO UTILIZADOR</h2>

<?php
if (isset($_SESSION['error'])) {
    echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';
    unset($_SESSION['success']);
}
?>

    <form action="registrar.php" method="post">
        <label for="username">Nome de Utilizador:</label>
        <input type="text" name="username" id="username" placeholder="Insira seu nome" required><br><br>

        <label for="password">Palavra-passe:</label>
        <input type="password" name="password" id="password" placeholder="Insira sua password" required><br><br>

        <label for="confirm_password">Confirmar Palavra-passe:</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirme sua password" required><br><br>

        <label for="birthdate">Data de Nascimento:</label>
        <input type="date" name="birthdate" id="birthdate" required><br><br>

        <button class="btn btn-outline-success me-2" type="submit">Registrar</button>
    </form>

<p class="loginnovo"><a href="admin_login.php">Já tem uma conta? Faça login aqui.</a></p></div></main>

</section>
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





