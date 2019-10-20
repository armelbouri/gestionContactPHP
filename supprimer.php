<?php
// test si l id est dans le parametre uri
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Inclusion de fichier de configuration pour connexion a bd
    require_once "config/config.php";

    // on ecrit la requete
    $sql = "DELETE FROM contacts WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);

        // modifie les parametre pour preparer la requete
        $param_id = trim($_POST["id"]);

        // on execute la requete
        if($stmt->execute()){
            // contact bien supprime
            header("location: index.php");
            exit();
        } else{
            echo "impossible reesayez.";
        }
    }

    // fermeture de variable de la requete
    unset($stmt);

    // fermeture de la connexion
    unset($pdo);
} else{
    // test si le parametre id existe
    if(empty(trim($_GET["id"]))){
        // redirige vers une page erreur
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>detail contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Supprimer contact</h1>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger fade in">
                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                        <p>Etes vous sur de supprimer ce contacct?</p><br>
                        <p>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="index.php" class="btn btn-default">Non</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
