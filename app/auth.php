<?php 
require_once("../app/utilisateurModel.php");

/*
function isAuth( $sType )
{
    switch ($sType) {
        case 'admin':
            $bReturn = true;
            break;
        case 'formateur':
            $bReturn = false;
            break;
        case 'membre':
            $bReturn = false;
            break;
        default:
            $bReturn = false;
            break;
    }

    return($bReturn);
}
*/

function authUserid($sEmail)
{
    return(utilisateurModelFindEmail( $sEmail ));
}

function authUserInfo( $nId )
{
    if ($nId != 0) {
        $aUser = utilisateurModelRead( $nId );
        return([ 'userid'=>$aUser['userid'], 'email'=>$aUser['email'], 'type'=>$aUser['type'], 'status'=>$aUser['status'] ]);
    } else {
        return([ 'userid'=>0, 'email'=>'', 'type'=>'', 'status'=>'' ]);
    }
    

    
}

function isAuthLogin()
{
    if (isset($_SESSION['userid']) && $_SESSION['userid'] != 0) {
        return(true);
    } else {
        return(false);
    }    
}

// Ne vérifie pas les mots de passe pendant les tests
// Verifie uniquement existence de l'utilisateur
function authLoginCheck( $sEmail, $sPassword )
{
    // ID = 0 si l'utilisateur n'existe pas
    if ( utilisateurModelFindEmail($sEmail) > 0 ) {
        return(true);
    }
    
    return(false);
}

function isAuthToken()
{
    $sToken = appRequestParam('token');
    // Comparer le token recu par la requete et celui stocké dans la session
    // Stocker plusieurs token dans la session pour gérer le multi-session

    $bTokenTrouve = false;
    $aToken = $_SESSION['token'];
    foreach ($aToken as $key => $value) {
        
        if (time() - $value > 86400 ) {
            // Token expiré plus de 24h, le supprimer
            unset($aToken[$key]);
        } else {
            if ($sToken=$key) {
                $bTokenTrouve = true;
            }
        } 
    }

    $_SESSION['token'] = $aToken;

    return($bTokenTrouve);
}

function authNewToken()
{
    // Token, toujours pareil 
    $sToken = '0123456789abcdef';

    $_SESSION['token'][$sToken] = time();

    return($sToken);
}

function authGetNewPassword()
{
    return(['password'=>'hashpassword', 'hash' => '**12345//']);
}