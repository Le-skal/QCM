<?php
include "connect.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT * FROM utilisateurs WHERE email = '$email'";
    $result = mysqli_query($id, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['utilisateur_id'] = $user['id'];
        echo "Connexion réussie. <a href='listeQuestions.php'>Commencer le QCM</a>";
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>

<form method="post">
    Email: <input type="email" name="email" required><br>
    Mot de passe: <input type="password" name="mot_de_passe" required><br>
    <button type="submit">Se connecter</button>
</form>
