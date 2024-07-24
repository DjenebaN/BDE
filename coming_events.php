<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Mon BDE - Event</title>
    <link rel="stylesheet" href="main.css" />
</head>
<body>
    <?php
    include("./header.php");
    include("./connexion.php");
    
    $stmt = $connexion->prepare("SELECT * FROM comingEvents WHERE id=? LIMIT 1"); 
    $stmt->execute(array($_GET['id'])); 
    $row = $stmt->fetch();

    echo "<div id='Contenu1'>".
        "<div class='block1'>".
            "<h2>".$row['name']."</h2>".
            "<h4>".$row['citation']."</h4>".
            "<img class='img-content' src='data:image/jpeg;base64,".base64_encode($row['image'])."'/>".
            "<p>".$row['description']."</p>".
        "</div>";
    
    echo "<div id='block2'>".
        "<div id='blockInsc'>".
        "<p>".$row['txt_choix']."</p>".
        "<div class ='participe'>";

    if(isset($_SESSION['user'])){
        $stmtExist = $connexion->prepare("SELECT * FROM `votes` WHERE comEvent=:comEvent and student=:student"); 
        $stmtExist->execute(array("comEvent"=>$_GET['id'], "student"=>$_SESSION['user']["id"])); 
        $resultExist = $stmtExist->fetch();
        if(!$resultExist){
            echo "<a href='vote_page.php'>Voter</a>";
        }
    }

    echo "</div></div>".
        "<div id='blocRegles'>".
        "<p> An adult frog has a stout body, protruding eyes, anteriorly-attached tongue, limbs folded underneath, and no tail (the tail of tailed frogs is an extension of the male cloaca). Frogs have glandular skin, with secretions ranging from distasteful to toxic. Their skin varies in colour from well-camouflaged dappled brown, grey and green to vivid patterns of bright red or yellow and black to show toxicity and ward off predators. Adult frogs live in fresh water and on dry land; some species are adapted for living underground or in trees.</p>".
        "</div></div></div></div>";

    include ("./footer.php");
    ?>
</body>
</html>