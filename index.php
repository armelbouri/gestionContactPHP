<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste contacts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Liste des contacts</h2>
                    <a href="ajouter.php" class="btn btn-success pull-right">Ajout Contact </a>
                </div>
                <?php
                // Inclusion de fichier de config
                require_once "config/config.php";

                // Attempt select query execution
                $sql = "SELECT * FROM contacts";
                if($result = $pdo->query($sql)){
                    if($result->rowCount() > 0){
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>N</th>";
                        echo "<th>Nom</th>";
                        echo "<th>Prenom</th>";
                        echo "<th>Civilite</th>";
                        echo "<th>Telephone</th>";
                        echo "<th>Email</th>";
                        echo "<th>Societe</th>";
                        echo "<th>Ville</th>";
                        echo "<th>Naissance</th>";
                        echo "<th>Operation sur contact</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = $result->fetch()){
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['nom'] . "</td>";
                            echo "<td>" . $row['prenom'] . "</td>";
                            echo "<td>" . $row['civilite'] . "</td>";
                            echo "<td>" . $row['telephone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['societe'] . "</td>";
                            echo "<td>" . $row['ville'] . "</td>";
                            echo "<td>" . $row['naissance'] . "</td>";
                            echo "<td>";
                            echo "<a href='detail.php?id=". $row['id'] ."' title='voir' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a> <span>detail </span>";
                            echo "<a href='editer.php?id=". $row['id'] ."' title='editer' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>  <span>editer </span>";
                            echo "<a href='supprimer.php?id=". $row['id'] ."' title='supprimer' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a><span>supprimer </span>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else{
                        echo "<p class='lead'><em>La liste de Contact est vide.</em></p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>