<?php 

function runProfilController()
{
    global $aProfil;

    readProfilModel();

    profilView();

}