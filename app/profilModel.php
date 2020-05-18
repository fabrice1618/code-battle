<?php 

function createProfilModel()
{
    global $aProfil;

    $sJSONProfil = json_encode($aProfil); 

    $fp = fopen('profil.json', 'w');
    fwrite($fp, $sJSONProfil);
    fclose($fp);

}

function readProfilModel()
{
    global $aProfil;

    if (file_exists('profil.json')) {
        $fp = fopen('profil.json', 'r');
        $sJSONProfil = fread($fp, 4096);
        fclose($fp);
        
        $aProfil = json_decode($sJSONProfil, true);
    } else {
        createProfilModel();
    }


}

function updateProfilModel()
{
    
}

function deleteProfilModel()
{
    
}
