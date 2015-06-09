<?php
    $user = $_SESSION['user'];
    $query = "SELECT * FROM membre WHERE pseudo = :pseudo";
        $preparedStatement = $db->prepare($query);
        $preparedStatement->execute(array(':pseudo' => $user));
        $result = $preparedStatement->fetch();
        $pseudoInit = $result['pseudo'];
        $prenomInit = $result['prenom'];
        $nomInit = $result['nom'];
        $emailInit = $result['email'];
        $mdpInit = $result['mdp'];
        $id = $result['id'];
?>
<section id="profil" class="clearfix">
    <h2 class="Bienvenue_profil">Bienvenue sur votre profil <?php echo $user ?></h2>
    <ol class="clearfix">
        <li>
            <p>Pseudo :</p>
            <?php echo '<p>'.$pseudoInit.'</p>';?>
        </li>
        <li>
            <p>Prénom :</p>
            <?php echo '<p>'.$prenomInit.'</p>';?>
        </li>
        <li>
            <p>Nom :</p>
            <?php echo '<p>'.$nomInit.'</p>';?>
        </li>
        <li>
            <p>Email :</p>
            <?php echo '<p>'.$emailInit.'</p>';?>
        </li>
        <li>
            <p>Mot de passe :</p>
            <?php 
                $mdp_crypte = preg_replace('/[a-zA-Z0-9]/', '*', $mdpInit);
                echo '<p>'.$mdp_crypte.'</p>';
            ?>
        </li>
    </ol>
<h3><a id="btn-modification">Modifier les données</a></h3>
<a class="deco_delete" href="index.php?page=deco">Se déconnecter</a>
    <a  class="deco_delete" id="delete">Supprimer votre compte</a>
</section>
<section id="confirm">
    <h2>Supprimer votre compte</h2>
    <p>Êtes-vous sûr de supprimer votre compte ?</p>
    <div>
        <h3 id="btn-y"><a id="yes" href="index.php?page=delete">Oui</a></h3>
        <h3 id="btn-n"><a id="no">Non</a></h3>
    </div>
</section>
<?php include 'update.php'; ?>