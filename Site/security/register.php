<?php require_once './init.php';   ?>
<!doctype html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STREAMLABS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/lux/bootstrap.min.css"
          integrity="sha512-B5sIrmt97CGoPUHgazLWO0fKVVbtXgGIOayWsbp9Z5aq4DJVATpOftE/sTTL27cu+QOqpI/jpt6tldZ4SwFDZw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= SITE.'css/style.css'; ?>">
    <link rel="icon" type="image/png" href="<?= SITE ?>img-vid/streamlabs-obs.png" sizes="16x16" />
</head>
<body>



    
<?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])):
  foreach ($_SESSION['messages'] as $type => $mess):
    foreach ($mess as $key => $message):?>

      <div class="alert alert-<?= $type; ?> text-center">
        <p><?= $message; ?></p>
      </div>
      <?php unset($_SESSION['messages'][$type][$key]); ?>
    <?php endforeach; 
  endforeach; 
endif; ?>




<!-- // PHP page register.php: -->

<?php 

if (!empty($_POST)):
    //die('coucou');

    //controles mdp: 
    
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
    
    //_____________

    // Controles email: 
     
    $resultat = executeRequete("SELECT * FROM user WHERE email=:email", array(
        ':email' => $_POST['email']
    ));

    //mail existe déjà: 
    if ($resultat->rowCount() !== 0):
        $_SESSION['messages']['danger'][] = "Un compte existe déjà à cette adresse mail";
        header('location:<?= SITE ?>register.php');
        exit();
    endif; //fin mail existe déjà

    // mail invalide
    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):
        $_SESSION['messages']['danger'][] = "email invalide";
        header('location:<?= SITE ?>register.php');
        exit();
    endif;  //fin mail invalide

    // controle caractères
    if(!password_strength_check($_POST['password'])):
        $_SESSION['messages']['danger'][] = "Votre mot de passe doit contenir au minimum 6 caractères, maximum 15 caractères,majuscule, minuscule et un caractère spécial ! # @ % & * + -";
        header('location:<?= SITE ?>register.php');
        exit();
    endif; // fin controle caractères

    //__________________

    // Enregistrement: 
    if ($_POST['password'] == $_POST['confirmPassword']):

        $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
        executeRequete("INSERT INTO user (email, password, roles) VALUES (:email, :password, :roles)", array(
            ':email' => $_POST['email'],
            ':password' => $mdp,
            ':roles' => 'ROLE_USER'
        ));

        $_SESSION['messages']['success'][] = "Félicitation, vous êtes à présent inscrit.e";
        header('location:<?= SITE ?>login.php');
        exit();

    else:
        $_SESSION['messages']['danger'][] = "Les mots de passe ne correspondent pas";
        header('location:<?= SITE ?>register.php');
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
						<label> <a class="forget" href=".<?= SITE ?>security/login.php" title="forget">Already have an account ? Log in</a> </label>
					</div>
                </form>
            </div>

        </div>

    </body>
</body>

</html>


<?php  require_once '.<?= SITE ?>inc/footer.php'?>
