<section id="connexion">
    <h2>Connectez-vous</h2>
<section>
    <form method="post">
        <ol>
            <li>
                <label for="pseudo_connexion">Pseudo</label>
                <input type="text" name="pseudo_connexion" placeholder="jurydwm" />
                <?php echo message_erreur($errors, 'pseudo_connexion'); ?>
            </li>
            <li>

                <label for="mdp_connexion">Mot de passe</label>
                <input type="password" name="mdp_connexion" placeholder="jury111215" />
                <?php 
                    echo message_erreur($errors, 'mdp_connexion');
                    if($errors['no_login'] != ''){
                        echo '<p class="error_message">'.$errors['no_login'].'</p>';
                    }
                ?>
            </li>
            <li>
                <input id="connexion_ref" type="submit" name="submit_connexion" value="connexion"/>
            </li>
        </ol>
    </form>
</section>    
<h2>Inscrivez-vous</h2>
    <!-- <h3>Pour gérer votre compte et être tenu au courant des nouveautés</h3> -->
<section>
    <form method="POST">
        <ol>
            <li>
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" value="<?php echo $pseudo_in ?>"/>
                <?php 
                    echo message_erreur($errors, 'pseudo');
                    if($errors['pseudo_taken'] != ''){
                        echo '<p>'.$errors['pseudo_taken'].'</p>';
                    }
                ?>
            </li>
            <li>
                <label for="prenom_in">Prénom</label>
                <input type="text" name="prenom_in" value="<?php echo $prenom_in ?>"/>
                <?php echo message_erreur($errors, 'prenom_in') ?>
            </li>
            <li>
                <label for="nom_in">Nom</label>
                <input type="text" name="nom_in" value="<?php echo $nom_in ?>"/>
                <?php echo message_erreur($errors, 'nom_in') ?>
            </li>
            <li>
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $email_in ?>"/>
                <?php 
                    echo message_erreur($errors, 'email');     
                    if($errors['email_taken'] != ''){
                        echo '<p>'.$errors['email_taken'].'</p>';                        
                    }
                ?>
            </li>
            <li>
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp"/>
                <?php echo message_erreur($errors, 'mdp') ?>
            </li>
            <li>
                <input class="btn btn-primary" type="submit" name="submit_in"/>
            </li>
        </ol>
    </form>
</section></section>