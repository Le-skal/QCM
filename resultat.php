<?php
include "connect.php";
session_start();

if (!isset($_SESSION['utilisateur_id'])) {
    echo "Veuillez vous connecter pour voir vos résultats.";
    exit;
}

$bonnes_reponses = 0;
$i = 0;

foreach ($_POST as $cle => $val) {
    $sql = "select * from reponses where idr = $val";
    $resultat = mysqli_query($id, $sql);
    $ligne = mysqli_fetch_assoc($resultat);
    if ($ligne["verite"] == 1) {
        $bonnes_reponses++;
    } else {
        // Affichez les erreurs
    }
    $i++;
}

$score = $bonnes_reponses * 2;

// Insérer le résultat dans la table
$utilisateur_id = $_SESSION['utilisateur_id'];
$sql = "INSERT INTO resultats (utilisateur_id, note) VALUES ('$utilisateur_id', '$score')";
mysqli_query($id, $sql);

echo "<br>Votre score est : $score / $i.<br>";
?>
