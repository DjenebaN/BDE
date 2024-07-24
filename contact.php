<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Mon BDE - Contact</title>
    <link rel="stylesheet" href="main.css" />
</head>
<body>
    <?php
    include("./header.php");
    include("./connexion.php");
    ?>

    <div id='Contenu2'>
        <div id="contactForm">
            <h2>Contact</h2>

            <form method="POST" action="#">
                    <h3>Choisissez un sujet :</h3>
                    <div id="choix">
                    <select name="choix">
                        <option value="Inscription">Inscription</option>
                        <option value="aaaa">aaa</option>
                        <option value="bbb">bbb</option>
                        <option value="ccc">ccc</option>
                    </select>
                </div>
                <div id='pp'>
                <input class='contact_style' type="text" name="name" placeholder="Name" />
                <input class='contact_style' type="text" name="email" placeholder="Email"/>
                <textarea class='contact_style' name="message" rows="50" cols="50" placeholder="Message" style="width: 392px; height: 129px;"></textarea> 
                <input class='contact_style' type="submit" name="Envoyer" value="Envoyer">
                </div>
              </form>
        </div>

        <?php
        if(isset($_POST["Envoyer"])){
            if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["message"])){
                echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
            } else {
                try {
                    $stmt = $connexion->prepare("INSERT INTO `messages` (`name`, `email`, `message`, `choix`)
                                                VALUES (:name, :email, :message, :choix);"); 
                    $stmt->execute(array(
                        "name" => $_POST["name"],
                        "email" => $_POST["email"],
                        "message" => $_POST["message"],
                        "choix" => $_POST["choix"]
                    )); 
                    echo "<p style='color:green'>Message envoyé</p>";
                } catch(PDOException $e){
                    printf("Erreur lors de l'envoi du message: %s\n", $e->getMessage());
                    exit();
                }
            }
        }
        ?>
    </div>

    <?php
    include("./footer.php");
    ?>
</body>
</html>
