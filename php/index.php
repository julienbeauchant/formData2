<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <input type="text" name="task">
        <input type="submit" name="submit">
    </form>
    <?php

    $host = "mysql"; // Nom du service du conteneur MySQL dans Docker
    $port = "3306"; // Le port exposé par le conteneur MySQL dans Docker
    $dbname = "afci"; // Remplacez par le nom de votre base de données
    $user = "admin"; // Remplacez par votre nom d'utilisateur
    $pass = "admin"; // Remplacez par votre mot de passe


    // Création d'une nouvelle instance de la classe PDO
    $connexion = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sqlRead = "SELECT * FROM task";
    $request = $connexion->query($sqlRead);
    $data = $request->fetchAll(PDO::FETCH_ASSOC);


    // $connexion->query($sqlRead);
    // $data = $request->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST["submit"]) && !empty($_POST['task'])) {
        $task = $_POST['task'];
        $sql = "INSERT INTO task (task) VALUES ('$task')";
        $connexion->query($sql);
        header("Location: index.php");
        echo "Données ajoutées";
    }

    var_dump($_POST['task']);

    if (isset($_POST['delete']) && isset($_POST['taskId'])) {
        $taskId = $_POST['id_task'];
        $sqlDelete = "DELETE FROM `task` WHERE `id_task` = '$taskId'";
        $connexion->query($sqlDelete);
        header("Location: index.php");
    }

    var_dump($_POST['taskId']);



    foreach ($data as $value) {
        $taskId = $value ['id_task'];
        echo '<p class="">' . $value['task'] . '</p>
        <form method="POST">
        <input type="submit" name="modifier" value="modifier">
        <br>
        <input type="submit" name="supprimer" value="supprimer">
        </form>';
    }
    ?>

    <script>
        const modifier = document.querySelector('.test');
        modifier.addEventListener('click', (e) => {
            e.preventDefault();
        })
    </script>
</body>

</html>