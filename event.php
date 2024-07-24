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
    
    $stmt = $connexion->prepare("SELECT * FROM events WHERE id=? LIMIT 1"); 
    $stmt->execute(array($_GET['id'])); //Get : données de l'URL
    $row = $stmt->fetch();

    $stmtCount = $connexion->prepare("SELECT count(student) as nbr FROM `participation` WHERE event=? group by event; "); //Grouper par evenements
        $stmtCount->execute(array($_GET['id'])); 
        $rowCount = $stmtCount->fetch();
        $nbrParticipant= $rowCount ? $rowCount["nbr"] : 0;

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
        "<h5>Participants:  ".$nbrParticipant."/".$row['nbrMax']."</h5>".
        "<div class ='participe'>";

        if(isset($_SESSION['user'])){ //Session : récuperer dans le navigateurs les cookies
            $stmtExist = $connexion->prepare("SELECT * FROM `participation` WHERE event=:event and student=:student"); 
            $stmtExist->execute(array("event"=>$_GET['id'], "student"=>$_SESSION['user']["id"])); 
            $resultExist = $stmtExist->fetch();
            if(!$resultExist){
                
                echo "<form method='POST' action='' style='text-align:center;margin:10px'>";
                echo "<input type='submit' class='button' name='participer' value='Participer'/>";
                echo "</form>";
            }else{
                echo "<form method='POST' action='' style='text-align:center;margin:10px'>";
                echo "<input type='submit' class='button' name='supprimer' value='Supprimer'/>";
                echo "</form>";
            }
        }
  
          if(isset($_POST["participer"])){
            try{
              $stmt = $connexion->prepare("INSERT INTO `participation` (`event`, `student`)
                                          VALUES (:event, :student);"); 
              $stmt->execute(array("event"=> $_GET['id'],
                                   "student"=>$_SESSION['user']["id"])); 
            }
            catch(PDOException $e){
                printf("Erreur lors de l'inscription : %s\n", $e->getMessage());
                exit();
            }finally{
                echo "<p style='color:green'>Inscription réussite!</p>";
            }
          }

          if(isset($_POST["supprimer"])){
            try{
                $stmt = $connexion->prepare("DELETE FROM `participation` WHERE event = :event AND student = :student"); 
                $stmt->execute(array("event" => $_GET['id'], "student" => $_SESSION['user']["id"])); 
                
                echo "<p style='color:green'>Désinscription réussie!</p>";
            }
            catch(PDOException $e){
                printf("Erreur lors de la désinscription : %s\n", $e->getMessage());
                exit();
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
