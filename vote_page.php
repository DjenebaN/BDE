<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>loisirs</title>
    <link rel="stylesheet" href="main.css" />
</head>
<body>
    <?php
    include("./connexion.php");
    include("./header.php");

        $stmt = $connexion->prepare("SELECT * FROM events WHERE id=? LIMIT 1"); 
        $stmt->execute(array($_GET['id'])); 
        $row = $stmt->fetch();
        
            echo "<div id='Contenu'>";
            echo "<div class='block'>"; 
            echo "<div class='inblock'>";
            
            echo "<div class='image'><img src='data:image/jpeg;base64," . base64_encode($row['choiceIm1']) . "'/></div>";
            echo "<h4>" . $row['citChoice1'] . "</h4>";
            echo "<p>" . $row['txtChoice1'] . "</p>";
            
            echo "<div class='image'><img src='data:image/jpeg;base64," . base64_encode($row['choiceIm2']) . "'/></div>";
            echo "<h4>" . $row['citChoice2'] . "</h4>";
            echo "<p>" . $row['txtChoice2'] . "</p>";
            
            echo "<div class='image'><img src='data:image/jpeg;base64," . base64_encode($row['choiceIm3']) . "'/></div>";
            echo "<h4>" . $row['citChoice3'] . "</h4>";
            echo "<p>" . $row['txtChoice3'] . "</p>";
            
            echo "</div>";
            echo "</div>"; 
            echo "</div>";

    include("./footer.php");
    ?>
</body>
</html>
