<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="basics.css">
    <title>Hackers Poulette</title>
</head>
<body>
    <form class="form" method="POST" action="">
        <label for="name">Name : </label><input type="text" name="nom" class="name">
        <label for="firstname">Firstname : </label><input type="text" name="prenom" class="firstname">
        <label for="email">Email address : </label><input type="email" name="email" class="email">
        <label for="file">Upload your picture : </label><input type="file" name="file" class="file">
        <label for="desc">Give us a description of your problem : </label><input type="text" name="description" class="desc">
        <button type="submit" name="submit">Send</button>
    </form>
    
    <?php
require 'vendor/autoload.php';

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Symfony\Component\Mime\Email;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hacker_poulette";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : null;
        $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : null;
        $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : null;
        $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null;

        if (!$email) {
            echo "Adresse e-mail invalide.";
        } else {
            $stmt = $conn->prepare('INSERT INTO formulaire (nom, prenom, email, description) VALUES (:nom, :prenom, :email, :description)');
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':description', $description);
            $stmt->execute();

            // Configuration de l'email
            $email = (new Email())
                ->from('huseyinsasmaz2001@gmail.com') // Remplacez par votre adresse Gmail
                ->to($email)
                ->subject('Confirmation de réception')
                ->text('Votre message a bien été reçu. Merci !');

            // Récupérez le jeton d'accès OAuth2
            $accessToken = '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'; // Remplacez par votre jeton d'accès OAuth2

            // Configurez le transport SMTP avec OAuth2
            $transport = new GmailSmtpTransport('huseyinsasmaz2001@gmail.com', $accessToken);

            // Création de l'instance Mailer avec le transport configuré
            $mailer = new Mailer($transport);

            // Envoi de l'email
            $mailer->send($email);

            echo "Les données ont été envoyées avec succès.";
        }
    } catch(PDOException $e) {
        echo "Erreur lors de l'envoi des données : " . $e->getMessage();
    }

    $conn = null;
}
?>




</body>
</html>
