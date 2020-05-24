<?php 

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

function isAuthLogin()
{
    return(true);
}

function isAuthToken()
{
    $sToken = appRequestParam('token');
    // Comparer le token recu par la requete et celui stocké dans la session
    // Stocker plusieurs token dans la session pour gérer le multi-session
    return(true);
}

function authNewToken()
{
    return('0123456789abcdef');
}

function authGetNewPassword()
{
    return(['password'=>'hashpassword', 'hash' => '**12345//']);
}