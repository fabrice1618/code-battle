<?php 


function runHomeController()
{
    global $aProfil;

    readProfilModel();

    homeView();


}