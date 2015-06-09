<?php
    if($_POST['submit_in'] == true){
        $pseudo_in = trim(strip_tags($_POST['pseudo']));
        $prenom_in = trim(strip_tags($_POST['prenom_in']));
        $nom_in = trim(strip_tags($_POST['nom_in']));
        $email = trim(strip_tags($_POST['email']));
        $mdp = trim(strip_tags($_POST['mdp']));
       
        $errors = array(); 
        $compare = array($pseudo_in, $email);
        //Nettoyage
        if($_POST['pseudo'] == ''){
            $errors['pseudo'] = 'Pseudo manquant';
        }
        if($_POST['prenom_in'] == ''){
            $errors['prenom_in'] = 'Prénom manquant';
        }
        if($_POST['nom_in'] == ''){
            $errors['nom_in'] = 'Nom manquant';
        }
        if($_POST['mdp'] == ''){
            $errors['mdp'] = 'Mot de passe manquant';
        }        
        if(is_valid_email($email) == false){
            $errors['email'] = 'Email invalide';
         }
        //Compraison & récupération
        $query = "  SELECT pseudo, email FROM membre WHERE pseudo = :pseudo || email = :email LIMIT 2";
        $preparedStatement = $db->prepare($query);
        $preparedStatement->execute(array( ':pseudo' => $pseudo_in, ':email' => $email ));
        $result = $preparedStatement->fetchAll();
        //Vérification pseudo-email identique
        if(!empty($result)){
            //Deux valeurs dans le même tableau
            if(in_array($pseudo_in, (array_intersect($result[0], $compare)))){
                $errors['pseudo_taken'] = 'Pseudo déjà utilisé';
            }
            if(in_array($email, (array_intersect($result[0], $compare)))){
                $errors['email_taken'] = 'Email déjà utilisé';
            }
            //Deux valeurs dans deux tableaux différents
            //Si deuxième tableau = deux emails identique
            if(array_key_exists(1, $result) == true){
                if(in_array($pseudo_in, (array_intersect($result[1], $compare)))){
                $errors['pseudo_taken'] = 'Pseudo déjà utilisé';
                }
                if(in_array($email, (array_intersect($result[1], $compare)))){
                    $errors['email_taken'] = 'Email déjà utilisé';
                }
            }  
        }else if(count($errors) == 0){
                //write
                $query = "INSERT
                        INTO membre (pseudo, prenom, nom, email, mdp)
                        VALUE (:pseudo, :prenom, :nom, :email, :mdp)";
                //Execute
                $params = array(
                            ':pseudo' => $pseudo_in,
                            ':prenom' => $prenom_in,
                            ':nom' => $nom_in,
                            ':email' => $email,
                            ':mdp' => $mdp
                        );
                $preparedStatement = $db->prepare($query);
                $preparedStatement->execute($params);
                //send message
                $mdp_crypte_in = preg_replace('/[a-zA-Z0-9]/', '*', $mdp);
                $line1 = 'Votre inscription sur AERIA-APP est ok :';
                $line2 = 'Pseudo : '.$pseudo_in;
                $line3 = 'Prénom : '.$prenom_in;
                $line4 = 'Nom : '.$nom_in;
                $line5 = 'Email : '.$email;
                $line6 = 'Mot de passe : '.$mdp_crypte_in;
                $message = $line1."\r\n".$line2."\r\n".$line3."\r\n".$line4."\r\n".$line5."\r\n".$line6;   
                $sujet = 'Message de confirmation';
                $resultEmail = mail($email, $sujet, $message);
                if($resultEmail){
                    $_SESSION['logged_in'] = 'ok';
                    $_SESSION['user'] = $pseudo_in;
                    header('location: index.php');
                    exit();
                }else{
                    echo '<p>Erreur, email non envoyé</p>';
                }
            }
    }

        if($_POST['submit_connexion'] == true){
            $pseudo_connexion = trim(strip_tags($_POST['pseudo_connexion']));
            $mdp_connexion = trim(strip_tags($_POST['mdp_connexion']));
            $errors = array();
            
            if($_POST['pseudo_connexion'] == ''){
                $errors['pseudo_connexion'] = 'erreur du pseudo';
            }
            if($_POST['mdp_connexion'] == ''){
                $errors['mdp_connexion'] = 'erreur du mot de passe';
            } 
            
            $query = "SELECT pseudo, mdp FROM membre WHERE pseudo = :pseudo && mdp = :mdp";
            $preparedStatement = $db->prepare($query);
            $preparedStatement->execute(array( ':pseudo' => $pseudo_connexion, ':mdp' => $mdp_connexion ));
            $result = $preparedStatement->fetchAll();
            
            if(!empty($result)){
                $_SESSION['logged_in'] = 'ok';
                $_SESSION['user'] = $pseudo_connexion;
                header('location: index.php');
                exit();
            }else if(count($errors) < 1){
                $errors['no_login'] = 'Votre email et/ou votre mot de passe est incorrect';
            }
        }

//UPDATE

    if($_POST['modify'] == true){
        
        //données
        $pseudo_modification = trim(strip_tags($_POST['pseudo_modification']));
        $prenom_modification = trim(strip_tags($_POST['prenom_modification']));
        $nom_modification = trim(strip_tags($_POST['nom_modification']));
        $email_modification = trim(strip_tags($_POST['email_modification']));
        $mdp_modification = trim(strip_tags($_POST['mdp_modification']));
        
        $errors = array();
        
        $compare = array($pseudo_modification, $email_modification);
        
        //Nettoyage
        if($_POST['pseudo_modification'] == ''){
            $errors['pseudo_modification'] = 'Pseudo manquant';
        }
        if($_POST['prenom_modification'] == ''){
            $errors['prenom_modification'] = 'Prénom manquant';
        }
        if($_POST['nom_modification'] == ''){
            $errors['nom_modification'] = 'Nom manquant';
        }
        if($_POST['mdp_modification'] == ''){
            $errors['mdp_modification'] = 'Mot de passe manquant';
        }        
        if(is_valid_email($email_modification) == false){
            $errors['email_modification'] = 'Email invalide';
         }
        
        //Comparaison pseudo
        //Récupérer pseudo
        $query = "  SELECT pseudo, email FROM membre WHERE pseudo = :pseudo || email = :email LIMIT 2";
        //Préparer lecture
        $preparedStatement = $db->prepare($query);
        $preparedStatement->execute(array( ':pseudo' => $pseudo_modification, ':email' => $email_modification ));
        //Lire
        $result = $preparedStatement->fetchAll();

        //Vérification pseudo-email identique
        if(!empty($result)){
            //Deux valeurs dans le même tableau
            if(in_array($pseudo_modification, (array_intersect($result[0], $compare)))){
                //Comparer entre le pseudo initial et modifié
                if($pseudo_modification != $pseudoInit){
                    $errors['pseudo_taken'] = 'Pseudo déjà utilisé';
                }
            }
            if(in_array($email_modification, (array_intersect($result[0], $compare)))){
                if($email_modification != $emailInit){
                    $errors['email_taken'] = 'Pseudo déjà utilisé';
                }
            }
            //Deux valeurs dans deux tableaux différents
            //Si deuxième tableau = deux emails identique
            if(array_key_exists(1, $result) == true){
                if(in_array($pseudo_modification, (array_intersect($result[1], $compare)))){
                    if($pseudo_modification != $pseudoInit){
                        $errors['pseudo_taken'] = 'Pseudo déjà utilisé';
                    }
                }
                if(in_array($email_modification, (array_intersect($result[1], $compare)))){
                    if($email_modification != $emailInit){
                        $errors['email_taken'] = 'Pseudo déjà utilisé';
                    }
                }
            }  
        }
        if(count($errors) == 0){
            //Ecrire
            $query = "  UPDATE membre SET pseudo = :pseudo, prenom = :prenom, nom = :nom, email = :email, mdp = :mdp WHERE id = :id ";
            //Executer écriture
            $params = array( ':pseudo' => $pseudo_modification, ':prenom' => $prenom_modification, ':nom' => $nom_modification, ':email' => $email_modification, ':mdp' => $mdp_modification, ':id' => $id );
            $preparedStatement = $db->prepare($query);
            $preparedStatement->execute($params);

            //message
            $mdp_crypte_modification = preg_replace('/[a-zA-Z0-9]/', '*', $mdp_modification);
            $line1 = 'Votre profil a bien est mis a jour :';
            $line2 = 'Pseudo : '.$pseudo_modification;
            $line3 = 'Prénom : '.$prenom_modification;
            $line4 = 'Nom : '.$nom_modification;
            $line5 = 'Email : '.$email_modification;
            $line6 = 'Mot de passe : '.$mdp_crypte_modification;
            $message = $line1."\r\n".$line2."\r\n".$line3."\r\n".$line4."\r\n".$line5."\r\n".$line6;    
            $sujet = 'Modification de profil';
            $resultEmail = mail($email_modification, $sujet, $message);
            if($resultEmail){
                $_SESSION['user'] = $pseudo_modification;
                if($success == 'no'){
                    header('location: index.php?success='.$success);
                }else{
                    header('location: index.php');
                }
                exit();
            }else{
                echo '<p>Erreur, email non envoyé</p>';
            }
        }
    }