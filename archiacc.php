<!DOCTYPE html>
<html>
<head>
  <title>Détails de l'annonce</title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      margin-top: 50px;
    }

    .annonce-details {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
    }

    .annonce-details h2 {
      margin-bottom: 20px;
    }

    .annonce-details .row {
      margin-bottom: 10px;
    }

    .annonce-details strong {
      font-weight: 600;
    }

    .profile-pic {
      width: 150px;
      height: 150px;
      border-radius: 10%;
      object-fit: cover;
      margin-bottom: 20px;
    }

    .message-section {
      margin-top: 30px;
    }

    .message-section textarea {
      width: 100%;
      height: 100px;
      resize: none;
      margin-bottom: 10px;
    }

    .message-section button {
      width: 100%;
    }
    .message-section .aa {
      height: 2em;
    }
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
</head>
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
    <div class="annonce-details">
      <h2>Détails de l'annonce</h2>

      <?php
      require("../connexion.php");

      // Vérifier si le paramètre d'ID d'annonce est présent dans l'URL
      if (isset($_GET['id_annonce'])) {
        // Récupérer l'ID de l'annonce à partir de l'URL
        $id_annonce = $_GET['id_annonce'];

        // Requête pour récupérer les détails de l'annonce
        $query = "SELECT annonce.id_annonce, architecte.id_architecte, utilisateur.nom, utilisateur.prenom, annonce.titre, annonce.description, categorie.nom_categorie, souscategorie.nom_sous_categorie, ville.nom_ville
        FROM annonce
        INNER JOIN architecte ON annonce.id_architecte = architecte.id_architecte
        INNER JOIN utilisateur ON architecte.id_utilisateur = utilisateur.id_utilisateur
        INNER JOIN ville ON annonce.id_ville = ville.id_ville
        INNER JOIN souscategorie ON annonce.id_sous_categorie = souscategorie.id_sous_categorie
        INNER JOIN categorie ON souscategorie.id_categorie = categorie.id_categorie
        WHERE annonce.id_annonce = $id_annonce";

        $result = mysqli_query($con, $query);

        if ($result) {
          // Vérifier s'il y a des résultats
          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Récupérer les données de l'annonce
            $titre = $row['titre'];
            $description = $row['description'];
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $id_architecte = $row['id_architecte'];
            $nom_categorie = $row['nom_categorie'];
            $nom_sous_categorie = $row['nom_sous_categorie'];
            $nom_ville = $row['nom_ville'];

            ?>
            <div class="row">
              <div class="col-md-6">
                <strong>Photo de profil de l'architecte:</strong>
                <br>
                <img class="profile-pic" src="../images/architecte.jpeg" alt="Photo de profil de l'architecte">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <strong>Nom de l'architecte:</strong> <?php echo $nom . ' ' . $prenom; ?>
              </div>
              <div class="col-md-6">
                <strong>Ville:</strong> <?php echo $nom_ville; ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <strong>Titre de l'annonce:</strong> <?php echo $titre; ?>
              </div>
              <div class="col-md-6">
                <strong>Catégorie:</strong> <?php echo $nom_categorie; ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <strong>Description:</strong> <?php echo $description; ?>
              </div>
              <div class="col-md-6">
                <strong>Sous-catégorie:</strong> <?php echo $nom_sous_categorie; ?>
              </div>
            </div>

            <form method="POST" action="msg-save.php">
              <div class="form-group">
                <fieldset>
                  <legend>Formulaire Message</legend>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group" hidden>
                        <label>Id</label>
                        <input type="text" name="id_message" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Sujet</label>
                        <input type="text" name="sujet" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Message</label>
                        <input type="text" name="message" class="form-control">
                      </div>
                      <div class="form-group" hidden>
                        <label>Date</label>
                        <input type="date" name="date_creation_message" class="form-control">
                      </div>
                      <div class="form-group" hidden>
                        <label>Utilisateur</label>
                        <select name="id_utilisateur" class="form-control">
                          <?php
                          require("../connexion.php");
                          $resultat = mysqli_query($con, "SELECT * FROM utilisateur WHERE id_utilisateur = 17");
                          while ($row = mysqli_fetch_assoc($resultat)) {
                            echo "<option value='" . $row['id_utilisateur'] . "'>" . $row['id_utilisateur'] . " - " . $row['nom'] . "</option>";
                          }
                          mysqli_close($con);
                          ?>
                        </select>
                      </div>
                      <div class="form-group" hidden>
                        <label>Destinataire</label>
                        <select name="id_destinataire" class="form-control">
                          <?php
                          require("../connexion.php");
                          $resultat = mysqli_query($con, "SELECT utilisateur.id_utilisateur, utilisateur.nom FROM utilisateur INNER JOIN architecte ON utilisateur.id_utilisateur = architecte.id_utilisateur INNER JOIN annonce ON architecte.id_architecte = annonce.id_architecte WHERE annonce.id_annonce = $id_annonce");
                          while ($row = mysqli_fetch_assoc($resultat)) {
                            echo "<option value='" . $row['id_utilisateur'] . "'>" . $row['id_utilisateur'] . " - " . $row['nom'] . "</option>";
                          }
                          mysqli_close($con);
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                  </div>
                </fieldset>
              </div>
            </form>

            <?php
            // Vous pouvez ajouter d'autres informations et fonctionnalités ici

          } else {
            echo "Aucune annonce trouvée.";
          }

          mysqli_free_result($result);
        } else {
          echo "Erreur lors de l'exécution de la requête : " . mysqli_error($con);
        }

      } else {
        echo "ID d'annonce non spécifié.";
      }
      ?>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
