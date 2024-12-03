<?php
include "connect.php";
session_start();

if (!isset($_SESSION['utilisateur_id'])) {
    echo "Veuillez vous connecter.";
    exit;
}

$utilisateur_id = $_SESSION['utilisateur_id'];
$sql = "SELECT note, date FROM resultats WHERE utilisateur_id = $utilisateur_id";
$result = mysqli_query($id, $sql);

echo "<h3>Vos résultats :</h3>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "Score : " . $row['note'] . " - Date : " . $row['date'] . "<br>";
}

// Calcul de la moyenne
$sql = "SELECT AVG(note) as moyenne FROM resultats WHERE utilisateur_id = $utilisateur_id";
$result = mysqli_query($id, $sql);
$row = mysqli_fetch_assoc($result);
echo "<br>Moyenne : " . round($row['moyenne'], 2);
?>
