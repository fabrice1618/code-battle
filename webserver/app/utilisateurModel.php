<?php 



function utilisateurModelCreate( $aData )
{

}

function utilisateurModelRead( $nId )
{
    global $aTableUser;

    return($aTableUser[$nId]);
}

function utilisateurModelUpdate( $nId, $aData )
{

}

function utilisateurModelUpdateField( $nId, $sField, $value )
{
    $aUser = utilisateurModelRead( $nId );
    $aUser[$sField] = $value;
    utilisateurModelUpdate( $nId, $aUser );
}

function utilisateurModelDelete( $nId )
{

}

function utilisateurModelIndex()
{
    global $aTableUser;

    return( $aTableUser );
}

function utilisateurModelFindEmail( $sEmail )
{
    global $aTableUser;

    $nUserId = 0;

    foreach ($aTableUser as $key => $aUser) {
        if ($aUser['email']==$sEmail) {
            $nUserId = $key;
        }
    }

    return($nUserId);
}

function utilisateurModelGroupeUpdate( $nId, $aGroupes ) 
{

}

function utilisateurModelGroupeReadText($nId)
{
    return("DWWM 2019/2020, TSSR 2019/2020");
}

function utilisateurModelMembreReadText($nId)
{
    return("DWWM 2019/2020");
}
