<?php
        if(isset($_POST["submit"])){
            try {
                $titre = $_POST["titre"];
                $file = $_FILES["file"];
                $fileName = basename($file["name"]);
                $fileTmpName = $file["tmp_name"];

                // Directory where the uploaded files will be saved
                $target_dir = "uploads/";
                $target_file = $target_dir . $fileName;

                move_uploaded_file($fileTmpName, $target_file);

                $stmt = $connexion->prepare("INSERT INTO `POSTS` (`post`) VALUES (:myfile)");
                    $stmt->execute(array(
                        "post"=>$_POST["myfile"];
                    ));
                    echo "<p style='color:green'>Upload success</p>";
                }
            }

    ?>