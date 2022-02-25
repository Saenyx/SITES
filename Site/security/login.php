<!-- Header security -->
<?php require_once '../inc/init.php'?> 

<?php
if(isset($_GET['unset'])):
  unset($_SESSION['user']);
endif;
?>


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




<!-- PHP page login.php -->

<?php 


// Indentification à partir du mail: 
if(!empty($_POST)):
    $resultat=executeRequete(" SELECT * FROM user WHERE email=:email", 
    array(':email'=>$_POST['email']
    ));
    
    // session existante: 
    if($resultat->rowCount() == 1):
        $user=$resultat->fetch(PDO::FETCH_ASSOC);

        // verif mdp: 
        if(password_verify($_POST['password'],$user['password'])):
            $_SESSION['user']=$user;
            $_SESSION['messages']['success'][]="Vous êtes à présent connecté.e";
            header('location:../'); 
            exit();
        else: 
            $_SESSION['messages']['danger'][]="Erreur sur le mot de passe";
            header('location:./login.php');
            exit();
        endif; // fin verif mdp

    //la session n'existe pas: 
    elseif($resultat->rowCount() == 0):
        $_SESSION['messages']['danger'][]="Il n'existe pas de compte relié à cette adresse mail";
        header('location:./login.php');
        exit();

    // une erreur est survenue 
    elseif($resultat->rowCount() > 1):
        $_SESSION['messages']['danger'][]="Une erreur est survenue; merci de contacter l'administrateurice du site";
        header('location:./login.php'); 
        exit();

    endif; //fin if($resultat->rowCount() == 1):
endif; //fin ident. mail

?>

<body>
	<div id="particles-js"></div>
	  <body class="register">
		  <div class="container">
			  <div class="register-container-wrapper clearfix">
				  <div class="welcome"><strong>Sign In :</strong></div>
				  <form method="post" action="" class="form-horizontal register-form">
					  <div class="form-group relative email">
						<input value="" name="email" id="inputEmail" class="form-control input-lg" type="email" placeholder="Email">
					  </div>
					  <br>
					  <div class="form-group relative password">
						<input name="password" id="inputPassword" class="form-control input-lg" type="password" placeholder="Password">
					  </div>
					  <div class="checkbox pull-right">
					<a class="forget" href="./security/forgot_password.php" title="forget">Forgot your password</a> </label>
					  </div>
					  <br>
					  <div class="form-group">
						<button type="submit" class="btn btn-success btn-lg btn-block">Log In</button>
            <a href="./security/register.php" class="btn btn-success btn-lg btn-block">REGISTER</a>
            </form>
					  </div>
				  </form>
			  </div>
		  </div>
    </body>
  </div>
</body>

</html>


<?php  require_once '../inc/footer.php'?>
