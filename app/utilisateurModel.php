<?php 

function utilisateurModelCreate( $aData )
{

}

function utilisateurModelRead( $nId )
{
    return([
        'id' => 1, 
        'email' => 'email@example.com',
        'hash' => '//hashpwd**',
        'type' => 'admin',
        'status' => "A"
        ]);
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
    return( [   
        [ 'userid' => 1, 'email' => 'toto@example.com', 'type' => 'admin',      'status' => "A" ],
        [ 'userid' => 2, 'email' => 'tata@example.com', 'type' => 'admin',      'status' => "A" ],
        [ 'userid' => 3, 'email' => 'titi@example.com', 'type' => 'admin',      'status' => "I" ],
        [ 'userid' => 4, 'email' => 'toto@example.com', 'type' => 'formateur',  'status' => "A" ],
        [ 'userid' => 5, 'email' => 'tata@example.com', 'type' => 'formateur',  'status' => "A" ],
        [ 'userid' => 6, 'email' => 'titi@example.com', 'type' => 'formateur',  'status' => "I" ],
        [ 'userid' => 7, 'email' => 'toto@example.com', 'type' => 'membre',     'status' => "A" ],
        [ 'userid' => 8, 'email' => 'tata@example.com', 'type' => 'membre',     'status' => "A" ],
        [ 'userid' => 9, 'email' => 'titi@example.com', 'type' => 'membre',     'status' => "I" ]
    ]);

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
