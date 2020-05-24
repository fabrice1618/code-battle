<?php
require_once("../app/auth.php");
require_once("../app/view.php");
require_once("../app/app.php");

// Les variables d'application
$aApp = array();
appRequestParamSetdefault( 'url', 'get', 'home' );

// Notre super router
if ( ! loadController( appRequestParam('url') ) ) {
    loadController( 'error' );
}
// Executer le controller
appGetData('controller')();

/// Fin du programme principal
//////////////////////////////


// Chargement automatique des controlleurs
function loadController( $sController )
{
    $sControllerName = $sController.'Controller';
    if (! function_exists($sControllerName)) {
        // Si le controller n'est pas disponible le charger
        $sFileName = '../app/' . $sControllerName.'.php';
        if ( file_exists($sFileName) ) {
          require_once($sFileName);
        }
        appSetData( 'controller', $sControllerName );
    } 

    return( function_exists($sControllerName) );
}


// Fabrique une URL avec un nom de controlleur et un tableau de parametres
// Format: controller?param1=val1&param2=val2
function routerMakeURL( $sController, $aParam = [] )
{
    $sURL = "";
    $sFileName = '../app/'.$sController . 'Controller.php';

    if ( ! empty($sController) && file_exists($sFileName) ) {
        // Le fichier controller à été trouvé
        $sParam = '';
        foreach ($aParam as $key => $value) {
            $sPart = urlencode($key) . "=" . urlencode($value);
            if ( ! empty($sParam) ) {
                $sParam .= '&' . $sPart;
            } else {
                $sParam = $sPart;
            }
        }

        // URL = controller
        $sURL = '/'.$sController;
        if ( ! empty($sParam) ) {
            // Ajouter les parametres
            $sURL .= '?' . $sParam;
        }
    }

    return($sURL);
}