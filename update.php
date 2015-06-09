<section id="modification" class="clearfix">
   <h2>Modifie tes données</h2>
    <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
        <ol>
            <li>
                <label for="pseudo_modification">Pseudo</label>
                <input type="text" value="<?php echo $pseudoInit ?>" name="pseudo_modification"/>
                <?php 
                    echo message_erreur($errors, 'pseudo_modification');
                    if($errors['pseudo_taken'] != ''){
                        echo '<p>'.$errors['pseudo_taken'].'</p>';
                    }
                ?>
            </li>
            <li>
                <label for="prenom_modification">Prénom</label>
                <input type="text" value="<?php echo $prenomInit ?>" name="prenom_modification"/>
                <?php echo message_erreur($errors, 'prenom_modification') ?>
            </li>
            <li>
                <label for="nom_modification">Nom</label>
                <input type="text" value="<?php echo $nomInit ?>" name="nom_modification"/>
                    <?php echo message_erreur($errors, 'nom_modification') ?>
            </li>
            <li>
                <label for="email_modification">Email</label>
                <input type="text" value="<?php echo $emailInit ?>" name="email_modification"/>
                    <?php 
                    echo message_erreur($errors, 'email_modification');
                    if($errors['email_taken'] != ''){
                        echo '<p>'.$errors['email_taken'].'</p>';                        
                    }
                ?>
            </li>
            <li>
                <label for="mdp_modification">Mot de passe</label>
                <input type="password" value="<?php echo $mdpInit ?>" name="mdp_modification"/>
                    <?php echo message_erreur($errors, 'mdp_modification') ?>
            </li>
            <li class="clearfix">
                <input type="submit" value="enregistrer" name="modify"/>
            </li>
        </ol>
    </form>
    <!--end form data-->
    
</section>
<!--end section-->