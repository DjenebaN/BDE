<!DOCTYPE html>
<html>
	<head>
   	 	<meta charset="utf-8" />
   	 	<title>Mon BDE - Login</title>
    	<link rel="stylesheet" href="main.css" />
    </head>
    <body>
        <?php
          include("./header.php");
          include("./connexion.php");
        ?>

        <div id='Contenu2'>

        <div id="loginPage">
            <form id="inscForm" method="POST" action="#" >
                <h3>S'inscrire</h3>
                <input class='form_style' type="text" name="lastname" placeholder="Nom"/>
                <input class='form_style' type="text" name="pseudo" placeholder="Pseudo"/>
                <input class='form_style' type="text" name="firstname" placeholder="Prénom"/>
                <input class='form_style' type="text" name="email" placeholder="Email"/>
                <input class='form_style' type="password" name="password" placeholder="mot de passe"/>
                <input type="radio" name="cond" value="Condition">
                <label for="condition">J'accepte de suivre le reglement</label><br>
                <input class='form_style' type="submit" name="inscription" value="Valider">
            </form> 
            <?php
            if(isset($_POST["inscription"])){
            if(empty($_POST["firstname"])
                ||empty($_POST["lastname"])
                ||empty($_POST["email"])
                ||empty($_POST["password"])
                ||empty($_POST["cond"])
                ||empty($_POST["pseudo"])){
                echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
            }else{
                try{
                    $stmt = $connexion->prepare("INSERT INTO `students`
                                                (`firstname`, `lastname`, `email`, `password`, `pseudo`)
                                                VALUES (:firstname, :lastname, :email, :password, :pseudo);"); 
                    $stmt->execute(array("firstname"=> $_POST["firstname"],
                                            "lastname"=>$_POST["lastname"],
                                            "email"=>$_POST["email"],
                                            "pseudo"=>$_POST["pseudo"],
                                            "password"=>password_hash($_POST["password"], PASSWORD_DEFAULT))); 
                }
                catch(PDOException $e){
                    printf("Erreur lors de l'inscription : %s\n", $e->getMessage());
                    exit();
                }finally{
                    echo "<p style='color:green'>Inscription réussite!</p>";
                }
            }
        }
        ?>
            <form id="conexForm" method="POST" action="#">
                <h3>Se connecter</h3>
                <input class='form_style' type="text" name="emailPseudo" placeholder="Email / Pseudo" />
                <input class='form_style' type="password" name="password" placeholder="mot de passe"/>
                <input class='form_style' type="submit" name="connexion" value="Valider">
            </form>
            <?php
            if(isset($_POST["connexion"])){
            if(empty($_POST["emailPseudo"]) ||empty($_POST["password"])){
                echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
            }else{
                $stmt = $connexion->prepare("SELECT * FROM students WHERE email=:email OR pseudo=:pseudo"); //Chercher par rapport à l'email
                $stmt->execute(array(":email" => $_POST['emailPseudo'], ":pseudo" => $_POST['emailPseudo']));
                $row = $stmt->fetch();
                if(password_verify($_POST['password'], $row["password"])){
                    $_SESSION["user"]= $row; //Sauvegarde l'utilsateur dans la session 'user'
                    header("Location: tous.php"); //Ouvre la page d'accueil
                }else{
                    echo "<p style='color:red'>Identifiants incorrect!</p>";
                }
            }
        }
        ?>
        </div>

        </div>

        <?php
        
          include("./footer.php");
        ?>

      