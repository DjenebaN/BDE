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

    <div>
        <form action="uploads.php" method="POST" enctype=" multipart/form-data">
            <label for="file">Select a file:</label>
            <input type="file" id="file" name="file">
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>

    </div>

</body>
</html>
