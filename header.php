<?php
session_start();
?>
<div id = "Header">
            <div id="Logo"> <img src = "cloud.png" alt="Logo"/> </div>
            <div id ="Title"><h1> LOISIRS </h1></div>
            <div id="Logo"> <img src = "cloud.png" alt="Logo"/> </div>
        </div>

        <div id = "Phrase">
            Phrase
        </div>

        <div id = "Menu">
            <ul> 
                <li> <a href="home.php"> Accueil</a></li>
                <li> <a href="coming.php"> À Venir</a></li>
                <li> <a href="tous.php"> Evenements</a></li>
                <li> <a href="contact.php"> Contacts</a></li>
                <li> <a href="about.php"> À propos</a></li>
                <li> <a href="publish.php"> Publier</a></li>
                <li> <a href="posts.php">Posts</a></li>
                <li> 
                    <?php
                    if (!isset($_SESSION['user'])){
                        echo "<a href='login.php'>Se connecter</a>";
                    }else{
                        echo "<a href='logout.php'>";
                        echo $_SESSION ['user'] ["firstname"]."".$_SESSION['user']["lastname"]."<br/>";
                        echo "Déconnection";
                        echo "</a>";
                    }
                    ?>
                </li>
            </ul>
        </div>
</div>