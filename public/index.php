<?php

require_once("../app/homeController.php");
require_once("../app/profilController.php");
require_once("../app/skillsController.php");
require_once("../app/skillsCompetenceController.php");
require_once("../app/skillsSavoirfaireController.php");

require_once("../app/profilModel.php");

require_once("../app/homeView.php");
require_once("../app/profilView.php");


$aProfil = array();
/*
$aProfil["nom"] = "Toto";
$aProfil["prenom"] = "tata";
$aProfil["presentation"] = "I love PHP :)";
$aProfil["email"] = "fabrice1618@gmail.com";

readProfilModel();

print_r($aProfil);
*/


if ( ! isset($_GET['url']) || empty($_GET['url']) ) {
    $sURL = 'home';
} else {
    $sURL = $_GET['url'];
}

// Notre super router
switch ($sURL) {
    case 'profil':
        $sController = 'runProfilController';
        break;
    case 'skills':
        $sController = 'runSkillsController';
        break;
    case 'skills-competence':
        $sController = 'runSkillsCompetenceController';
        break;
    case 'skills-savoirfaire':
        $sController = 'runSkillsSavoirfaireController';
        break;
                        
    case 'home':
    default:
        $sController = 'runHomeController';
//        runHomeController();
        break;
}

// Executer le controller
$sController();
