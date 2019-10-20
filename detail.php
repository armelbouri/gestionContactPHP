<?php
// on test si id existe et que sa valeur different de null
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Inclusion de fichier de configuration pour connexion a la base de donnees
    require_once "config/config.php";

    // on selectionne le conntact qui a pour id passer en parametre de uri
    $sql = "SELECT * FROM contacts WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        // on bind les parametre pour preparer la requete eviter les injections sql
        $stmt->bindParam(":id", $param_id);
        $param_id = trim($_GET["id"]);

        // on execute notre requete preparer
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                //on extrait les donnees recu sous form tableau associatif
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // recuperation des donnees
                $id=$row["id"];
                $nom = $row["nom"];
                $prenom = $row["prenom"];
                $civilite = $row["civilite"];
                $telephone = $row["telephone"];
                $email = $row["email"];
                $societe = $row["societe"];
                $ville = $row["nom"];
                $naissance = $row["naissance"];
            }

        } else{
            echo "impossible d executer la requete";
        }
    }

} else{
    // rediriger vers  vers la connexion
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">

</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Les details d'un contact</h2>
                </div>
                <div class="panel panel-primary">
                    <div class="panel panel-heading">consulter les informations d'un contact</div>
                    <div class="panel panel-body">
                        <div class="contenair">
                            <p class="text"><strong>Nom : </strong><span class="text"><?php echo $row["nom"]; ?></span></p>
                            <p class="text"><strong>Prenom : </strong><span class="text"><?php echo $row["prenom"]; ?></span></p>
                            <p class="text"><strong>Civilite : </strong><span class="text"><?php echo $row["civilite"]; ?></span></p>
                            <p class="text"><strong>Telephone : </strong><span class="text"><?php echo $row["telephone"]; ?></span></p>
                            <p class="text"><strong>Email : </strong><span class="text"><?php echo $row["email"]; ?></span></p>
                            <p class="text"><strong>Societe : </strong><span class="text"><?php echo $row["societe"]; ?></span></p>
                            <p class="text"><strong>Ville : </strong><span class="text"><?php echo $row["ville"]; ?></span></p>
                            <p class="text"><strong>Date Naissance : </strong><span class="text"><?php echo $row["naissance"]; ?></span></p>

                        </div>


                    </div>

                </div>


            </div>
        </div>
    </div>
</div>


</body>
</html>