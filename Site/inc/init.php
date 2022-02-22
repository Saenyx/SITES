<!-- PHP page init.php: -->
<!-- Associé au dossier security -->


<?php

$pdo= new PDO('mysql:host=localhost;dbname=site_streaming', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
//ICI: changer password si vous n'êtes pas sur Mac pour ''.

session_start();

define('SITE', '/01-Cours/Site/'); // ICI: indiquer votre propre chemin d'acces

$contenu='';

function debug($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

//--------
// Security: 
//--------

//  ExecuteRequete():
function executeRequete($requete, $param=array()){
    $order=false;
    foreach ($param as $marqueur => $valeur) {
        if ($marqueur==':amount'):
          $order=true;
        endif;
        $param[$marqueur] = htmlspecialchars($valeur);
    } 
    global $pdo; 
    $resultat=$pdo->prepare($requete); 
    $success=$resultat->execute($param); 

    if ($order):
        $id=$pdo->lastInsertId();
    endif;

    if ($success){ 
        if ($order):
            return $id;
        else:
            return $resultat;
        endif;
    } else {
        return false; 
    }
} // fin function executeRequete

// connect()
function connect(){
    if(isset($_SESSION['user'])):
        return true;
    else:
        return false;
    endif;
} //fin connect

// admin()
function admin(){
    if(connect() && $_SESSION['user']['roles']=='ROLE_ADMIN'):
        return true; 
    else: 
        return false;
    endif;     
} // fin admin

