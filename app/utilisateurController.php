<?php 
require_once("../app/utilisateurModel.php");

    /* Actions de ce controller
    index (par défaut)
    ajouter             display:+fieldset ajouter, -bouton ajouter
    add                 database:insert utilisateur
                        post: token, inputUtilEmail, inputUtilType
    groupe              display:+fieldset groupe
                        get:userid
    modifgroupe         database:modif des affectations
                        post: token, inputUtilEmail, inputUtilGroupe array des valeurs selectionnées
    supprimer           database:delete utilisateur
                        get: userid, token
    toformateur         database:changer type formateur
                        get: userid, token
    toadmin             database:changer type admin
                        get: userid, token
    desactive           database:desactive le compte
                        get: userid, token
    active              database:active le compte
                        get: userid, token
    newpwd              database:attribue un nouveau mot de passe
                        get: userid, token
    */


function utilisateurController()
{

    appRequestParamSetdefault( 'action', 'get', 'index' );
    appRequestParamSetdefault( 'token', 'post', '' );
    appRequestParamSetdefault( 'userid', 'both', 0 );
    appRequestParamSetdefault( 'inputUtilEmail', 'post', '' );
    appRequestParamSetdefault( 'inputUtilType', 'post', 'null' );
    appRequestParamSetdefault( 'inputUtilGroupe', 'post', [] );

    // Suivant l'action faire quelque chose, puis afficher la liste
    switch ( appRequestParam('action') ) {
        case 'index':
        case 'ajouter':
        case 'groupe':
            break;

        case 'add':
            if ( isAuthToken() ) {
                utilisateurModelCreate( [ 
                    'id' => 0, 
                    'email' => appRequestParam('inputUtilEmail'),
                    'type' => appRequestParam('inputUtilType'),
                    'status' => "A"        
                    ] );
            }
            break;
    
        case 'modifgroupe':
            if ( isAuthToken() ) {
                utilisateurModelGroupeUpdate( appRequestParam('userid'), appRequestParam('inputUtilGroupe') );
            }
            break;
    
        case 'supprimer':
            if ( isAuthToken() ) {
                utilisateurModelDelete( appRequestParam('userid') );
            }
            break;

        case 'toformateur':
            if ( isAuthToken() ) {
                utilisateurModelUpdateField( appRequestParam('userid'), 'type', 'formateur' );
            }
            break;
        
        case 'toadmin':
            if ( isAuthToken() ) {
                utilisateurModelUpdateField( appRequestParam('userid'), 'type', 'admin' );
            }
            break;
        
        case 'desactive':
            if ( isAuthToken() ) {
                utilisateurModelUpdateField( appRequestParam('userid'), 'status', 'I' );
            }
            break;

        case 'active':
            if ( isAuthToken() ) {
                utilisateurModelUpdateField( appRequestParam('userid'), 'status', 'A' );
            }
            break;

        case 'newpwd':
            if ( isAuthToken() ) {
                $aPwd = authGetNewPassword();
                utilisateurModelUpdateField( appRequestParam('userid'), 'hash', $aPwd['hash'] );
            }
            break;
    }

    // Suivant l'action faire quelque chose, puis afficher la liste
    appSetData( 'token', authNewToken() );  // generer un nouveau token

    // Recuperer les données à afficher
    $aUserList = utilisateurModelIndex();
    foreach ($aUserList as $key => $aUser) {
        $sDescription = "";
        if ($aUser['type'] == 'formateur') {
          $sDescription = utilisateurModelGroupeReadText($aUser['userid']);
        } elseif ($aUser['type'] == 'membre') {
          $sDescription = utilisateurModelMembreReadText($aUser['userid']);
        }
    
        $aUserList[$key]['view_groupe'] = $sDescription;
    }
    appSetData( 'user_list', $aUserList ); // Liste des utilisateurs à afficher

    viewRender("utilisateurView");
}