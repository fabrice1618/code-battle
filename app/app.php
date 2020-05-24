<?php 

/*
    Gestion des parametres de requete $_GET et $_POST
*/
function appRequestParamSetdefault( $sParamName, $sRequestMethod, $val_defaut = null )
{
    global $aApp;

    if ( ! isset($aApp['request_param'][$sParamName]['request_method']) ) {
        $aApp['request_param'][$sParamName]['request_method'] = $sRequestMethod;

        $aApp['request_param'][$sParamName]['value'] = $val_defaut;
        $aApp['request_param'][$sParamName]['init'] = 'default';
    }
}

function appRequestParamRead( $sParamName, $sRequestMethod )
{
    global $aApp;

    // Initialiser le parametre suivant la REQUEST METHOD
    switch ($sRequestMethod) {
        case 'get':
            if ( isset($_GET[$sParamName]) && !empty($_GET[$sParamName]) ) {
                $aApp['request_param'][$sParamName]['value'] = $_GET[$sParamName];
                $aApp['request_param'][$sParamName]['init'] = 'get';
            }
            break;
        case 'post':
            if ( isset($_POST[$sParamName]) && !empty($_POST[$sParamName]) ) {
                $aApp['request_param'][$sParamName]['value'] = $_POST[$sParamName];
                $aApp['request_param'][$sParamName]['init'] = 'post';
            }
            break;
        case 'both':
            // POST d'abord puis GET
            if ( isset($_POST[$sParamName]) && !empty($_POST[$sParamName]) ) {
                $aApp['request_param'][$sParamName]['value'] = $_POST[$sParamName];
                $aApp['request_param'][$sParamName]['init'] = 'post';
            }
            if ( 
                $aApp['request_param'][$sParamName]['init'] == 'default' && 
                isset($_GET[$sParamName]) && 
                !empty($_GET[$sParamName]) 
                ) {
                $aApp['request_param'][$sParamName]['value'] = $_GET[$sParamName];
                $aApp['request_param'][$sParamName]['init'] = 'get';
            }
            break;
    }
}

function appRequestParam( $sParamName )
{
    global $aApp;


    if ( $aApp['request_param'][$sParamName]['init'] == 'default' ) {
        appRequestParamRead( $sParamName, $aApp['request_param'][$sParamName]['request_method'] );
    }

    if ( isset($aApp['request_param'][$sParamName]['value']) ) {
//        echo "appRequestParam('$sParamName') => " . $aApp['request_param'][$sParamName]['value'] . " " . $aApp['request_param'][$sParamName]['init'] . "<br>";
        return($aApp['request_param'][$sParamName]['value']);
    } else {
        return(null);
    }
}

/*
    Gestion des données stockées 'data'
*/
function appSetData( $sParamName, $value = null )
{
    global $aApp;

    $aApp['data'][$sParamName] = $value;
}

function appGetData( $sParamName )
{
    global $aApp;

    if (isset($aApp['data'][$sParamName])) {
        return($aApp['data'][$sParamName]);
    } else {
        return(null);
    }

}
