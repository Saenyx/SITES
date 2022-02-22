<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <title>Register form</title>
</head>

<!-- PHP page register.php: -->

<?php 

require_once '../inc/init.php';




    if (!empty($_POST)):
       // die('coucou');
        function password_strength_check($password, $min_len = 6, $max_len = 15, $req_digit = 1, $req_lower = 1, $req_upper = 1, $req_symbol = 1) {
            // Build regex string depending on requirements for the password
            $regex = '/^';
            if ($req_digit == 1) { $regex .= '(?=.*\d)'; }              // Match at least 1 digit
            if ($req_lower == 1) { $regex .= '(?=.*[a-z])'; }           // Match at least 1 lowercase letter
            if ($req_upper == 1) { $regex .= '(?=.*[A-Z])'; }           // Match at least 1 uppercase letter
            if ($req_symbol == 1) { $regex .= '(?=.*[^a-zA-Z\d])'; }    // Match at least 1 character that is none of the above
            $regex .= '.{' . $min_len . ',' . $max_len . '}$/';
    
            if(preg_match($regex, $password)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    
    
    
        $resultat = executeRequete("SELECT * FROM user WHERE email=:email", array(
            ':email' => $_POST['email']
        ));
    
        if ($resultat->rowCount() !== 0):
            $_SESSION['messages']['danger'][] = "Un compte est déjà existant à cette adresse mail";
    
            header('location:./register.php');
            exit();
        endif;
    
        if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):
            $_SESSION['messages']['danger'][] = "email invalide";
    
            header('location:./register.php');
            exit();
        endif;
    
        if(!password_strength_check($_POST['password'])):
    
            $_SESSION['messages']['danger'][] = "Votre mot de passe doit contenir au minimum 6 caractères, maximum 15 caractères,majuscule, minuscule et un caractère spécial ! # @ % & * + -";
            header('location:./register.php');
            exit();
    
        endif;


        if ($_POST['password'] == $_POST['confirmPassword']):

            $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
            executeRequete("INSERT INTO user ( email, password, roles) VALUES ( :email, :password, :roles)", array(
            
                ':email' => $_POST['email'],
                ':password' => $mdp,
                ':roles' => 'ROLE_USER'
    
            ));
    
            $_SESSION['messages']['success'][] = "Félicitation, vous êtes à présent inscrit";
    
            header('location:./login.php');
            exit();
    
        else:
    
            $_SESSION['messages']['danger'][] = "Les mots de passe ne correspondent pas";
    
            header('location:./register.php');
            exit();
    
        endif;
    
    
    endif;
    
    
    ?>

   

<body>
    <div id="particles-js"></div>
    <body class="register">
        <div class="container">
            <div class="register-container-wrapper clearfix">
                <div class="welcome"><strong>Sign Up :</strong></div>

                <form method="post" action="" class="form-horizontal register-form" >
                    <div class="form-group relative email">
                        <input name="email" id="email" class="form-control input-lg" type="email" placeholder="Email">
                    </div>
                    <br>
                    <div class="form-group relative password">
                        <input name="password" id="register_password" class="form-control input-lg" type="password" placeholder="Password">
                    </div>
                    <br>
                    <div class="form-group relative password">
                        <input name="confirmPassword" id="register_confirm_password" class="form-control input-lg" type="password" placeholder="Confirm Password">
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Register</button>
                    </div>
                    <br>
                    <div class="form-group text-center">
						<label> <a class="forget" href="../security/login.php" title="forget">Already have an account ? Log in</a> </label>
					</div>
                </form>
            </div>

        </div>

    </body>
</body>

</html>