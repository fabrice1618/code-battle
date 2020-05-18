<?php
//print_r($_SERVER);

$sBasePath = $_SERVER['CONTEXT_DOCUMENT_ROOT'];
//echo "DIR:".__DIR__;

require_once($sBasePath . "/app/homeController.php");
require_once($sBasePath . "/app/profilController.php");
require_once($sBasePath . "/app/skillsController.php");
require_once($sBasePath . "/app/skillsCompetenceController.php");
require_once($sBasePath . "/app/skillsSavoirfaireController.php");



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
