<?php
// Inclusion de fichier de configuration pour se connecter a la base de donnees
require_once "config/config.php";

// initialisation des variables avec les valeur vide
$nom = $prenom = "";
$nom_err = $prenom_err = "";

// on test si on soummets le formulaire avec la methode post
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validation des parametre et recuperation des valeurs des champs formulaire
    $nom = ucfirst(strtolower(trim($_POST["nom"])));
    if(empty($nom)){
        $nom_err = "Le nom est obligatiore.";
    } else{
        $nom = $nom;
    }

    $prenom = ucfirst(strtolower(trim($_POST["prenom"])));
    if(empty($prenom)){
        $prenom_err = "Le prenom est obligatoire.";
    } else{
        $address = $prenom;
    }
    $civilite = ucfirst(strtolower(trim($_POST["civilite"])));
    $telephone = ucfirst(strtolower(trim($_POST["telephone"])));
    $email = ucfirst(strtolower(trim($_POST["email"])));
    $societe = ucfirst(strtolower(trim($_POST["societe"])));
    $ville = ucfirst(strtolower(trim($_POST["ville"])));
    $naissance = ucfirst(strtolower(trim($_POST["naissance"])));

    // on test si on n a pas des erreur dans la saisi
    if(empty($nom_err_) && empty($prenom_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO contacts (nom, prenom, civilite,telephone,email,societe,ville,naissance) VALUES (:nom, :prenom, :civilite, :telephone, :email, :societe, :ville, :naissance)";

        if($stmt = $pdo->prepare($sql)){
            //binder nos parametre pour preparer la requete
            $stmt->bindParam(":nom", $param_nom);
            $stmt->bindParam(":prenom", $param_prenom);
            $stmt->bindParam(":civilite", $param_civilite);
            $stmt->bindParam(":telephone", $param_telephone);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":societe", $param_societe);
            $stmt->bindParam(":ville", $param_ville);
            $stmt->bindParam(":naissance", $param_naissance);

            //modifie des  parametres
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_civilite = $civilite;
            $param_telephone = $telephone;
            $param_email = $email;
            $param_societe = $societe;
            $param_ville = $ville;
            $param_naissance = $naissance;

            // exection de la requete
            if($stmt->execute()){
                // contact ajoute et on redirige vers la page d acceuil
                header("location: index.php");
                exit();
            } else{
                echo "echec de la requete";
            }
        }

        // destruction de la variable de requete
        unset($stmt);
    }

    // destruction de la variable de connexion
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2>Ajouter un Contact</h2>
                </div>
                <p>veuillez remplir ce formulaire pour ajouter un contact dans la base de donnees.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($nom_err)) ? 'warning' : ''; ?>">
                        <label class="control-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required  placeholder="nom">
                        <span class="help-block"><?php echo $nom_err;?></span>

                    </div>
                    <div class="form-group <?php echo (!empty($prenom_err)) ? 'warning' : ''; ?>">
                        <label class="control-label">Prenom</label>
                        <input type="text" name="prenom" class="form-control" required placeholder="prenom">
                        <span class="help-block"><?php echo $prenom_err;?></span>

                    </div>
                    <div class="form-group">
                        <label class="control-label">Civilite</label>
                        <input type="text" name="civilite" class="form-control" placeholder="civilite">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Telephone</label>
                        <input type="tel" name="telephone" class="form-control" placeholder="telephone">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="exemple@gmail.com">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Societe</label>
                        <input type="text" name="societe" class="form-control" placeholder="Digital-com">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ville</label>
                        <input type="text" name="ville" class="form-control" placeholder="ville">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Naissance</label>
                        <input type="date" name="naissance" class="form-control" placeholder="date naissance">
                    </div>
                    <input type="submit" class="btn btn-primary creer" value="Ajouter">
                    <a href="index.php" class="btn btn-default">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>