<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hacker_poulette";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
    }

      $requete = $conn->query('SELECT * FROM formulaire');

      echo "<table border='1'>";
      echo "<tr><th>Name</th><th>Firstname</th><th>Email</th><th>Picture</th><th>Description</th></tr>";
      while ($donnees = $requete->fetch()) {
          echo "<tr><td>".$donnees['nom']."</td><td>".$donnees['prenom']."</td><td>".$donnees['email']." Km</td><td>".$donnees['deposer']."</td><td>".$donnees['height_difference']."</td><td>".$donnees['description']."</td></tr>";
      }
      echo "</table>";
    ?>
  </body>
</html>