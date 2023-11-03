<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
      nav{
  background-color: #333;
}
.btn-custom {
      background-color:azure;
      font-style: oblique;
      border-radius: 10px;
      padding: 4px 12px;
      font-size: 16px;
      font-weight: bold;
      font-family: 'Arial', sans-serif;
      transition: background-color 0.3s ease;
      
    }

    .btn-custom:hover {
      background-color: #d21717;
    }
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-light ">
    <a style="font-weight: bold; font-size:34px; color: #d21717;" class="navbar-brand" href="#">Archi<em style="font-family: cursive;">MA</em></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <button class="btn btn-custom"><a class="nav-link" href="index.php" style="color:#333;">Accueille</a></button>
        </li>
        <li class="nav-item">
          <span class="navbar-text mx-2"></span>
        </li>
      
      </ul>
    </div>
  </nav>
  <div class="container">
    <h1>Connexion</h1>
    <form action="useracc.php" method="POST">
      <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
      </div>
      <button type="submit" class="btn btn-primary">Se connecter</button> 
     <br> <hr style="border: none; height: 3px; background-color: #d21710; margin: 10px 0; width: 100%;">
      <a href="../inscription/if.php">Inscrivez-vous</a>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
