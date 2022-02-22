<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/register.css">
	<title>Login form</title>
</head>

<!-- PHP page login.php -->

<?php 


require_once '../inc/init.php';

if(connect()):
    header('location:../');  //ICI: chemin page d'accueil
    exit();
endif;

// Indentification à partir du mail: 
if(!empty($_POST)):
    $resultat=executeRequete(" SELECT * FROM user WHERE email=:email", 
    array(':email'=>$_POST['email']
    ));
    
    // session existante: 
    if($resultat->rowCount() == 1):
        $user=$resultat->fetch(PDO::FETCH_ASSOC);

        // verif mdp: 
        if(password_verify($_POST[ 'password'],$user['password'])):
            $_SESSION['user']=$user;
            $_SESSION['messages']['success'][]="Vous êtes à présent connecté.e";
            header('location:../'); //ICI: chemin page d'accueil
            exit();
        else: 
            $_SESSION['messages']['danger'][]="Erreur sur le mot de passe";
            header('location:./login.php');
            exit();
        endif; // fin verif mdp

    //la session n'existe pas: 
    elseif($resultat->rowCount() == 0):
        $_SESSION['messages']['danger'][]="Il n'existe pas de compte relié à cette adresse mail";
        header('location:./login.php'); //ICI: chemin page login 
        exit();

    // une erreur est survenue 
    elseif($resultat->rowCount() > 1):
        $_SESSION['messages']['danger'][]="Une erreur est survenue; merci de contacter l'administrateur du site";
        header('location:./login.php'); //ICI: chemin page login 
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

				<form class="form-horizontal register-form">
					<div class="form-group relative email">
						<input id="email" class="form-control input-lg" type="email" placeholder="Email">
					</div>
					<br>
					<div class="form-group relative password">
						<input id="register_password" class="form-control input-lg" type="password" placeholder="Password">
					</div>
					<div class="checkbox pull-right">
						<label> <a class="forget" href="./forgot_password.php" title="forget">Forgot your password</a> </label>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-lg btn-block">Log In</button>
					</div>
					<div class="checkbox pull-left">
			    		<label><input type="checkbox"> Remember</label>
			  		</div>
				</form>
			</div>
		</div>

	</body>
</body>

</html>