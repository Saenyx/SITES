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

if(!empty($_POST)):

    // Controles email: 

    $resultat=executeRequete(" SELECT * FROM user WHERE email=:email", 
    array(':email'=>$_POST['email']));

    // mail existe déjà: 
    if($resultat->rowCount() !==0):
        $_SESSION['messages']['danger'][]="Un compte existe déjà à cette adresse";
        header('location:./register.php');
        exit();
    endif; //fin mail existe déjà


    // mail invalide
    if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):
        $_SESSION['messages']['danger'][]="email invalide";
        header('location:./register.php');
        exit();
    endif; //fin mail invalide


    // controle caractères
    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/', ($_POST['password']))):
        $_SESSION['messages']['danger'][] = "Votre mot de passe doit contenir au minimum 8 caractères, maximum 50 caractères, majuscule, minuscule, chiffre et un caractère spécial ! # @ % & * + -";
        header('location:./register.php');
        exit();
    endif;
    // fin controle caractères
    //_________________________
    
    //Enregistrement BDD: 

    if($_POST['password'] == $_POST['confirmPassword'] ):

        $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
        executeRequete("INSERT INTO user (email, password, roles) VALUES (:email,:password, :roles)", array(
        ':email'=>$_POST['email'],
        ':password'=>$mdp,
        ':roles'=>'ROLE_USER'
        ));

        $_SESSION['messages']['success'][]="Félicitation, vous êtes à présent inscrit.e";
        header('location:./login.php');
        exit();

    else:
        $_SESSION['messages']['danger'][]="Les mots de passe ne correspondent pas ";
        header('location:./login.php');
        exit();
    endif; //fin enregistrement

endif; //fin if(!empty($_POST)):

?>

<body>
    <div id="particles-js"></div>
    <body class="register">
        <div class="container">
            <div class="register-container-wrapper clearfix">
                <div class="welcome"><strong>Sign Up :</strong></div>

                <form class="form-horizontal register-form">
                    <div class="form-group relative email">
                        <input id="email" class="form-control input-lg" type="email" placeholder="Email">
                    </div>
                    <br>
                    <div class="form-group relative password">
                        <input id="register_password" class="form-control input-lg" type="password" placeholder="Password">
                    </div>
                    <br>
                    <div class="form-group relative password">
                        <input id="register_confirm_password" class="form-control input-lg" type="password" placeholder="Confirm Password">
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