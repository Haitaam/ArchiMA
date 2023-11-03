<!DOCTYPE html>
<html>
<head>
  <title>ArchiMA</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Styles pour les boutons */
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

    /* Style pour la police de caractères */
    body {
      font-family: 'Arial', sans-serif;
       background-image: url(images/bg.jpg); 
      background-repeat: no-repeat;
      background-size: 100%;
      background-attachment: fixed;
    }

    /* Styles pour le centrage de la phrase */
    .centered-text {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      
    }

    .container {
      padding-top: 10%;
    }

    /* Style pour l'effet de survol des annonces */
    .card {
  transition: all 0.3s ease;
  position: relative;
  background-color: rgba(242, 252, 252, 0.906);
  color: black;
  font-weight: bold;
}

.card:hover {
  box-shadow: 0 0 8px rgba(255,0,0,0.3);;
  transform: translateY(-5px);
}

.card:hover::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.1);
  z-index: -1;
}

.card:hover .card-content {
  color: #d21710;
}

.card-content {
  transition: color 0.3s ease;
}
nav{
  background-color: #333;
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
          <button class="btn btn-custom"><a class="nav-link" href="../inscription/if.php" style="color:#333;">Architecte ! Inscrivez-vous</a></button>
        </li>
        <li class="nav-item">
          <span class="navbar-text mx-2"></span>
        </li>
        <li class="nav-item">
          <button class="btn btn-custom"><a class="nav-link" href="login.php" style="color:#333;">Mon compte</a></button>
        </li>
      </ul>
    </div>
  </nav>
  <div style="display: flex; justify-content: center;">
  <hr style="border: none; height: 3px; background-color: #d21710; margin: 0px 0; width: 70%;">
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <h2 class="text-center d-inline-block" style="color: black; font-weight: bold; text-shadow: 2px 2px whitesmoke;">
          Contactez notre Architecte ! Démarrez votre projet
        </h2>
        <div class="form-group d-flex">
          <select class="custom-select form-control mr-2" id="villeSelect" name="ville">
            <option value="">Sélectionner une ville</option>
            <?php
            require("../connexion.php");

            $query = "SELECT * FROM ville";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($result)) {
              echo '<option value="' . $row['id_ville'] . '">' . $row['nom_ville'] . '</option>';
            }

            mysqli_free_result($result);
            mysqli_close($con);
            ?>
          </select>
          <button class="btn btn-custom d-inline-block"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
<div style="display: flex; justify-content: center;">
  <h2 class="d-inline-block" style="color: #d21717; font-weight: 700; text-shadow: 2px 2px black;">
    Annonces des Architectes
  </h2>
</div>



<div class="col">
  <div >
    <?php
    require("../connexion.php");

    $query = "SELECT annonce.id_annonce, architecte.id_architecte, utilisateur.nom, utilisateur.prenom, annonce.titre, annonce.description, categorie.nom_categorie, souscategorie.nom_sous_categorie, ville.nom_ville
    FROM annonce
    INNER JOIN architecte ON annonce.id_architecte = architecte.id_architecte
    INNER JOIN utilisateur ON architecte.id_utilisateur = utilisateur.id_utilisateur
    INNER JOIN ville ON annonce.id_ville = ville.id_ville
    INNER JOIN souscategorie ON annonce.id_sous_categorie = souscategorie.id_sous_categorie
    INNER JOIN categorie ON souscategorie.id_categorie = categorie.id_categorie";
    $result = mysqli_query($con, $query);

    if ($result) {
      $i = 0; 
      $j = 2;
      $t = 4;
      echo '<div class="row">';
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col-md-'.$t.'">';
        $titre = $row['titre'];
        $description = $row['description'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $id_annonce = $row['id_annonce'];
        $id_architecte = $row['id_architecte'];
        $nom_categorie = $row['nom_categorie'];
        $nom_sous_categorie = $row['nom_sous_categorie'];
        $nom_ville = $row['nom_ville'];
        
        

        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title"><strong>' . $titre . '</strong></h5>';
        echo '<p class="card-text">' .$description. '</p>'; 
        echo '<p class="card-text">' .$nom. ' ' .$row['prenom']. '</p>';
        echo '<p class="card-text">' . $nom_categorie . ' - ' . $nom_sous_categorie . ' - ' . $nom_ville . '</p>';
echo '<div class="card-footer">
<a href="archiacc.php?id_annonce=' . $id_annonce . '" class="btn btn-primary stretched-link">Voir plus</a>
</div>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
        if ($i == $j) {
          echo '</div><div class="row">';
          $j += 3;
        }
        $i++;
      }
      echo '</div>';

      mysqli_free_result($result);
    } else {
      echo "Error executing the query: " . mysqli_error($con);
    }

    mysqli_close($con);
    ?>
  </div>
</div>


  
</body>
</html>
