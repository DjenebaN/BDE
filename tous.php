<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> loisirs </title>
        <link rel="stylesheet"  href="main.css"/>
    </head>
    <body>
        <?php
            include ("./connexion.php");
            include ("./header.php");
        ?>
        
        <?php
        $sql="SELECT * FROM events ORDER BY id ASC;";
        if(!$connexion->query($sql)) echo "Pb d'accès au events";
        else{
            echo"<div id = 'Contenu'>";
            foreach ($connexion->query($sql) as $row){
                echo "<div class='block'>".
                     "<div class='inblock'>".
                        "<div class='image'><img src='data:image/jpeg;base64,".base64_encode($row['image'])."'/></div>".
                        "<h2>".$row['name']."</h2>".
                        "<h4>".$row['citation']."</h4>".
                        "<a class='ref'href='event.php?id=".$row['id']."'>voir details</a>".
                     "</div>";
                    echo "</div>";
            }
            echo "</div>";
        }
            include("./footer.php");
        ?>
    </body>
</html>

