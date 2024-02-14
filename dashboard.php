<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./output.css">
    <title>Admin Dashboard</title>
</head>
<body class="flex items-center justify-center w-screen flex-col">
    <h1 class="text-4xl font-semi-bold tracking-tight text-black sm:text-4xl">Admin Dashboard</h1>
    <a href="./index.php" class="text-base font-semibold leading-7 text-black"><span aria-hidden="true">&larr;</span> Return to form</a>

    <div class="w-9/12 my-14">
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

      echo "<table class=''>";
      echo "<tr><th class='p-3 border-b border-r-2 w-1/5'>Name</th><th class='p-3 border-b border-r-2 w-1/5'>Firstname</th><th class='p-3 border-b border-r-2 w-1/5'>Email</th><th class='p-3 border-b border-r-2 w-1/5'>Picture</th><th class='p-3 border-b border-r-2 w-1/5'>Description</th><th class='p-3 border-b w-1/5'>Status</th></tr>";
      while ($donnees = $requete->fetch()) {
          echo "<tr><td class='text-center border-r-2 p-2 border-b'>".$donnees['nom']."</td><td class='text-center border-r-2 p-2 border-b'>".$donnees['prenom']."</td><td class='text-center border-r-2 p-2 border-b'>".$donnees['email']."</td><td class='text-center border-r-2 p-2 border-b'>".$donnees['deposer']."</td><td class='text-center border-r-2 p-2 border-b'>".$donnees['description']."</td><td class='text-center p-2 border-b'>☺</td></tr>";
      }
      echo "</table>";
    ?>
    </div>
  </body>
</html>