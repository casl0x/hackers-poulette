<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['submit']) && isset($_POST['captcha'])) {
  // Vérification du CAPTCHA
  if ($_POST['captcha'] == $_SESSION['captcha_code']) {

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hacker_poulette";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Récupération des données du formulaire
      $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : null;
      $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : null;
      $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : null;
      $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null;

      // Insertion des données dans la base de données
      $stmt = $conn->prepare('INSERT INTO formulaire (nom, prenom, email, description) VALUES (:nom, :prenom, :email, :description)');
      $stmt->bindParam(':nom', $nom);
      $stmt->bindParam(':prenom', $prenom);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':description', $description);
      $stmt->execute();

      // Envoi de l'e-mail avec PHPMailer
      $mail = new PHPMailer(true);

      // Paramètres du serveur SMTP
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'huseyinsasmaz2001@gmail.com'; // Votre adresse Gmail
      $mail->Password = 'ohln hhgq vlyn igak'; // Votre mot de passe Gmail
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      // Destinataire, sujet, corps du message
      $mail->setFrom('poulettehackers@gmail.com', 'Hackers Poulette');
      $mail->addAddress($email);
      $mail->Subject = 'Confirmation de réception';
      $mail->Body = 'Votre message a bien été reçu. Merci !';

      // Envoi du message
      $mail->send();

      echo "Les données ont été envoyées avec succès.";
    } catch (PDOException $e) {
      echo "Erreur lors de l'envoi des données : " . $e->getMessage();
    } catch (Exception $e) {
      echo "Erreur lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
    }

    // Fermeture de la connexion à la base de données
    $conn = null;

    exit(); // Arrête l'exécution du script si le CAPTCHA est incorrect
  } else {
    echo "Erreur Captcha Invalid";
  }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./output.css">
  <script src="./script.js"></script>
  <title>Hackers Poulette</title>
</head>

<body class="flex items-center justify-center w-screen flex-col">
  <h1 class="text-4xl font-semi-bold tracking-tight text-black sm:text-5xl">Hackers Poulette</h1>
  <a href="./dashboard.php" class="text-base font-semibold leading-7 text-black">Admin Dashboard <span aria-hidden="true">&rarr;</span></a>

  <form class="w-1/3 my-14 space-y-4" method="POST" action="captcha/captcha.php" enctype="multipart/form-data">
    <div class="">
      <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name :</label>
      <input type="text" name="nom" id="name" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      <div id="nameError"></div>
    </div>
    <div>
      <label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">Firstname :</label>
      <input type="text" name="prenom" id="firstname" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      <div id="firstnameError"></div>
    </div>
    <div>
      <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email adress :</label>
      <input type="email" name="email" id="email" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      <div id="emailError"></div>
    </div>
    <div class="col-span-full">
      <label for="file-upload" class="block text-sm font-medium leading-6 text-gray-900">Upload your picture :</label>
      <div class="mt-1 flex justify-center rounded-lg border border-dashed border-gray-900/25 py-6">
        <div class="text-center">
          <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
          </svg>
          <div class="mt-4 flex text-sm leading-6 text-gray-600">
            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
              <span>Upload a file up to 2MB</span>
              <input id="file-upload" name="file-upload" type="file" class="sr-only">
          </div>
        </div>
        <div id="uploadError"></div>
      </div>
      <div>
        <label for="desc" class="block text-sm font-medium leading-6 text-gray-900">Give us a description of your problem :</label>
        <input type="text" name="description" id="desc" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        <div id="descError"></div>
      </div>
      <div class="form-group">
        <label for="captcha">CAPTCHA :</label>
        <img src="captcha.php" alt="CAPTCHA">
        <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Entrez le CAPTCHA" required>
      </div>

      <div>
        <button type="submit" id="validate-btn" name="submit" class="text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-indigo-500 dark:hover:bg-indigo-400 my-3"> Send
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </button>
      </div>
  </form>
</body>

</html>