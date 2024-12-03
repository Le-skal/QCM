<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tentez votre chance !</h1><hr>
    <form action="resultat.php" method="post">
    <?php
    Include "connect.php";
    $sql = "SELECT * FROM questions ORDER BY RAND() LIMIT 10";
    $resultat = mysqli_query($id, $sql);
    $i = 1;
    while($ligne = mysqli_fetch_assoc($resultat)){
        echo "<h3>$i : ".$ligne['libelleQ']."</h3>";
        $i++;
        $sql2 = "select * from reponses where idq = ".$ligne["idq"];
        $resultat2 = mysqli_query($id, $sql2);
        while($ligne2 = mysqli_fetch_assoc($resultat2)){
            $idq = $ligne2["idq"];
            $idr = $ligne2["idr"];
            echo "<input type='radio' name='$idq' value='$idr' checked>".$ligne2["libeller"]."<br>";
        }
    }
    ?><hr>
    <input type="submit" value="ENVOYER"><br><br>
</body>
</html>