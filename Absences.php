<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../CSS/ens_abs.css">
    <script src="https://kit.fontawesome.com/ac3cf60506.js" crossorigin="anonymous"></script>
    <title>Mes absences </title>
</head>
<body>
<?php
/*require("../script/verifie_session.php");*/
?>

<!--<input type="checkbox" id="check">
<label for="check">
    <i class="fas fa-bars" id="btn"></i>
    <i class="fas fa-times" id="cancel"></i>
</label>-->

<div class="sidebar">
    <header>ENT-GI</header>
    <ul>
        <li><a href="index.php"><i class="fas fa-home" style="color: white"></i>Accueil</a></li>
        <li><a href="profile.php"><i class="fas fa-user"  style="color: white"></i>Profil</a></li>
        <li><a href="#"><i class="fas fa-book-open" style="color: white"></i>Cours</a></li>
        <li><a href="Notes.php"><i class="fas fa-calendar-week"  style="color: white"></i>Notes</a></li>
        <li><a href="Absences.php"><i class="fas fa-clock"  style="color: white"></i>Absences</a></li>
        <li><a href="../server/deconnexion.php"><i class="fas fa-sign-out-alt"  style="color: white"></i>Déconnexion</a></li>
    </ul>

</div>


<main>
    <!--  <div class="title">
          <span style="font-size: 14pt; color: deepskyblue; font-style: italic;"> Notes des étudiants: Suivi et évaluation des performances académiques </span>
      </div>  -->


    <div class="select-container">

        <form method="post">

            <select  id="filiere" name="filiere">
                <option  style="text-align: justify;"> Filière</option>
                <?php
                session_start();
                $id=$_SESSION['prpen'];

                $connexion = mysqli_connect("localhost","root","");

                if( !$connexion) { echo "Desolé, connexion à localhost impossible"; exit; }

                if( !mysqli_select_db($connexion,'entgi')) { echo "Désolé, accès à la base entgi impossible"; exit; } // A remplacer avec le fichier de connexion

                $result=mysqli_query($connexion,"SELECT DISTINCT f.libelle FROM filiere f INNER JOIN matiere m ON f.id_filiere = m.id_filiere INNER JOIN enseignant_matiere em ON m.id_matiere = em.id_matiere WHERE em.prp = '$id';");
                if($result)
                {

                    while($ligne=mysqli_fetch_object($result))
                    {

                        echo '<option style="text-align: justify; color:white;" value="'.$ligne->libelle.'">'.$ligne->libelle.'</option>';

                    }
                }
                else
                {
                    echo "Erreur dans la requette";
                }



                mysqli_close(mysqli_connect('127.0.0.1','root','','entgi'));
                ?>

            </select> &nbsp; &nbsp;


            <select id="matiere" name="matiere">

                <option  style="text-align: justify;">Matière</option>
                <?php
                session_start();

                $ID=$_SESSION['prpen'];

                $connexion = mysqli_connect("localhost","root","");

                if( !$connexion) { echo "Desolé, connexion à localhost impossible"; exit; }

                if( !mysqli_select_db($connexion,'entgi')) { echo "Désolé, accès à la base entgi impossible"; exit; } // A remplacer avec le fichier de connexion

                $request=mysqli_query($connexion,"SELECT m.libelle FROM enseignant e JOIN enseignant_matiere em ON e.prp = em.prp JOIN matiere m ON em.id_matiere = m.id_matiere WHERE e.prp = '$ID';");
                if($request)
                {

                    while($line=mysqli_fetch_object($request))
                    {
                        echo '<option  style="text-align: justify; color:white;" value="'.$line->libelle.'">'.$line->libelle.'</option>';

                    }
                }
                else
                {
                    echo "Erreur dans la requette";
                }
                mysqli_close(mysqli_connect('127.0.0.1','root','','entgi'));
                ?>

            </select>
            <select>
                <option  style="text-align: justify;">Date</option>
                <?php
                $ens=$_SESSION['prpen'];
                $subject = $_POST['matiere'];
                $orient = $_POST['filiere'];
                $connexion = mysqli_connect("localhost","root","");

                if( !$connexion) { echo "Desolé, connexion à localhost impossible"; exit; }

                if( !mysqli_select_db($connexion,'entgi')) { echo "Désolé, accès à la base entgi impossible"; exit; }
                $quer=mysqli_query($connexion,"SELECT DISTINCT a.date_absence
                FROM absence a
                JOIN matiere m ON a.id_matiere = m.id_matiere
                JOIN filiere f ON m.id_filiere = f.id_filiere
                JOIN enseignant e ON m.prp = e.prp
                WHERE e.prp = '$ens'
                AND f.libelle = '$orient'
                AND m.libelle = '$subject';");
                if($quer)
                {
                    while ($btn=mysqli_fetch_object($quer))
                    {
                        echo '<option  style="text-align: justify; color:white;" value="'.$btn->date_absence.'">'.$btn->date_absence.'</option>';
                    }
                }
                else
                {
                    echo "Erreur dans la requette";
                }
                mysqli_close(mysqli_connect('127.0.0.1','root','','entgi'));
                ?>
            </select><br>
            <div class="submitted"><br>

                <input type="submit" name="submit" class="styled" value="Envoi"></div>

    </div>
    </form>
    <br><br>
    <div class="pic">

        <img src="../images/img.png" id="monImage">
    </div>


        <?php
         $Id=$_SESSION['prpen'];
        if (isset($_POST['submit']))
        {
            echo"<script>
         document.getElementById('monImage').style.display = 'none';
      </script>";
            $matiere = $_POST['matiere'];
            $filiere = $_POST['filiere'];

            echo "<form method='post' action=''>";
            echo"<table id='tab' class='tableau-style'><thead><tr><th>Massar</th> <th>Nom</th>  <th>Prénom</th>   <th width='60px'>Heures</th>  <th> Date d'absence </th> <th> Action </th> <!--<th></th>--> </tr></thead>";
            echo"<caption>$filiere - $matiere</caption>";
            $connexion = mysqli_connect("localhost","root","");

            if( !$connexion) { echo "Desolé, connexion à localhost impossible"; exit; }

            if( !mysqli_select_db($connexion,'entgi')) { echo "Désolé, accès à la base entgi impossible"; exit; } // A remplacer avec le fichier de connexion

            $resultat=mysqli_query($connexion," SELECT a.id_massar,e.nom, e.prenom,a.nbr_heure,a.date_absence FROM absence a INNER JOIN etudiant e ON a.id_massar = e.id_massar INNER JOIN matiere m ON a.id_matiere = m.id_matiere INNER JOIN filiere f ON m.id_filiere = f.id_filiere INNER JOIN enseignant_matiere em ON m.id_matiere = em.id_matiere INNER JOIN enseignant en ON em.prp = en.prp WHERE f.libelle = '$filiere'AND en.prp = '$Id'AND m.libelle = '$matiere';");
            if($resultat)
            {
                while($row=mysqli_fetch_object($resultat))
                {
                    echo "<tr align='justify'> <td>$row->id_massar</td> <td>$row->nom</td><td>$row->prenom</td><td class='petite'><input type='number' value='$row->nbr_heure' id='hour'></td><td><input type='date' value='$row->date_absence' id='date' style='border: 0; background-color: transparent;'></td>

                     <td><a href='editer.php?id=$row->id_massar'><i class='fas fa-edit'></i></a>&nbsp&nbsp&nbsp&nbsp<a href='Supprimer.php?id=$row->id_massar' onclick=\"return confirm('Voulez-vous vraiment supprimer cet etudiant ?');\"><i class='fas fa-trash-alt'></i></a></td>
                     
           
                  
                    </tr>";
                }
                echo "</table>";
                echo "</form>";
            }
            else
            {
                echo "Erreur dans la requette";
            }
            mysqli_close(mysqli_connect('127.0.0.1','root','','entgi'));
        }
        ?>
</main>
</body>
</html>