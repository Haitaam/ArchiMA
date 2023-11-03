<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ARCHIMA</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    a {
      color: white;
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
<nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="#" style="color: #d21710;">
        <?php
            require("../connexion.php");
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["email"];
                $mot_de_passe = $_POST["mot_de_passe"];
                $query = "SELECT DISTINCT
                            d.nom AS nom_destinataire,
                            d.prenom AS prenom_destinataire
                        FROM
                            message m
                            JOIN utilisateur u ON m.id_utilisateur = u.id_utilisateur
                            JOIN utilisateur d ON m.id_destinataire = d.id_utilisateur
                        WHERE
                            d.email = '$email'";
                $result = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($result))  {
                    echo '<strong><em>' . $row['nom_destinataire'] ." ". $row['prenom_destinataire'] . '</em></strong>';
                }

                mysqli_free_result($result);
                mysqli_close($con);
            }
        ?>
        </a>
        <ul class="navbar-nav ml-auto " >
            <li class="nav-item">
                <a class="nav-link" href="mesannonce.php" >Mes annonces</a>
            </li>
        </ul>
    </nav>
  <hr style="border: none; height: 3px; background-color: #d21710; margin: -20px 0; width: 100%;">

  <div class="container">
    <h1>Tableau des messages</h1>
    <div class="row">
      <div class="col-md-6">
        <a href="message-ajouter.php" class="btn btn-primary">Ajouter</a>
        <a href="message-file1.php" class="btn btn-primary">Imprimer1</a>
      </div>
      <div class="col-md-6">
      
      </div>
    </div>
    <br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST["email"];
      $mot_de_passe = $_POST["mot_de_passe"];
  require("../connexion.php");
      $query = "SELECT * FROM utilisateur WHERE email = '$email' AND mot_de_passe = '$mot_de_passe'";
      $result = mysqli_query($con, $query);
      if ($result) {
        if (mysqli_num_rows($result) == 1) 
        {
          $row = mysqli_fetch_assoc($result);
          $_SESSION["utilisateur_id"] = $row["id_utilisateur"];
            $r = "SELECT
                    m.id_message,
                    m.sujet,
                    m.message,
                    m.date_creation_message,
                    u.id_utilisateur,
                    u.nom,
                    u.prenom,
                    m.id_destinataire,
                    d.nom AS nom_destinataire,
                    d.prenom AS prenom_destinataire
                FROM
                    message m
                    JOIN utilisateur u ON m.id_utilisateur = u.id_utilisateur
                    JOIN utilisateur d ON m.id_destinataire = d.id_utilisateur
                WHERE
                    d.email = '$email';"; // Modifier ici pour filtrer les messages par email
          $res = mysqli_query($con, $r);
          if ($res) {
            echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
            echo "<tr>";
       
            echo "<th>SUJET</th>";
            echo "<th>MESSAGE</th>";
            echo "<th>DATE</th>";
            echo "<th>IDU</th>";
            echo "<th>NOM U</th>";
            echo "<th>PRENOM U</th>";
      
            echo "</tr>";
            echo "</thead>";
            echo "<tbody id='myTable'>";  // Afficher les données des messages
            while ($data = mysqli_fetch_assoc($res)) {
              echo "<tr>";
     
              $cle = $data['id_message'];
              echo "<td>" . $data['sujet'] . "</td>";
              echo "<td>" . $data['message'] . "</td>";
              echo "<td>" . $data['date_creation_message'] . "</td>";
              echo "<td>" . $data['id_utilisateur'] . "</td>";
              echo "<td>" . $data['nom'] . "</td>";
              echo "<td>" . $data['prenom'] . "</td>";
               echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
          } else {
            echo "Erreur lors de l'exécution de la requête : " . mysqli_error($con);
          }

          mysqli_close($con);
          exit(); // Terminer le script après avoir affiché les messages
        } else {
          // Les informations d'identification sont incorrectes
          echo "Identifiants invalides. Veuillez réessayer.";
        }
      } else {
        echo "Erreur lors de l'exécution de la requête : " . mysqli_error($con);
      }
      mysqli_close($con);
    }
  
    ?>


</div>
  </div>
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>
