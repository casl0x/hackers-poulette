<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body class="flex items-center justify-center w-screen flex-col">
    <h1 class="text-4xl font-semi-bold tracking-tight text-black sm:text-4xl">Admin Dashboard</h1>

    <div class="w-1/3 my-14">
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

      echo "<table class='border-2 border-black'>";
      echo "<tr><th class=''>Name</th><th class=''>Firstname</th><th class=''>Email</th><th class=''>Picture</th><th class=''>Description</th><th class=''>Status</th></tr>";
      while ($donnees = $requete->fetch()) {
          echo "<tr><td>".$donnees['nom']."</td><td>".$donnees['prenom']."</td><td>".$donnees['email']." Km</td><td>".$donnees['deposer']."</td><td>".$donnees['description']."</td></tr>";
      }
      echo "</table>";
    ?>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
  </body>
</html>