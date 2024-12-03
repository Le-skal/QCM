<?php
include "connect.php";

// Vérification si une recherche est effectuée
$search_query = '';
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}

// Requête SQL pour rechercher les résultats
$sql = "SELECT utilisateurs.nom, resultats.note, resultats.date 
        FROM resultats 
        JOIN utilisateurs ON resultats.utilisateur_id = utilisateurs.id";
if ($search_query !== '') {
    $sql .= " WHERE utilisateurs.nom LIKE '%$search_query%'";
}
$sql .= " ORDER BY utilisateurs.nom, resultats.date";

$result = mysqli_query($id, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Résultats</title>
</head>
<body>
    <h1>Résultats des utilisateurs</h1>
    
    <!-- Formulaire de recherche -->
    <form method="post">
        <label for="search">Rechercher un utilisateur :</label>
        <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($search_query); ?>" placeholder="Nom de l'utilisateur">
        <button type="submit">Rechercher</button>
    </form>
    <hr>
    
    <!-- Affichage des résultats -->
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Nom de l'utilisateur</th>
                    <th>Note</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nom']); ?></td>
                        <td><?php echo $row['note']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>
</body>
</html>
