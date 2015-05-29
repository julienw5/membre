<?php
    //valid
    function is_valid_email($email){
        return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }

    //error
    function message_erreur($errors, $input){
        if($_POST){
            if ($errors[$input] != '') {
                return '<p class="error_message">'.$errors[$input].'</p>';
            }
        }
    }

?>