<?php

echo "Hello world";
exit(0);

require_once("../app/auth.php");
require_once("../app/view.php");
require_once("../app/app.php");

// Données simulées pour les tests
require_once("../app/fake.php");

// Session
session_set_cookie_params( 120 );   // Durée de session 2 minutes pendant les tests
session_start();

// Debug
/*
echo "Get:" . print_r($_GET, true) . '<br>';
echo "Post:" . print_r($_POST, true) . '<br>';
echo "Session:" . print_r($_SESSION, true) . '<br>';
echo "Cookies:" . print_r($_COOKIE, true) . '<br>';
*/

// Les variables d'application
$aApp = array();
appRequestParamSetdefault( 'url',           'get',  'home' );
appRequestParamSetdefault( 'action',        'get',  'index' );
appRequestParamSetdefault( 'token',         'both', 'index' );
appRequestParamSetdefault( 'loginEmail',    'post', 'index' );
appRequestParamSetdefault( 'loginPassword', 'post', 'index' );
appRequestParamSetdefault( 'loginRemember', 'post', 'index' );

// Notre super router
if ( ! loadController( appRequestParam('url') ) ) {
    loadController( 'error' );
}

//Gestion de la connexion
/////////////////////////
if ( isset($_SESSION['userid']) && $_SESSION['userid']!=0 ) {
    // session connectee
    if ( appRequestParam('action')=='logout' ) {
        // Action logout
        $_SESSION['userid'] = 0;
        $aApp['user'] = authUserInfo( 0 );
    } else {
        // Recuperer les infos utilisateur
        $aApp['user'] = authUserInfo( $_SESSION['userid'] );
    }

} else {
    // Session non connectée
    if ( appRequestParam('action')=='login' ) {
        // Action login
        if ( authLoginCheck( appRequestParam('loginEmail'), appRequestParam('loginPassword') ) ) {

            $aApp['user'] = authUserInfo( authUserid( appRequestParam('loginEmail') ) );
            if ($aApp['user']['status']=='A') {
                // L'utilisateur ne peut se conneter que si son compte est actif
                $_SESSION['userid'] = $aApp['user']['userid'];
            }
        }
    } else {
        // Utilisateur non connecte, aucunes infos !
        $aApp['user'] = authUserInfo( 0 );
    }
}

// Executer le controller
appGetData('controller')();

// Ecrire la session sur disque
session_write_close();

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