
<?php
session_start(); // Iniciar a sessão

// Verifica se existe uma mensagem de sucesso na sessão
if (isset($_SESSION['mensagem_sucesso'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['mensagem_sucesso'] . "</div>";
    unset($_SESSION['mensagem_sucesso']); // Limpa a mensagem para não ser exibida novamente
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Soundwave Vinyl - Home</title>
  
  <meta name="description" content="A Soundwave é sua loja online de vinis, oferecendo uma vasta seleção de álbuns clássicos e novos lançamentos.">
  <meta name="keywords" content="Vinil, loja de vinil, música, álbuns, discos">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="soundwave.css">

</head>

  <script type="text/javascript">
        setTimeout(function() {
            alert('Bem-vindo à SoundWave - onde a música é vivida, não apenas ouvida.');
        }, 2000);
        </script>
          </head>
          <body>
  <!-- Header -->
  <header class="navbar">
    <div class="logo">
      <img src="imagens/soundwavelogo.png" alt="Soundwave Vinyl" width="200" height="100">
    </div>
    <nav>
      <ul>
        <li><a class="btn btn-outline-success me-2" type="button" href="soundwavehomepage.php">Home</a></li>
        <li><a class="btn btn-outline-success me-2" type="button" href="loja.html">Loja</a></li>
        <li><a class="btn btn-outline-success me-2" type="button" href="sobrenos.html">Sobre Nós</a></li>
        <li><a class="btn btn-outline-success me-2" type="button" href="admin_login.php">Login</a></li>
      </ul>
    </nav>
</header>
<main>
    <div class="vinils">
      <img class="imagevinil" src="imagens/vinilhome.avif" alt="vinil colecao" width="100%">
      <p>Explore nossa coleção exclusiva de álbuns clássicos e achados raros.</p>
    <a href="loja.html" class="btn btn-outline-success">Comprar</a>
    </div>
    <h1 class="tituloloja">História do Vinil</h1><br>
    <p class="historiavinil">Desenvolvido na década de 1940 pelo húngaro Peter Carl a pedido da Columbia Records, o long player ou disco de vinil é um tocador de música. Por isso, sua idealização se baseou na criação de um material que fosse mais resistente, durável e que pudesse ser usado para gravar um grande volume de músicas. A tecnologia da época para discos era feita a partir da goma laca, também conhecida como disco de 78 rpm. Mais tarde, essa alternativa foi substituída pelos discos de vinil, um material plástico, tradicionalmente preto, que grava informações de áudio reproduzidas por meio de toca-discos. Por outro lado, esse foi um acontecimento importante e inovador para a indústria musical. Afinal, o antigo disco de vinil era mais leve, suportava gravações dos dois lados e tinha boa qualidade sonora.</p>
    </main>
</main>
<article>
    <h2>Os mais vendidos </h2><br><br>
    <div class="product-grid">
        <div class="product">
            <img src="imagens/rhcp/californication.jpeg" alt="Album 1">
            <p>Californication - Red Hot Chili Peppers</p>
            <p>€29.99</p>
            <a href="shopnow.php" class="btn btn-outline-success">Comprar</a><br>
          </div>
      <div class="product">
        <img src="imagens/linkinpark/meteora.jpeg" alt="Album 2">
        <p>Meteora - Linkin Park </p>
        <p>€49.99</p>
        <a href="shopnow.php" class="btn btn-outline-success">Comprar</a><br>
      </div>
      <div class="product">
        <img src="imagens/rhcp/unlimitedlove.jpeg" alt="Album 1">
        <p>Unlimited Love - Red Hot Chili Peppers</p>
        <p>€39.99</p>
        <a href="shopnow.php" class="btn btn-outline-success">Comprar</a><br>
      </div>
      <div class="product">
        <img src="imagens/rhcp/bloodsugarsexmagik.jpeg" alt="Album 1">
        <p>Blood Sugar Sex Magik - Red Hot Chili Peppers</p>
        <p>€49.99</p>
        <a href="shopnow.php" class="btn btn-outline-success">Comprar</a><br>
      </div>
      <div class="product">
        <img src="imagens/linkinpark/livingthings.jpeg" alt="Album 1">
        <p>Living Things - Linkin Park</p>
        <p>€39.99</p>
        <a href="shopnow.php" class="btn btn-outline-success">Comprar</a><br>
      </div>
          <div class="product">
            <img src="imagens/linkinpark/hybridtheory.jpeg" alt="Album 1">
            <p>Hybrid Theory - Linkin Park</p>
            <p>€29.99</p>
            <a href="shopnow.php" class="btn btn-outline-success">Comprar</a><br>
          </div>
    </div>
      </article>
  <!-- About Section -->
  <aside class="about"><br>
    <h2> SoundWave Vinyl</h2>
    <p class="p-sobre">Na SoundWave, somos apaixonados por música e pelo som autêntico dos discos de vinil. Nossa coleção é cuidadosamente selecionada para trazer a você o melhor de todos os gêneros e eras.</p>
      </aside>
<footer>
  <p class="copy">&copy; 2024 SoundWave Vinyl. All rights reserved.</p>
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