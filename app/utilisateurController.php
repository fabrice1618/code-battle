<?php 
require_once("../app/utilisateurModel.php");

    /* Actions de ce controller
    index (par défaut)
    addform             display:+fieldset ajouter, -bouton ajouter
    add                 database:insert utilisateur
                        post: token, inputUtilEmail, inputUtilType
    groupeform          display:+fieldset groupe
                        get:userid
    groupe              database:modif des affectations
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
    if ( isAuthToken() ) {
        switch ( appRequestParam('action') ) {
            case 'index':
            case 'addform':
            case 'groupeform':
                break;
    
            case 'add':
                utilisateurModelCreate( [ 
                    'id' => 0, 
                    'email' => appRequestParam('inputUtilEmail'),
                    'type' => appRequestParam('inputUtilType'),
                    'status' => "A"        
                    ] );
                break;
        
            case 'groupe':
                utilisateurModelGroupeUpdate( appRequestParam('userid'), appRequestParam('inputUtilGroupe') );
                break;
        
            case 'supprimer':
                utilisateurModelDelete( appRequestParam('userid') );
                break;
    
            case 'toformateur':
                utilisateurModelUpdateField( appRequestParam('userid'), 'type', 'formateur' );
                break;
            
            case 'toadmin':
                utilisateurModelUpdateField( appRequestParam('userid'), 'type', 'admin' );
                break;
            
            case 'desactive':
                utilisateurModelUpdateField( appRequestParam('userid'), 'status', 'I' );
                break;
    
            case 'active':
                utilisateurModelUpdateField( appRequestParam('userid'), 'status', 'A' );
                break;
    
            case 'newpwd':
                $aPwd = authGetNewPassword();
                utilisateurModelUpdateField( appRequestParam('userid'), 'hash', $aPwd['hash'] );
                break;
        }
    }

    // Suivant l'action faire quelque chose, puis afficher la liste
    authNewToken();  // generer un nouveau token

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